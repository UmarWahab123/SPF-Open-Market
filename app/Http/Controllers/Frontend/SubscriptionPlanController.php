<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Traits\OrderPdf;
use App\Traits\Otp;
use App\Traits\SendMail;
use Exception;
use App\Models\User;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Modules\FrontendCMS\Entities\PricingPlan;
use Modules\Wallet\Repositories\WalletRepository;
use Modules\PaymentGateway\Services\PaymentGatewayService;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\PaymentGateway\Http\Controllers\StripeController;
use Modules\PaymentGateway\Http\Controllers\BankPaymentController;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;

class SubscriptionPlanController extends Controller
{
    use Notification;
    public function subscription_plans_index()
    {
        // dd("test");
        $data['subscription_plans'] = PricingPlan::with(['discountRole','subscriptionPayments' => function ($query) {
            $query->where('customer_id', auth()->user()->id)
                  ->where(function ($q) {
                      $q->where('status', 'Pending')
                        ->orWhere('status', 'Active')
                        ->orWhere('status', 'Expired');
                  });
        }])->where('status', 1)
        ->get();
        return view(theme('pages.profile.subscription_plan'), ['data' => $data]);
    }
    public function subscriptionPaymentPageDetails($id, PaymentGatewayService $paymentGatewayService)
    {
        $id = decrypt($id);
        $data['subscription_plan'] = PricingPlan::findOrFail($id);
        $data['plan_price'] = $data['subscription_plan']->plan_price;
        $walletRepo = new WalletRepository;
        $data['payment_gateways'] = $walletRepo->activePaymentGayteway();
        $data['gateway_activations'] = $paymentGatewayService->gateway_active()->where('method','!=','Cash On Delivery');
        return view('multivendor::customer_payment.payment', $data);
    }

    public function subscriptionPaymentPage($id, PaymentGatewayService $paymentGatewayService)
    {
        $data['subscription_plan'] = PricingPlan::findOrFail($id);
        $data['plan_price'] = $data['subscription_plan']->plan_price;
        $walletRepo = new WalletRepository;
        $gateway = $walletRepo->activePaymentGayteway();
        $gateway = $gateway->where('slug','!=','wallet');

        $data['gateway_activations'] = $gateway->where('method','!=','Cash On Delivery');
        return view('multivendor::customer_payment.payment_gateway', $data);
    }

    public function subscriptionPayment(Request $request)
    {
        if (empty($request->method)) {
            Toastr::error('Payment method is not selected');
            return back();
        }
        if ($request->method == 'Bank Payment') {
            $request->validate([
                "bank_name" => "required",
                "branch_name" => "required",
                "account_number" => "required",
                "account_holder" => "required",
                "image" => "nullable",
            ]);
        }
    
        try {    
            DB::beginTransaction();
            if ($request->method == "Paypal") {
                session()->put('customer_subscription_payment', '1');
                $stripeController = new StripeController;
                $response = $stripeController->stripePost($request->all());  
                if (gettype($response) == 'object') {
                    return redirect()->back();
                }
            }
            if ($request->method == "Stripe") {
                session()->put('customer_subscription_payment', '1');
                $stripeController = new StripeController;
                $response = $stripeController->stripePost($request->all());  
                if (gettype($response) == 'object') {
                    return redirect()->back();
                }
            }
    
            if ($request->method == "Bank Payment") {
                $bankController = new BankPaymentController;
                $response = $bankController->store($request->all());
            }
    
            // Send notification
            $this->typeId = EmailTemplateType::where('type', 'subscription_payment_email_template')->first()->id;
            $notification = NotificationSetting::where('slug', 'seller-payout')->first();
            if ($notification) {
                $this->notificationSend($notification->id, auth()->id());
            }
    
            DB::commit();
            Toastr::success(__('common.successful'), __('common.success'));
            LogActivity::successLog('Customer Subscription payment successful.');
            return redirect()->route('frontend.subscription_plans');
        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    
    public function subscriptionCancel($id)
    {
        $subscription_id = $id ;
        $customer_id = auth()->user()->id;
        $subscription_cancel = CustomerSubscriptionPaymentInfo::where('id', $subscription_id)->update(['status' => 'Cancel']);
        $update_customer_plan_status = User::where('id',$customer_id)->update(['status' => 'Cancel']);
        Toastr::success(__('common.successful'), __('common.success'));
        return back();

    }
    // public function cancel()
    // {
    //    dd("Cancel");
    //     // Logic to handle subscription cancellation
    //     return view('subscription.cancel'); // Create a view to inform the user
    // }

    // public function success()
    // {
    //     dd("Success");
    //     // Logic to handle successful subscription activation
    //     return view('subscription.success'); // Create a view to inform the user
    // }
}
