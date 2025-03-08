<?php

namespace Modules\PaymentGateway\Http\Controllers;
use Illuminate\Routing\Controller;
use Modules\Wallet\Entities\WalletBalance;
use Modules\Wallet\Entities\BankPayment;
use App\Traits\ImageStore;
use Illuminate\Support\Arr;
use Brian2694\Toastr\Facades\Toastr;
use App\Repositories\OrderRepository;
use \Modules\Wallet\Repositories\WalletRepository;
use Modules\Account\Repositories\TransactionRepository;
use Modules\Account\Entities\Transaction;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;
use App\Traits\Accounts;
use Carbon\Carbon;
use App\Models\User;
use Modules\FrontendCMS\Entities\PricingPlan;
use Illuminate\Support\Facades\DB;
use Modules\GeneralSetting\Entities\Currency;
use Modules\UserActivityLog\Traits\LogActivity;
use Unicodeveloper\Paystack\Paystack;

class BankPaymentController extends Controller
{
    use ImageStore, Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }    

    public function store($data)
    {
        if(isset($data['image'])){
            $data = Arr::add($data, 'image_src', $this->saveImage($data['image']));
        }

        if(session()->has('wallet_recharge')){
            $currency_code = auth()->user()->currency_code;
            $currency = Currency::where('code', $currency_code)->first();
            if($currency){
                $amount = $data['deposit_amount'] / $currency->convert_rate;
            }else{
                $amount = $data['deposit_amount'];
            }
        }else{
            $amount = $data['bank_amount'];
        }

        $bank_payment = BankPayment::create([
            'bank_name' => $data['bank_name'],
            'branch_name' => $data['branch_name'],
            'account_number' => $data['account_number'],
            'account_holder' => $data['account_holder'],
            'image_src' => isset($data['image_src'])?$data['image_src']:null,
        ]);
        LogActivity::successLog('bank payment create successful.');
        if (session()->has('wallet_recharge')) {
            $wallet_deposit = WalletBalance::create([
                'walletable_type' => "Modules\Wallet\Entities\BankPayment",
                'walletable_id' => $bank_payment->id,
                'user_id' => auth()->user()->id,
                'type' => "Deposite",
                'amount' => $amount,
                'payment_method' => $data['method'],
            ]);
            session()->forget('wallet_recharge');
            LogActivity::successLog('wallet recharge successful.');
        }elseif (session()->has('order_payment')) {
            session()->put('bank_detail_id', $bank_payment->id);
            session()->forget('order_payment');
            $order_paymentRepo = new OrderRepository;
            $order_payment = $order_paymentRepo->orderPaymentDone($data['bank_amount'], 7, "none", (auth()->check())?auth()->user():null);
            LogActivity::successLog('order payment successful.');
            return $order_payment->id;
        }elseif (session()->has('subscription_payment')) {
            $defaultIncomeAccount = $this->defaultIncomeAccount();
            $seller_subscription = getParentSeller()->SellerSubscriptions;
            $transactionRepo = new TransactionRepository(new Transaction);
            $transaction = $transactionRepo->makeTransaction(getParentSeller()->first_name." - Subsriction Payment", "in", "Bank Payment", "subscription_payment", $defaultIncomeAccount, "Subscription Payment", $seller_subscription, $amount, Carbon::now()->format('Y-m-d'), getParentSellerId(), null, null);
            $seller_subscription->update(['last_payment_date' => Carbon::now()->format('Y-m-d')]);
            $subscription_info = SubsciptionPaymentInfo::create([
                'transaction_id' => $transaction->id,
                'txn_id' => "none",
                'seller_id' => getParentSellerId(),
                'subscription_type' => getParentSeller()->sellerAccount->subscription_type,
                'commission_type' => @$seller_subscription->pricing->name
            ]);
            $bank_payment->update(['itemable_id' => $subscription_info->id, 'itemable_type' => SubsciptionPaymentInfo::class]);
            LogActivity::successLog('Subscription payment successful.');
        }elseif (session()->has('customer_subscription_payment')){
            $pricingPlanId = $data['pricing_plan_id'];
            $subscription_plan = PricingPlan::findOrFail($pricingPlanId);
            $defaultIncomeAccount = $this->defaultIncomeAccount();
            $transactionRepo = new TransactionRepository(new Transaction);
            $transaction = $transactionRepo->makeTransaction(auth()->user()->name."- Customer Subsriction Payment", "in", "Bank Payment", "subscription_payment", $defaultIncomeAccount, "Subscription Payment", auth()->user(), $amount, Carbon::now()->format('Y-m-d'), auth()->user()->id , null, null);
            DB::transaction(function () use ($transaction , $subscription_plan , &$customer_subscription_info) {
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
                    'pricing_plan_id' => $subscription_plan->id,
                    'status' => 'Pending',
                ]);
                $assign_plan_to_customer = User::where('id', auth()->user()->id)->first(); 
                if ($assign_plan_to_customer) {
                    $assign_plan_to_customer->plan_id = $subscription_plan->id;
                    $assign_plan_to_customer->status = 'Pending';              
                    $assign_plan_to_customer->save();                          
                }
            });
            $bank_payment->update(['itemable_id' => $customer_subscription_info->id, 'itemable_type' => CustomerSubscriptionPaymentInfo::class]);
            LogActivity::successLog('Customer Subscription payment successful.');
        }

    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'), env('PAYSTACK_PAYMENT_URL'));
        $payment = $paystack->getPaymentData();
        if ($payment['status'] == "true") {
            if (session()->has('wallet_recharge')) {
                $amount = $payment['data']['amount'] / 100;
                $response = $payment['data']['reference'];
                $walletService = new WalletRepository;
                $walletService->walletRecharge($amount, "PayStack", $response);
                return redirect()->route('my-wallet.index', auth()->user()->role->type);
            }
        }else {
            Toastr::error(__('common.operation_failed'));
            return redirect()->route('my-wallet.index', auth()->user()->role->type);
        }
    }

}
