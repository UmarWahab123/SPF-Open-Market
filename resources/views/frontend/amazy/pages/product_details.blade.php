@extends('frontend.amazy.layouts.app')
@section('title')
    @if(@$product->product->meta_title != null)
        {{ @substr(@$product->product->meta_title,0, 60)}}
    @else
        {{ @substr(@$product->product_name,0, 60)}}
    @endif
@endsection
@section('share_meta')
    @if(@$product->product->meta_description != null)
        <meta property="og:description" content="{{@$product->product->meta_description}}" />
        <meta name="description" content="{{@$product->product->meta_description}}">
    @else
        <meta property="og:description" content="{{ Str::limit(strip_tags($product->product->description),128)}}" />
        <meta name="description" content="{{ Str::limit(strip_tags($product->product->description),128) }}">
    @endif
    @if(@$product->product->meta_title != null)
        <meta name="title" content="{{ @substr(@$product->product->meta_title,0,60) }}"/>
        <meta property="og:title" content="{{substr(@$product->product->meta_title,0,60)}}" />
    @else
        <meta property="og:title" content="{{@substr(@$product->product_name,0,60)}}" />
        <meta name="title" content="{{ @substr(@$product->product_name,0,60) }}"/>
    @endif
    @if(@$product->product->meta_image != null && @getimagesize(showImage(@$product->product->meta_image))[0] > 200)
        <meta property="og:image" content="{{showImage($product->product->meta_image)}}" />
    @elseif(@$product->product->thumbnail_image_source != null && @getimagesize(showImage(@$product->product->thumbnail_image_source))[0] > 200)
        <meta property="og:image" content="{{showImage(@$product->product->thumbnail_image_source)}}" />
    @elseif(count(@$product->product->gallary_images) > 0 && @getimagesize(showImage(@$product->product->gallary_images[0]->images_source))[0] > 200)
        <meta property="og:image" content="{{showImage(@$product->product->gallary_images[0]->images_source)}}" />
    @endif


    <meta property="og:url" content="{{singleProductURL(@$product->seller->slug, $product->slug)}}" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:type" content="og:product">
    @php
        $total_tag = count($product->product->tags);
        $meta_tags = '';
        foreach($product->product->tags as $key => $tag){
            if($key + 1 < $total_tag){
                $meta_tags .= $tag->name.', ';
            }else{
                $meta_tags .= $tag->name;
            }
        }
        if(!empty($product->product->meta_title)){
            $product_title = $product->product->meta_title;
        }else{
            $product_title = $product->product_name;
        }
    @endphp
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
    @php
        $public_code = null;
        $payment = DB::table('payment_methods')->where('method','Tabby')->where('active_status',1)->first();
        if($payment)
        {
            $tabby_gateway = getPaymentGatewayInfo($payment->id);
            if($tabby_gateway){
                $public_code = $tabby_gateway->perameter_1;
            }
        }

    @endphp
     <meta property="product:plural_title"      content="{{ $product_title }}" />
     <meta property="product:price:amount"      content="{{str_replace('$','',getProductDiscountedPrice($product))}}"/>
     <meta property="product:price:currency"    content="{{ currencyCode() }}"/>
    <meta name ="keywords", content="{{$meta_tags}}, {{ config('app.name') }}">
@endsection


@push('styles')
    <link rel="stylesheet" href="{{asset(asset_path('frontend/amazy/css/page_css/product_details.css'))}}" />
    <link rel="stylesheet" href="{{asset(asset_path('frontend/default/css/lightbox.css'))}}" />
    @if(isRtl())
        <style>
            .zoomWindowContainer div {
                left: 0!important;
                right: 510px;
            }
            .product_details_part .cs_color_btn .radio input[type="radio"] + .radio-label:before {
                left: -1px !important;
            }
            @media (max-width: 970px) {
                .zoomWindowContainer div {
                    right: inherit!important;
                }
            }



        </style>

    @endif


    <style>
        .report-product {
                font-size: 12px;
                color: var(--base_color) !important;
                font-weight: 700;
                display: inline-flex;
                align-items: center;
                grid-gap: 10px;
                text-transform: uppercase;
            }
            .report-product:hover{
                color: var(--base_color) !important;
            }
             .amaz_primary_yellow {
                background:#e5e01a;
                border-radius: 10px;
                display: inline-block;
                font-family: "Circular Std Book";
                font-size: 14px;
                color: black;
                font-weight: 700;
                padding: 18.5px 24px;
                border: 1px solid transparent;
                text-transform: uppercase;
                display: inline-block;
                transition: 0.3s;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                }
    </style>
@endpush
@section('content')

