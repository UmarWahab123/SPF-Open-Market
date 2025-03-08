<?php

namespace Modules\FrontendCMS\Repositories;
use App\Traits\ImageStore;
use Modules\FrontendCMS\Entities\PricingPlan;
use Stripe;
class PricingPlanRepository {

    protected $pricingPlan;
    public function __construct(PricingPlan $pricingPlan){
        $this->pricingPlan = $pricingPlan;
    }
    public function getAll()
    {
        return $this->pricingPlan::all();
    }
    public function getAllActive()
    {
        return $this->pricingPlan::where('status',1)->get();
    }
    public function save($data)
    {
        $image = null;
        if (!empty($data['image'])) {
            $image = ImageStore::saveImage($data['image'], 165, 165);
        }
    
        // Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    
        // // Create a Stripe product
        // $product = Stripe\Product::create([
        //     'name' => $data['name'],
        //     'type' => 'service',
        // ]);
    
        // // No recurring logic, single charge only
        // $price = Stripe\Price::create([
        //     'unit_amount' => round($data['plan_price'] * 100),  // Convert amount to cents
        //     'currency' => auth()->user()->currency_code,
        //     'product' => $product->id,
        //     'recurring' => [
        //         'interval' => 'month',  // You can change this to 'year' for yearly subscriptions
        //     ],
        // ]);
    
        // Save the plan information in your database
        $pricingPlan = PricingPlan::create([
            'name' => $data['name'],
            'plan_price' => $data['plan_price'],
            'monthly_cost' => isset($data['monthly_cost']) ? $data['monthly_cost'] : $data['plan_price'],
            'yearly_cost' => isset($data['yearly_cost']) ? $data['yearly_cost'] : $data['plan_price'],
            'best_for' => $data['best_for'],
            'status' => $data['status'],
            'description' => $data['description'],
            'image' => $image,
            'expire_in' => $data['expire_in'],
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'gst_tax_id' => isset($data['gst_id']) ? $data['gst_id'] : null,
            'discount_type' => isset($data['discount_type']) ? $data['discount_type'] : null,
            'discount' => isset($data['discount']) ? $data['discount'] : null,
            // 'stripe_product_id' => $product->id,
            // 'stripe_price_id' => $price->id,
        ]);
    
        return $pricingPlan;
    }
    
    public function update($data)
    {
        $image = isset($data['old_image']) ? $data['old_image'] : '';
        if (!empty($data['image'])) {
            $image = ImageStore::saveImage($data['image'], 165, 165);
        }
    
        $pricingPlan = PricingPlan::findOrFail($data['id']);
    
        // Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        
        // // Create a new price in Stripe without recurring interval
        // $price = Stripe\Price::create([
        //     'unit_amount' => round($data['plan_price'] * 100),  // Convert to cents
        //     'currency' => auth()->user()->currency_code,
        //     'product' => $pricingPlan->stripe_product_id,
        //     'recurring' => [
        //         'interval' => 'month',  // You can change this to 'year' for yearly subscriptions
        //     ],
        // ]);
    
        return $pricingPlan->update([
            'name' => $data['name'],
            'plan_price' => $data['plan_price'],
            'monthly_cost' => isset($data['monthly_cost']) ? $data['monthly_cost'] : $data['plan_price'],
            'yearly_cost' => isset($data['yearly_cost']) ? $data['yearly_cost'] : $data['plan_price'],
            'best_for' => $data['best_for'],
            'status' => $data['status'],
            'description' => $data['description'],
            'image' => $image,
            'expire_in' => $data['expire_in'],
            'is_featured' => isset($data['is_featured']) ? 1 : 0,
            'gst_tax_id' => isset($data['gst_id']) ? $data['gst_id'] : null,
            'discount_type' => isset($data['discount_type']) ? $data['discount_type'] : null,
            'discount' => isset($data['discount']) ? $data['discount'] : null,
            // 'stripe_price_id' => $price->id,
        ]);
    }
    
    public function delete($id){
        $pricingPlan = $this->pricingPlan->findOrFail($id);
        $pricingPlan->delete();
        return $pricingPlan;
    }
    public function show($id){
        $pricingPlan = $this->pricingPlan->findOrFail($id);
        return $pricingPlan;
    }
    public function edit($id){
        $pricingPlan = $this->pricingPlan->findOrFail($id);
        return $pricingPlan;
    }
    public function statusUpdate($data, $id){
        return $this->pricingPlan::where('id',$id)->update([
            'status' => $data['status']
        ]);
    }
}
