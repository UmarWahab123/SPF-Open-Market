<?php

namespace Modules\PaymentGateway\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Repositories\OrderRepository;
use \Modules\Wallet\Repositories\WalletRepository;
use Modules\Account\Repositories\TransactionRepository;
use Modules\Account\Entities\Transaction;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use App\Traits\Accounts;
use Carbon\Carbon;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\UserActivityLog\Traits\LogActivity;
use Stripe;
use Modules\FrontendCMS\Entities\PricingPlan;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;

class StripeController extends Controller
{
    use Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    } 

    public function payment_page(Request $request)
    {
         return view('paymentgateway::stripe_payment.create');
    }
    public function stripePost($data)
    {
        if (session()->has('customer_subscription_payment')) {
            $currency_code = auth()->user()->currency_code;
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            try {
                 $user = auth()->user();
                   if (!$user->stripe_customer_id) {
                        $stripeCustomer = Stripe\Customer::create([
                            'email' => $user->email,
                            'name' => $user->name,
                            'source' => $data['stripeToken'], 
                        ]);
                        $user->stripe_customer_id = $stripeCustomer->id;
                        $user->save();
                    }
                    $pricingPlanId = $data['pricing_plan_id'];
                    $pricing_plan = PricingPlan::findOrFail($pricingPlanId);
        
                    $newStripeSubscription = Stripe\Subscription::create([
                        'customer' => $user->stripe_customer_id, 
                        'items' => [[
                            'price' => $pricing_plan->stripe_price_id, 
                        ]],
                        'expand' => ['latest_invoice.payment_intent'],
                    ]);
                    $pricingPlanId = $data['pricing_plan_id'];
                    $pricing_plan = PricingPlan::findOrFail($pricingPlanId);
                    $defaultIncomeAccount = $this->defaultIncomeAccount();
                    $transactionRepo = new TransactionRepository(new Transaction);
                    $transaction = $transactionRepo->makeTransaction(auth()->user()->name . "- Customer Subscription Payment", "in", "Stripe", "customer_subscription_payment", $defaultIncomeAccount, "Customer Subscription Payment", auth()->user(), $data['bank_amount'], Carbon::now()->format('Y-m-d'), auth()->user()->id, null, null);
    
                    DB::transaction(function () use ($transaction, $pricing_plan, $newStripeSubscription) {
                        $existingPlans = CustomerSubscriptionPaymentInfo::where('customer_id', auth()->user()->id)
                            ->where(function ($query) {
                                $query->where('status', 'Pending')
                                    ->orWhere('status', 'Active');
                            })
                            ->get();
    
                        if ($existingPlans->isNotEmpty()) {
                            foreach ($existingPlans as $plan) {
                                $plan->update(['status' => 'Cancel']);
                            }
                        }
    
                        $customer_subscription_info = CustomerSubscriptionPaymentInfo::create([
                            'transaction_id' => $transaction->id,
                            'txn_id' => "none",
                            'customer_id' => auth()->user()->id,
                            'pricing_plan_id' => $pricing_plan->id,
                            'status' => 'Pending',
                            'stripe_subscription_id' =>$newStripeSubscription->id,
                        ]);
                        $assign_plan_to_customer = User::where('id', auth()->user()->id)->first();
                        if ($assign_plan_to_customer) {
                            $assign_plan_to_customer->plan_id = $pricing_plan->id;
                            $assign_plan_to_customer->status = 'Pending';
                            $assign_plan_to_customer->save();
                        }
                    });
                      // Get all existing subscriptions for the customer
                    $existingSubscriptions = Stripe\Subscription::all([
                        'customer' => $user->stripe_customer_id,
                        'status' => 'active',  // Only retrieve active subscriptions
                    ]);
                  // Cancel all subscriptions except the latest one
                    if (count($existingSubscriptions->data) > 1) {
                        foreach ($existingSubscriptions->data as $subscription) {
                            if ($subscription->id != $newStripeSubscription->id) {
                                // Use the subscription object to call the cancel method
                                $subscription->cancel();  // Immediately cancel the subscription
                            }
                        }
                    }
                    $stripe = Stripe\Charge::create([
                        "amount" => round($data['bank_amount'] * 100),
                        "currency" => $currency_code,
                        "customer" => $user->stripe_customer_id, 
                        "description" => "Payment from " . url('/')
                    ]);
                LogActivity::successLog('Customer Subscription payment successful.');
                return true;
            } catch (Exception $e) {
                Toastr::error($e->getMessage(), __('common.error'));
                return redirect()->back();
            }
        } else {
            $currency_code = getCurrencyCode();
            $credential = $this->getCredential();
            Stripe\Stripe::setApiKey(@$credential->perameter_3);

            try {
                $stripe = Stripe\Charge::create([
                    "amount" => round($data['amount'] * 100),
                    "currency" => $currency_code,
                    "source" => $data['stripeToken'],
                    "description" => "Payment from " . url('/')
                ]);
            } catch (Exception $e) {
                Toastr::error($e->getMessage(), __('common.error'));
                return redirect()->back();
            }
        }
        if ($stripe['status'] == "succeeded") {
            $return_data = $stripe['id'];

            // Wallet recharge logic
            if (session()->has('wallet_recharge')) {
                $walletService = new WalletRepository;
                return $walletService->walletRecharge($data['amount'], $credential->method->id, $return_data);
            }

            // Order payment logic
            if (session()->has('order_payment')) {
                $orderPaymentService = new OrderRepository;
                $order_payment = $orderPaymentService->orderPaymentDone($data['amount'], $credential->method->id, $return_data, (auth()->check()) ? auth()->user() : null);
                if ($order_payment == 'failed') {
                    Toastr::error('Invalid Payment');
                    return redirect(url('/checkout'));
                }
                $payment_id = $order_payment->id;
                Session()->forget('order_payment');
                LogActivity::successLog('Order payment successful.');
                return $payment_id;
            }

            // Seller subscription payment logic
            if (session()->has('subscription_payment')) {
                $defaultIncomeAccount = $this->defaultIncomeAccount();
                $seller_subscription = getParentSeller()->SellerSubscriptions;
                $transactionRepo = new TransactionRepository(new Transaction);
                $transaction = $transactionRepo->makeTransaction(getParentSeller()->first_name . " - Subscription Payment", "in", "Bank Payment", "subscription_payment", $defaultIncomeAccount, "Subscription Payment", $seller_subscription, $data['amount'], Carbon::now()->format('Y-m-d'), getParentSellerId(), null, null);
                $seller_subscription->update(['last_payment_date' => Carbon::now()->format('Y-m-d')]);

                SubsciptionPaymentInfo::create([
                    'transaction_id' => $transaction->id,
                    'txn_id' => $return_data,
                    'seller_id' => getParentSellerId(),
                    'subscription_type' => getParentSeller()->sellerAccount->subscription_type,
                    'commission_type' => @$seller_subscription->pricing->name
                ]);

                LogActivity::successLog('Subscription payment successful.');
                return true;
            }
        } else {
            return redirect()->route('frontend.welcome');
        }
    }
    private function getCredential(){
        $url = explode('?',url()->previous());
        if(isset($url[0]) && $url[0] == url('/checkout')){
            $is_checkout = true;
        }else{
            $is_checkout = false;
        }
        if(session()->has('order_payment') && app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout') && $is_checkout){
            $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'stripe');
        }else{
            $credential = getPaymentInfoViaSellerId(1, 'stripe');
        }
        return $credential;
    }

}
