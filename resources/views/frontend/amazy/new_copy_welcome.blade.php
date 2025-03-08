@extends('frontend.amazy.layouts.app')

@push('styles')
<style>
    .banner_img {
    width: 100%;
    position: relative;
    overflow: hidden;
    display: block;
    padding-bottom: 31.5%;
}

.banner_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}
.new_two_sliders_home .slick-next:before, .new_two_sliders_home .slick-prev:before{color: #39b021;}
.slick-next, .slick-prev {
    width: 40px !important;
}
.clean-button {
    background-color: #34ff4c;
    color: #0b1915;
    border: none;
    padding: 10px;
    cursor: pointer;
    width: 100%;
    margin-top: -10px;
}
</style>
@endpush

@section('content')
    <!-- home_banner::start  -->
    @php
        $headers = \Modules\Appearance\Entities\Header::all();
    @endphp
    <x-slider-component :headers="$headers"/>
<!-- home_banner::end  -->

{{-- new code start --}}


<div class="bodyhome">
 <div class="third_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5">

        @php
            use Modules\FrontendCMS\Entities\HomePageSection;

            $id = 1; // Set the ID of the record you want to retrieve
            $homepagesection = HomePageSection::find($id); // Use the namespaced model

            // Set default values
            $defaultHeading = "Unlock Growth with Transparency and Fair Pricing";
            $defaultParagraph = "Join SPF Open Market for exclusive, real-time pricing on spray foam products.";
        @endphp

        <h1>{{ $homepagesection->heading ?? $defaultHeading }}</h1>
        <p>{{ $homepagesection->paragraph ?? $defaultParagraph }}</p>
            
          {{-- <h1>Unlock Growth with
            Transparency and 
            Fair Pricing</h1>
          <p>Join SPF Open Market for exclusive, real-time 
            pricing on spray foam products. </p> --}}
          <div class="unlock_exclusive">
            <button>Unlock <br>
            Exclusive Pricing</button>
          </div>
          <div class="explore_membership">
            <button>Explore <br>
            Membership Benefits</button>
          </div>
        </div>
        <div class="col-md-7">
          <h2>TOP SELLERS RANKING</h2>
          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Trend</th>
                  <th>Change</th>
                  <th>Quantity Remaining @ Price</th>
                  <th>Price Rating</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>NCFI InsulStar Light</td>
                  <td class="up">$1,266.34</td>
                  <td class="up">&#9650;</td>
                  <td>$12.00</td>
                  <td>22 Sets</td>
                  <td class="stars">★★★★★</td>
                </tr>
                <tr>
                  <td>ACCUFOAM CC-HFO</td>
                  <td class="down">$1,736.45</td>
                  <td class="down">&#9660;</td>
                  <td>$1.00</td>
                  <td>344 Sets</td>
                  <td class="stars">★★★★★</td>
                </tr>
                <tr>
                  <td>NCFI InsulBloc 2.0</td>
                  <td class="down">$1,608.35</td>
                  <td class="down">&#9660;</td>
                  <td>$8.00</td>
                  <td>201 Sets</td>
                  <td class="stars">★★★★☆</td>
                </tr>
                <tr>
                  <td>NSF POLYMERS OC-OG</td>
                  <td class="up">$1,251.72</td>
                  <td class="up">&#9650;</td>
                  <td>$15.00</td>
                  <td>88 Sets</td>
                  <td class="stars">★★★★</td>
                </tr>
                <tr>
                  <td>ACCUFOAM ROOF FOAM</td>
                  <td class="up">$1,671.09</td>
                  <td class="up">&#9650;</td>
                  <td>$15.67</td>
                  <td>990 Sets</td>
                  <td class="stars">★★★★★</td>
                </tr>
                <tr>
                  <td>DYNAMO D5 No Mix</td>
                  <td class="up">$1,199.76</td>
                  <td class="up">&#9650;</td>
                  <td>$10.00</td>
                  <td>770 Sets</td>
                  <td class="stars">★★★★★</td>
                </tr>
                <tr>
                  <td>AMBI-SEAL 5.0</td>
                  <td class="down">$1,133.78</td>
                  <td class="down">&#9660;</td>
                  <td>$12.70</td>
                  <td>8 Sets</td>
                  <td class="stars">★★★★</td>
                </tr>
                <tr>
                  <td>DYNAMO HFO HIGH</td>
                  <td class="up">$1,750.26</td>
                  <td class="up">&#9650;</td>
                  <td>$13.00</td>
                  <td>94 Sets</td>
                  <td class="stars">★★★</td>
                </tr>
                <tr>
                  <td>AMBIT-TITE 201</td>
                  <td class="up">$1,768.12</td>
                  <td class="up">&#9650;</td>
                  <td>$14.00</td>
                  <td>12 Sets</td>
                  <td class="stars">★</td>
                </tr>
              </tbody>
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>





  <div class="forth_section">
    <div class="container">
      <div class="row">
        <div class="five_logos">     
          <div class="logos_all_first"> <img src="{{asset('public/frontend/amazy/img/home/ncfi.png')}}"></div>
          <div class="logos_all_second"><img src="{{asset('public/frontend/amazy/img/home/ambit.png')}}"></div>
          <div class="logos_all_third"><img src="{{asset('public/frontend/amazy/img/home/graco.png')}}"></div> 
          <div class="logos_all_forth"><img src="{{asset('public/frontend/amazy/img/home/nsf.png')}}"></div>
          <div class="logos_all_fifth"><img src="{{asset('public/frontend/amazy/img/home/accu.png')}}"></div> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-12">
            @php
                $id = 2; // Set the ID of the record you want to retrieve
                $homepagesection_two = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model
                $defaultHeading_two = "Empower Your Business and  Connect with Top Suppliers.";
                $defaultParagraph_two = "Always know you're getting the best deal with real-time pricing.";
            @endphp
         
          {{-- <div class="video_left"><img  src="{{asset('public/frontend/amazy/img/home/video.jpg')}}"></div> --}}
          <div class="video_left"></div>
            <video id="videoElement" autoplay loop muted playsinline style="width: 100%; height: auto; z-index: 2; position: relative;">
                <source src="{{ asset('public/images/reviews/' . $homepagesection_two->field_1) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-12">
          <div class="right_text">
            {{-- @php
            use Modules\FrontendCMS\Entities\HomePageSection;

                $id = 2; // Set the ID of the record you want to retrieve
                $homepagesection_two = HomePageSection::find($id); // Use the namespaced model

                // Set default values
                $defaultHeading_two = "Empower Your Business and  Connect with Top Suppliers.";
                $defaultParagraph_two = "Always know you're getting the best deal with real-time pricing.";
            @endphp

            <h1>{{ $homepagesection_two->heading ?? $defaultHeading_two }}</h1>
            <p>{{ $homepagesection_two->paragraph ?? $defaultParagraph_two }}</p> --}}

            

            

                <h2>{{ $homepagesection_two->heading ?? $defaultHeading_two }}</h2>
                <p>{{ $homepagesection_two->paragraph ?? $defaultParagraph_two }}</p>
            </div>
        </div>
      </div>
    </div>
  </div>


@php
    $best_deal = $widgets->where('section_name', 'best_deals')->first();
@endphp
  <div class="fifth_section">
    <div class="fifth_section_first_slider">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-12 col-12">
        <h1>Categories</h1>
      </div>
      <div class="col-md-1 col-lg-1 col-sm-6 col-6">
        <p class="filter">Filter <span class="filter_line">|</span> </p>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="search-container">
          <input type="text" placeholder="Search" class="search-input">
          <button class="search-button"> <i class="fa fa-search"></i> </button>
        </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-9 col-9 p-0 m-0"> <a href="{{url('/all-products')}}" 
        class="view-all-products-button"> View All Products
        <div class="arrow_button">
            <span>➜</span>
            {{-- <span class="arrow"></span> --}}
        </div>
        </a> </div>
      <div class="col-md-1 col-lg-1 col-sm-3 col-3">
        <div class="cart_image"><a href="{{ url('/cart') }}"><img src="{{asset('public/frontend/amazy/img/home/cart_1.png')}}"></a></div>
      </div>
    </div>
  </div>



@php
    $feature_categories = $widgets->where('section_name', 'feature_categories')->first();

@endphp
{{-- <div id="feature_categories" class="amaz_section {{$feature_categories->status == 0 ? 'd-none' : ''}}">
    <div class="container mt-5">
        <div class="row">
            @foreach($feature_categories->getCategoryByQuery()->where('status', 1) as $key => $category)
               <!-- Change '3' to however many you want -->
                <div class="col-md-4">
                    <a class="shop_now_text" href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}">
                        <div class="categories_boxes">
                            <div class="on_sale">
                                <p>ON SALE</p>
                            </div>
                            <div class="img_box">
                                @if(app('general_setting')->lazyload == 1)
                                    <img class="lazyload" src="{{showImage(themeDefaultImg())}}" data-src="{{showImage(@$category->categoryImage->image ? @$category->categoryImage->image : 'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                                @else
                                    <img src="{{showImage(@$category->categoryImage->image ? @$category->categoryImage->image : 'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                                @endif
                            </div>
                        </div>
                    </a>
                    <div class="categories_boxes_btm">
                        <a href="{{url('/register')}}"><button>Unlock Prices - Join Now</button></a>
                        <h2>{{textLimit($category->name, 25)}}</h2>
                        <p>Explore our {{@$category->name}} category for top-tier solutions, including innovative products and high-performance accessories.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}
<div class="new_two_sliders_home">
    <div class="container">
    <div class="wrapper">
        <div class="center-slider-collection-top">
            @php
                // Desired order of category names
                $desiredOrder = ['ACCUFOAM', 'GRACO', 'FX GUN', 'FX GUN1'];

                // Reorder categories based on the desired order
                $orderedCategories = $feature_categories->getCategoryByQuery()
                    ->where('status', 1)
                    ->sortBy(function ($category) use ($desiredOrder) {
                        return array_search($category->name, $desiredOrder);
                    });
            @endphp
            @foreach($orderedCategories as $key => $category)
               <!-- Change '3' to however many you want -->
                <div class="col-md-3">
                    <div class="categories_boxes_btm">
                        <h2>{{textLimit($category->name, 25)}}</h2>
                        <p>{{@$category->description}}</p>
                    </div>
                    <a class="shop_now_text" href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}">     
                        <div class="categories_boxes mt-4">
                            {{-- <div class="on_sale">
                                <p>ON SALE</p>
                            </div> --}}
                            <div class="img_box" style="height: 170px; display: flex; justify-content: center; align-items: center; padding-left: 56px;">
                                @if(app('general_setting')->lazyload == 1)
                                    <img class="lazyload" src="{{showImage(themeDefaultImg())}}" data-src="{{showImage(@$category->categoryImage->image ? @$category->categoryImage->image : 'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                                @else
                                    <img src="{{showImage(@$category->categoryImage->image ? @$category->categoryImage->image : 'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                                @endif
                            </div>
                            
                        </div>
                    </a>
                    <div class="categories_boxes_btm">
                        <a href="{{url('/register')}}"><button>Unlock Prices - Join Now</button></a>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </div>
