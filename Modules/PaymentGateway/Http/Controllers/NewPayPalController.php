<?php

namespace Modules\PaymentGateway\Http\Controllers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Repositories\OrderRepository;
use \Modules\Wallet\Repositories\WalletRepository;
use Modules\Account\Repositories\TransactionRepository;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use Modules\MultiVendor\Entities\SellerSubcription;
use App\Traits\Accounts;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\FrontendCMS\Entities\PricingPlan;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;
use Modules\Account\Entities\Transaction as AccountTransaction;



class NewPayPalController extends Controller
{
    private $apiContext;
    use Accounts;
    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('services.paypal.settings'));
    }
    public function success(Request $request)
    {
        $credential = $this->getCredential();
        $paymentId = $request->payment_id;
        $payerId = $request->payer_id;
        $paymentAmount = $request->amount;
        $paymentStatus = $request->status;
        $pricingPlanId = $request->pricing_plan_id;
        $type = $request->type;

        if ($paymentId && $payerId) {
            try {
                if ($paymentStatus == 'COMPLETED' || $paymentStatus == 'APPROVED') {
                    if ($type === 'customer_subscription_payment') {
                        $pricingPlan = PricingPlan::findOrFail($pricingPlanId);
                        $transactionRepo = new TransactionRepository(new AccountTransaction);
                        $transaction = $transactionRepo->makeTransaction(
                            auth()->user()->name . " - Customer Subscription Payment",
                            "in",
                            "PayPal",
                            "customer_subscription_payment",
                            $this->defaultIncomeAccount(),
                            "Customer Subscription Payment",
                            auth()->user(),
                            $paymentAmount,
                            Carbon::now()->format('Y-m-d'),
                            auth()->user()->id,
                            null, 
                            null
                        );
                        DB::transaction(function () use ($transaction, $pricingPlan, $paymentId) {
                            CustomerSubscriptionPaymentInfo::where('customer_id', auth()->user()->id)
                                ->whereIn('status', ['Pending', 'Active'])
                                ->update(['status' => 'Cancel']);

                            CustomerSubscriptionPaymentInfo::create([
                                'transaction_id' => $transaction->id,
                                'txn_id' => $paymentId,
                                'customer_id' => auth()->user()->id,
                                'pricing_plan_id' => $pricingPlan->id,
                                'status' => 'Pending'
                            ]);

                            auth()->user()->update(['plan_id' => $pricingPlan->id, 'status' => 'Pending']);
                        });
                        LogActivity::successLog('Customer Subscription payment successful.');
                        return response()->json([
                            'success' => true,
                            'message' => 'Subscription payment successful',
                            'type' => 'customer_subscription_payment'
                        ]);
                    } elseif ($type === 'order') {
                        $orderService = new OrderRepository;
                        $orderPaymentResult = $orderService->orderPaymentDone(
                            $paymentAmount,
                            $credential->method->id,
                            $paymentId,
                            auth()->user()
                        );
                        // dd($orderPaymentResult);
                        if ($orderPaymentResult === 'failed') {
                            return response()->json(['success' => false, 'message' => 'Invalid Payment']);
                        }

                        return response()->json([
                            'success' => true,
                            'type' => 'order',
                            'payment_id' => encrypt($orderPaymentResult->id),
                            'gateway_id' => encrypt($credential->method->id)
                        ]);
                    } elseif ($type === 'seller_subscription_payment') {
                        SellerSubcription::create([
                            'seller_id' => session('user_id'),
                            'pricing_id' => $request->pricing_plan_id,
                            'is_paid' => 1,
                            'last_payment_date' =>Carbon::now()->format('Y-m-d'),
                            'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                        ]);
                        LogActivity::successLog('Seller Subscription payment successful.');
                        return response()->json([
                            'success' => true,
                            'message' => 'Seller payment successful',
                            'type' => 'seller_subscription_payment'
                        ]);
                    }
                }

                return response()->json(['success' => false, 'message' => 'Payment failed']);
            } catch (\Exception $e) {
                Toastr::error($e->getMessage(), 'Payment Failed');
                return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid Payment Attempt.']);
    }

    public function cancel()
    {
        // Handle cancel flow like the old paypalFailed method
        if (session()->has('wallet_recharge')) {
            session()->forget('wallet_recharge');
            if (auth()->user()->role->type == 'customer') {
                return redirect(url('wallet/customer/my-wallet-index'))->with('error', 'Payment was canceled!');
            } elseif (auth()->user()->role->type == 'seller') {
                return redirect(url('wallet/seller/my-wallet-index'))->with('error', 'Payment was canceled!');
            } elseif (auth()->user()->role->type == 'admin') {
                return redirect(url('wallet/admin/my-wallet-index'))->with('error', 'Payment was canceled!');
            }
        } elseif (session()->has('order_payment')) {
            session()->forget('order_payment');
            return redirect(url('/checkout'))->with('error', 'Payment was canceled!');
        } elseif (session()->has('subscription_payment')) {
            session()->forget('subscription_payment');
            return redirect()->route('seller.dashboard')->with('error', 'Payment was canceled!');
        }
    
        // Default cancel response
        return redirect(url('/'))->with('error', 'Payment was canceled!');
    }

    private function getCredential(){
        $url = explode('?',url()->previous());
        if(isset($url[0]) && $url[0] == url('/checkout')){
            $is_checkout = true;
        }else{
            $is_checkout = false;
        }
        if(session()->has('order_payment') && app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout') && $is_checkout){
            $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'paypal');
        }else{
            $credential = getPaymentInfoViaSellerId(1, 'paypal');
        }
        return $credential;
    }

   
}
