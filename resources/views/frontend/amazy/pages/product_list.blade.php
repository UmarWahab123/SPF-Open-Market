<!-- resources/views/frontend/amazy/pages/product_list.blade.php -->
<style>
.singleProduct{
        border: 3px solid #060606;
        border-radius: 10px;
}
.product_name{
    text-align: start;
    font-size: 19px;
}
.add-to-cart {
  background-color: #e5e01a;
  border: none;
}
.add-to-cart:hover {
  background-color: #f6f12c;
}
.add_to_cart {
  margin-top: 8px;
}
.add_to_cart button {
  padding: 10px 10px;
  border-radius: 10px;
}
.loginuser{
    font-size: 9px !important;
    margin-left: 1px !important;
}
.unloginedprice{
    color: #202529 !important;
}
</style>
@php
// Fetch customer subscription and discount roles
$customerId = auth()->id();
$customerSubscription = Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo::where('customer_id', $customerId)
                            ->where('status', 'active')
                            ->first();
if ($customerSubscription) {
    $pricingPlanId = $customerSubscription->pricing_plan_id;
    $discountRoles = Modules\FrontendCMS\Entities\DiscountRole::where('pricing_plan_id', $pricingPlanId)->get();
}
@endphp
@if($products->count() > 0)
@foreach($products as $key => $product)
    @php
        // Remove '/import' from the image URL if it exists
        $thumbnail = @$product->thum_img 
            ? str_replace('/import', '', showImage(@$product->thum_img)) 
            : str_replace('/import', '', showImage(@$product->product->thumbnail_image_source));
        // $thumbnail = @$product->thum_img != null ? showImage(@$product->thum_img) : showImage(@$product->product->thumbnail_image_source);
        $price_qty = getProductDiscountedPrice(@$product);
        $showData = [
            'name' => @$product->product_name,
            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
            'price' => $price_qty,
            'thumbnail' => $thumbnail,
        ];
    @endphp

    <div class="col-md-3">
        <div class="card h-100" style="border: 0px solid #ddd; border-radius: 10px;">
            <div class="card-body p-3 text-center">
                <a href="{{ singleProductURL($product->seller->slug, $product->id) }}" class="singleProduct d-block mb-3">
                    <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                         class="img-fluid" style="height: 200px; object-fit: cover; border-radius: 10px;">
                </a>
                {{-- <h6 class="product_name text-wrap">{{ $product->product_name }}</h6> --}}
                <h6 class="product_name text-truncate">{{ Str::limit($product->product_name, 35, '...') }}</h6>
                <div class="rating mb-2 d-none">
                    @php
                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');
                        $rating = count($reviews) > 0 ? $reviews->avg() : 0;
                    @endphp
                    <x-rating :rating="$rating" />
                </div>
               @if(!auth()->check())
                @php 
                   //Note :: the below code is for the feture use i only use the selling_price now
                    // Retrieve subscription plan and associated discount roles
                    $subscriptionPlan = Modules\FrontendCMS\Entities\PricingPlan::where('name', 'TIER 3')->first();
                    $discountRoles = [];
                    if ($subscriptionPlan) {
                        $pricingPlanId = $subscriptionPlan->id;
                        $discountRoles = Modules\FrontendCMS\Entities\DiscountRole::where('pricing_plan_id', $pricingPlanId)->get();
                    }
                    $selling_price = $product->skus->first()->selling_price;
                    // Calculate product price without dollar sign and ensure it's a float
                    $finalPriceAfterDiscount = $selling_price; // Default value for final price
                    $subscriptionDiscount = 0; // Default value for discount
        
                    // Apply discount based on the defined roles
                    if (collect($discountRoles)->isNotEmpty()) {
                        foreach ($discountRoles as $role) {
                            if ($selling_price >= $role->start_price && $selling_price <= $role->end_price) {
                                $subscriptionDiscountPercentage = $role->discount;
                                $subscriptionDiscount = ($selling_price * $subscriptionDiscountPercentage) / 100;
                                // Calculate the final discounted price
                                $finalPriceAfterDiscount = $selling_price - $subscriptionDiscount;
                                break; // Exit loop after applying the first matched discount role
                            }
                        }
                    }
                @endphp
                <div class="d-flex">
                    <div class="add_to_cart">
                        <button class="add-to-cart">Add to Cart</button>
                    </div>
                    <div class="price mb-3">
                        @if(auth()->check() && $customerSubscription !== null)
                        <span class="text-muted text-decoration-line-through">${{ number_format($selling_price, 2) }}</span>
                        <br>
                        @endif
                        <span class="unloginedprice fw-bold">${{ number_format($selling_price, 2) }}</span>
                        <span class="price_subscribers d-block mt-1">Price for subscribers*</span>
                    </div>
                </div>
                @elseif((auth()->check() && $customerSubscription === null))
                @php 
                   //Note :: the below code is for the feture use i only use the selling_price now
                    // Retrieve subscription plan and associated discount roles
                    $subscriptionPlan = Modules\FrontendCMS\Entities\PricingPlan::where('name', 'TIER 3')->first();
                    $discountRoles = [];
                    if ($subscriptionPlan) {
                        $pricingPlanId = $subscriptionPlan->id;
                        $discountRoles = Modules\FrontendCMS\Entities\DiscountRole::where('pricing_plan_id', $pricingPlanId)->get();
                    }
                    $selling_price = $product->skus->first()->selling_price;
                    // Calculate product price without dollar sign and ensure it's a float
                    $finalPriceAfterDiscount = $selling_price; // Default value for final price
                    $subscriptionDiscount = 0; // Default value for discount
        
                    // Apply discount based on the defined roles
                    if (collect($discountRoles)->isNotEmpty()) {
                        foreach ($discountRoles as $role) {
                            if ($selling_price >= $role->start_price && $selling_price <= $role->end_price) {
                                $subscriptionDiscountPercentage = $role->discount;
                                $subscriptionDiscount = ($selling_price * $subscriptionDiscountPercentage) / 100;
                                // Calculate the final discounted price
                                $finalPriceAfterDiscount = $selling_price - $subscriptionDiscount;
                                break; // Exit loop after applying the first matched discount role
                            }
                        }
                    }
                @endphp
                <div class="d-flex justify-content-around">
                    <div class="add_to_cart">
                        <button class="add-to-cart">Add to Cart</button>
                    </div>
                    <div class="price mb-3  text-start fs-6">
                        @if(auth()->check())
                        <span class="text-muted text-decoration-line-through fs-6">${{ number_format($selling_price, 2) }}</span>
                        <br>
                        @endif
                            <span class="fw-bold fs-6">${{ number_format($finalPriceAfterDiscount, 2) }}</span>
                            <span class="loginuser price_subscribers d-block">Price for subscribers*</span>
                    </div>
                </div>
               @else
                 @php 
                 $selling_price = $product->skus->first()->selling_price;
                    // Calculate product price without dollar sign and ensure it's a float
                    $finalPriceAfterDiscount = $selling_price; // Default value for final price
                    $subscriptionDiscount = 0; // Default value for discount
                    // Apply discount based on the defined roles
                    if (collect($discountRoles)->isNotEmpty()) {
                        foreach ($discountRoles as $role) {
                            if ($selling_price >= $role->start_price && $selling_price <= $role->end_price) {
                                $subscriptionDiscountPercentage = $role->discount;
                                $subscriptionDiscount = ($selling_price * $subscriptionDiscountPercentage) / 100;
                                // Calculate the final discounted price
                                $finalPriceAfterDiscount = $selling_price - $subscriptionDiscount;
                                break; // Exit loop after applying the first matched discount role
                            }
                        }
                    }
                @endphp 
                <div class="d-flex">
                   @if($product->stock_manage == 1 && $product->skus->where('status',1)->first()->product_stock >= $product->product->minimum_order_qty) 
                    <div class="add_to_cart">
                        <button class="add-to-cart add_to_cart_btn" id="add_to_cart_btn">Add to Cart</button>
                    </div>
                    <div>
                        <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20 d-none  w-100 text-center justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                    </div>
                    @elseif($product->stock_manage == 0)
                    <div class="add_to_cart">
                        <button class="add-to-cart add_to_cart_btn" id="add_to_cart_btn">Add to Cart</button>
                    </div>
                    <div>
                        <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20  w-100 text-center d-none justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                    </div>
                    @else
                    <div>
                        <button type="button" disabled class="amaz_primary_btn style2 mb_20  add_to_cart text-uppercase flex-fill text-center w-100">{{__('defaultTheme.out_of_stock')}}</button>
                    </div>
                    @endif
                    <div class="price mb-3 fs-6">
                        @if(auth()->check() && $customerSubscription !== null)
                        <span class="text-muted text-decoration-line-through fs-6">${{ number_format($selling_price, 2) }}</span>
                        <br>
                        @endif
                        <span class="fw-bold fs-6">${{ number_format($finalPriceAfterDiscount, 2) }}</span>
                        <span class="price_subscribers d-block ">Price for subscribers*</span>
                    </div>
                </div>
               @endif
            </div>
        </div>
    </div>
@endforeach
@else
    <div class="col-12 text-center">
        <h5>No products found</h5>
    </div>
@endif