{{-- new start--}}
        <div class="second_section_new_navbar" style="padding:0px; margin: 0px" >
            <div class="top" style="  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%); height: 10px; "></div>
            <div class="container" >
            <div class="row">
                <div class="col-md-12">
                <div class="navbar">
                    <a href="{{url('/parts-finder')}}">Parts Finder</a> </div>
                </div>
            </div>
            </div>
        </div>
    <!-- product_details_wrapper::start  -->
    <div class="product_details_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <div class="slider-container slick_custom_container mb_30" id="myTabContent">
                                <div class="slider-for gallery_large">
                                    @if(count($product->product->gallary_images) > 0)
                                        @foreach($product->product->gallary_images as $image)
                                            <div class="item-slick {{$product->product->gallary_images->first()->id == $image->id?'slick-current slick-active':''}}" id="thumb_{{$image->id}}"
                                            style="background-color: #fff; border: 2px solid black; border-radius: 25px;">
                                                <img class="varintImg zoom_01" src="{{showImage($image->images_source)}}" data-zoom-image="{{showImage($image->images_source)}}" alt="{{$product->product_name}}" title="{{$product->product_name}}">
                                            </div>
                                        @endforeach
                                    @else
                                       @php
                                        // Remove '/import' from the image URL if it exists
                                        $thumbnail = @$product->thum_img
                                            ? str_replace('/import', '', showImage(@$product->thum_img))
                                            : str_replace('/import', '', showImage(@$product->product->thumbnail_image_source));
                                            // $thumbnail = @$product->thum_img ? showImage(@$product->thum_img) : showImage(@$product->product->thumbnail_image_source);
                                        @endphp
                                        <div class="item-slick slick-current slick-active" id="thumb_{{$product->id}}">
                                            <img class="varintImg zoom_01" data-zoom-image="{{ $thumbnail }}" src="{{ $thumbnail }}" alt="{{$product->product_name}}" title="{{$product->product_name}}">
                                        </div>
                                    @endif
                                </div>
                                <div class="slider-nav">
                                    @if(count($product->product->gallary_images) > 0)
                                        @foreach($product->product->gallary_images as $i => $image)
                                            <div class="item-slick {{$i == 0?'slick-active slick-current':''}}" style="background-color: #fff; border: 2px solid black; border-radius: 10px;">
                                                <img src="{{showImage($image->images_source)}}" alt="{{$product->product_name}}" title="{{$product->product_name}}">
                                            </div>
                                        @endforeach
                                    @else
                                        @php
                                        // Remove '/import' from the image URL if it exists
                                        $thumbnail = @$product->thum_img
                                            ? str_replace('/import', '', showImage(@$product->thum_img))
                                            : str_replace('/import', '', showImage(@$product->product->thumbnail_image_source));
                                            // $thumbnail = @$product->thum_img ? showImage(@$product->thum_img) : showImage(@$product->product->thumbnail_image_source);
                                        @endphp
                                        <div class="item-slick slick-active slick-current">
                                            <img src="{{ $thumbnail }}" alt="{{$product->product_name}}" title="{{$product->product_name}}">
                                        </div>
                                    @endif
                                </div>
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" id="maximum_order_qty" value="{{@$product->product->max_order_qty}}">
                                <input type="hidden" id="minimum_order_qty" value="{{@$product->product->minimum_order_qty}}">
                                <input type="hidden" name="thumb_image" id="thumb_image" value="{{showImage($product->thum_img ? $product->thum_img : $product->product->thumbnail_image_source)}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="product_content_details mb_20">
                                <div id="stock_div">
                                    @if ($product->stock_manage == 1 && @$product->skus->where('status',1)->first()->product_stock >= @$product->product->minimum_order_qty)
                                        <span class="stoke_badge">{{__('common.in_stock')}}</span>
                                    @elseif($product->stock_manage == 0)
                                        <span class="stoke_badge">{{__('common.in_stock')}}</span>
                                    @else
                                        <span class="stokeout_badge">{{__('amazy.Out of stock')}}</span>
                                    @endif
                                </div>
                                <h3>{{$product->product_name}}</h3>
                                {{-- <h3>{{$product->product ? $product->product->product_name : $product->product_name}}<h3> --}}
                                @if(app('general_setting')->product_subtitle_show)
                                    @if($product->subtitle_1)
                                        <h5>{{$product->subtitle_1}}</h5>
                                    @endif
                                    @if($product->subtitle_2)
                                        <h5>{{$product->subtitle_2}}</h5>
                                    @endif
                                @endif
                                <div class="viendor_text align-items-center">
                                    <p class="" style="font-weight: 500; color: black; font-size:20px; "> <span class="text-uppercase">{{__('defaultTheme.sku')}}:</span> <span class="" id="sku_id_li"> {{@$product->skus->where('status',1)->first()->sku->sku??'-'}}</span></p>
                                    <p class="" style="font-weight: 500; color: black; font-size:20px;"> <span class="text-uppercase">{{__('common.category')}}:</span>
                                        @php
                                            $cates = count($product->product->categories);
                                        @endphp
                                        @foreach($product->product->categories as $key => $category)
                                            <span>{{$category->name}}</span>
                                            @if($key + 1 < $cates), @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="viendor_text d-flex align-items-center">
                                    <p class="" style="font-weight: 500; color: black; font-size:20px;"> <span class="text-uppercase">{{__('defaultTheme.availability')}}:</span> <span class="" id="availability">
                                        @if ($product->stock_manage == 0)
                                        {{__('defaultTheme.unlimited')}}
                                        @else
                                            {{ $product->skus->where('status',1)->first()->product_stock }}
                                        @endif
                                    </span></p>
                                </div>
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="product_ratings mb-2">
                                        <div class="stars">
                                            <x-rating :rating="$rating"/>
                                        </div>
                                        <span>{{getNumberTranslate(sprintf("%.2f",$rating))}}/{{getNumberTranslate(5)}} ({{($total_review<10 && $total_review>0)?'0':''}}{{getNumberTranslate($total_review)}} {{__('defaultTheme.review')}})</span>
                                    </div>
                                    @if(isModuleActive('ClubPoint'))
                                    <div class="border-start ps-3 ms-3">
                                        <span class="d-flex align-items-center point">
                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{getNumberTranslate(@$product->product->club_point)}}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                <input id="new_get_price_to_compare" type="hidden" value="{{@$product->skus->first()->selling_price}}"/> 
                                <div class="destils_prise_information_box mb_20 d-flex justify-content-between">
                                 <div class="jno">
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
                                        $selling_price = @$product->skus->first()->selling_price;
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
                                    @if(isGuestAddtoCart() == true)
                                    <h2 class="pro_details_prise d-flex align-items-center  m-0">
                                        <span>
                                            ${{ number_format(@$selling_price, 2) }}
                                        </span>
                                    </h2>
                                    @endif
                                    <div class="pro_details_disPrise d-flex align-items-center gap_15">
                                     @if(auth()->check() && $customerSubscription !== null)
                                        @if(isGuestAddtoCart() == true)
                                            <h4 class="discount_prise  m-0  ">
                                                <span class="text-decoration-line-through">
                                                    @if($product->hasDeal || $product->hasDiscount == 'yes')
                                                        <span id="get_price_to_compare">${{ number_format($selling_price, 2) }}</span>
                                                    @endif
                                                </span>
                                            </h4>
                                        @endif
                                     @endif
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
                                            $selling_price = @$product->skus->first()->selling_price;
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
                                        @if(isGuestAddtoCart() == true)
                                        <h2 class="pro_details_prise d-flex align-items-center  m-0">
                                            <span>
                                                ${{ number_format($finalPriceAfterDiscount, 2) }}
                                            </span>
                                        </h2>
                                        @endif
                                        <div class="pro_details_disPrise d-flex align-items-center gap_15">
                                            @if(isGuestAddtoCart() == true)
                                                <h4 class="discount_prise  m-0  ">
                                                    <span class="text-decoration-line-through">
                                                        {{-- @if($product->hasDeal || $product->hasDiscount == 'yes') --}}
                                                        @if(auth()->check())
                                                            <span id="get_price_to_compare">${{ number_format($selling_price, 2) }}</span>
                                                        {{-- @endif --}}
                                                        @endif
                                                    </span>
                                                </h4>
                                          @endif
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
                                     @if(auth()->check() && $customerSubscription !== null)
                                     @if(isGuestAddtoCart() == true)
                                     <h2 class="pro_details_prise d-flex align-items-center  m-0">
                                         <span>
                                             ${{ number_format($finalPriceAfterDiscount, 2) }}
                                         </span>
                                     </h2>
                                     @endif
                                     @endif
                                     <div class="pro_details_disPrise d-flex align-items-center gap_15">
                                         @if(isGuestAddtoCart() == true)
                                             <h4 class="discount_prise  m-0  ">
                                                 <span class="text-decoration-line-through">
                                                     {{-- @if($product->hasDeal || $product->hasDiscount == 'yes') --}}
                                                         <span id="get_price_to_compare">${{ number_format($selling_price, 2) }}</span>
                                                     {{-- @endif --}}
                                                 </span>
                                             </h4>
                                         @endif
                                       @endif
                                    </div>
                                    <input type="hidden" name="product_sku_id" id="product_sku_id" value="{{$product->product->product_type == 1?$product->skus->where('status',1)->first()->id : $product->skus->where('status',1)->first()->id}}">
                                    <input type="hidden" name="seller_id" id="seller_id" value="{{$product->user_id}}">
                                    <input type="hidden" id="owner" value="{{encrypt($product->user_id)}}">
                                    <input type="hidden" name="stock_manage_status" id="stock_manage_status" value="{{$product->stock_manage}}">
                                    <p class="pro_details_text">
                                        <span class="text-uppercase">{{__('common.tag')}}:</span>
                                        @php
                                            $total_tag = count($product->product->tags);
                                        @endphp
                                        @foreach($product->product->tags as $key => $tag)
                                            <a class="tag_link" href="{{route('frontend.category-product',['slug' => $tag->name, 'item' =>'tag'])}}">{{$tag->name}}</a>
                                        @endforeach
                                    </p>
                                   
                                    </div>
                                    {{-- @dd($$subscription_plans); --}}
                                    <div class="right_button">
                                          <a href="{{ url('/register') }}">
                                                <button>Register and save</button>
                                            </a>
                                               @php
                                                    $subscription_plan_price = \Modules\FrontendCMS\Entities\PricingPlan::where('name', 'TIER 1')->value('plan_price') ?? 200;
                                                @endphp

                                            <p>Subscribe for only ${{ number_format($subscription_plan_price) }}/month to <br>
                                            get access to wholesale discounts.</p>
                                    </div>
                                </div>
                                <input type="hidden" name="product_type" class="product_type" value="{{ $product->product->product_type }}">

                                @if($product->product->product_type == 2 && session()->get('item_details') != '')
                                    @foreach (session()->get('item_details') as $key => $item)
                                        @if ($item['attr_id'] === 1)
                                            <div class="product_color_varient mb_20">
                                                <h5 class="font_14 f_w_500 theme_text3  text-capitalize d-block mb_10" id="color_name">{{ $item['name'] }}: {{$item['value'][0]}} </h5>
                                                <div class="color_List d-flex gap_5 flex-wrap">
                                                    <input type="hidden" class="attr_value_name" name="attr_val_name[]" value="{{$item['value'][0]}}">
                                                    <input type="hidden" class="attr_value_id" name="attr_val_id[]" value="{{$item['id'][0]}}-{{$item['attr_id']}}">
                                                    @foreach ($item['value'] as $k => $value_name)
                                                        <label class="round_checkbox d-flex">
                                                            <input id="radio-{{$k}}" name="color_filt" class="attr_val_name  radio_{{ $item['id'][$k] }}" type="radio" color="color" @if ($k === 0) checked @endif data-value="{{ $item['id'][$k] }}" data-name="{{ $item['name'] }}" data-value-key="{{$item['attr_id']}}" value="{{ $value_name }}"/>
                                                            <span class="checkmark colors_{{$k}} class_color_{{ $item['code'][$k] }}">
                                                                <div class="check_bg_color"></div>
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if ($item['attr_id'] != 1)
                                            <div class="product_color_varient mb_20">
                                                <h5 class="font_14 f_w_500 theme_text3  text-capitalize d-block mb_10" id="size_name{{$key}}">{{$item['name']}}: {{$item['value'][0]}}</h5>
                                                <div class="color_List d-flex gap_5 flex-wrap">
                                                    <input type="hidden" class="attr_value_name" data-name="{{ $item['name'] }}" name="attr_val_name[]" value="{{$item['value'][0]}}">
                                                    <input type="hidden" class="attr_value_id" name="attr_val_id[]" value="{{$item['id'][0]}}-{{$item['attr_id']}}">
                                                    @foreach ($item['value'] as $m => $value_name)
                                                        <a class="attr_val_name size_btn not_111 @if ($m === 0) selected_btn @endif" color="not" id="attr_val_variant_id_{{ $item['id'][$m] }}" data-name="{{ $item['name'] }}" data-value-key="{{$item['attr_id']}}" data-value="{{ $item['id'][$m] }}">{{ $value_name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @php
                                        $variant_images = [];
                                        $variant_skus = [];
                                        foreach($product->skus->where('status',1) as $sku){
                                            if(@$sku->sku->variant_image){
                                                $variant_images[] = $sku->sku->variant_image;
                                                $variant_skus[] = $sku->sku->sku;
                                                $variant_product_sku_ids[] = $sku->product_sku_id;
                                            }
                                        }
                                    @endphp
                                    @if(count($variant_images) > 0)
                                    <div class="single_details_content variant_image d-flex flex-wrap align-items-center mb-2 mb-md-3">
                                        <h5>{{__('amazy.Variant images')}}:</h5>
                                        @if(count($variant_images) > 5)
                                            <div class="variant-slider owl-carousel">
                                                @foreach($variant_images as $variant_key => $variant_image)
                                                    <div class="sku_img_div @if($loop->first) active @endif " id="{{$variant_skus[$variant_key]}}" data-id="{{$variant_product_sku_ids[$variant_key]}}" onclick="changeProdDetailsByVariantImg(this)">
                                                        <img src="{{showImage($variant_image)}}" title="{{ $variant_skus[$variant_key] }}" class="img-fluid p-1 var_img_sources " alt="{{ $variant_skus[$variant_key] }}" data-id="{{$variant_skus[$variant_key]}}"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                        <div class="img_div_width d-flex">
                                            @foreach($variant_images as $variant_key => $variant_image)
                                             <div class="sku_img_div @if($loop->first) active @endif " id="{{$variant_skus[$variant_key]}}"  data-id="{{$variant_product_sku_ids[$variant_key]}}">
                                                <img src="{{showImage($variant_image)}}" title="{{ $variant_skus[$variant_key] }}" class="img-fluid p-1 var_img_sources " alt="{{ $variant_skus[$variant_key] }}" data-id="{{$variant_skus[$variant_key]}}"/>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                @endif
                                <!--show wholesale price -->
                                @if(isModuleActive('WholeSale'))
                                    <div class="{{ @$product->skus->where('status',1)->first()->wholeSalePrices->count() ? 'd-flex':'d-none'}}">
                                        <table class="table-sm append_w_s_p_tbl mb-3" width="100%">
                                            <thead>
                                            <tr class="border-bottom ">
                                                <td  class="text-left">
                                                    <label for="" class="control-label">{{__('common.Min QTY')}}</label>
                                                </td>
                                                <td class="text-left">
                                                    <label for="" class="control-label">{{__('common.Max QTY')}}</label>
                                                </td>
                                                <td class="text-left">
                                                    <label for="" class="control-label">{{__('common.unit_price')}}</label>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody id="append_w_s_p_all">
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <div class="product_info">
                                    <div class="single_pro_varient">
                                        <h5 class="font_14 f_w_500 theme_text3 " >{{__('common.quantity')}}:</h5>
                                        <div class="product_number_count mr_5" data-target="amount-1">
                                            <span class="count_single_item inumber_decrement qtyChange" data-value="-"> <i class="ti-minus"></i></span>
                                            <input name="qty" id="qty" class="count_single_item input-number qty" type="text" data-value="{{@$product->product->minimum_order_qty}}" value="{{getNumberTranslate(@$product->product->minimum_order_qty)}}">
                                            <span class="count_single_item number_increment qtyChange" data-value="+"> <i class="ti-plus"></i></span>
                                        </div>
                                    </div>
                                    @if (!auth()->check())
                                    <input type="hidden" name="base_sku_price" id="base_sku_price" value="
                                        {{ number_format(@$selling_price, 2) }}
                                    ">
                                    <input type="hidden" name="final_price" id="final_price" value="
                                       {{ number_format(@$selling_price, 2) }}
                                    ">
                                    @else
                                    <input type="hidden" name="base_sku_price" id="base_sku_price" value="
                                    {{ number_format(@$finalPriceAfterDiscount, 2) }}
                                    ">
                                    <input type="hidden" name="final_price" id="final_price" value="
                                    {{ number_format(@$finalPriceAfterDiscount, 2) }}
                                    ">
                                    @endif

                                    @if(isGuestAddtoCart() == true)
                                        @if (!auth()->check())
                                            <h5 class="mb-0">{{__('common.total')}}:
                                                <span id="total_price">
                                                    {{ str_replace(' ', '', single_price(@$selling_price * $product->product->minimum_order_qty)) }}
                                                </span>
                                            </h5>
                                        @else
                                            <h5 class="mb-0">{{__('common.total')}}:
                                               <span id="total_price">
                                                    {{ str_replace(' ', '', single_price(@$finalPriceAfterDiscount * $product->product->minimum_order_qty)) }}
                                                </span>
                                            </h5>
                                        @endif
                                    @endif

                                    @if(isModuleActive('CheckPincode') && $pincodeConfig->pincode_check_system_status==1)
                                        <div class="row mt_30 form-inline" id="checkpincode_div">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group ">
                                                    <input type="text" class="form-control" id="check_pincode" placeholder="CHECK PINCODE" style="border: none;border-bottom: 1px solid #ced4da;border-radius:0px;padding-top:20px; text-align:center;">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-3 mt-md-0">
                                                <button type="button" class="amaz_primary_btn3" id="check_pincode_btn">{{__('checkpincode.check')}}</button>
                                            </div>
                                        </div>
                                        <div class="row d-none mt_10 availablity_show_div">
                                            <div class="col-lg-12">
                                                <p>{{__('checkpincode.available_at')}} <span id="pin_code_area"></span>.</p>

                                                <p class="pdelivery d-none">{{__('amazy.Delivery within')}}: <span id="pin_code_delivery"></span>.</p>

                                            </div>
                                        </div>
                                        <div class="row mt_10 not_serve d-none">
                                            <p>{{__('checkpincode.oops_we_are_not_currently_servicing_your_area')}}</p>
                                        </div>
                                    @endif

                                    @if(!auth()->check())
                                        <p>Unlock Wholesale Prices with a Monthly Subscription!</p>
                                    @else
                                        <!-- Optionally, you can leave this empty or put any other content if logged in -->
                                    @endif

                                    @if(isGuestAddtoCart() == true)
                                        <div class="row mt_30 " id="add_to_cart_div">
                                                @if ($product->stock_manage == 1 && $product->skus->where('status',1)->first()->product_stock >= $product->product->minimum_order_qty)          
                                                    <div class="col-6">
                                                        <button type="button" id="add_to_cart_btn" class="amaz_primary_yellow amaz_primary_btn style2 mb_20  add_to_cart add_to_cart_btn text-uppercase flex-fill text-center w-100">{{__('common.add_to_cart')}}</button>
                                                    </div> 
                                                    <div class="col-6">
                                                        <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20 d-none  w-100 text-center justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                                                    </div>
                                                @elseif($product->stock_manage == 0)
                                                    <div class="col-6">
                                                        <button type="button" id="add_to_cart_btn" class="amaz_primary_yellow amaz_primary_btn style2 mb_20  add_to_cart text-uppercase add_to_cart_btn flex-fill text-center w-100">{{__('common.add_to_cart')}}</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20  w-100 text-center d-none justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <button type="button" disabled class="amaz_primary_btn style2 mb_20  add_to_cart text-uppercase flex-fill text-center w-100">{{__('defaultTheme.out_of_stock')}}</button>
                                                    </div>
                                                @endif
                                        </div>
                                        <div class="add_wish_compare d-flex alingn-items-center mb_20">
                                            <a id="wishlist_btn" data-product_id="{{$product->id}}" data-seller_id="{{$product->user_id}}" class="single_wish_compare text-uppercase text-nowrap cursor_pointer">
                                                <i class="far fa-heart"></i> {{__('defaultTheme.add_to_wishlist')}}
                                            </a>
                                            <a id="add_to_compare_product_price" class="single_wish_compare text-uppercase text-nowrap cursor_pointer">
                                                <i class="ti-control-shuffle"></i>Compare Packages
                                            </a>
                                            {{-- <a id="add_to_compare_btn_modify d-none" data-product_sku_id="#product_sku_id" data-product_type="{{$product->product->product_type}}" class="single_wish_compare text-uppercase text-nowrap cursor_pointer">
                                                <i class="ti-control-shuffle"></i> {{__('defaultTheme.add_to_compare')}}
                                            </a> --}}
                                            @if(!empty($product->seller) && $product->seller->role_id !=  1 && app('general_setting')->product_report == 1)

                                                <a class="report-product" data-product-id='{{ $product->product_id }}' href="javascript:void(0)">
                                                    <i class="fas fa-ban"></i>
                                                    {{ __('product.report_this_product') }}
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                    <div class="row mt_30 " id="add_to_cart_div">
                                        <div class="col-md-12">
                                            <a href="{{ url('/login') }}" class="amaz_primary_btn w-100">
                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @php
                                $both_buy_product = null;
                                if(@$product->product->display_in_details == 1){
                                    if($product->up_sales->count()){
                                        $both_buy_product = @$product->up_sales[0]->up_seller_products[0];
                                    }
                                }else{
                                    if($product->cross_sales->count()){
                                        $both_buy_product = @$product->cross_sales[0]->cross_seller_products[0];
                                    }
                                }
                            @endphp
                            @if($product->stock_manage == 1 && $product->skus->where('status',1)->first()->product_stock >= $product->product->minimum_order_qty || $product->stock_manage == 0)
                                @if($both_buy_product && $both_buy_product->stock_manage == 1 && $both_buy_product->skus->first()->product_stock >= $both_buy_product->product->minimum_order_qty || $both_buy_product && $both_buy_product->stock_manage == 0)
                                <div class="product_details_sujjetion">
                                    <h4 class="font_14 f_w_700 text-uppercase mb_12 lh-1">{{__('amazy.YOU CAN ALSO BUY')}}:</h4>
                                    <div class="product_details_sujjetion_box">
                                        <a href="{{singleProductURL(@$both_buy_product->seller->slug, $both_buy_product->slug)}}" class="product_details_sujjetion_single d-flex align-items-center gap_15">
                                            @php
                                                if(@$product->hasDeal){
                                                    $both_buy_price = selling_price(@$both_buy_product->skus->first()->sell_price,@$both_buy_product->hasDeal->discount_type,@$both_buy_product->hasDeal->discount);
                                                }else{
                                                    if(@$product->hasDiscount == 'yes'){
                                                        $both_buy_price = selling_price(@$both_buy_product->skus->first()->sell_price,@$both_buy_product->discount_type,@$both_buy_product->discount);
                                                    }else{
                                                        $both_buy_price = @$both_buy_product->skus->first()->sell_price;
                                                    }
                                                }
                                            @endphp
                                            <input type="hidden" id="both_buy_price" value="{{$both_buy_price}}">
                                            <div class="thumb both_buy">
                                                <img src="
                                                @if(@$both_buy_product->thum_img != null)
                                                    {{showImage(@$both_buy_product->thum_img)}}
                                                @else
                                                    {{showImage(@$both_buy_product->product->thumbnail_image_source)}}
                                                @endif
                                                " alt="{{@$both_buy_product->product->product_name}}" title="{{@$both_buy_product->product->product_name}}">
                                            </div>
                                            <div class="product_details_sujjetion_content">
                                                <h4 class="fs-6 f_w_700">@if ($both_buy_product->product_name) {{ textLimit($both_buy_product->product_name,28) }} @else {{textLimit(@$both_buy_product->product->product_name,28)}} @endif</h4>
                                                <p class="font_14 f_w_500 mb-0 lh-1">
                                                    {{single_price($both_buy_price)}}
                                                </p>
                                            </div>
                                        </a>
                                        <div class="product_details_sujjetion_total d-flex align-items-center gap_15">
                                            <div class="product_details_sujjetion_left flex-fill">
                                                <span class="font_12 f_w_500 d-block">{{__('common.total_price')}}:</span>
                                                <h4 id="both_buy_price_show" class="font_16 f_w_700 m-0 lh-1"></h4>
                                            </div>
                                            <a href="#" class="amaz_primary_btn style3 text-uppercase" id="both_buy_btn" data-sku_id="{{ @$both_buy_product->skus->first()->id }}"
                                                data-seller_id="{{ $both_buy_product->user_id }}" data-product_id="{{$both_buy_product->id}}" data-qty="{{@$both_buy_product->product->minimum_order_qty}}" >{{__('amazy.Buy Both')}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif




                            <div class="description_toggle">
                            <div class="section">
                                    <div class="section-header" onclick="toggleSection(this)"> <span><h4 class="font_20 f_w_600 m-0 ">{{__('common.description')}}</h4></span> <span class="toggle-icon">+</span> </div>
                                    <div class="section-content">
                                        <p> @php
                                            echo $product->product->description
                                        @endphp</p>
                                    </div>
                                </div>
                            <div class="section">
                                    <div class="section-header" onclick="toggleSection(this)"> <span><h4 class="font_20 f_w_600 m-0 ">Specifications</h4></span> <span class="toggle-icon">+</span> </div>
                                    <div class="section-content">
                                    <p>@php
                                        echo $product->product->specification;
                                       @endphp</p>
                                    </div>
                                </div>
                            <div class="section">
                                    <div class="section-header" onclick="toggleSection(this)"> <span><h4 class="font_20 f_w_600 m-0 ">Characteristics</h4></span> <span class="toggle-icon">+</span> </div>
                                    <div class="section-content" style="margin:10px;">
                                    <p><a class="anchore_color subscription-btn" style="background:#636a67; "href="{{ asset(asset_path($product->product->pdf)) }}" download>{{ __('product.download_file') }}</a></p>
                                    </div>
                                </div>
                                </div>

                        </div>

                        <div class="products_tabs">
                            <div class="container">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="tab-container">
                                    <div class="tab active" onclick="showTab(event, 'benefits')">Benefits</div>
                                    <div class="tab" onclick="showTab(event, 'terms')">Terms</div>
                                    <div class="tab" onclick="showTab(event, 'cancelation')">Cancelation</div>
                                    <div class="tab" onclick="showTab(event, 'discounts')">Discounts</div>
                                    <div class="tab" onclick="showTab(event, 'video')">Video</div>
                                    </div>
                                    <div id="benefits" class="tab-content active">
                                        <p>@php
                                            echo $product->product->benefits;
                                        @endphp</p>
                                        <span><a href="#" class="subscription-btn">Subscription</a> </span>
                                    </div>
                                    <div id="terms" class="tab-content">
                                     <p>@php
                                        echo $product->product->terms;
                                       @endphp</p>
                                    </div>
                                    <div id="cancelation" class="tab-content">
                                     <p>@php
                                        echo $product->product->cancelation;
                                       @endphp</p>
                                    </div>
                                    <div id="discounts" class="tab-content">
                                    <p>@php
                                        echo $product->product->discounts;
                                       @endphp</p>
                                    </div>
                                <div id="video" class="tab-content">
                                    @php
                                        $videoLink = $product->product->video_link;
                                    @endphp
                                    
                                    @if (!empty($videoLink))
                                        @if (strpos($videoLink, 'youtube.com') !== false || strpos($videoLink, 'youtu.be') !== false)
                                            @php
                                                $videoId = '';
                                                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoLink, $match)) {
                                                    $videoId = $match[1];
                                                }
                                            @endphp
                                            @if ($videoId)
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                            @endif
                                        
                                        @elseif (strpos($videoLink, 'vimeo.com') !== false)
                                            @php
                                                $videoId = preg_replace('/[^0-9]/', '', $videoLink);
                                            @endphp
                                            <iframe src="https://player.vimeo.com/video/{{ $videoId }}" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                        
                                        @elseif (strpos($videoLink, 'dailymotion.com') !== false || strpos($videoLink, 'dai.ly') !== false)
                                            @php
                                                $videoId = '';
                                                if (preg_match('/^.+dailymotion.com\/(?:video|embed\/video)\/([a-zA-Z0-9]+)/', $videoLink, $match) ||
                                                    preg_match('/^.+dai.ly\/([a-zA-Z0-9]+)/', $videoLink, $match)) {
                                                    $videoId = $match[1];
                                                }
                                            @endphp
                                            @if ($videoId)
                                                <iframe 
                                                    width="560" 
                                                    height="315" 
                                                    src="https://www.dailymotion.com/embed/video/{{ $videoId }}?autoplay=0" 
                                                    frameborder="0" 
                                                    allow="autoplay; fullscreen; picture-in-picture" 
                                                    allowfullscreen
                                                    referrerpolicy="no-referrer-when-downgrade">
                                                </iframe>
                                            @endif
                                        
                                        @else
                                            <p>Invalid video URL</p>
                                        @endif
                                    @else
                                        <p>No video available</p>
                                    @endif
                                </div>


                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="space" style="margin:20px 0px"></div>



                        {{-- seler information start --}}
                                <div class="container" style="width:96%">
                                        <div class="row">
                                            @if(isModuleActive('MultiVendor'))
                                                <div class="amazcart_delivery_wiz mb_30">
                                                    <div class="amazcart_delivery_wiz_head d-flex justify-content-between">
                                                        <h4 class="font_18 f_w_700 m-0">{{__('amazy.Seller Information')}}</h4>

                                                        <div class="Information_box_right">
                                                            @if(auth()->check() && auth()->id()!= $product->seller->id)
                                                                @if(auth()->check() && !auth()->user()->follow($product->seller->id))
                                                                    <button type="btn" id="follow_seller_btn" class="subscription-btn style3 text-uppercase">{{__('common.follow')}}</button>
                                                                @elseif(auth()->check() && auth()->user()->follow($product->seller->id))
                                                                    <button type="btn" class="subscription-btn style3 text-uppercase">{{__('amazy.Followed')}}</button>
                                                                @endif
                                                            @elseif(!auth()->check())
                                                                <a href="{{url('/login')}}" class="subscription-btn style3 text-uppercase">{{__('common.follow')}}</a>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="amazcart_delivery_wiz_body" >
                                                        @php
                                                            $seller_rating_avg = $product->seller->sellerReviews()->where('status',1)->avg('rating');
                                                            $seller_score = ($seller_rating_avg * 20);
                                                        @endphp
                                                            <input type="hidden" class="form-control" name="seller_id" id="seller_id" value="{{$product->seller->id}}">
                                                            <div class="Information_box d-flex gap-2 flex-wrap ">
                                                                <div class="Information_box_left flex-fill">
                                                                        <h4 class="font_14 f_w_700 mb-0">
                                                                        <a id="shopLink" href="
                                                                            @if ($product->seller->slug)
                                                                                {{route('frontend.seller',$product->seller->slug)}}
                                                                            @else
                                                                                {{route('frontend.seller',base64_encode($product->seller->id))}}
                                                                            @endif
                                                                        ">
                                                                            @if($product->seller->role->type == 'seller')
                                                                                @if (@$product->seller->SellerAccount->seller_shop_display_name)
                                                                                    {{ @$product->seller->SellerAccount->seller_shop_display_name }}
                                                                                @else
                                                                                    {{$product->seller->first_name .' '.$product->seller->last_name}}
                                                                                @endif
                                                                            @else
                                                                                {{ app('general_setting')->company_name }}
                                                                            @endif
                                                                        </a>
                                                                    </h4>
                                                                    <div class="single_info_seller d-flex align-items-center gap_15">
                                                                        <h4 class="font_14 f_w_500 m-0">{{getNumberTranslate($seller_score)}}%</h4>
                                                                        <p class="font_14 f_w_400 m-0">{{__('amazy.Seller Score')}}</p>
                                                                    </div>
                                                                    <div class="single_info_seller d-flex align-items-center gap_15">
                                                                        <h4 class="font_14 f_w_500 m-0" id="follow_seller_count">{{getNumberTranslate($product->seller->countFollow())}}</h4>
                                                                        <p class="font_14 f_w_400 m-0">{{__('amazy.Followers')}}</p>
                                                                    </div>
                                                                </div>

                                                        <div class="seller_performance_box" style=" border-top:0; margin-top:0; padding-top:0;">
                                                            <h4 class="font_14 f_w_700 text-uppercase ">{{__('amazy.Seller Performance')}}</h4>

                                                            @php
                                                                $total_review = $product->seller->sellerReviews->where('status',1)->sum('rating');
                                                                $review_count = $product->seller->sellerReviews->where('status',1)->count();
                                                            @endphp
                                                            @php
                                                                $review  = 1;
                                                                if( $total_review > 0 && review_count > 0){
                                                                    $review = round($total_review /$review_count,0);
                                                                }

                                                            @endphp
                                                                <div class="single_seller_performance d-flex align-items-center gap_10 mb-1">
                                                                    <img src="{{showImage('frontend/amazy/img/product_details/star.svg')}}" alt="{{@$product->seller->SellerAccount->seller_shop_display_name}}" title="{{@$product->seller->SellerAccount->seller_shop_display_name}}">
                                                                    <p class="font_14 f_w_400 m-0">{{__('amazy.Order Fulfilment Rate')}}:</p>
                                                                    <h4 class="font_14 f_w_500 m-0">
                                                                        @if($review == 1)
                                                                        {{__('Excellent')}}
                                                                        @elseif($review == 2)
                                                                        {{__('common.poor')}}
                                                                        @elseif($review == 3)
                                                                        {{__('common.neutral')}}
                                                                        @elseif($review == 4)
                                                                        {{__('common.satisfactory')}}
                                                                        @elseif($review == 5)
                                                                        {{__('common.delightful')}}
                                                                        @endif
                                                                    </h4>
                                                                </div>
                                                                {{-- @dd($product->seller); --}}
                                                                <div class="seller_dashboard_link mt-2">
                                                                    <a href="{{route('frontend.seller',$product->seller->id)}}"
                                                                        class="primary-btn radius_30px mr-10 fix-gr-bg"> View Seller Shop
                                                                    </a>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


            {{-- seler information end --}}




                <div class="col-xl-0">
                    @php
                        $free_shipping = \Modules\Shipping\Entities\ShippingMethod::where('request_by_user', $product->user_id)->where('is_active', 1)->where('id','>', 1)->where('cost', 0)->first();
                    @endphp
                    <div class="amazcart_delivery_wiz mb_20" style="display:none;">
                        <div class="amazcart_delivery_wiz_body">
                            <div class="loc_city_selectBox d-flex flex-column">
                                <div class="selectBox_box" >
                                    @php
                                        $pickup_locations = \Modules\Shipping\Entities\PickupLocation::where('created_by', $product->user_id)->where('status', 1)->get();
                                    @endphp
                                    <select class="amaz_select2 w-100" id="selectPickup">
                                        <option data-display="Choose pickup location" disabled>{{__('amazy.Choose pickup location')}}</option>
                                        @if($pickup_locations)
                                        @foreach($pickup_locations as $pickup_location)
                                            <option value="{{$pickup_location->id}}" {{$pickup_location->is_default?'selected':''}}>{{$pickup_location->address}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- product_details_wrapper::end  -->

{{-- <div class="container" >
    <div class="row">
        <div class="col-12" id="Reviews">
            @include(theme('partials._product_review_with_paginate'),['reviews' => @$product->ActiveReviewsWithPaginate, 'all_reviews' => $product->reviews])
        </div>
    </div>
</div> --}}

{{-- new products --}}

<div class="single_product_page">
<div class="ninth_section_product">
                <div class="container">
                    <div class="row">
                    <div class="col-md-12 d-flex align-items-center gap-3 mb_30">
                        <h1 class="m-0 flex-fill">{{__('amazy.Customers who viewed this also viewed')}}</h1>
                    </div>
                    </div>
                </div>
                @php
                    $top_selling_products = $widgets->where('section_name', 'top_picks')->first();
                @endphp
                <div class="wrapper">
                    <div class="center-slider-collection">
                        @foreach($top_selling_products->getHomePageProductByQuery()->take(50) as $key => $singleproduct)
                        @php
                        if (@$singleproduct->thum_img != null) {
                            $thumbnail = showImage(@$singleproduct->thum_img);
                        } else {
                            $thumbnail = showImage(@$singleproduct->product->thumbnail_image_source);
                        }
                        $price_qty = getProductDiscountedPrice(@$singleproduct);
                        $showData = [
                            'name' => @$singleproduct->product_name,
                            'url' => singleProductURL(@$singleproduct->seller->slug, @$singleproduct->slug),
                            'price' => $price_qty,
                            'thumbnail' => $thumbnail,
                        ];
                        @endphp
                        <div>
                            <div class="bottom_slider_content">
                                <div class="top_btn_sale">
                                    <button class="best_selling">Best Selling</button>
                                    @php
                                    if (@$singleproduct->thum_img != null) {
                                        $thumbnail = showImage(@$singleproduct->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$singleproduct->product->thumbnail_image_source);
                                    }
                                    @endphp
                                    <a href="{{ singleProductURL($singleproduct->seller->slug, $singleproduct->slug) }}" class="thumb">
                                        @if(app('general_setting')->lazyload == 1)
                                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                alt="{{ @$singleproduct->product_name }}" title="{{ @$singleproduct->product_name }}"
                                                class="lazyload">
                                        @else
                                            <img src="{{ $thumbnail }}" alt="{{ @$singleproduct->product_name }}" title="{{ @$singleproduct->product_name }}">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <p class="product_name">{{ Str::limit($singleproduct->product_name, 35, '...') }}</p>
                            <div class="rating"><span>
                            @php
                                $reviews = @$singleproduct->reviews->where('status', 1)->pluck('rating');

                                if (count($reviews) > 0) {
                                    $value = 0;
                                    $rating = 0;
                                    foreach ($reviews as $review) {
                                        $value += $review;
                                    }
                                    $rating = $value / count($reviews);
                                    $total_review = count($reviews);
                                } else {
                                    $rating = 0;
                                    $total_review = 0;
                                }
                            @endphp
                            <x-rating :rating="$rating" /></span> </div>
                            <div class="buttons">
                                <div class="add_to_cart">
                                    @if(isGuestAddtoCart())
                                        <button class="add-to-cart addToCartFromThumnail"
                                            data-producttype="{{ @$singleproduct->product->product_type }}"
                                            data-seller="{{ $singleproduct->user_id }}"
                                            data-product-sku="{{ @$singleproduct->skus->first()->id }}"
                                            @if (@$singleproduct->hasDeal)
                                                data-base-price="{{ selling_price(@$singleproduct->skus->first()->sell_price, @$singleproduct->hasDeal->discount_type, @$singleproduct->hasDeal->discount) }}"
                                            @else
                                                @if (@$singleproduct->hasDiscount == 'yes')
                                                    data-base-price="{{ selling_price(@$singleproduct->skus->first()->sell_price, @$singleproduct->discount_type, @$singleproduct->discount) }}"
                                                @else
                                                    data-base-price="{{ @$singleproduct->skus->first()->sell_price }}"
                                                @endif
                                            @endif
                                            data-shipping-method="0"
                                            data-product-id="{{ $singleproduct->id }}"
                                            data-stock_manage="{{ $singleproduct->stock_manage }}"
                                            data-stock="{{ @$singleproduct->skus->first()->product_stock }}"
                                            data-min_qty="{{ @$singleproduct->product->minimum_order_qty }}"
                                            data-prod_info="{{ json_encode($showData) }}">
                                            {{ __('defaultTheme.add_to_cart') }}
                                        </button>
                                    @else
                                        <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="{{ url('/login') }}">
                                            {{ __('defaultTheme.login_to_order') }}
                                        </a>
                                    @endif
                                </div>
                                @if(!auth()->check())
                                 <div class="price">
                                    {{-- @if (getProductwitoutDiscountPrice(@$singleproduct) != single_price(0))
                                        <span class="old-price">{{ getProductwitoutDiscountPrice(@$singleproduct) }}</span>
                                    @endif --}}
                                    <br>
                                    <span>${{ number_format($singleproduct->skus->first()->selling_price, 2) }}</span>
                                    <span class="price_subscribers">Price for subscribers*</span>
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
                                        $selling_price = @$product->skus->first()->selling_price;
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
                                     <div class="price">
                                        <span class="old-price">${{ number_format($selling_price, 2) }}</span>
                                    <br>
                                    <span>${{ number_format($finalPriceAfterDiscount, 2) }}</span>
                                    <span class="price_subscribers">Price for subscribers*</span>
                                </div>
                                @else
                                 @php 
                                  $selling_price = $singleproduct->skus->first()->selling_price;
                                //   dd($selling_price);
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
                                //    dd($finalPriceAfterDiscount);
                                 @endphp 
                                  <div class="price">
                                        <span class="old-price">${{ number_format($selling_price, 2) }}</span>
                                    <br>
                                    <span>${{ number_format($finalPriceAfterDiscount, 2) }}</span>
                                    <span class="price_subscribers">Price for subscribers*</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>


{{-- new products --}}

{{-- subscription start --}}

                            @php
                                use Modules\FrontendCMS\Entities\PricingPlan;

                                $subscription_plans = PricingPlan::with(['discountRole','subscriptionPayments' => function ($query) {
                                    $query->where('customer_id', @auth()->user()->id)
                                        ->where(function ($q) {
                                            $q->where('status', 'Pending')
                                                ->orWhere('status', 'Active')
                                                ->orWhere('status', 'Expired');
                                        });
                                }])->where('status', 1)
                                ->get();



                            @endphp


                                <div class="seventh_section" id="seventh_section" style="background:#d1d1d1; padding:10px 0px;">
                                <div class="container">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <h1 class="first_head" style="color:black;">Subscribe and save</h1>
                                         </div>
                                    </div>
                                </div>
                                <div class="slide-container swiper">
                                    <div class="slide-content">
                                    <div class="card-wrapper swiper-wrapper">
                                        @if($subscription_plans->count() > 0)
                                            @foreach($subscription_plans as $plan)
                                            <div class="card swiper-slide">
                                            <div class="card-content">
                                                <h1 class="name">{{ $plan->name ?? 'Lorem' }}</h1>
                                                <p class="description" style="margin-bottom: 30px">{!! $plan->description  !!}</p>
                                                <h1 class="name">${{ number_format($plan->plan_price ?? 200) }}</h1>




                                                @php
                                                    // Check if there's a subscription payment with status "Pending", "Active", or "Expired"
                                                    $subscription = $plan->subscriptionPayments->first();
                                                @endphp

                                                <div class="d-flex mt-4">
                                                    @if($subscription && $subscription->status == "Pending")
                                                        {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg plan_cancel_btn btn-outline-secondary mr_5">{{__('common.cancel')}}</a> --}}

                                                        <button class="btn btn-lg btn-outline-dark buy-now-btn text-white" style="padding: 3px 10px; background-color: red; border-radius: 13px !important;" disabled>
                                                            {{ __('common.pending_plan') }}
                                                        </button>
                                                    @elseif($subscription && $subscription->status == "Active")
                                                        {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg mt-4 plan_cancel_btn btn-block btn-outline-secondary">{{__('common.cancel')}}</a> --}}

                                                        <button class="button" style="background-color : cornsilk;" disabled>
                                                            {{ __('common.active_plan') }}
                                                        </button>
                                                    @elseif($subscription && $subscription->status == "Expired")
                                                        <button class="button" style="background-color : rgb(192 206 56); color :red;" disabled>
                                                            {{ __('common.expired') }}
                                                        </button>
                                                        @if(auth()->check())
                                                        <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="button paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                                                            {{ __('common.buy_now') }}
                                                        </a>
                                                        @else
                                                        <a href="{{ url('/login') }}" class="button">
                                                            {{ __('common.buy_now') }}
                                                        </a>
                                                        @endif
                                                    @else
                                                    @if(auth()->check())
                                                    <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="button paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                                                        {{ __('common.buy_now') }}
                                                    </a>
                                                    @else
                                                    <a href="{{ url('/register') }}" class="button">
                                                        {{ __('common.buy_now') }}
                                                    </a>
                                                    @endif
                                                  @endif
                                                </div>



                                            </div>
                                            </div>

                                            @endforeach
                                        @else
                                            {{-- Fallback to static content if no plans are available --}}
                                            <div class="card swiper-slide">
                                            <div class="image-content"> </div>
                                            <div class="card-content">
                                                <h1 class="name">Lorem</h1>
                                                <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
                                                <h1 class="name">$200</h1>
                                                <p>Access for 30 days</p>
                                                <button class="button">Buy now</button>
                                                <ul>
                                            </div>
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="swiper-button-prev swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/left_arrow.png')}}"></div>
                                    <div class="swiper-button-next swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/right_arrow.png')}}"></div>
                                </div>
                                </div>


                    </div>
                </div>
   <div id="paypalModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete Your Subscription Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
</div>
<div id="compareProductPriceModal" class="modal fade" tabindex="-1" role="dialog" style="display: none; background-color: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center;">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px; width: 100%; border-radius: 8px; overflow: hidden;">
        <div class="modal-content" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #00ab43; padding: 15px; border-bottom: 1px solid #ddd;">
                <h5 class="modal-title" style="margin: 0; font-size: 18px; color:white;">Compare Package Prices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 24px; color: black; cursor: pointer; padding: 0; line-height: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 15px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f1f1f1;">
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Tier 1 Price</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Tier 2 Price</th>
                            <th style="padding: 10px; border-bottom: 1px solid #ddd;">Tier 3 Price</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffffff;">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    if ($(".dropdown").length) {
  $(document).on("click", ".dropdown-menu .dropdown-item", function (e) {
    e.preventDefault();
    if (!$(this).hasClass("active")) {
      var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary",
          cancelButton: "btn btn-danger me-3",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "Do you really want to change your current language!",
          icon: "warning",
          confirmButtonText: "<i class='fas fa-check-circle me-1'></i> Yes, I am!",
          cancelButtonText: "<i class='fas fa-times-circle me-1'></i> No, I'm Not",
          showCancelButton: true,
          reverseButtons: true,
          focusConfirm: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            if (!$(this).hasClass("active")) {
              $(".dropdown-menu .dropdown-item").removeClass("active");
              $(this).addClass("active");
              $(this)
                .parents(".dropdown")
                .find(".btn")
                .html("<span class='flag-icon flag-icon-us me-1'></span>" + $(this).text());
            }
            Swal.fire({
              icon: "success",
              title: "Amazing!",
              text: "Your current language has been changed successfully.",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        });
    }
  });
}


var swiper = new Swiper(".slide-content", {
  slidesPerView: 3,
  spaceBetween: 25,
  loop: true,
  centerSlide: 'true',
  fade: 'true',
  grabCursor: 'true',
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 3,
    },
  },
});

</script>



{{-- subscription end --}}

    @if ($product->related_sales->count() > 0)
        <!-- sujjested_prosuct_area::start  -->
        <div class="sujjested_prosuct_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section__title d-flex align-items-center gap-3 mb_30">
                            <h3 class="m-0 flex-fill">{{__('defaultTheme.related_products')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($product->related_sales as $key => $related_sale)
                        @foreach ($related_sale->related_seller_products->take(2) as $key => $related_seller_product)
                            <div class="col-xl-3 col-lg-4 col-md-6 d-flex">
                                <div class="product_widget5 mb_30 style5 w-100">
                                    <div class="product_thumb_upper">
                                        @php
                                            if(@$related_seller_product->thum_img != null){
                                                $thumbnail = showImage(@$related_seller_product->thum_img);
                                            }else {
                                                $thumbnail = showImage(@$related_seller_product->product->thumbnail_image_source);
                                            }
                                            $price_qty = getProductDiscountedPrice(@$related_seller_product);
                                            $showData = [
                                                'name' => @$related_seller_product->product_name,
                                                'url' => singleProductURL(@$related_seller_product->seller->slug, @$related_seller_product->slug),
                                                'price' => $price_qty,
                                                'thumbnail' => $thumbnail
                                            ];
                                        @endphp
                                        <a href="{{singleProductURL(@$related_seller_product->seller->slug, $related_seller_product->slug)}}" class="thumb">
                                            @if(app('general_setting')->lazyload == 1)
                                             <img data-src="{{$thumbnail}}" src="{{ showImage(themeDefaultImg()) }}"alt="{{@$related_seller_product->product_name}}" title="{{@$related_seller_product->product_name}}" class="lazyload">
                                            @else
                                             <img  src="{{$thumbnail}}"  alt="{{@$related_seller_product->product_name}}" title="{{@$related_seller_product->product_name}}" >
                                            @endif
                                        </a>
                                        @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="" class="addToCompareFromThumnail" data-producttype="{{ @$related_seller_product->product->product_type }}" data-seller={{ $related_seller_product->user_id }} data-product-sku={{ @$related_seller_product->skus->first()->id }} data-product-id={{ $related_seller_product->id }}>
                                                    <i class="ti-control-shuffle" title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="" class="add_to_wishlist {{$related_seller_product->is_wishlist() == 1?'is_wishlist':''}}" id="wishlistbtn_{{$related_seller_product->id}}" data-product_id="{{$related_seller_product->id}}" data-seller_id="{{$related_seller_product->user_id}}">
                                                    <i class="ti-heart"  title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{$related_seller_product->id}}" data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="product_badge">
                                            @if(isGuestAddtoCart())
                                                @if($related_seller_product->hasDeal)
                                                    @if($related_seller_product->hasDeal->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($related_seller_product->hasDeal->discount_type ==0)
                                                                {{getNumberTranslate($related_seller_product->hasDeal->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($related_seller_product->hasDeal->discount)}} {{__('common.off')}}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @else
                                                    @if($related_seller_product->hasDiscount == 'yes')
                                                        @if($related_seller_product->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($related_seller_product->discount_type ==0)
                                                                    {{getNumberTranslate($related_seller_product->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($related_seller_product->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            @if(isModuleActive('ClubPoint'))
                                            <span class="d-flex align-items-center point">
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" >
                                                    <path d="M15 7.6087V10.087C15 11.1609 12.4191 12.5652 9.23529 12.5652C6.05153 12.5652 3.47059 11.1609 3.47059 10.087V8.02174M3.71271 8.2357C4.42506 9.18404 6.628 10.0737 9.23529 10.0737C12.4191 10.0737 15 8.74704 15 7.60704C15 6.96683 14.1872 6.26548 12.9115 5.77313M12.5294 3.47826V5.95652C12.5294 7.03044 9.94847 8.43478 6.76471 8.43478C3.58094 8.43478 1 7.03044 1 5.95652V3.47826M6.76471 5.9433C9.94847 5.9433 12.5294 4.61661 12.5294 3.47661C12.5294 2.33578 9.94847 1 6.76471 1C3.58094 1 1 2.33578 1 3.47661C1 4.61661 3.58094 5.9433 6.76471 5.9433Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                {{ @$related_seller_product->product->club_point }}
                                            </span>
                                            @endif
                                            @if(isModuleActive('WholeSale') && @$related_seller_product->skus->first()->wholeSalePrices->count())
                                                <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product_star mx-auto">
                                        @php

                                        $reviews = $related_seller_product->reviews->where('status',1)->pluck('rating');
                                        if(count($reviews)>0){
                                            $value = 0;
                                            $rating = 0;
                                            foreach($reviews as $review){
                                                $value += $review;
                                            }
                                            $rating = $value/count($reviews);
                                            $total_review = count($reviews);
                                        }else{
                                            $rating = 0;
                                            $total_review = 0;
                                        }
                                    @endphp

                                        <x-rating :rating="$rating" />
                                    </div>
                                    <div class="product__meta text-center">
                                        <span class="product_banding ">{{ @$related_seller_product->brand->name ?? " " }}</span>
                                        <a href="{{singleProductURL(@$related_seller_product->seller->slug, $related_seller_product->slug)}}">
                                            <h4>@if ($related_seller_product->product_name) {{ textLimit(@$related_seller_product->product_name, 50) }} @else {{ textLimit(@$related_seller_product->product->product_name, 50) }} @endif</h4>
                                        </a>

                                        @if(isGuestAddtoCart())
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn add_cart add_to_cart addToCartFromThumnail" data-producttype="{{ @$related_seller_product->product->product_type }}" data-seller={{ $related_seller_product->user_id }} data-product-sku={{ @$related_seller_product->skus->first()->id }}
                                                @if(@$related_seller_product->hasDeal)
                                                    data-base-price={{ selling_price(@$related_seller_product->skus->first()->sell_price,@$related_seller_product->hasDeal->discount_type,@$related_seller_product->hasDeal->discount) }}
                                                @else
                                                    @if(@$related_seller_product->hasDiscount == 'yes')
                                                        data-base-price={{ selling_price(@$related_seller_product->skus->first()->sell_price,@$related_seller_product->discount_type,@$related_seller_product->discount) }}
                                                    @else
                                                        data-base-price={{ @$related_seller_product->skus->first()->sell_price }}
                                                    @endif
                                                @endif
                                                data-shipping-method=0
                                                data-product-id={{ $related_seller_product->id }}
                                                data-stock_manage="{{$related_seller_product->stock_manage}}"
                                                data-stock="{{@$related_seller_product->skus->first()->product_stock}}"
                                                data-min_qty="{{@$related_seller_product->product->minimum_order_qty}}"
                                                data-prod_info="{{ json_encode($showData) }}"
                                                ><svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                    <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                </svg>
                                                {{__('defaultTheme.add_to_cart')}}
                                            </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$related_seller_product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$related_seller_product)}}
                                                        </del>
                                                     @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$related_seller_product)}}
                                                    </strong>
                                                </p>
                                        </div>
                                        @else
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn add_cart w-100 " style="text-indent: 0;" href="{{ url('/login') }}">
                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <!-- sujjested_prosuct_area::end  -->
    @endif



<div class="above_footer_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="above_footer_first">
          <div class="payment_gitway"> <img src="{{asset('public/frontend/amazy/img/home/visa.png')}}"> </div>
          <div class="payment_gitway"> <img src="{{asset('public/frontend/amazy/img/home/master.png')}}"> </div>
          <div class="payment_gitway"> <img src="{{asset('public/frontend/amazy/img/home/maestro.png')}}"> </div>
          <div class="payment_gitway"> <img src="{{asset('public/frontend/amazy/img/home/paypal.png')}}"> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12" id="Reviews">
            @include(theme('partials._product_review_with_paginate'),['reviews' => @$product->ActiveReviewsWithPaginate, 'all_reviews' => $product->reviews])
        </div>

    </div>
</div>




    @if(@$product->hasDeal)
        <input type="hidden" id="discount_type" value="{{@$product->hasDeal->discount_type}}">
        <input type="hidden" id="discount" value="{{@$product->hasDeal->discount}}">
    @else
        @if(@$product->hasDiscount == 'yes')
        <input type="hidden" id="discount_type" value="{{$product->discount_type}}">
        <input type="hidden" id="discount" value="{{$product->discount}}">
        @else
        <input type="hidden" id="discount_type" value="{{$product->discount_type}}">
        <input type="hidden" id="discount" value="0">
        @endif
    @endif



    <!--for whole sale price -->
    @if(isModuleActive('WholeSale'))
        <input type="hidden" id="getWholesalePrice" value="@if(@$product->skus->where('status',1)->first()->wholeSalePrices->count()){{ json_encode(@$product->skus->where('status',1)->first()->wholeSalePrices) }} @else 0 @endif">
    @endif
    <input type="hidden" id="isWholeSaleActive" value="{{isModuleActive('WholeSale')}}">
    <input type="hidden" id="isMultiVendorActive" value="{{isModuleActive('MultiVendor')}}">
    @include(theme('components.product_report'),compact('reasons','product'))
@endsection




@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const paypalButtons = document.querySelectorAll('.paypal-payment-btn');

    paypalButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // Set dynamic amount from the clicked plan
            const planPrice = event.target.getAttribute('data-plan-price');
            var pricing_plan_id = event.target.getAttribute('data-plan-id');
            // Show the modal
            $('#paypalModal').modal('show');

            // Remove previous PayPal button instance if it exists
            document.getElementById('paypal-button-container').innerHTML = '';

            // Render the PayPal button in the modal and trigger it automatically
            paypal.Buttons({
                fundingSource: paypal.FUNDING.CARD,
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: planPrice // Dynamic total amount
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Handle the payment success
                        const paymentData = {
                            payment_id: details.id,
                            pricing_plan_id:pricing_plan_id,
                            payer_id: details.payer.payer_id,
                            amount: details.purchase_units[0].amount.value,
                            status: details.status,
                            type:'customer_subscription_payment'
                        };
                        $('#pre-loader').show();

                        fetch('{{ route("paypal.success") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(paymentData)
                        }).then(response => response.json())
                        .then(data => {
                          $('#pre-loader').hide();
                          $('#paypalModal').modal('hide')
                            if (data.success) {
                                toastr.success("Subscription payment successful", "{{__('common.success')}}");
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.error('Payment failed: ' + data.message, "{{__('common.error')}}");
                            }
                        }).catch(error => {
                            $('#pre-loader').hide();
                            $('#paypalModal').modal('hide')
                            toastr.error('An error occurred: ' + error.message, "{{__('common.error')}}");
                        });
                    });
                }
            }).render('#paypal-button-container'); // Renders PayPal button inside modal
        });
    });
});
$(".close").click(function(){
  $('#paypalModal').modal('hide');
});

