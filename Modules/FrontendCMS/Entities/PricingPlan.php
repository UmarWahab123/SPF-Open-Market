<?php

namespace Modules\FrontendCMS\Entities;
use Illuminate\Database\Eloquent\Model;
use Modules\FrontendCMS\Entities\DiscountRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GST\Entities\GstTax;
use App\Models\User;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;
use Spatie\Translatable\HasTranslations;

class PricingPlan extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];
    public $translatable = [];
    protected $appends = [];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (isModuleActive('FrontendMultiLang')) {
            $this->translatable = ['name'];
            $this->appends = ['translateName'];
        }
    }
    public function getTranslateNameAttribute(){
        return $this->attributes['name'];
    }

    public function vat()
    {
        return $this->belongsTo(GstTax::class,'gst_tax_id');
    }
    public function subscriptionPayments()
    {
        return $this->hasMany(CustomerSubscriptionPaymentInfo::class, 'pricing_plan_id', 'id');
    }
    public function discountRole()
    {
        return $this->hasMany(DiscountRole::class, 'pricing_plan_id', 'id');
    }
    public function customer()
    {
        return $this->hasOne(User::class, 'plan_id', 'id');
    }
}