</div>
</div>




{{-- @php
    $best_deal = $widgets->where('section_name', 'best_deals')->first();
@endphp

<div class="container mt-5">
    <div class="row">
        @foreach($best_deal->getProductByQuery()->take(3) as $key => $product)
            <div class="col-md-4">
                <div class="categories_boxes">
                    <div class="on_sale">
                        <p>ON SALE</p>
                    </div>

                    <!-- Dynamic Product Image -->
                    @php
                        if (@$product->thum_img != null) {
                            $thumbnail = showImage(@$product->thum_img);
                        } else {
                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                        }
                    @endphp
                    
                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}" class="thumb">
                        @if(app('general_setting')->lazyload == 1)
                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}" 
                                alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" class="lazyload product-image">
                        @else
                            <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" class="product-image">
                        @endif
                    </a>
                </div>
                <div class="categories_boxes_btm">
                    <button>Unlock Prices - Join Now</button>
                    <h2 class="product_name" style="word-wrap: break-word;">
                        {{ @$product->product_name }}
                    </h2>
                    <p>Explore our {{ @$product->product_name }} category for top-tier solutions, including innovative products and high-performance accessories.</p>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}


  {{-- <div class="container mt-5" >
    <div class="row">
      <div class="col-md-4">
        <div class="categories_boxes">
          <div class="on_sale">
            <p>ON SALE</p>
          </div>
          <img  src="{{asset('public/frontend/amazy/img/home/Graco.jpg')}}"> </div>
        <div class="categories_boxes_btm">
          <button>Unlock Prices - Join Now</button>
          <h2>GRACO</h2>
          <p>Explore our Graco category for top-tier spray foam solutions, including the innovative Reactor series and high-performance accessories</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="categories_boxes">
          <div class="on_sale">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/spray.jpg')}}"> </div>
        <div class="categories_boxes_btm">
          <button>Unlock Prices - Join Now</button>
          <h2>SPRAY FOAM</h2>
          <p>Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="categories_boxes">
          <div class="on_sale">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/rigs.jpg')}}"> </div>
        <div class="categories_boxes_btm">
          <button>Unlock Prices - Join Now</button>
          <h2>RIGS</h2>
          <p>Explore our Rig category for top-of-the-line equipment designed to maximize efficiency and performance.</p>
        </div>
      </div>
    </div>
  </div> --}}


@php
    $more_products = $widgets->where('section_name', 'more_products')->first();
@endphp
{{-- <div class="container mt-3">
    <div class="row">
        @foreach($more_products->getHomePageProductByQuery()->where('status', 1) as $key => $product)
            <div class="col-md-2 col-lg-2 col-sm-6 col-6">
                <div class="categories_boxes">
                    <div class="on_sale_last">
                        <p>ON SALE</p>
                    </div>
                    
                    @php
                        if (@$product->thum_img != null) {
                            $thumbnail = showImage(@$product->thum_img);
                        } else {
                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                        }
                    @endphp
                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}" class="thumb">
                        @if(app('general_setting')->lazyload == 1)
                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                 alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                 class="lazyload">
                        @else
                            <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                        @endif
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

<div class="new_two_sliders_home">
    <div class="container">
    <div class="wrapper">
        <div class="center-slider-collection">
          @foreach($more_products->getHomePageProductByQuery()->where('status', 1) as $key => $product)
            <div class="col-md-2 col-lg-2 col-sm-6 col-6">
                <div class="categories_boxes">
                    {{-- <div class="on_sale_last">
                        <p>ON SALE</p>
                    </div> --}}
                    
                    @php
                        // Determine product thumbnail image
                        $thumbnail = @$product->thum_img ? showImage(@$product->thum_img) : showImage(@$product->product->thumbnail_image_source);
                    @endphp
                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}" class="thumb">
                        @if(app('general_setting')->lazyload == 1)
                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                 alt="{{ @$product->product_name }}" style="height: 160px;" title="{{ @$product->product_name }}"
                                 class="lazyload">
                        @else
                            <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                        @endif
                    </a>
                </div>
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
               @if(!auth()->check())
                @php 
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
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="name-button">{{ substr($product->product_name, 0, 22)}}</p>
                    </div>
                 </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <p class="name-button">${{ number_format($finalPriceAfterDiscount, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                       <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}">
                        <button class="Get-button">Get</button></a>
                    </div>
                 </div>
               @elseif((auth()->check() && $customerSubscription === null))
               @php 
                    $selling_price = $product->skus->first()->selling_price;
                @endphp
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="name-button">{{ substr($product->product_name, 0, 22)}}</p>
                    </div>
                 </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <p class="name-button">${{ number_format($selling_price, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                       <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}">
                        <button class="Get-button">Get</button></a>
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
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p class="name-button">{{ substr($product->product_name, 0, 22)}}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <p class="name-button">${{ number_format($finalPriceAfterDiscount, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                        <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}">
                            <button class="Get-button">Get</button></a>
                        </div>
                    </div>
                    @endif
                {{-- <div class="price_button">
                    <button class="clean-button"><b>Starting At</b> : ${{ number_format($finalPriceAfterDiscount, 2) }}</button>
                </div> --}}
        
            </div>
           @endforeach
        
        
        </div>
      </div>
    </div>
</div>


  {{-- <div class="container mt-3" style="display:none;" >
    <div class="row">
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_1.jpg')}}"> </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_2.jpg')}}"> </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_3.jpg')}}"> </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_4.jpg')}}"> </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_5.jpg')}}"> </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-6 col-6">
        <div class="categories_boxes">
          <div class="on_sale_last">
            <p>ON SALE</p>
          </div>
          <img src="{{asset('public/frontend/amazy/img/home/btm_6.jpg')}}"> </div>
      </div>
    </div>
  </div>
</div> --}}
</div>