$('#add_to_compare_product_price').click(function() {
    // Find the first non-empty span with id 'get_price_to_compare'
    var price = null;
    var price = parseFloat($('#new_get_price_to_compare').val().replace('$', '').trim()) || 0; // Check the value in the console
    // alert(price);
    // Ensure a valid price was found
    if (price !== null) {
        // Make AJAX call to the backend
        $.ajax({
            url: '/compare-product-price/' + price,
            method: 'GET',
            success: function(response) {
                // Handle the response
                if (response.success) {
                    // Example handling of returned data
                    var tierPrices = response.data;
                    $('#compareProductPriceModal .modal-body table tbody').html(`
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">&nbsp;&nbsp;$&nbsp;${tierPrices.tier1}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">&nbsp;&nbsp;$&nbsp;${tierPrices.tier2}</td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">&nbsp;&nbsp;$&nbsp;${tierPrices.tier3}</td>
                        </tr>
                    `);
                  $('#compareProductPriceModal').modal('show');
                } else {
                    toastr.error("Failed to retrieve price comparisons ","{{__('common.error')}}");
                }
            },
        });
    } else {
        toastr.error("No valid price found to compare","{{__('common.error')}}");
    }
});

$(".close").click(function(){
   $('#compareProductPriceModal').modal('hide');
});
</script>
<script type="text/javascript">
    $('.center-slider-collection').slick({
  slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
    centerPadding: '20px',
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: false,
  responsive: [
    {
      breakpoint: 768, // Screen width for mobile devices
      settings: {
        slidesToShow: 1, // Number of slides to show
        slidesToScroll: 1,
        centerMode: false // Optional, keeps the centered slide in focus
      }
    }
  ]

});
</script>
<script type="text/javascript">
    $('.center-slider-top').slick({
  slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
    centerPadding: '20px',
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: false,
  responsive: [
    {
      breakpoint: 768, // Screen width for mobile devices
      settings: {
        slidesToShow: 1, // Number of slides to show
        slidesToScroll: 1,
        centerMode: false // Optional, keeps the centered slide in focus
      }
    }
  ]

});
</script>
<script>
// Get the button
let mybutton = document.getElementById("myBtn");
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<script>
        function toggleSection(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('.toggle-icon');
            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                icon.textContent = "-";
            } else {
                content.style.display = "none";
                icon.textContent = "+";
            }
        }
    </script>
