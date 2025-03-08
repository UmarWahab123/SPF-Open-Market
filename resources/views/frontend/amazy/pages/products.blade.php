@extends('frontend.amazy.layouts.app')
@section('styles')


@endsection
@section('title')
SPF Open Market
@endsection
@section('breadcrumb')

@endsection

@section('content')
<div class="collection_ page single_product_page">
<div class="top_main_lines_bg">
  <div class="second_section_new_navbar">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="navbar">
            <div class="subnav">
              <button class="subnavbtn"><i class="fa fa-bars" style="font-size: 20px;"></i> Menu </button>
              <div class="subnav-content"> <a href="#company">Company</a> <a href="#team">Team</a> <a href="#careers">Careers</a> </div>
            </div>
            <a href="#line">|</a> <a href="#contact">Advertising</a> <a href="#line">|</a> <a href="#contact">Promotions</a> <a href="#line">|</a> <a href="#contact">Videos</a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="third_section_product">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="collection_page">
            <div class="sidebar">
              <h3>Categories</h3>
              <ul>
                <li>
                  <input type="checkbox">
                  Open cell</li>
                <li>
                  <input type="checkbox">
                  Closed cell</li>
                <li>
                  <input type="checkbox">
                  Brand</li>
                <li>
                  <input type="checkbox">
                  Residential</li>
              </ul>
              <h3>Qualifications</h3>
              <ul class="stars">
                <li>⭐⭐⭐⭐⭐</li>
                <li>⭐⭐⭐⭐</li>
                <li>⭐⭐⭐</li>
              </ul>
              <h3>Price</h3>
              <input type="range" min="145" max="100000" value="10000">
              <h3>Special characters</h3>
              <ul>
                <li>
                  <input type="checkbox">
                  Insulation</li>
                <li>
                  <input type="checkbox">
                  Density</li>
                <li>
                  <input type="checkbox">
                  Environmental friendliness</li>
              </ul>
              <button class="clean-button">Clean</button>
            </div>
            
            <!-- Product Display Section --> 
            
          </div>
        </div>
        @php
        $all_products = $widgets->where('section_name', 'top_rating')->first();
        @endphp
        <div class="col-md-9">
          <h1 class="text-center">Top Rated</h1>
          <div class="products">
            <div class="wrapper">
              <div class="center-slider-top">
                @foreach($all_products->getHomePageProductByQuery()->take(50) as $key => $product)
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
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="best_selling">Top Rated</button>
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
                  </a> </div>
                  </div>
                  <div class="buttons">
                    <div class="price">
                      @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                          <span class="old-price">{{ getProductwitoutDiscountPrice(@$product) }}</span>
                      @endif
                      <br>
                      <span>{{ getProductDiscountedPrice(@$product) }}</span> 
                      <span class="price_subscribers">Price for subscribers*</span>
                  </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart"><a href="{{ singleProductURL($product->seller->slug, $product->slug) }}" class="text-black">Viewer</a></button>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ninth_section_product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Latest Products</h1>
      </div>
    </div>
  </div>
  @php
    $latest_products = $widgets->where('section_name', 'top_brands')->first();
  @endphp
  <div class="wrapper">
    <div class="center-slider-collection">
      @foreach($latest_products->getHomePageProductByQuery()->take(50) as $key => $product)
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
      <div>
        <div class="bottom_slider_content">
          <div class="top_btn_sale">
            <button class="best_selling">Latest Product</button>
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
          </a> </div>
        </div>
        <p class="product_name">{{ Str::limit($product->product_name, 35, '...') }}</p>
  
        <div class="rating"><span> @php
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
      <x-rating :rating="$rating" /></span> </div>
        <div class="buttons">
          <div class="add_to_cart">
              @if(isGuestAddtoCart())
                  <button class="add-to-cart addToCartFromThumnail" 
                      data-producttype="{{ @$product->product->product_type }}" 
                      data-seller="{{ $product->user_id }}" 
                      data-product-sku="{{ @$product->skus->first()->id }}"
                      @if (@$product->hasDeal)
                          data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->hasDeal->discount_type, @$product->hasDeal->discount) }}"
                      @else
                          @if (@$product->hasDiscount == 'yes')
                              data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->discount_type, @$product->discount) }}"
                          @else
                              data-base-price="{{ @$product->skus->first()->sell_price }}"
                          @endif
                      @endif
                      data-shipping-method="0"
                      data-product-id="{{ $product->id }}"
                      data-stock_manage="{{ $product->stock_manage }}"
                      data-stock="{{ @$product->skus->first()->product_stock }}"
                      data-min_qty="{{ @$product->product->minimum_order_qty }}"
                      data-prod_info="{{ json_encode($showData) }}">
                      {{ __('defaultTheme.add_to_cart') }}
                  </button>
              @else
                  <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="{{ url('/login') }}">
                      {{ __('defaultTheme.login_to_order') }}
                  </a>
              @endif
          </div>
          
          <div class="price">
              @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                  <span class="old-price">{{ getProductwitoutDiscountPrice(@$product) }}</span>
              @endif
              <br>
              <span>{{ getProductDiscountedPrice(@$product) }}</span> 
              <span class="price_subscribers">Price for subscribers*</span>
          </div>
        </div>
      
      </div>
      @endforeach
    </div>
  </div>
  @php
  $top_selling_products = $widgets->where('section_name', 'top_picks')->first();
