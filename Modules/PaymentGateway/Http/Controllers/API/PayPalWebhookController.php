<?php

namespace Modules\PaymentGateway\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;
use App\Models\User;
use Carbon\Carbon;

class PayPalWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Log the incoming webhook payload for debugging
        Log::info('Received PayPal webhook:', $request->all());

        $eventType = $request->event_type;

        switch ($eventType) {
            case 'PAYMENT.SALE.COMPLETED':
                // Handle successful recurring payment
                $subscriptionId = $request->resource['billing_agreement_id'] ?? null;
                $paymentId = $request->resource['id'] ?? null;
                $subscription = CustomerSubscriptionPaymentInfo::where('paypal_agreement_id', $subscriptionId)->first();
                
                if ($subscription) {
                    $user = User::find($subscription->customer_id);
                    $subscription->last_payment_id = $paymentId;
                    $subscription->status = 'Active';  // Keep subscription active on successful recharge
                    $subscription->expiration_date = Carbon::now()->addMonth();
                    $subscription->recurring_payments = "Completed";
                    $subscription->save();

                    if ($user) {
                        $user->status = "Active";
                        $user->save();
                    }
                }
                break;

            case 'BILLING.SUBSCRIPTION.SUSPENDED':
                // Handle subscription suspension
                $subscriptionId = $request->resource['billing_agreement_id'] ?? null;

                $subscription = CustomerSubscriptionPaymentInfo::where('paypal_agreement_id', $subscriptionId)->first();
                
                if ($subscription) {
                    $user = User::find($subscription->customer_id);

                    $subscription->status = 'Expired';  // Mark subscription as expired on failed recharge
                    $subscription->expiration_date = Carbon::now();
                    $subscription->recurring_payments = "Incomplete";
                    $subscription->save();

                    if ($user) {
                        $user->status = "Expired";
                        $user->save();
                    }

                }
                break;
            case 'BILLING.SUBSCRIPTION.CANCELLED':
                $subscriptionId = $request->resource['billing_agreement_id'] ?? null;
                $subscription = CustomerSubscriptionPaymentInfo::where('paypal_agreement_id', $subscriptionId)->first();
                if ($subscription) {
                    $user = User::find($subscription->customer_id);
                    $subscription->status = 'Cancel';
                    $subscription->recurring_payments = "Incomplete";
                    $subscription->expiration_date = Carbon::now();
                    $subscription->save();
                
                    if ($user) {
                        $user->status = "Cancel";
                        $user->save();
                    }
             
                }
                break;

            default:
                Log::info("Unhandled PayPal webhook event: {$eventType}");
                break;
        }

        return response()->json(['status' => 'success'], 200);

    }
}