<script>
        function showTab(event, tabId) {
            // Hide all tab content
            var tabContents = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }
            // Remove active class from all tabs
            var tabs = document.getElementsByClassName('tab');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }
            // Show the clicked tab's content and mark the tab as active
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>





<script src="{{ asset(asset_path('frontend/default/js/zoom.js')) }}"></script>
<script src="{{ asset(asset_path('frontend/default/js/lightbox.js')) }}"></script>
<script>
    (function($){
        "use strict";
        $(document).ready(function(){

            if($(window).outerWidth() > 767 ){
                zoom_enable();
            }

            function zoom_enable(){
                $(".zoom_01").elevateZoom({
                    zoomEnabled: true,
                    zoomWindowHeight:120,
                    zoomWindowWidth:120,
                    zoomLevel:.9
                });
            }

            @if(isModuleActive('CheckPincode'))
                $('#check_pincode_btn').click(function(e){
                    e.preventDefault();
                    var pin_code = $('#check_pincode').val();
                    var seller_id = $('#seller_id').val();

                    $('#pre-loader').show();
                    var data = {pin_code: pin_code,seller_id: seller_id, _token: '{{csrf_token()}}'};
                    $.post("{{route('checkpincode.pin.code.availablity')}}",data,function(response){
                        if(response.data != null){
                            $('.not_serve').addClass('d-none');
                            $('.availablity_show_div').removeClass('d-none');
                            $('#pin_code_area').text(response.data.city+", "+response.data.state);
                            $('#pin_code_delivery').text(response.data.delivery_days+" days");
                            if(response.pinConfig.delivery_days_status==1){
                                $('.pdelivery').removeClass('d-none');
                            }
                            else{
                                $('.pdelivery').addClass('d-none');
                            }
                        }else{
                            $('.availablity_show_div').addClass('d-none');
                            $('.not_serve').removeClass('d-none');
                        }
                        $('#pre-loader').hide();
                    });

                });
            @endif

            if($('#isWholeSaleActive').val() == 1 && $('#getWholesalePrice').val() != 0){
                var getWholesalePrice = JSON.parse($('#getWholesalePrice').val());
                if(getWholesalePrice){
                    appendWholeSaleP();
                    $('.append_w_s_p_tbl').removeClass('d-none');
                }else {
                    $('.append_w_s_p_tbl').addClass('d-none');
                }
            }else{
                var getWholesalePrice = null;
            }
            both_buy_price($('#base_sku_price').val().trim());
            function both_buy_price(product_price){
                let both_buy_price = $('#both_buy_price').val();
                let qty = $('.qty').data('value');
                let total_product_price = parseFloat(product_price) * parseInt(qty);
                let total = currency_format(total_product_price + parseFloat(both_buy_price));
                $('#both_buy_price_show').text(total);
            }
            $(document).on('click', '.page_link', function(event){
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            $(document).on('click','.report-product',function(){
                $("#report_modal").modal('show');
            });

            function fetch_data(page){
                $('#pre-loader').show();
                var url = "{{route('frontend.product.reviews.get-data')}}" + '?product_id='+ "{{$product->id}}" +'&page=' + page;
                if(page != 'undefined'){
                    $.ajax({
                        url: url,
                        success:function(data)
                        {
                            $('#Reviews').html(data);
                            $('#pre-loader').hide();
                        }
                    });
                }else{
                    toastr.warning('this is undefined');
                }
            }
            var productType = $('.product_type').val();
            if (productType == 2) {
                '@if (session()->has('item_details') != '')'+
                    '@foreach (session()->get('item_details') as $key => $item)'+
                        '@if ($item['attr_id'] === 1)'+
                            '@foreach ($item['value'] as $k => $value_name)'+
                                $(".colors_{{$k}}").css("background", "{{ $item['code'][$k]}}");
                            '@endforeach'+
                        '@endif'+
                    '@endforeach'+
                '@endif'
            }
            $(document).on('click', '.attr_val_name', function(){
                $(this).parent().parent().find('.attr_value_name').val($(this).attr('data-value')+'-'+$(this).attr('data-value-key'));
                $(this).parent().parent().find('.attr_value_id').val($(this).attr('data-value')+'-'+$(this).attr('data-value-key'));
                if ($(this).attr('color') == "color") {
                    $(this).closest('.color_List').find('.attr_clr').removeClass('selected_btn');
                }
                if ($(this).attr('color') == "not") {
                    $(this).closest('.color_List').find('.not_111').removeClass('selected_btn');
                }
                $(this).addClass('selected_btn');
                get_price_accordint_to_sku();

            });


            $(document).on('click', '.item-slick', function(event){
                var logo = $(this).children().attr("src");
                $('.varintImg').attr("src", logo);
                $('.varintImg').data("zoom-image", logo);
                $('.varintImg').addClass('zoom_01');
                if($(window).outerWidth() > 767 ){
                    zoom_enable();
                }
            });


            $(document).on('click', '.add_to_cart_btn', function(event){
                event.preventDefault();
                var showData = {
                    'name' : "{{ @$product->product_name }}",
                    'url' : "{{singleProductURL(@$product->seller->slug, @$product->slug)}}",
                    'price': '$' + $('#final_price').val(),
                    'thumbnail' : $('#thumb_image').val()
                };
                // let shipping_type=1;
                // console.log(shipping_type);
                // addToCart($('#product_sku_id').val(),$('#seller_id').val(),$('#qty').data('value'),$('#base_sku_price').val().trim(),shipping_type,'product',showData);
                addToCart($('#product_sku_id').val(),$('#seller_id').val(),$('#qty').data('value'),$('#base_sku_price').val().trim(),$('#shipping_type').val(),'product',showData);
            });
            $(document).on('click', '#both_buy_btn', function (event){
                event.preventDefault();
                let product_sku_id = $(this).data('sku_id');
                let product_id = $(this).data('product_id');
                let qty = $(this).data('qty');
                let seller_id = $(this).data('seller_id');
                addToCart(product_sku_id, seller_id, qty, $('#both_buy_price').val(), '0', 'product');
                addToCart($('#product_sku_id').val(),$('#seller_id').val(),$('#qty').data('value'),$('#base_sku_price').val().trim(),$('#shipping_type').val(),'product');
            });
            $(document).on('click', '#wishlist_btn', function(event){
                event.preventDefault();
                let product_id = $(this).data('product_id');
                let seller_id = $(this).data('seller_id');
                let type = "product";
                let is_login = $('#login_check').val();
                if(is_login == 1){
                    addToWishlist(product_id, seller_id, type);
                }else{
                    toastr.warning("{{__('defaultTheme.please_login_first')}}","{{__('common.warning')}}");
                }
            });
            $(document).on('click', '#add_to_compare_btn_modify', function(event){
                event.preventDefault();
                let product_sku_class = $(this).data('product_sku_id');
                let product_sku_id = $(product_sku_class).val();
                let product_type = $(this).data('product_type');
                addToCompare(product_sku_id, product_type, 'product');
            });
            $(document).on('click', '.qtyChange', function(event){
                event.preventDefault();
                let value = $(this).data('value');
                qtyChange(value);
            });

            $(document).on('keyup', '#qty', function(event){
                event.preventDefault();
                let qty = $(this).val();
                let available_stock = $('#availability').html();
                let stock_manage_status = $('#stock_manage_status').val();
                let maximum_order_qty = $('#maximum_order_qty').val();
                let minimum_order_qty = $('#minimum_order_qty').val();
                if (stock_manage_status != 0) {
                    if (parseInt(qty) < parseInt(available_stock)) {
                        if (maximum_order_qty != '' && maximum_order_qty != '') {
                            if(parseInt(qty)>=1){
                                if(parseInt(qty) > parseInt(maximum_order_qty) && parseInt(qty) > parseInt(minimum_order_qty)){
                                    toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}');
                                }else if(parseInt(qty) < parseInt(maximum_order_qty) && parseInt(qty) < parseInt(minimum_order_qty)){
                                    toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                                }else{
                                    let qty1 = parseInt(qty)
                                    $('#qty').val(numbertrans(qty1));
                                    $('#qty').data('value',qty1);
                                    totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                                }
                            }else{
                                if (parseInt(qty) == 0) {
                                    toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                                }
                                return false;
                            }
                        }
                        else if(maximum_order_qty != ''){
                            if(parseInt(qty)>=1){
                                if(parseInt(qty) <= parseInt(maximum_order_qty)){
                                let qty1 = parseInt(qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                                }else{
                                    toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}');
                                }
                            }else{
                                if (parseInt(qty) == 0) {
                                    toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                                }
                                return false;
                            }
                        }else if(maximum_order_qty != ''){
                            if(parseInt(qty) > parseInt(minimum_order_qty)){
                                if(parseInt(qty)>=1){
                                    let qty1 = parseInt(qty)
                                    $('#qty').val(numbertrans(qty1));
                                    $('#qty').data('value',qty1);
                                    totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                                }else{
                                    if (parseInt(qty) == 0) {
                                        toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                                    }
                                    return false;
                                }
                            }else{
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}')
                            }
                        }else{
                            if(parseInt(qty)>=1){
                                let qty1 = parseInt(qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                            }else{
                                if (parseInt(qty) == 0) {
                                    toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                                }
                                return false;
                            }
                        }
                    }else{
                        if (parseInt(qty) >= 0) {
                                toastr.error("{{__('defaultTheme.no_more_stock')}}", "{{__('common.error')}}");
                            }
                            return false;
                    }
                }else{
                    if (maximum_order_qty != '' && minimum_order_qty != '') {
                        if(parseInt(qty)>=1){
                            if(parseInt(qty) >= parseInt(maximum_order_qty) && parseInt(qty) >= parseInt(minimum_order_qty)){
                                toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}')
                            }else if (parseInt(qty) < parseInt(maximum_order_qty) && parseInt(qty) < parseInt(minimum_order_qty)) {
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}')
                            }else{
                                let qty1 = parseInt(qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                            }
                        }else{
                            if (parseInt(qty) == 0) {
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                            }
                            return false;
                        }

                    }else if(maximum_order_qty != ''){
                        if(parseInt(qty)>=1){
                            if(parseInt(qty) <= parseInt(maximum_order_qty)){
                                let qty1 = parseInt(qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                            }else{
                                toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}')
                            }
                        }else{
                            if (parseInt(qty) == 0) {
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                            }
                            return false;
                        }
                    }else if(minimum_order_qty != ''){
                        if(parseInt(qty)>=1){
                            if(parseInt(qty) >= parseInt(minimum_order_qty)){
                                let qty1 = parseInt(qty)
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                            }else{
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                            }
                        }else{
                            if (parseInt(qty) == 0) {
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                            }
                            return false;
                        }
                    }else{
                        if(parseInt(qty)>=1){
                            let qty1 = parseInt(qty);
                            $('#qty').val(numbertrans(qty1));
                            $('#qty').data('value',qty1);
                            totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                        }else{
                            toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}');
                        }
                    }
                }
            });
            function qtyChange(val){
                $('.cart-qty-minus').prop('disabled',false);
                let available_stock = $('#availability').html();
                let stock_manage_status = $('#stock_manage_status').val();
                let maximum_order_qty = $('#maximum_order_qty').val();
                let minimum_order_qty = $('#minimum_order_qty').val();
                let qty = $('#qty').data('value');
                if (stock_manage_status != 0) {
                    if(val == '+'){
                        if (parseInt(qty) < parseInt(available_stock)) {
                            if(maximum_order_qty != ''){
                                if(parseInt(qty) < parseInt(maximum_order_qty)){
                                let qty1 = parseInt(++qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                                }else{
                                    toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}');
                                }
                            }else{
                                let qty1 = parseInt(++qty);
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                            }
                        }else{
                            toastr.error("{{__('defaultTheme.no_more_stock')}}", "{{__('common.error')}}");
                        }
                    }
                    if(val == '-'){
                        if (parseInt(qty) <= parseInt(available_stock)) {
                            if(minimum_order_qty != ''){
                                if(parseInt(qty) > parseInt(minimum_order_qty)){
                                    if(qty>1){
                                        let qty1 = parseInt(--qty)
                                        $('#qty').val(numbertrans(qty1));
                                        $('#qty').data('value',qty1);
                                        totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                                        $('.cart-qty-minus').prop('disabled',false);
                                    }else{
                                        $('.cart-qty-minus').prop('disabled',true);
                                    }
                                }else{
                                    toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}')
                                }
                            }else{
                                if(parseInt(qty)>1){
                                    let qty1 = parseInt(--qty)
                                    $('#qty').val(numbertrans(qty1));
                                    $('#qty').data('value',qty1);
                                    totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                                    $('.cart-qty-minus').prop('disabled',false);
                                }else{
                                    $('.cart-qty-minus').prop('disabled',true);
                                }
                            }
                        }else{
                            toastr.error("{{__('defaultTheme.no_more_stock')}}", "{{__('common.error')}}");
                        }
                    }
                }
                else {
                    if(val == '+'){
                        if(maximum_order_qty != ''){
                            if(parseInt(qty) < parseInt(maximum_order_qty)){
                            let qty1 = parseInt(++qty);
                            $('#qty').val(numbertrans(qty1));
                            $('#qty').data('value',qty1);
                            totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                            }else{
                                toastr.warning('{{__("defaultTheme.maximum_quantity_limit_is")}}'+maximum_order_qty+'.', '{{__("common.warning")}}')
                            }
                        }else{
                            let qty1 = parseInt(++qty);
                            $('#qty').val(numbertrans(qty1));
                            $('#qty').data('value',qty1);
                            totalValue(qty1, '#base_price','#total_price', getWholesalePrice);
                        }
                    }
                    if(val == '-'){
                        if(minimum_order_qty != ''){
                            if(parseInt(qty) > parseInt(minimum_order_qty)){
                                if(qty>1){
                                    let qty1 = parseInt(--qty)
                                    $('#qty').val(numbertrans(qty1));
                                    $('#qty').data('value',qty1);
                                    totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                                    $('.cart-qty-minus').prop('disabled',false);
                                }else{
                                    $('.cart-qty-minus').prop('disabled',true);
                                }
                            }else{
                                toastr.warning('{{__("defaultTheme.minimum_quantity_Limit_is")}}'+minimum_order_qty+'.', '{{__("common.warning")}}')
                            }
                        }else{
                            if(parseInt(qty)>1){
                                let qty1 = parseInt(--qty)
                                $('#qty').val(numbertrans(qty1));
                                $('#qty').data('value',qty1);
                                totalValue(qty1, '#base_price','#total_price', getWholesalePrice)
                                $('.cart-qty-minus').prop('disabled',false);
                            }else{
                                $('.cart-qty-minus').prop('disabled',true);
                            }
                        }
                    }
                }
            }
            function totalValue(qty, main_price, total_price, getWholesalePrice){
                if($('#isWholeSaleActive').val() == 1 && getWholesalePrice != null){
                    var max_qty='',min_qty='',selling_price='',main_price_vat = 0;
                    for (let i = 0; i < getWholesalePrice.length; ++i) {
                        max_qty = getWholesalePrice[i].max_qty;
                        min_qty = getWholesalePrice[i].min_qty;
                        selling_price = getWholesalePrice[i].sell_price;
                        if ( (min_qty<=qty) && (max_qty>=qty) ){
                            main_price_vat = selling_price;
                            let discount = $('#discount').val();
                            let discount_type = $('#discount_type').val();
                            if (discount_type == 0) {
                                discount = (main_price_vat * discount) / 100;
                            }
                            main_price_vat = (main_price_vat - discount);
                            break;
                        }
                        else if(main_price=='#base_price'){
                            main_price_vat = $('#base_sku_price').val().trim();
                        }
                    }
                    if (main_price != '#base_price') {
                        let discount = $('#discount').val();
                        let discount_type = $('#discount_type').val();
                        if (discount_type == 0) {
                            discount = (main_price_vat * discount) / 100;
                        }
                        var base_sku_price = (main_price_vat - discount);
                    }else{
                        var base_sku_price = main_price_vat;
                    }

                }else {
                    var base_sku_price = $('#base_sku_price').val().trim();
                }

                let value = parseInt(qty) * parseFloat(base_sku_price);

                // Format the total price
                let formatted_value = currency_format(value);

                // Remove any space between the currency symbol and price
                formatted_value = formatted_value.replace(' ', ''); 

                // Update the displayed total price without space
                $(total_price).html(formatted_value);

                // Update the buy price and final price
                both_buy_price(base_sku_price);
                $('#final_price').val(value);

            }
            function get_price_accordint_to_sku(){
                var value = $("input[name='attr_val_name[]']").map(function(){return $(this).val();}).get();
                var id = $("input[name='attr_val_id[]']").map(function(){return $(this).val();}).get();
                var product_id = $("#product_id").val();
                var user_id = $('#seller_id').val();
                $('#pre-loader').show();
                $.post("{{ route('seller.get_seller_product_sku_wise_price') }}", {_token:'{{ csrf_token() }}', id:id, product_id:product_id, user_id:user_id}, function(response){
                    if (response != 0) {
                        let discount_type = $('#discount_type').val();
                        let discount = $('#discount').val();
                        let qty = $('.qty').data('value');
                        if(typeof response.data.whole_sale_prices != 'undefined'){
                            if(response.data.whole_sale_prices.length > 0){
                                getWholesalePrice = response.data.whole_sale_prices;
                                if(getWholesalePrice){
                                    appendWholeSaleP();
                                    $('.append_w_s_p_tbl').removeClass('d-none');
                                }else {
                                    $('.append_w_s_p_tbl').addClass('d-none');
                                }
                            }
                        }
                        calculatePrice(response.data.selling_price, discount, discount_type, qty);
                        $('#sku_id_li').text(response.data.sku.sku);
                        var color = response.data.sku.sku.split('-');
                        $(".sku_img_div").removeClass('active');
                        $("#"+response.data.sku.sku).addClass('active');
                        var variant_img = response.data.sku.variant_image;
                        if(variant_img){
                        if(variant_img.includes('amazonaws.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('digitaloceanspaces.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('drive.google.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('wasabisys.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('backblazeb2.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('dropboxusercontent.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('storage.googleapis.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('contabostorage.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('b-cdn.net')){
                            var image_path = variant_img;
                        }else{
                            var image_path="{{asset(asset_path(''))}}/" + variant_img;
                        }
                        $('.varintImg').attr("src", image_path);
                        $('.varintImg').data("zoom-image", image_path);
                        $('.varintImg').addClass('zoom_01');
                        if($(window).outerWidth() > 767 ){
                            zoom_enable();
                        }
                        @if(!empty($public_code))
                            changeTabbyAmount();
                        @endif
                    }
                    $(response.data.product.variantDetails).each(function( key,index ) {
                        if(response.data.product.variantDetails.length > 1){
                            $.each(color, function(i, v) {
                                var isLastElement = i == color.length -1;
                                if (isLastElement) {
                                    $('#color_name').text(index.name +': ' + v);
                                }else{
                                    $('#size_name'+key).text(index.name +': ' + color[key+1]);
                                }
                            });
                            @if(!empty($public_code))
                                changeTabbyAmount();
                            @endif
                        }else{
                            if (index.attr_id == 1) {
                                $('#color_name').text(index.name +': ' + color[1]);
                            }else if (index.attr_id == 2) {
                                $('#size_name').text(index.name +': ' + color[1] + '-'+ color[2]);
                            }else{
                                $('#size_name').text(index.name +': ' + color[1]);
                            }
                        }
                    });
                        $('#product_sku_id').val(response.data.id);
                        if (response.data.product_stock == 0) {
                            $('#availability').html("{{__('defaultTheme.unlimited')}}");
                        }else{
                            $('#availability').html(response.data.product_stock);
                        }
                        if(response.data.product.stock_manage == 1 && parseInt(response.data.product_stock) >= parseInt(response.data.product.product.minimum_order_qty) || response.data.product.stock_manage == 0){
                            @if(isGuestAddtoCart())
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-6">
                                        <button type="button" id="add_to_cart_btn" class="amaz_primary_yellow amaz_primary_btn style2 mb_20  add_to_cart text-uppercase add_to_cart_btn flex-fill text-center w-100">{{__('defaultTheme.add_to_cart')}}</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" id="butItNow" class="amaz_primary_btn3 d-none mb_20  w-100 text-center justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                                    </div>
                                `);
                            @else
                                $('#add_to_cart_div').html(`
                                <div class="col-md-12">
                                                <a href="{{ url('/login') }}" class="amaz_primary_btn w-100">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                `);
                            @endif
                            $('#stock_div').html(`<span class="stoke_badge">{{__('common.in_stock')}}</span>`);
                            if($('#isMultiVendorActive').val() == 1){
                                $('#cart_footer_mobile').html(`
                                    <a href="
                                        @if ($product->seller->slug)
                                            {{route('frontend.seller',$product->seller->slug)}}
                                        @else
                                            {{route('frontend.seller',base64_encode($product->seller->id))}}
                                        @endif
                                    " class="d-flex flex-column justify-content-center product_details_icon">
                                        <i class="ti-save"></i>
                                        <span>{{__('common.store')}}</span>
                                    </a>
                                    <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                        <span>{{__('common.buy_now')}}</span>
                                    </button>
                                    <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                `);
                            }else{
                                if($('#isMultiVendorActive').val() == 1){
                                    $('#cart_footer_mobile').html(`
                                        <a href="
                                            @if ($product->seller->slug)
                                                {{route('frontend.seller',$product->seller->slug)}}
                                            @else
                                                {{route('frontend.seller',base64_encode($product->seller->id))}}
                                            @endif
                                        " class="d-flex flex-column justify-content-center product_details_icon">
                                            <i class="ti-save"></i>
                                            <span>{{__('common.store')}}</span>
                                        </a>
                                        <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                            <span>{{__('common.buy_now')}}</span>
                                        </button>
                                        <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                    `);
                                }else{
                                    $('#cart_footer_mobile').html(`
                                        <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                            <span>{{__('common.buy_now')}}</span>
                                        </button>
                                        <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                    `);
                                }
                            }
                        }
                        else{
                            @if(isGuestAddtoCart())
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-6">
                                        <button type="button" disabled class="amaz_primary_btn style2 mb_20 add_to_cart text-uppercase flex-fill text-center w-100">{{__('defaultTheme.out_of_stock')}}</button>
                                    </div>
                                `);
                            @else
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-12">
                                                    <a href="{{ url('/login') }}" class="amaz_primary_btn w-100">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                `);
                            @endif
                            $('#stock_div').html(`<span class="stokeout_badge">{{__('defaultTheme.out_of_stock')}}</span>`);

                            $('#cart_footer_mobile').html(`
                                <button type="button" class="product_details_button style1" disabled>
                                    <span>{{__('defaultTheme.out_of_stock')}}</span>
                                </button>
                                <button type="button" class="product_details_button" disabled>{{__('defaultTheme.out_of_stock')}}</button>
                            `);
                        }
                    }else {
                        toastr.error("{{__('defaultTheme.no_stock_found_for_this_seller')}}", "{{__('common.error')}}");
                    }
                    $('#pre-loader').hide();
                });
            }

            function calculatePrice(main_price, discount, discount_type, qty){
                var main_price = main_price;
                var discount = discount;
                var discount_type = discount_type;
                var total_price = 0;
                if($('#isWholeSaleActive').val() == 1 && getWholesalePrice != null){
                    var max_qty='',min_qty='',selling_price='';
                    for (let i = 0; i < getWholesalePrice.length; ++i) {
                        max_qty = getWholesalePrice[i].max_qty;
                        min_qty = getWholesalePrice[i].min_qty;
                        selling_price = getWholesalePrice[i].selling_price;

                        if ( (min_qty<=qty) && (max_qty>=qty) ){
                            main_price = selling_price;
                        }
                        else if(max_qty < qty){
                            main_price = selling_price;
                        }
                    }
                    @if(!empty($public_code))
                    changeTabbyAmount();
                    @endif
                }
                if (discount_type == 0) {
                discount = (main_price * discount) / 100;
                }
                total_price = (main_price - discount);

                // Get the formatted price
                var formatted_price = currency_format((total_price * qty));

                // Remove space between currency symbol and price
                formatted_price = formatted_price.replace(' ', ''); 

                // Set the updated total price without space
                $('#total_price').text(formatted_price);

                // Update other fields with the calculated total price
                both_buy_price(total_price);
                $('#base_sku_price').val(total_price);
                $('#final_price').val(total_price);
            }
            function appendWholeSaleP(){
                $('#append_w_s_p_all').empty();
                $.each(getWholesalePrice, function(index, value) {
                    $('#append_w_s_p_all').append(`
                    <tr class="border-bottom">
                        <td class="text-left">
                            <span>${numbertrans(value.min_qty)}</span>
                        </td>
                        <td class="text-left">
                            <span>${numbertrans(value.max_qty)}</span>
                        </td>
                        <td class="text-left">
                            <span>${currency_format(value.selling_price)}</span>
                        </td>
                    </tr>
                `);
                });
            }
            $(document).on('change', '#select_city', function(event){
                let id = $(this).val();
                let data = {
                    city_id : id,
                    _token : "{{csrf_token()}}",
                    seller_id: "{{$product->seller->id}}"
                }
                $('#pre-loader').show();
                $.post("{{route('frontend.item.get_pickup_by_city')}}",data,function(response){
                    $('#selectPickup').empty();
                    $('#selectPickup').append(
                        `<option selected disabled data-display="Choose pickup location">{{__('amazy.Choose pickup location')}}</option>`
                    );
                    $.each(response, function(index, pickup) {
                        $('#selectPickup').append('<option value="' + pickup.id + '">' + pickup.address + '</option>');
                    });
                    $('#selectPickup').niceSelect('update');
                    $('#pre-loader').hide();
                });
            });
            $(document).on('change', '#selectPickup', function (event){
                getPickupInfo();
            });
            getPickupInfo();
            function getPickupInfo(){
                let pickup_id = $('#selectPickup').val();
                let data = {
                    pickup_id : pickup_id,
                    _token : "{{csrf_token()}}",
                    seller_id: "{{$product->seller->id}}"
                }
                $('#pre-loader').show();
                $.post("{{route('frontend.item.get_pickup_info')}}",data,function(response){
                    if (response.shipping != null) {
                        if(response.shipping.cost == 0){
                            $('#door_delivery').text(`
                                ${trans('amazy.free_shipping_note')} ${response.shipping.shipment_time}.
                            `);
                        }else{
                            $('#door_delivery').text(`
                                ${trans('amazy.shipping_note')} ${currency_format(response.shipping.cost)}. ${trans('amazy.Delivery within')} ${response.shipping.shipment_time}.
                            `);
                        }
                    }
                    if (response.pickup_location != null) {
                        $('#pickup_location').text(`
                            {{__('shipping.delivery_from_pickup_location_always_free_of_cost')}} {{__('common.pickup_address')}}: ${response.pickup_location.address}.
                            {{__('common.country')}}: ${response.pickup_location.country.name} {{__('common.state')}}: ${response.pickup_location.state.name} {{__('common.city')}}: ${response.pickup_location.city.name} {{__('common.postcode')}}: ${response.pickup_location.pin_code}
                        `);
                    }
                    $('#pre-loader').hide();
                });
            }
            $(document).on("click", ".buy_now_btn", function(event){
                event.preventDefault();
                buyNow($('#product_sku_id').val(),$('#seller_id').val(),$('#qty').data('value'),$('#base_sku_price').val().trim(),$('#shipping_type').val(),'product', $('#owner').val());
            });
            $(document).on("click","#follow_seller_btn" ,function(event){
                event.preventDefault();
                let id = $('#seller_id').val();
                let data = {
                    seller_id: id,
                    _token : "{{csrf_token()}}"
                }
                $('#pre-loader').show();
                $(this).prop("disabled",true);
                $.post("{{route('frontend.follow_seller')}}",data,function(response){
                    if(response.message == 'success'){
                        toastr.success("{{__('amazy.Followed Successfully')}}","{{__('common.success')}}");
                        $('#follow_seller_btn').text("{{__('amazy.Followed')}}");
                        $('#follow_seller_count').text(numbertrans(response.result));
                    }
                    else{
                        $(this).prop("disabled",false);
                        toastr.error("{{__('amazy.Not Followed')}}","{{__('common.error')}}");
                    }
                    $('#pre-loader').hide();
                });
            });

            // Showing Review Image Bigger
            $(document).on('click', '.lightboxed', function (event) {
                let selector = $('iframe');
                $.each(selector, function () {
                    let src = $(this).attr('src');
                    let selector = $(this).closest('.lightboxed--frame');
                    let caption = selector.find('.lightboxed--caption').text();
                    $(this).remove();
                    selector.append("<img src='" + src + "' data-caption='" + caption + "'>");
                });
            });

            $(document).on('click','.filter-review',function(){
                let product_id = "{{ $product->id }}";
                let star = $(this).attr('data-review');
                let data = {
                    product_id : product_id,
                    rating : star,
                }
                $.ajax({
                    url: "{{ route('filterReview') }}",
                    method : "get",
                    data : data,
                }).done(function(response){

                        if(response.status == 1){
                            $("#all-reviews").html(response.html);
                            $("#review-pager").remove();
                        }
                });
            });
        });
    })(jQuery);
</script>
<script>


    function zoom_enable_for_variant(){
                $(".zoom_01").elevateZoom({
                    zoomEnabled: true,
                    zoomWindowHeight:120,
                    zoomWindowWidth:120,
                    zoomLevel:.9
                });
    }
    function both_variant_buy_price(product_price){
                let both_buy_price = $('#both_buy_price').val();
                let qty = $('.qty').data('value');
                let total_product_price = parseFloat(product_price) * parseInt(qty);
                let total = currency_format(total_product_price + parseFloat(both_buy_price));
                $('#both_buy_price_show').text(total);
    }
     function calculateVariantProductPrice(main_price, discount, discount_type, qty){
                var main_price = main_price;
                var discount = discount;
                var discount_type = discount_type;
                var total_price = 0;
                if($('#isWholeSaleActive').val() == 1 && getWholesalePrice != null){
                    var max_qty='',min_qty='',selling_price='';
                    for (let i = 0; i < getWholesalePrice.length; ++i) {
                        max_qty = getWholesalePrice[i].max_qty;
                        min_qty = getWholesalePrice[i].min_qty;
                        selling_price = getWholesalePrice[i].selling_price;

                        if ( (min_qty<=qty) && (max_qty>=qty) ){
                            main_price = selling_price;
                        }
                        else if(max_qty < qty){
                            main_price = selling_price;
                        }
                    }
                }
                if (discount_type == 0) {
                    discount = (main_price * discount) / 100;
                }
                total_price = (main_price - discount);
                var formatted_price = currency_format((total_price * qty));

                // Remove space between currency symbol and price
                formatted_price = formatted_price.replace(' ', ''); 

                $('#total_price').text(formatted_price);
                both_variant_buy_price(total_price);
                $('#base_sku_price').val(total_price);
                $('#final_price').val(total_price);
                        }

     function changeProdDetailsByVariantImg(element){
                var color_id = $(element).children("img").data("id");
                var attr_id = $( '.attr_val_name' ).data("value-key");
                $(".sku_img_div").removeClass('active');
                $("#"+color_id).addClass('active');
                var value = $("input[name='attr_val_name[]']").map(function(){return $(this).val();}).get();
                var id = $("input[name='attr_val_id[]']").map(function(){return $(this).val();}).get();

                var product_id = $(element).data("id");
                var user_id = $('#seller_id').val();
                $('#pre-loader').show();

                $.post("{{ route('seller.get_seller_product_variant_wise_price') }}", {_token:'{{ csrf_token() }}', id:id, product_id:product_id, user_id:user_id}, function(response){
                    if (response != 0) {
                        let discount_type = $('#discount_type').val();
                        let discount = $('#discount').val();
                        let qty = $('.qty').data('value');
                        if(typeof response.data.whole_sale_prices != 'undefined'){
                            if(response.data.whole_sale_prices.length > 0){
                                getWholesalePrice = response.data.whole_sale_prices;
                                if(getWholesalePrice){
                                    appendWholeSaleP();
                                    $('.append_w_s_p_tbl').removeClass('d-none');
                                }else {
                                    $('.append_w_s_p_tbl').addClass('d-none');
                                }
                            }
                        }
                        calculateVariantProductPrice(response.data.selling_price, discount, discount_type, qty);
                        $('#sku_id_li').text(response.data.sku.sku);
                        var color = response.data.sku.sku.split('-');
                        $("#"+response.data.sku.sku).addClass('active');
                        var variant_img = response.data.sku.variant_image;
                        var variant_img = variant_img;
                        if(variant_img){
                        if(variant_img.includes('amazonaws.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('digitaloceanspaces.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('drive.google.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('wasabisys.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('backblazeb2.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('dropboxusercontent.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('storage.googleapis.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('contabostorage.com')){
                            var image_path = variant_img;
                        }else if(variant_img.includes('b-cdn.net')){
                            var image_path = variant_img;
                        }else{
                            var image_path;
                            if(window.location.origin.includes('localhost')){
                                var strurl = $(location).attr("pathname").split('/');
                                image_path = window.location.origin+'/'+strurl[1]+'/public/' + variant_img;
                            }else{
                                image_path = window.location.origin+'/public/' + variant_img;
                            }
                        }
                        $('.varintImg').attr("src", image_path);
                        $('.varintImg').data("zoom-image", image_path);
                        $('.varintImg').addClass('zoom_01');

                        if($(window).outerWidth() > 767 ){
                            zoom_enable_for_variant();
                        }

                    }

                    var globalSelector=0;
                    var globalColorSelector=0;
                    $(response.data.product.skus).each(function(key,index){
                        if(response.data.product_sku_id==index.product_sku_id){
                            $(index.product_variations).each(function(key2, index2){
                                if(index2.attribute.name=='Shoe Size'){
                                    globalSelector=1;
                                    $('.attr_val_name').removeClass('selected_btn');
                                    $('#attr_val_variant_id_'+index2.attribute_value.id).addClass('selected_btn');
                                }
                                if(index2.attribute.name=='Color'){
                                    if(globalColorSelector==0){
                                        $('.attr_val_name').removeAttr("checked");
                                        globalColorSelector=1;
                                    }
                                    $('.radio_'+index2.attribute_value.id).attr('checked','checked');
                                }
                                if(index2.attribute.name=='Size'){
                                    if(globalSelector==0){
                                        $('.attr_val_name').removeClass('selected_btn');
                                        globalSelector=1;
                                    }
                                    $('#attr_val_variant_id_'+index2.attribute_value.id).addClass('selected_btn');
                                }
                            })
                        }
                    });

                    $(response.data.product.variantDetails).each(function( key,index ) {
                        if(response.data.product.variantDetails.length == 1){
                            $.each(color, function(i, v) {
                                var isLastElement = i == color.length -1;
                                if (isLastElement) {
                                    $('#color_name').text(index.name +': ' + v);
                                }else{
                                    $('#size_name'+key).text(index.name +': ' + color[key+1]);
                                }
                            });
                        }else{
                            if (index.attr_id == 1) {
                                $('#color_name').text(index.name +': ' + color[2]);
                            }else if (index.attr_id == 2) {
                                $('#size_name').text(index.name +': ' + color[1] + '-'+ color[2]);
                            }else{
                                $('#size_name').text(index.name +': ' + color[1]);
                            }
                        }
                    });
                        $('#product_sku_id').val(response.data.id);
                        if (response.data.product_stock == 0) {
                            $('#availability').html("{{__('defaultTheme.unlimited')}}");
                        }else{
                            $('#availability').html(response.data.product_stock);
                        }
                        if(response.data.product.stock_manage == 1 && parseInt(response.data.product_stock) >= parseInt(response.data.product.product.minimum_order_qty) || response.data.product.stock_manage == 0){
                            @if(isGuestAddtoCart())
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-6">
                                        <button type="button" id="add_to_cart_btn" class="amaz_primary_yellow amaz_primary_btn style2 mb_20  add_to_cart text-uppercase add_to_cart_btn flex-fill text-center w-100">{{__('defaultTheme.add_to_cart')}}</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" id="butItNow" class="amaz_primary_btn3 mb_20  w-100 text-center d-none justify-content-center text-uppercase buy_now_btn" data-id="{{$product->id}}" data-type="product">{{__('common.buy_now')}}</button>
                                    </div>
                                `);
                            @else
                                $("#add_to_cart_div").html(`<div class="col-md-12">
                                        <a href="{{ url('/login') }}" class="amaz_primary_btn w-100">
                                        {{__('defaultTheme.login_to_order')}}
                                    </a>
                                </div>`);
                            @endif


                            $('#stock_div').html(`<span class="stoke_badge">{{__('common.in_stock')}}</span>`);
                            if($('#isMultiVendorActive').val() == 1){
                                $('#cart_footer_mobile').html(`
                                    <a href="
                                        @if ($product->seller->slug)
                                            {{route('frontend.seller',$product->seller->slug)}}
                                        @else
                                            {{route('frontend.seller',base64_encode($product->seller->id))}}
                                        @endif
                                    " class="d-flex flex-column justify-content-center product_details_icon">
                                        <i class="ti-save"></i>
                                        <span>{{__('common.store')}}</span>
                                    </a>
                                    <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                        <span>{{__('common.buy_now')}}</span>
                                    </button>
                                    <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                `);
                            }else{
                                if($('#isMultiVendorActive').val() == 1){
                                    $('#cart_footer_mobile').html(`
                                        <a href="
                                            @if ($product->seller->slug)
                                                {{route('frontend.seller',$product->seller->slug)}}
                                            @else
                                                {{route('frontend.seller',base64_encode($product->seller->id))}}
                                            @endif
                                        " class="d-flex flex-column justify-content-center product_details_icon">
                                            <i class="ti-save"></i>
                                            <span>{{__('common.store')}}</span>
                                        </a>
                                        <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                            <span>{{__('common.buy_now')}}</span>
                                        </button>
                                        <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                    `);
                                }else{
                                    $('#cart_footer_mobile').html(`
                                        <button type="button" class="product_details_button style1 buy_now_btn" data-id="{{$product->id}}" data-type="product">
                                            <span>{{__('common.buy_now')}}</span>
                                        </button>
                                        <button class="product_details_button add_to_cart_btn" type="button">{{__('common.add_to_cart')}}</button>
                                    `);
                                }
                            }
                        }
                        else{
                            @if(isGuestAddtoCart())
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-6">
                                        <button type="button" disabled class="amaz_primary_btn style2 mb_20 add_to_cart text-uppercase flex-fill text-center w-100">{{__('defaultTheme.out_of_stock')}}</button>
                                    </div>
                                `);
                            @else
                                $('#add_to_cart_div').html(`
                                    <div class="col-md-12">
                                            <a href="{{ url('/login') }}" class="amaz_primary_btn w-100">
                                            {{__('defaultTheme.login_to_order')}}
                                        </a>
                                    </div>
                                `);
                            @endif

                            $('#stock_div').html(`<span class="stokeout_badge">{{__('defaultTheme.out_of_stock')}}</span>`);

                            $('#cart_footer_mobile').html(`
                                <button type="button" class="product_details_button style1" disabled>
                                    <span>{{__('defaultTheme.out_of_stock')}}</span>
                                </button>
                                <button type="button" class="product_details_button" disabled>{{__('defaultTheme.out_of_stock')}}</button>
                            `);
                        }
                    }else {
                        toastr.error("{{__('defaultTheme.no_stock_found_for_this_seller')}}", "{{__('common.error')}}");
                    }
                    $('#pre-loader').hide();
                });
            }
</script>
<script>
    // Function to toggle section open and close
    function toggleSection(header) {
        const section = header.parentElement;
        const content = section.querySelector('.section-content');
        const icon = header.querySelector('.toggle-icon');

        if (section.classList.contains('open')) {
            // Close section
            content.style.maxHeight = null;
            content.style.padding = "0 10px";  // Reset padding
            section.classList.remove('open');
            icon.textContent = "+";
        } else {
            // Open section
            content.style.maxHeight = content.scrollHeight + "px";
            content.style.padding = "10px";  // Set padding back to default
            section.classList.add('open');
            icon.textContent = "-";
        }
    }

    // Automatically open the first section (Description) on page load
   document.addEventListener('DOMContentLoaded', function() {
    const firstSection = document.querySelector('.section.open');
    const content = firstSection.querySelector('.section-content');
    content.style.maxHeight = (content.scrollHeight + 10) + "px";


});
</script>
    <script>
        function showTab(event, tabId) {
            // Hide all tab content
            var tabContents = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }
            // Remove active class from all tabs
            var tabs = document.getElementsByClassName('tab');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }
            // Show the clicked tab's content and mark the tab as active
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        function scrollToSection() {
            document.getElementById("seventh_section").scrollIntoView({
                behavior: "smooth"
            });
        }
    </script>

@php
    $public_code = null;
    $merchantCode = null;
    $payment = DB::table('payment_methods')->where('method','Tabby')->where('active_status',1)->first();
    if($payment)
    {
        $tabby_gateway = getPaymentGatewayInfo($payment->id);
        if($tabby_gateway){
            $public_code = $tabby_gateway->perameter_1;
            $merchantCode = $tabby_gateway->perameter_5;
        }
    }
@endphp




@if(!empty( $public_code))
    <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
    <script>

        function changeTabbyAmount()
        {
            let amount = $("#total_price").html();
            const price = amount.replace(/[^0-9.]/g, '');
            new TabbyPromo({
                    selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
                    currency: 'AED', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
                    price: price, // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
                    installmentsCount: 4, // Optional, for non-standard plans.
                    lang: 'en', // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
                    source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
                    publicKey: '{{ $public_code }}', // required, store Public Key which identifies your account when communicating with tabby.
                    merchantCode: '{{ $merchantCode }}'
                });
        }

        let amount = $("#total_price").html();
        const price = amount.replace(/[^0-9.]/g, '');
        new TabbyPromo({
            selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
            currency: 'AED', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
            price: price, // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
            installmentsCount: 4, // Optional, for non-standard plans.
            lang: 'en', // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
            publicKey: '{{ $public_code }}', // required, store Public Key which identifies your account when communicating with tabby.
            merchantCode: 'FONCY'
        });



    </script>

    @endif
@endpush

@include(theme('partials.add_to_cart_script'))
@include(theme('partials.add_to_compare_script'))

{{-- i have a project idea which is detecting covid or phonomia --}}
