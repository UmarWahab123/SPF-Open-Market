<?php

namespace Modules\FrontendCMS\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FrontendCMS\Entities\PricingPlan;
use Spatie\Translatable\HasTranslations;

class DiscountRole extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = ['id'];
    public $translatable = [];
    protected $appends = [];

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class,'pricing_plan_id');
    }
    
}