<div class="sixth_section">
  <div class="container">
    <div class="row">
        @php
            $id = 3; // Set the ID of the record you want to retrieve
            $Section_three = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model

            // Set default values
            $Section3_defaultHeading = "About SPF Open Marketplace";
            $Section3_defaultParagraph = "Using the Graco Reactor 3 has been a game-changer, saving our business $37,500 annually. Its advanced technology and reliability streamline our operations and reduce waste. A must-have for serious spray foam contractors.";
            //$Section3_defaultHeading1 = "1"
            //$Section3_defaultHeading2 = "2"
            //$Section3_defaultHeading3 = "3"
            //$Section3_defaultParagraph1 = "1"
            //$Section3_defaultParagraph2 = "2"
            //$Section3_defaultParagraph3 = "3"
        @endphp

        
        
      <div class="col-md-12">
        <h1>{{ $Section_three->heading ?? $Section3_defaultHeading }}</h1>
        {{-- <h1>Stop Overpaying for Foam and  Supplies</h1> --}}
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 mt-5">
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Transparency.png')}}" > </div>
          <div class="right_text_btm">
            <h4>{{$Section_three->heading1}}</h4>
            <p>{{$Section_three->paragraph1}}</p>
            {{-- <h4>Transparency</h4>
            <p>Eliminate guesswork with complete visibility into product pricing and market trends.</p> --}}
          </div>
        </div>
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Fair_Pricing.png')}}" > </div>
          <div class="right_text_btm">
            <h4>{{$Section_three->heading2}}</h4>
            <p>{{$Section_three->paragraph2}}</p>
            {{-- <h4>Fair Pricing</h4>
            <p>Get the best deal with transparent, real-time pricing on all spray foam products.</p> --}}
          </div>
        </div>
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Exclusivity.png')}}" > </div>
          <div class="right_text_btm">
          <h4>{{$Section_three->heading3}}</h4>
          <p>{{$Section_three->paragraph3}}</p>
            {{-- <h4>Exclusivity</h4>
            <p>Join an elite, members-only club where only approved, accredited, and vetted professionals gain access to unparalleled growth opportunities. Stay ahead of the competition with the best wholesale pricing, available exclusively to our trusted members.</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="center_image_main"> <img src="{{asset('public/frontend/amazy/img/home/center_image.png')}}" /></div>
      </div>
      <div class="col-md-4">
        <div class="center_image_main_paragraph">
          <p>{{ $Section_three->paragraph ?? $Section3_defaultParagraph }}</p>
          <button class="mt-3">READ MORE</button>
        </div>
      </div>
    </div>
  </div>
</div>





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

<div class="seventh_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      @php

            $id = 4; // Set the ID of the record you want to retrieve
            $homepagesubscriptionsection = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model

            // Set default values
            $sub_defaultHeading = "Flexible Membership and Subscription Plans";
            $sub_defaultParagraph = "Discover how joining our elite club can elevate your business with industry-leading pricing and resources";
        @endphp

        <h1 class="first_head">{{ $homepagesubscriptionsection->heading ?? $sub_defaultHeading }}</h1>
        <h2> 30 DAYS FREE - NO RISK</h2>
        <p class="top_parag">{{ $homepagesubscriptionsection->paragraph ?? $sub_defaultParagraph }}</p>
        {{-- <h1 class="first_head">Flexible Membership and Subscription Plans</h1>
        <p class="top_parag">Discover how joining our elite club can elevate your business with industry-leading pricing and resources</p> --}}
      </div>
    </div>
  </div>
  <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        @if($subscription_plans->count() > 0)
            @foreach($subscription_plans as $plan)
            <div class="card swiper-slide">
              {{-- <div class="image-content"> </div> --}}
              <div class="card-content">
                @if($plan->name == "TIER 3")                
                <div class="most_popular"><a href="#">Most Popular</a></div>
                @endif
                <h1 class="name">{{ $plan->name ?? 'Lorem' }}</h1>
                <p class="description">
                    {{ $plan->best_for }}
                    {{-- {{ $plan->description ?? 'Discover premium spray foam products in our marketplace, 
                    renowned for their superior chemical quality and competitive pricing' }} --}}
                    </p>
                <h1 class="name">
                    Up to <span  class="percentage-text">{{ number_format($plan->discountRole->max('discount') ?? 0, 1) }}%</span> 
                    {{-- ${{ number_format($plan->plan_price ?? 200) }} --}}
                </h1>
                <div class="dashes_lines"></div>
                {{-- <p>{{ 'Access for ' . ($plan->expire_in ?? '30') . ' days' }}</p> --}}
                 {!! $plan->description !!}

                @php
                    // Check if there's a subscription payment with status "Pending", "Active", or "Expired"
                    $subscription = $plan->subscriptionPayments->first();
                @endphp

                <div class="d-flex mt-4">
                    {{-- @if($subscription && $subscription->status == "Pending") --}}
                        {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg plan_cancel_btn btn-outline-secondary mr_5">{{__('common.cancel')}}</a> --}}
                        
                        {{-- <button class="btn btn-lg btn-outline-dark buy-now-btn text-white" style="padding: 3px 10px; background-color: red; border-radius: 13px !important;" disabled>
                            {{ __('common.pending_plan') }}
                        </button> --}}
                    {{-- @elseif($subscription && $subscription->status == "Active") --}}
                        {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg mt-4 plan_cancel_btn btn-block btn-outline-secondary">{{__('common.cancel')}}</a> --}}

                        {{-- <button class="button" style="background-color : cornsilk;" disabled>
                            {{ __('common.active_plan') }}
                        </button> --}}
                    {{-- @elseif($subscription && $subscription->status == "Expired")
                        <button class="button" style="background-color : rgb(192 206 56); color :red;" disabled>
                            {{ __('common.expired') }}
                        </button>

                        <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="button paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                            {{ __('common.buy_now') }}
                        </a>
                    @else
                    @endif --}}
                    <a href="#" class="thirty_days">30 DAYS FREE - NO RISK</a>
                    
                        {{-- <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="button paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                            {{ $plan->buy_now_text ?? __('common.buy_now') }}
                        </a> --}}
                   
                    
                </div>
                <div class="dashes_lines"></div>   
                 {{-- <p>
                    <strong>{{ $plan->expire_in }}</strong> {{ __('frontendCms.days_access') }}</p>
                   <p><strong>{{ $plan->best_for }}</strong></p> --}}
                    <a href="#" class="see_all_features">See all features</a>
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
                  <li><b>List</b></li>
                  <li>Lorem Ipsum</li>
                  <li>Lorem Ipsum</li>
                  <li>Lorem Ipsum</li>
                </ul>
              </div>
            </div>
        @endif
      </div>
    </div>
    <div class="swiper-button-prev swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/left_arrow.png')}}"></div>
    <div class="swiper-button-next swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/right_arrow.png')}}"></div>
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



{{-- <div class="seventh_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="first_head">Flexible Membership and Subscription Plans</h1>
        <p class="top_parag">Discover how joining our elite club can elevate your business with industry-leading pricing and resources</p>
      </div>
    </div>
  </div>
  <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content"> </div>
          <div class="card-content">
            <h1 class="name">Lorem</h1>
            <p class="description">Discover premium spray foam products in our marketplace, renowned for their superior chemical quality and competitive pricing</p>
            <h1  class="name">$200</h1>
            <p>Discover premium </p>
            <button class="button">Buy now</button>
            <ul>
              <li><b>List</b></li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
              <li>Lorem Ipsum</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-button-prev swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/left_arrow.png')}}"></div>
    <div class="swiper-button-next swiper-navBtn"><img src="{{asset('public/frontend/amazy/img/home/right_arrow.png')}}"></div>
  </div>
</div> --}}


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





<div class="eight_section">
  <div class="eight_section_left">
         @php
            $id = 5; // Set the ID of the record you want to retrieve
            $how_it_work_section = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model

            // Set default values
            $how_defaultHeading = "How it Works";
            $how_defaultParagraph = "Create an account by signing up on our platform, providing your business details, and verifying your email address to start exploring membership benefits";
        @endphp
    <h1>{{ $how_it_work_section->heading ?? $sub_defaultHeading }}</h1>
    <img src="{{asset('public/frontend/amazy/img/home/how_its_work.png')}}"> </div>
  <div class="eight_section_right">
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/one.png')}}"> </div>
      <div class="right_texts_eight">
        {{-- <p><b>Create an account with us</b></p> --}}
        <p><b>{{$how_it_work_section->heading1}}</b></p>
        <p>{{ $how_it_work_section->paragraph ?? $sub_defaultParagraph }}</p>
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/two.png')}}"> </div>
      <div class="right_texts_eight">
            <p><b>{{$how_it_work_section->heading2}}</b></p>
            <p>{{$how_it_work_section->paragraph1}}</p>
        {{-- <p><b>Discover our subscription plans</b></p>
        <p>Our tailored subscription plans, each offering unique advantages to enhance your business, with detailed descriptions and pricing.</p> --}}
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/three.png')}}"> </div>
      <div class="right_texts_eight">
            <p><b>{{$how_it_work_section->heading3}}</b></p>
            <p>{{$how_it_work_section->paragraph2}}</p>
        {{-- <p><b>Choose the best plan that fits you </b></p>
        <p>The best plan that fits your business needs and budget, then subscribe securely.</p> --}}
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/four.png')}}">  </div>
      <div class="right_texts_eight">
        {{-- <p><b>Unlock unbeatable wholesale pricing </b></p>
        <p>Exclusive wholesale pricing and unleash new growth opportunities for your business.</p> --}}
            <p><b>{{$how_it_work_section->heading4}}</b></p>
            <p>{{$how_it_work_section->paragraph3}}</p>
      </div>
    </div>
    <div class="eight_section_right_btm">
        <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/five.png')}}">  </div>
        <div class="right_texts_eight">
          {{-- <p><b>Unlock unbeatable wholesale pricing </b></p>
          <p>Exclusive wholesale pricing and unleash new growth opportunities for your business.</p> --}}
              <p><b>{{$how_it_work_section->heading4}}</b></p>
              <p>{{$how_it_work_section->paragraph3}}</p>
        </div>
      </div>
  </div>
</div>







<div class="ninth_section" style="display:none;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Top Foam  Brand</h1>
      </div>
    </div>
  </div>
  <div class="wrapper">
    <div class="center-slider">
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>NCFI InsulStar <br>
              Ligth</p>
          </div>
          <div class="top_image_title">
            <h6>$1,266.34</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm red">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow.png')}}"></h5>
              <p>22 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $12.00</h5>
            </div>
          </div>
          <div class="btm_chart_design"><img src="{{asset('public/frontend/amazy/img/home/chart_1.png')}}"></div>
        </div>
      </div>
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>ACCUFOAM <br>
              CC-HFO</p>
          </div>
          <div class="top_image_title">
            <h6>$1,736.45</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm green">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow_1.png')}}"></h5>
              <p>344 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $1.00</h5>
            </div>
          </div>
          <div class="btm_chart_design second"><img src="{{asset('public/frontend/amazy/img/home/chart_2.png')}}"></div>
        </div>
      </div>
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>NCFI InsulBloc<br>
              2.0 </p>
          </div>
          <div class="top_image_title">
            <h6>$1,608.35</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm green">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow_1.png')}}"></h5>
              <p>201 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $2.350</h5>
            </div>
          </div>
          <div class="btm_chart_design third"><img src="{{asset('public/frontend/amazy/img/home/chart_3.png')}}"></div>
        </div>
      </div>
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>NSF POLYMERS<br>
              OC-OG</p>
          </div>
          <div class="top_image_title">
            <h6>$1,251.72</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow.png')}}"></h5>
              <p>88 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $15.00</h5>
            </div>
          </div>
          <div class="btm_chart_design"> 
            <!--              <img src="images/chart_1.png">--> 
          </div>
        </div>
      </div>
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>ACCOUFOAM ROOF<br>
              FOAM</p>
          </div>
          <div class="top_image_title">
            <h6>$62,</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow.png')}}"></h5>
              <p>22 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $15.67</h5>
            </div>
          </div>
          <div class="btm_chart_design second"><img src="{{asset('public/frontend/amazy/img/home/chart_2.png')}}"></div>
        </div>
      </div>
      <div>
        <div class="bottom_slider_content">
          <div class="top_image_title"> <img src="{{asset('public/frontend/amazy/img/home/graco_1.png')}}">
            <p>NCFI InsulStar <br>
              Ligth</p>
          </div>
          <div class="top_image_title">
            <h6>$1,266.34</h6>
          </div>
          <div class="left_and_right_btm">
            <div class="left_content_btm">
              <h5>(+12.25%)<img src="{{asset('public/frontend/amazy/img/home/arrow.png')}}"></h5>
              <p>22 Sets</p>
            </div>
            <div class="right_content_btm">
              <h5>change <br>
                $12.00</h5>
            </div>
          </div>
          <div class="btm_chart_design"><img src="{{asset('public/frontend/amazy/img/home/chart_1.png')}}"></div>
        </div>
      </div>
    </div>
  </div>
  </div>





<script>
$(document).ready(function () {
  $('.center-slider').slick({
  slidesToShow: 5,
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
        centerMode: true // Optional, keeps the centered slide in focus
      }
    }
  ]
});
});
</script>



{{-- new code end --}}







@php
    $best_deal = $widgets->where('section_name','best_deals')->first();
@endphp
<div id="best_deals" class="amaz_section section_spacing {{$best_deal->status == 0?'d-none':''}}" style="display:none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap">
                    <h3 id="best_deals_title" class="m-0 flex-fill">{{$best_deal->title}}</h3>
                    <a href="{{route('frontend.category-product',['slug' =>  ($best_deal->section_name), 'item' =>'product'])}}" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text">{{ __('common.view_all') }}</span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="display:none;">
            <div class="col-12">
                <input type="hidden" class="productQtyCount" value="{{$best_deal->getProductByQuery()->count()}}">
                <div class="trending_product_active owl-carousel">
                    @foreach($best_deal->getProductByQuery() as $key => $product)
                        <div class="product_widget5 mb_30 style5">
                            <div class="product_thumb_upper">
                                @php
                                    if (@$product->thum_img != null) {
                                        $thumbnail = showImage(@$product->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                    }

                                    $price_qty = getProductDiscountedPrice(@$product);
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];
                                @endphp
                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                    class="thumb">
                                    @if(app('general_setting')->lazyload == 1)
                                        <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                        class="lazyload">
                                    @else
                                        <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                    @endif
                                </a>
                                @if(isGuestAddtoCart() == true)
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="{{ @$product->product->product_type }}"
                                        data-seller={{ $product->user_id }}
                                        data-product-sku={{ @$product->skus->first()->id }}
                                        data-product-id={{ $product->id }}>
                                        <i class="ti-control-shuffle"
                                            title="{{ __('defaultTheme.compare') }}"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                        id="wishlistbtn_{{ $product->id }}"
                                        data-product_id="{{ $product->id }}"
                                        data-seller_id="{{ $product->user_id }}">
                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                    </a>
                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                        data-type="product">
                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                    </a>
                                </div>
                                @endif
                                <div class="product_badge">
                                @if(isGuestAddtoCart() == true)
                                    @if($product->hasDeal)
                                        @if($product->hasDeal->discount >0)
                                            <span class="d-flex align-items-center discount">
                                                @if($product->hasDeal->discount_type ==0)
                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                @else
                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                @endif
                                            </span>
                                        @endif
                                    @else
                                        @if($product->hasDiscount == 'yes')
                                            @if($product->discount >0)
                                                <span class="d-flex align-items-center discount">
                                                    @if($product->discount_type ==0)
                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                    @else
                                                        {{single_price($product->discount)}} {{__('common.off')}}
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
                                        {{getNumberTranslate(@$product->product->club_point)}}
                                    </span>
                                    @endif
                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product_star mx-auto">
                                @php
                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                <x-rating :rating="$rating" />
                            </div>
                            <div class="product__meta text-center">
                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                </a>


                                @if(isGuestAddtoCart() == true)
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                            @if (@$product->hasDeal)
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                            @else
                                                @if (@$product->hasDiscount == 'yes')
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                @else
                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                @endif
                                            @endif
                                            data-shipping-method=0
                                            data-product-id={{ $product->id }}
                                            data-stock_manage="{{$product->stock_manage}}"
                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                            data-prod_info="{{ json_encode($showData) }}"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            {{__('defaultTheme.add_to_cart')}}
                                        </a>
                                        <p>
                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                <del>
                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                </del>
                                            @endif
                                            <strong>
                                                {{getProductDiscountedPrice(@$product)}}
                                            </strong>
                                        </p>
                                    </div>

                                @else
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">
                                            {{__('defaultTheme.login_to_order')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- amaz_section::start  -->
@php
    $feature_categories = $widgets->where('section_name','feature_categories')->first();
@endphp
<div id="feature_categories" class="amaz_section {{$feature_categories->status == 0?'d-none':''}}" style="display:none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_30 flex-wrap ">
                    <h3 id="feature_categories_title" class="m-0 flex-fill">{{$feature_categories->title}}</h3>
                    <a href="{{url('/category')}}" class="title_link d-flex align-items-center lh-1">
                        <span class="title_text">{{ __('common.view_all') }}</span>
                        <span class="title_icon">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($feature_categories->getCategoryByQuery() as $key => $category)
                <div class="col-xxl-3 col-lg-4 col-md-6">
                    <div class="amaz_home_cartBox amaz_cat_bg1 d-flex justify-content-between mb_30">
                        <div class="img_box">
                            @if(app('general_setting')->lazyload == 1)
                             <img class="lazyload" src="{{showImage(themeDefaultImg())}}" data-src="{{showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                            @else
                            <img src="{{showImage(@$category->categoryImage->image?@$category->categoryImage->image:'frontend/default/img/default_category.png')}}" alt="{{@$category->name}}" title="{{@$category->name}}">
                            @endif
                        </div>
                        <div class="amazcat_text_box">
                            <h4>
                                <a>{{textLimit($category->name,25)}}</a>
                            </h4>
                            <p class="lh-1">{{getNumberTranslate($category->sellerProducts->count())}} {{__('common.products')}}</p>
                            <a class="shop_now_text" href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}">{{__('common.shop_now')}} »</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- amaz_section::end  -->
<!-- new  -->
<!-- new  -->
<!-- amaz_section::start  -->
@php
    $filter_category_1 = $widgets->where('section_name','filter_category_1')->first();
    $category = @$filter_category_1->customSection->category;
@endphp

<div id="filter_category_1" class="amaz_section section_spacing2 {{@$filter_category_1->status == 0?'d-none':''}}" style="display:none;">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_1->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#house_appliance_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_1->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_1->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_1->title}}" title="{{@$filter_category_1->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="house_appliance_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                       <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                       <img src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"   >
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                    <div class="product_action">
                                                        <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                            data-producttype="{{ @$product->product->product_type }}"
                                                            data-seller={{ $product->user_id }}
                                                            data-product-sku={{ @$product->skus->first()->id }}
                                                            data-product-id={{ $product->id }}>
                                                            <i class="ti-control-shuffle"
                                                                title="{{ __('defaultTheme.compare') }}"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                            id="wishlistbtn_{{ $product->id }}"
                                                            data-product_id="{{ $product->id }}"
                                                            data-seller_id="{{ $product->user_id }}">
                                                            <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                        </a>
                                                        <a class="quickView" data-product_id="{{ $product->id }}"
                                                            data-type="product">
                                                            <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="product_badge">
                                                    @if(isGuestAddtoCart())
                                                        @if($product->hasDeal)
                                                            @if($product->hasDeal->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
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
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                         @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a href="{{ url('/login') }}" class="amaz_primary_btn w-100" style="text-indent: 0;">

                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- content  -->
                                </div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="house_appliance_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">
                                                @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                    alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                    class="lazyload">

                                                @else
                                                <img  src="{{ $thumbnail }}" alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                                                @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="product_badge">
                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
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
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>
                                            @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                        @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a href="{{ url('/login') }}" class="amaz_primary_btn w-100" style="text-indent: 0;">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>

                                            </div>

                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- content  -->
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@php
    $filter_category_2 = $widgets->where('section_name','filter_category_2')->first();
    $category = @$filter_category_2->customSection->category;
@endphp

<div id="filter_category_2" class="amaz_section section_spacing2 {{@$filter_category_2->status == 0?'d-none':''}}" style="display:none;">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_2->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#fashion_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_2->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_2->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_2->title}}" title="{{@$filter_category_2->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="fashion_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                    <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                    <img  src="{{ $thumbnail }}"   alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}">
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="product_badge">

                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
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
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>
                                                @if(isGuestAddtoCart())
                                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                            @if (@$product->hasDeal)
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                            @else
                                                                @if (@$product->hasDiscount == 'yes')
                                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                                @else
                                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                                @endif
                                                            @endif
                                                            data-shipping-method=0
                                                            data-product-id={{ $product->id }}
                                                            data-stock_manage="{{$product->stock_manage}}"
                                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                            data-prod_info="{{ json_encode($showData) }}"
                                                            >
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                            </svg>
                                                            {{__('defaultTheme.add_to_cart')}}
                                                        </a>
                                                        <p>
                                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                                <del>
                                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                                </del>
                                                            @endif
                                                            <strong>
                                                                {{getProductDiscountedPrice(@$product)}}
                                                            </strong>
                                                        </p>
                                                    </div>
                                                @else

                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">
                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- content  -->
                                </div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="fashion_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">
                                                @if(app('general_setting')->lazyload == 1)
                                                    <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                @else
                                                    <img  src="{{ $thumbnail }}"
                                                    alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                    >
                                                @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="product_badge">

                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
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
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                     @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent:0;">
                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- content  -->
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@php
    $filter_category_3 = $widgets->where('section_name','filter_category_3')->first();
    $category = @$filter_category_3->customSection->category;
@endphp

<div id="filter_category_3" class="amaz_section section_spacing2 {{@$filter_category_3->status == 0?'d-none':''}}" style="display:none;">
    <div class="container ">
        @if($category)
            <div class="row no-gutters">
                <div class="col-xl-5 p-0 col-lg-12">
                    <div class="House_Appliances_widget">
                        <div class="House_Appliances_widget_left d-flex flex-column flex-fill">
                            <h4 id="filter_category_title">{{$filter_category_3->title}}</h4>
                            <ul class="nav nav-tabs flex-fill flex-column border-0" id="myTab10" role="tablist">
                                @foreach(@$category->subCategories as $key => $subcat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{$key == 0?'active':''}}" id="tab_link_{{$subcat->id}}" data-bs-toggle="tab" data-bs-target="#electronics_tab_pane_subcat_{{$subcat->id}}" type="button" role="tab" aria-controls="Dining" aria-selected="true">{{$subcat->name}}</button>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="title_link d-flex align-items-center lh-1">
                                <span class="title_text">{{__('common.more_deals')}}</span>
                                <span class="title_icon">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                        <a href="{{route('frontend.category-product',['slug' => $category->slug, 'item' =>'category'])}}" class="House_Appliances_widget_right overflow-hidden p-0 {{$filter_category_3->customSection->field_2?'':'d-none'}}">
                            <img class="h-100 lazyload" data-src="{{showImage($filter_category_3->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{@$filter_category_3->title}}" title="{{@$filter_category_3->title}}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 p-0 col-lg-12">
                    <div class="tab-content" id="myTabContent10">
                        @if($category->subCategories->count())
                            @foreach($category->subCategories as $key => $subcat)
                                <div class="tab-pane fade {{$key == 0?'show active':''}}" id="electronics_tab_pane_subcat_{{$subcat->id}}" role="tabpanel" aria-labelledby="Dining-tab">
                                    <!-- content  -->
                                    <div class="House_Appliances_product">
                                        @foreach($subcat->sellerProductTake() as $product)
                                        <div class="product_widget5 style4 mb-0 style5">
                                            <div class="product_thumb_upper">
                                                @php
                                                    if (@$product->thum_img != null) {
                                                        $thumbnail = showImage(@$product->thum_img);
                                                    } else {
                                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                    }

                                                    $price_qty = getProductDiscountedPrice(@$product);
                                                    $showData = [
                                                        'name' => @$product->product_name,
                                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                        'price' => $price_qty,
                                                        'thumbnail' => $thumbnail,
                                                    ];
                                                @endphp
                                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                    class="thumb">
                                                    @if(app('general_setting')->lazyload == 1)
                                                      <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                      <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                                    @endif
                                                </a>
                                                @if(isGuestAddtoCart())
                                                <div class="product_action">
                                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                        data-producttype="{{ @$product->product->product_type }}"
                                                        data-seller={{ $product->user_id }}
                                                        data-product-sku={{ @$product->skus->first()->id }}
                                                        data-product-id={{ $product->id }}>
                                                        <i class="ti-control-shuffle"
                                                            title="{{ __('defaultTheme.compare') }}"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                        id="wishlistbtn_{{ $product->id }}"
                                                        data-product_id="{{ $product->id }}"
                                                        data-seller_id="{{ $product->user_id }}">
                                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                    </a>
                                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                                        data-type="product">
                                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                    </a>
                                                </div>
                                                @endif
                                                <div class="product_badge">
                                                    @if(isGuestAddtoCart())
                                                        @if($product->hasDeal)
                                                            @if($product->hasDeal->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->hasDeal->discount_type ==0)
                                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @else
                                                            @if($product->hasDiscount == 'yes')
                                                                @if($product->discount >0)
                                                                    <span class="d-flex align-items-center discount">
                                                                        @if($product->discount_type ==0)
                                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                        @else
                                                                            {{single_price($product->discount)}} {{__('common.off')}}
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
                                                        {{getNumberTranslate(@$product->product->club_point)}}
                                                    </span>
                                                    @endif
                                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product_star mx-auto">
                                                @php
                                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                                <x-rating :rating="$rating" />
                                            </div>
                                            <div class="product__meta text-center">
                                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                                </a>

                                                @if(isGuestAddtoCart())
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                        @if (@$product->hasDeal)
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                        @else
                                                            @if (@$product->hasDiscount == 'yes')
                                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                            @else
                                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                                            @endif
                                                        @endif
                                                        data-shipping-method=0
                                                        data-product-id={{ $product->id }}
                                                        data-stock_manage="{{$product->stock_manage}}"
                                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                        data-prod_info="{{ json_encode($showData) }}"
                                                        >
                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                        </svg>
                                                        {{__('defaultTheme.add_to_cart')}}
                                                    </a>
                                                    <p>
                                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                            <del>
                                                                {{getProductwitoutDiscountPrice(@$product)}}
                                                            </del>
                                                         @endif
                                                        <strong>
                                                            {{getProductDiscountedPrice(@$product)}}
                                                        </strong>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                    <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent:0; ">

                                                        {{__('defaultTheme.login_to_order')}}
                                                    </a>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- content  -->
                                </div>
                            @endforeach
                        @else
                            <div class="tab-pane fade show active" id="electronics_tab_pane_subcat_1" role="tabpanel" aria-labelledby="Dining-tab">
                                <!-- content  -->
                                <div class="House_Appliances_product">
                                    @foreach($category->sellerProductTake() as $product)
                                    <div class="product_widget5 style4 mb-0 style5">
                                        <div class="product_thumb_upper">
                                            @php
                                                if (@$product->thum_img != null) {
                                                    $thumbnail = showImage(@$product->thum_img);
                                                } else {
                                                    $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                                }

                                                $price_qty = getProductDiscountedPrice(@$product);
                                                $showData = [
                                                    'name' => @$product->product_name,
                                                    'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                    'price' => $price_qty,
                                                    'thumbnail' => $thumbnail,
                                                ];
                                            @endphp
                                            <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                                class="thumb">

                                                    @if(app('general_setting')->lazyload == 1)
                                                      <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                        class="lazyload">
                                                    @else
                                                      <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                                    @endif
                                            </a>
                                            @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                            @endif
                                            <div class="product_badge">
                                                @if(isGuestAddtoCart())
                                                    @if($product->hasDeal)
                                                        @if($product->hasDeal->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->hasDeal->discount_type ==0)
                                                                    {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                                @endif
                                                            </span>
                                                        @endif
                                                    @else
                                                        @if($product->hasDiscount == 'yes')
                                                            @if($product->discount >0)
                                                                <span class="d-flex align-items-center discount">
                                                                    @if($product->discount_type ==0)
                                                                        {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                    @else
                                                                        {{single_price($product->discount)}} {{__('common.off')}}
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
                                                    {{getNumberTranslate(@$product->product->club_point)}}
                                                </span>
                                                @endif
                                                @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                                    <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product_star mx-auto">
                                            @php
                                                $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                            <x-rating :rating="$rating" />
                                        </div>
                                        <div class="product__meta text-center">
                                            <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                            <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                                <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                            </a>

                                            @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                     @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                            @else
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn w-100" href="{{ url('/login') }}" style="text-indent: 0;">

                                                    {{__('defaultTheme.login_to_order')}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- content  -->
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- amaz_section::end  -->
<!-- cta::start  -->
<div class="amaz_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <x-random-ads-component/>
            </div>
        </div>
    </div>
</div>
<!-- cta::end  -->

@php
    $top_rating = $widgets->where('section_name','top_rating')->first();
    $peoples_choice = $widgets->where('section_name','people_choices')->first();
    $top_picks = $widgets->where('section_name','top_picks')->first();
@endphp
<div class="amaz_section section_spacing3" style="display:none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav amzcart_tabs d-flex align-items-center justify-content-center flex-wrap " id="myTab" role="tablist">
                    <li class="nav-item {{$top_rating->status == 0 ? 'd-none' : ''}}" role="presentation" id="top_rating">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><span id="top_rating_title">{{$top_rating->title}}</span></button>
                    </li>
                    <li class="nav-item {{$peoples_choice->status == 0 ? 'd-none' : ''}}" role="presentation" id="people_choices">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><span id="people_choice_title">{{$peoples_choice->title}}</span></button>
                    </li>
                    <li class="nav-item {{$top_picks->status == 0 ? 'd-none' : ''}}" role="presentation" id="top_picks">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><span id="top_picks_title">{{$top_picks->title}}</span></button>
                    </li>
                </ul>
            </div>
            <div class="col-xl-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{$top_rating->status == 0 ? 'hide' : 'show active'}}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($top_rating->getHomePageProductByQuery() as $key => $product)
                            <div class="product_widget5 mb_30 style5">
                                <div class="product_thumb_upper">
                                    @php
                                        if (@$product->thum_img != null) {
                                            $thumbnail = showImage(@$product->thum_img);
                                        } else {
                                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                        }

                                        $price_qty = getProductDiscountedPrice(@$product);
                                        $showData = [
                                            'name' => @$product->product_name,
                                            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail,
                                        ];
                                    @endphp
                                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                        class="thumb">
                                            @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                class="lazyload">
                                            @else
                                                <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                            @endif
                                    </a>
                                    @if(isGuestAddtoCart())
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="{{ @$product->product->product_type }}"
                                                data-seller={{ $product->user_id }}
                                                data-product-sku={{ @$product->skus->first()->id }}
                                                data-product-id={{ $product->id }}>
                                                <i class="ti-control-shuffle"
                                                    title="{{ __('defaultTheme.compare') }}"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                id="wishlistbtn_{{ $product->id }}"
                                                data-product_id="{{ $product->id }}"
                                                data-seller_id="{{ $product->user_id }}">
                                                <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                            </a>
                                            <a class="quickView" data-product_id="{{ $product->id }}"
                                                data-type="product">
                                                <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="product_badge">
                                        @if(isGuestAddtoCart())
                                            @if($product->hasDeal)
                                                @if($product->hasDeal->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->hasDeal->discount_type ==0)
                                                            {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                        @endif
                                                    </span>
                                                @endif
                                            @else
                                                @if($product->hasDiscount == 'yes')
                                                    @if($product->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->discount_type ==0)
                                                                {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->discount)}} {{__('common.off')}}
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
                                            {{getNumberTranslate(@$product->product->club_point)}}
                                        </span>
                                        @endif
                                        @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices->count())
                                            <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product_star mx-auto">
                                    @php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                    <x-rating :rating="$rating" />
                                </div>
                                <div class="product__meta px-3 text-center">
                                    <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                    <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                        <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                    </a>
                                    @if(isGuestAddtoCart())
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                @if (@$product->hasDeal)
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                @else
                                                    @if (@$product->hasDiscount == 'yes')
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                    @else
                                                        data-base-price={{ @$product->skus->first()->sell_price }}
                                                    @endif
                                                @endif
                                                data-shipping-method=0
                                                data-product-id={{ $product->id }}
                                                data-stock_manage="{{$product->stock_manage}}"
                                                data-stock="{{@$product->skus->first()->product_stock}}"
                                                data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                data-prod_info="{{ json_encode($showData) }}"
                                                >
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                    <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                </svg>
                                                {{__('defaultTheme.add_to_cart')}}
                                            </a>
                                            <p>
                                                @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                    <del>
                                                        {{getProductwitoutDiscountPrice(@$product)}}
                                                    </del>
                                                    @endif
                                                <strong>
                                                    {{getProductDiscountedPrice(@$product)}}
                                                </strong>
                                            </p>
                                        </div>
                                    @else
                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100" href="{{ url('/login') }}"  style="text-indent: 0;">

                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <!-- conttent  -->
                    </div>
                    <div class="tab-pane fade {{ $peoples_choice->status == 1 && $top_rating->status == 0 ? 'show active': 'hide' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($peoples_choice->getHomePageProductByQuery() as $key => $product)

                            <div class="product_widget5 mb_30 style5">
                                <div class="product_thumb_upper">
                                    @php
                                        if (@$product->thum_img != null) {
                                            $thumbnail = showImage(@$product->thum_img);
                                        } else {
                                            $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                        }

                                        $price_qty = getProductDiscountedPrice(@$product);
                                        $showData = [
                                            'name' => @$product->product_name,
                                            'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                            'price' => $price_qty,
                                            'thumbnail' => $thumbnail,
                                        ];
                                    @endphp
                                    <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                        class="thumb">
                                        @if(app('general_setting')->lazyload == 1)
                                            <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                            alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                            class="lazyload">
                                        @else
                                            <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                        @endif
                                    </a>

                                    @if(isGuestAddtoCart())
                                        <div class="product_action">
                                            <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                data-producttype="{{ @$product->product->product_type }}"
                                                data-seller={{ $product->user_id }}
                                                data-product-sku={{ @$product->skus->first()->id }}
                                                data-product-id={{ $product->id }}>
                                                <i class="ti-control-shuffle"
                                                    title="{{ __('defaultTheme.compare') }}"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                id="wishlistbtn_{{ $product->id }}"
                                                data-product_id="{{ $product->id }}"
                                                data-seller_id="{{ $product->user_id }}">
                                                <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                            </a>
                                            <a class="quickView" data-product_id="{{ $product->id }}"
                                                data-type="product">
                                                <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="product_badge">
                                        @if(isGuestAddtoCart())
                                            @if($product->hasDeal)
                                                @if($product->hasDeal->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->hasDeal->discount_type ==0)
                                                            {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                        @endif
                                                    </span>
                                                @endif
                                            @else
                                                @if($product->hasDiscount == 'yes')
                                                    @if($product->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->discount_type ==0)
                                                                {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->discount)}} {{__('common.off')}}
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
                                            {{getNumberTranslate(@$product->product->club_point)}}
                                        </span>
                                        @endif
                                        @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                            <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product_star mx-auto">
                                    @php
                                        $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                    <x-rating :rating="$rating" />
                                </div>
                                <div class="product__meta px-3 text-center">
                                    <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                    <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                        <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                    </a>

                                    @if(isGuestAddtoCart())
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                            @if (@$product->hasDeal)
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                            @else
                                                @if (@$product->hasDiscount == 'yes')
                                                    data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                @else
                                                    data-base-price={{ @$product->skus->first()->sell_price }}
                                                @endif
                                            @endif
                                            data-shipping-method=0
                                            data-product-id={{ $product->id }}
                                            data-stock_manage="{{$product->stock_manage}}"
                                            data-stock="{{@$product->skus->first()->product_stock}}"
                                            data-min_qty="{{@$product->product->minimum_order_qty}}"
                                            data-prod_info="{{ json_encode($showData) }}"
                                            >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                            </svg>
                                            {{__('defaultTheme.add_to_cart')}}
                                        </a>
                                        <p>
                                            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                <del>
                                                    {{getProductwitoutDiscountPrice(@$product)}}
                                                </del>
                                                @endif
                                            <strong>
                                                {{getProductDiscountedPrice(@$product)}}
                                            </strong>
                                        </p>
                                    </div>
                                    @else
                                    <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                        <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="{{ url('/login') }}" >

                                            {{__('defaultTheme.login_to_order')}}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <!-- conttent  -->
                    </div>
                    <div class="tab-pane fade {{$top_picks->status == 1 && $peoples_choice->status == 0 && $top_rating->status == 0 ? 'show active': 'hide' }}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- conttent  -->
                        <div class="amaz_fieature_active fieature_crousel_area owl-carousel">
                            @foreach($top_picks->getHomePageProductByQuery() as $key => $product)
                                <div class="product_widget5 mb_30 style5">
                                    <div class="product_thumb_upper">
                                        @php
                                            if (@$product->thum_img != null) {
                                                $thumbnail = showImage(@$product->thum_img);
                                            } else {
                                                $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                            }

                                            $price_qty = getProductDiscountedPrice(@$product);
                                            $showData = [
                                                'name' => @$product->product_name,
                                                'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                                'price' => $price_qty,
                                                'thumbnail' => $thumbnail,
                                            ];
                                        @endphp
                                        <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                            class="thumb">
                                            @if(app('general_setting')->lazyload == 1)
                                                <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                                alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                                class="lazyload">
                                            @else
                                                <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                            @endif
                                        </a>
                                        @if(isGuestAddtoCart())
                                            <div class="product_action">
                                                <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                                    data-producttype="{{ @$product->product->product_type }}"
                                                    data-seller={{ $product->user_id }}
                                                    data-product-sku={{ @$product->skus->first()->id }}
                                                    data-product-id={{ $product->id }}>
                                                    <i class="ti-control-shuffle"
                                                        title="{{ __('defaultTheme.compare') }}"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                                    id="wishlistbtn_{{ $product->id }}"
                                                    data-product_id="{{ $product->id }}"
                                                    data-seller_id="{{ $product->user_id }}">
                                                    <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                                </a>
                                                <a class="quickView" data-product_id="{{ $product->id }}"
                                                    data-type="product">
                                                    <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="product_badge">
                                            @if(isGuestAddtoCart())
                                                @if($product->hasDeal)
                                                    @if($product->hasDeal->discount >0)
                                                        <span class="d-flex align-items-center discount">
                                                            @if($product->hasDeal->discount_type ==0)
                                                                {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                            @else
                                                                {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                            @endif
                                                        </span>
                                                    @endif
                                                @else
                                                    @if($product->hasDiscount == 'yes')
                                                        @if($product->discount >0)
                                                            <span class="d-flex align-items-center discount">
                                                                @if($product->discount_type ==0)
                                                                    {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                                @else
                                                                    {{single_price($product->discount)}} {{__('common.off')}}
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
                                                {{getNumberTranslate(@$product->product->club_point)}}
                                            </span>
                                            @endif
                                            @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                                <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product_star mx-auto">
                                        @php
                                            $reviews = @$product->reviews->where('status', 1)->pluck('rating');

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
                                        <x-rating :rating="$rating" />
                                    </div>
                                    <div class="product__meta px-3 text-center">
                                        <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                        <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                            <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                        </a>

                                        @if(isGuestAddtoCart())
                                            <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                                <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                                    @if (@$product->hasDeal)
                                                        data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                                    @else
                                                        @if (@$product->hasDiscount == 'yes')
                                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                                        @else
                                                            data-base-price={{ @$product->skus->first()->sell_price }}
                                                        @endif
                                                    @endif
                                                    data-shipping-method=0
                                                    data-product-id={{ $product->id }}
                                                    data-stock_manage="{{$product->stock_manage}}"
                                                    data-stock="{{@$product->skus->first()->product_stock}}"
                                                    data-min_qty="{{@$product->product->minimum_order_qty}}"
                                                    data-prod_info="{{ json_encode($showData) }}"
                                                    >
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                                        <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                                    </svg>
                                                    {{__('defaultTheme.add_to_cart')}}
                                                </a>
                                                <p>
                                                    @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                                        <del>
                                                            {{getProductwitoutDiscountPrice(@$product)}}
                                                        </del>
                                                    @endif
                                                    <strong>
                                                        {{getProductDiscountedPrice(@$product)}}
                                                    </strong>
                                                </p>
                                            </div>
                                        @else

                                        <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                            <a class="amaz_primary_btn w-100"  style="text-indent: 0;" href="{{ url('/login') }}">
                                                {{__('defaultTheme.login_to_order')}}
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- conttent  -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@php
    $discount_banner = $widgets->where('section_name','discount_banner')->first();
@endphp
<div id="discount_banner" class="amaz_section amaz_deal_area {{$discount_banner->status == 0?'d-none':''}}">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_4?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_4}}" class="mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_1)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_5?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_5}}" class=" mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_2)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb_20 {{!@$discount_banner->customSection->field_6?'d-none':''}}">
                <a href="{{@$discount_banner->customSection->field_6}}" class=" mb_30">
                    <img data-src="{{showImage(@$discount_banner->customSection->field_3)}}" src="{{showImage(themeDefaultImg())}}" alt="{{$discount_banner->title}}" title="{{$discount_banner->title}}" class="img-fluid lazyload">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- amaz_recomanded::start  -->

@php
    $more_products = $widgets->where('section_name','more_products')->first();
@endphp
<div class="amaz_recomanded_area {{$more_products->status == 0?'d-none':''}}" style= "display:none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="more_products" class="amaz_recomanded_box mb_60">
                    <div class="amaz_recomanded_box_head">
                        <h4 class="mb-0">{{$more_products->title}}</h4>
                    </div>
                    <div class="amaz_recomanded_box_body2 dataApp">
                        @foreach($more_products->getHomePageProductByQuery() as $key => $product)
                        <div class="product_widget5 style5">
                            <div class="product_thumb_upper">
                                @php
                                    if (@$product->thum_img != null) {
                                        $thumbnail = showImage(@$product->thum_img);
                                    } else {
                                        $thumbnail = showImage(@$product->product->thumbnail_image_source);
                                    }

                                    $price_qty = getProductDiscountedPrice(@$product);
                                    $showData = [
                                        'name' => @$product->product_name,
                                        'url' => singleProductURL(@$product->seller->slug, @$product->slug),
                                        'price' => $price_qty,
                                        'thumbnail' => $thumbnail,
                                    ];
                                @endphp
                                <a href="{{ singleProductURL($product->seller->slug, $product->slug) }}"
                                    class="thumb">
                                    @if(app('general_setting')->lazyload == 1)
                                        <img data-src="{{ $thumbnail }}" src="{{ showImage(themeDefaultImg()) }}"
                                        alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}"
                                        class="lazyload">
                                    @else
                                        <img  src="{{ $thumbnail }}"  alt="{{ @$product->product_name }}" title="{{ @$product->product_name }}" >
                                    @endif
                                </a>
                                @if(isGuestAddtoCart())
                                <div class="product_action">
                                    <a href="javascript:void(0)" class="addToCompareFromThumnail"
                                        data-producttype="{{ @$product->product->product_type }}"
                                        data-seller={{ $product->user_id }}
                                        data-product-sku={{ @$product->skus->first()->id }}
                                        data-product-id={{ $product->id }}>
                                        <i class="ti-control-shuffle"
                                            title="{{ __('defaultTheme.compare') }}"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                        class="add_to_wishlist {{ $product->is_wishlist() == 1 ? 'is_wishlist' : '' }}"
                                        id="wishlistbtn_{{ $product->id }}"
                                        data-product_id="{{ $product->id }}"
                                        data-seller_id="{{ $product->user_id }}">
                                        <i class="far fa-heart" title="{{ __('defaultTheme.wishlist') }}"></i>
                                    </a>
                                    <a class="quickView" data-product_id="{{ $product->id }}"
                                        data-type="product">
                                        <i class="ti-eye" title="{{ __('defaultTheme.quick_view') }}"></i>
                                    </a>
                                </div>
                                @endif
                                <div class="product_badge">
                                    @if(isGuestAddtoCart())
                                        @if($product->hasDeal)
                                            @if($product->hasDeal->discount >0)
                                                <span class="d-flex align-items-center discount">
                                                    @if($product->hasDeal->discount_type ==0)
                                                        {{getNumberTranslate($product->hasDeal->discount)}} % {{__('common.off')}}
                                                    @else
                                                        {{single_price($product->hasDeal->discount)}} {{__('common.off')}}
                                                    @endif
                                                </span>
                                            @endif
                                        @else
                                            @if($product->hasDiscount == 'yes')
                                                @if($product->discount >0)
                                                    <span class="d-flex align-items-center discount">
                                                        @if($product->discount_type ==0)
                                                            {{getNumberTranslate($product->discount)}} % {{__('common.off')}}
                                                        @else
                                                            {{single_price($product->discount)}} {{__('common.off')}}
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
                                        {{getNumberTranslate(@$product->product->club_point)}}
                                    </span>
                                    @endif
                                    @if(isModuleActive('WholeSale') && @$product->skus->first()->wholeSalePrices != '')
                                        <span class="d-flex align-items-center sale">{{__('common.wholesale')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product_star mx-auto">
                                @php
                                    $reviews = @$product->reviews->where('status', 1)->pluck('rating');
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
                                <x-rating :rating="$rating" />
                            </div>
                            <div class="product__meta text-center">
                                <span class="product_banding ">{{ @$product->brand->name ?? " " }}</span>
                                <a href="{{singleProductURL(@$product->seller->slug, $product->slug)}}">
                                    <h4>@if ($product->product_name) {{ textLimit(@$product->product_name, 50) }} @else {{ textLimit(@$product->product->product_name, 50) }} @endif</h4>
                                </a>
                                @if(isGuestAddtoCart())
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn addToCartFromThumnail" data-producttype="{{ @$product->product->product_type }}" data-seller={{ $product->user_id }} data-product-sku={{ @$product->skus->first()->id }}
                                        @if (@$product->hasDeal)
                                            data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->hasDeal->discount_type,@$product->hasDeal->discount) }}
                                        @else
                                            @if (@$product->hasDiscount == 'yes')
                                                data-base-price={{ selling_price(@$product->skus->first()->sell_price,@$product->discount_type,@$product->discount) }}
                                            @else
                                                data-base-price={{ @$product->skus->first()->sell_price }}
                                            @endif
                                        @endif
                                        data-shipping-method=0
                                        data-product-id={{ $product->id }}
                                        data-stock_manage="{{$product->stock_manage}}"
                                        data-stock="{{@$product->skus->first()->product_stock}}"
                                        data-min_qty="{{@$product->product->minimum_order_qty}}"
                                        data-prod_info="{{ json_encode($showData) }}"
                                        >
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" >
                                            <path d="M0.464844 1.14286C0.464844 0.78782 0.751726 0.5 1.10561 0.5H1.58256C2.39459 0.5 2.88079 1.04771 3.15883 1.55685C3.34414 1.89623 3.47821 2.28987 3.58307 2.64624C3.61147 2.64401 3.64024 2.64286 3.66934 2.64286H14.3464C15.0557 2.64286 15.5679 3.32379 15.3734 4.00811L13.8119 9.50163C13.5241 10.5142 12.6019 11.2124 11.5525 11.2124H6.47073C5.41263 11.2124 4.48508 10.5028 4.20505 9.47909L3.55532 7.10386L2.48004 3.4621L2.47829 3.45572C2.34527 2.96901 2.22042 2.51433 2.03491 2.1746C1.85475 1.84469 1.71115 1.78571 1.58256 1.78571H1.10561C0.751726 1.78571 0.464844 1.49789 0.464844 1.14286ZM4.79882 6.79169L5.44087 9.1388C5.56816 9.60414 5.98978 9.92669 6.47073 9.92669H11.5525C12.0295 9.92669 12.4487 9.60929 12.5795 9.14909L14.0634 3.92857H3.95529L4.78706 6.74583C4.79157 6.76109 4.79548 6.77634 4.79882 6.79169ZM7.72683 13.7857C7.72683 14.7325 6.96184 15.5 6.01812 15.5C5.07443 15.5 4.30942 14.7325 4.30942 13.7857C4.30942 12.8389 5.07443 12.0714 6.01812 12.0714C6.96184 12.0714 7.72683 12.8389 7.72683 13.7857ZM6.4453 13.7857C6.4453 13.5491 6.25405 13.3571 6.01812 13.3571C5.7822 13.3571 5.59095 13.5491 5.59095 13.7857C5.59095 14.0224 5.7822 14.2143 6.01812 14.2143C6.25405 14.2143 6.4453 14.0224 6.4453 13.7857ZM13.7073 13.7857C13.7073 14.7325 12.9423 15.5 11.9986 15.5C11.0549 15.5 10.2899 14.7325 10.2899 13.7857C10.2899 12.8389 11.0549 12.0714 11.9986 12.0714C12.9423 12.0714 13.7073 12.8389 13.7073 13.7857ZM12.4258 13.7857C12.4258 13.5491 12.2345 13.3571 11.9986 13.3571C11.7627 13.3571 11.5714 13.5491 11.5714 13.7857C11.5714 14.0224 11.7627 14.2143 11.9986 14.2143C12.2345 14.2143 12.4258 14.0224 12.4258 13.7857Z" fill="currentColor"/>
                                        </svg>
                                        {{__('defaultTheme.add_to_cart')}}
                                    </a>
                                    <p>
                                        @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                                            <del>
                                                {{getProductwitoutDiscountPrice(@$product)}}
                                            </del>
                                            @endif
                                        <strong>
                                            {{getProductDiscountedPrice(@$product)}}
                                        </strong>
                                    </p>
                                </div>
                                @else
                                <div class="product_price d-flex align-items-center justify-content-between flex-wrap">
                                    <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="{{ url('/login') }}">

                                        {{__('defaultTheme.login_to_order')}}
                                    </a>
                                </div>

                                @endif
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                @if($more_products->getHomePageProductByQuery()->lastPage() > 1)
                <a id="loadmore" class="amaz_primary_btn2 min_200 load_more_btn_homepage">{{__('common.load_more')}}</a>
                @endif

                <input type="hidden" id="login_check" value="@if(auth()->check()) 1 @else 0 @endif">
            </div>
        </div>
    </div>
</div>
<div class="home certified_foam_second_section">
    <div class="celler_left_txt">
      <h2>Training <img src="{{asset('public/frontend/amazy/img/home/center_arrow.png')}}" style="width:40px;"> Section:</h2>
      <h4>Become a Certified Spray Foam Installer</h4>
      <h6>Why become a certified installer:</h6>
      <p>•Gain Credibility: Stand out in the industry with recognized certification, 
        building trust with clients and partners.</p>
      <p>•Access Better Contracts: Certified installers have more opportunities to 
        work on high-value projects.</p>
      <p>•Qualify for Bigger Jobs: Meet the standards required by larger contractors 
        and industry leaders, opening doors to extensive job options. </p>
      

     {{-- <ul>
        <li>Gain Credibility: Stand out in the industry with recognized certification, 
            building trust with clients and partners.</li>
        <li>Access Better Contracts: Certified installers have more 
            opportunities to work on high-value projects.</li>
        <li>Qualify for Bigger Jobs: Meet the standards required by larger contractors and industry leaders, 
opening doors to extensive job options.</li>
      </ul> --}}
      <button class="become_certified_btn">Get Certified Today</button>
    </div>
    <div class="celler_right_img"> <img src="public/frontend/amazy/img/home/training_section.jpg"> </div>
  </div>


<div class="tenth_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="review_section_heading">
          <h2>Product Videos</h2>
          <h1>Reviews</h1>
          <h4>by Experts</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="reviews_sections">
            @php
                $id = 7; // Set the ID of the record you want to retrieve
                $review_one_section = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model

                // Set default values
                $rev_defaultHeading = "Reactor 3 GRACO";
                $rev_defaultParagraph = "Using the Graco Reactor 3 has been a game-changer, saving our business $37,500 annually. Its advanced technology and reliability streamline our operations and reduce waste. A must-have for serious spray foam contractors.";
            @endphp
        {{-- <div class="video_left"><img src="{{asset('public/frontend/amazy/img/home/video_1.jpg')}}"></div> --}}
        <div class="video_left">
            <video autoplay loop muted playsinline style="width: 100%; height: auto; z-index: 2; position: relative;">
            <source src="{{ asset('public/images/reviews/' . $review_one_section->field_1) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        </div>
        {{-- <div class="video_left"><img src="{{asset('public/frontend/amazy/img/home/video_1.jpg')}}"></div> --}}
    
        <div class="video_right">
            <h2>{{ $review_one_section->heading ?? $rev_defaultHeading }}</h2>
            <p>{{ $review_one_section->paragraph ?? $rev_defaultParagraph }}</p>
                {{-- <h2>Reactor 3 GRACO</h2>
                <p>Using the Graco Reactor 3 has been a game-changer, saving our business $37,500 annually. Its advanced technology and reliability streamline our operations and reduce waste. A must-have for serious spray foam contractors. </p> --}}
                {{-- <div class="client_data"><img src="{{asset('public/frontend/amazy/img/home/review.png')}}"> --}}
                {{-- <div class="client_data"><img src="{{asset('public/images/reviews/review.png')}}"> --}}
                <div class="client_data"><img src="{{ asset('public/images/reviews/' . $review_one_section->field_2) }}">
                {{-- <div class="video_left"><img  src="{{asset('images/reviews/1730895534_arrow_1.png')}}"></div> --}}
                    {{-- <div class="video_left"><img  src="{{asset('public/frontend/amazy/img/home/1730895449_btm_2.jpg')}}"></div> --}}
                    <h6><b>{{$review_one_section->heading1}}</b><br>
                    {{$review_one_section->heading2}}</h6>
                    {{-- <h6><b>Mike Kuscher</b><br>
                    CEO</h6> --}}
                </div>
        </div>
  </div>
  <div class="reviews_sections_1">
    <div class="video_right">
        @php
            $id = 8; // Set the ID of the record you want to retrieve
            $review_two_section = Modules\FrontendCMS\Entities\HomePageSection::find($id); // Use the namespaced model

            // Set default values
            $rev2_defaultHeading = "About SPF Open Marketplace";
            $rev2_defaultParagraph = "Using the Graco Reactor 3 has been a game-changer, saving our business $37,500 annually. Its advanced technology and reliability streamline our operations and reduce waste. A must-have for serious spray foam contractors.";
        @endphp

        <h2>{{ $review_two_section->heading ?? $rev2_defaultHeading }}</h2>
        <p>{{ $review_two_section->paragraph ?? $rev2_defaultParagraph }}</p>
      {{-- <h2>About SPF Open Marketplace</h2>
      <p>Joining SPF Open Market has saved us a significant amount on foam and equipment. The transparent pricing and top suppliers make purchasing smooth and cost-effective. Highly recommend for cutting costs and boosting profits!</p> --}}
      <div class="client_data"><img src="{{ asset('public/images/reviews/' . $review_two_section->field_2) }}">
        <h6><b>{{$review_two_section->heading1}}</b><br>
          {{$review_two_section->heading2}}</h6>
        {{-- <h6><b>Mike Kuscher</b><br>
          CEO</h6> --}}
      </div>
    </div>
    <div class="video_left" style="position: relative; max-width: 100%; height: auto;">
    <!-- Fallback image to show before the video loads -->
    <img id="fallbackImage" src="{{ asset('public/frontend/amazy/img/home/video_2.jpg') }}" alt="Fallback Image" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: 1;">

    <!-- Video element with autoplay, loop, and no controls -->
    <video id="videoElement" autoplay loop muted playsinline style="width: 100%; height: auto; z-index: 2; position: relative;">
        <source src="{{ asset('public/images/reviews/' . $review_two_section->field_1) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<script>
    // JavaScript to hide the fallback image when the video starts playing
    document.getElementById('videoElement').addEventListener('play', function() {
        document.getElementById('fallbackImage').style.display = 'none';
    });
</script>



  </div>
</div>
</div>
<!-- amaz_recomanded::end -->
{{-- <x-top-brand-component/> --}}
<!-- amaz_brand::start  -->

<!-- amaz_brand::end  -->

<!-- Popular Searches::start  -->
{{-- <x-popular-search-component/> --}}
<!-- Popular Searches::end  -->

@include(theme('partials._subscription_modal'))
@endsection
@include(theme('partials.add_to_cart_script'))
@include(theme('partials.add_to_compare_script'))

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
</script>
    <script type="text/javascript">
    $('.center-slider-collection').slick({
  slidesToShow: 6,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
    centerPadding: '0px',
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
    $('.center-slider-collection-top').slick({
  slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
    centerPadding: '0px',
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
@endpush