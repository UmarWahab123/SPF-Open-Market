<?php

namespace Modules\FrontendCMS\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Wallet\Entities\BankPayment;
use Modules\Account\Entities\Transaction;
use App\Models\User;
use Modules\FrontendCMS\Entities\PricingPlan;
// use Modules\MultiVendor\Entities\SellerSubcription;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerSubscriptionPaymentInfo extends Model
{
    use HasFactory;
    protected $table = 'customer_subscription_payment_info';
    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id')->withDefault();
    }

    public function item_details()
    {
        return $this->morphOne(BankPayment::class, 'itemable');
    }

    public function customerSubscription()
    {
        return $this->belongsTo(User::class, 'customer_id','id');
    }
    public function pricingPlans()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id','id');
    }
}