@endphp
  <div class="wrapper">
    <h1 class="text-center">Top Selling Product </h1>
    <div class="center-slider-collection">
      @foreach($top_selling_products->getHomePageProductByQuery()->take(50) as $key => $product)
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
      <div>
        <div class="bottom_slider_content">
          <div class="top_btn_sale">
            <button class="best_selling">Best Selling</button>
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
        </a></div>
        </div>
        <p class="product_name">{{ Str::limit($product->product_name, 35, '...') }}</p>
        <div class="rating"><span> @php
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
      <x-rating :rating="$rating" /></span> </div>
      <div class="buttons">
        <div class="add_to_cart">
            @if(isGuestAddtoCart())
                <button class="add-to-cart addToCartFromThumnail" 
                    data-producttype="{{ @$product->product->product_type }}" 
                    data-seller="{{ $product->user_id }}" 
                    data-product-sku="{{ @$product->skus->first()->id }}"
                    @if (@$product->hasDeal)
                        data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->hasDeal->discount_type, @$product->hasDeal->discount) }}"
                    @else
                        @if (@$product->hasDiscount == 'yes')
                            data-base-price="{{ selling_price(@$product->skus->first()->sell_price, @$product->discount_type, @$product->discount) }}"
                        @else
                            data-base-price="{{ @$product->skus->first()->sell_price }}"
                        @endif
                    @endif
                    data-shipping-method="0"
                    data-product-id="{{ $product->id }}"
                    data-stock_manage="{{ $product->stock_manage }}"
                    data-stock="{{ @$product->skus->first()->product_stock }}"
                    data-min_qty="{{ @$product->product->minimum_order_qty }}"
                    data-prod_info="{{ json_encode($showData) }}">
                    {{ __('defaultTheme.add_to_cart') }}
                </button>
            @else
                <a class="amaz_primary_btn w-100" style="text-indent: 0;" href="{{ url('/login') }}">
                    {{ __('defaultTheme.login_to_order') }}
                </a>
            @endif
        </div>
        
        <div class="price">
            @if (getProductwitoutDiscountPrice(@$product) != single_price(0))
                <span class="old-price">{{ getProductwitoutDiscountPrice(@$product) }}</span>
            @endif
            <br>
            <span>{{ getProductDiscountedPrice(@$product) }}</span> 
            <span class="price_subscribers">Price for subscribers*</span>
        </div>
      </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="above_footer_section_collection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="above_footer_section_content">
          <h1>¡Unlock Wholesale Prices <br>
            with a Monthly Subscription!</h1>
          <a href="#" class="view-all-products-button"> Shop now
          <div class="arrow_button"><span class="arrow"></span></div>
          </a>
          <h5>www.spf.com</h5>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@include(theme('partials.add_to_cart_script'))
@push('scripts')
<script>
  (function($){
      $(document).ready(function(){
          $(document).on('click', ".add_to_cart_gift_thumnail", function() {
              addToCart($(this).attr('data-gift-card-id'),$(this).attr('data-seller'),1,$(this).attr('data-base-price'),1,'gift_card',$(this).data('prod_info'));
          });
      });
  })(jQuery);
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
@endpush
