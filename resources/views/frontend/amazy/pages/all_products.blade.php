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
  <div class="second_section_new_navbar" style="padding:0px; margin: 0px">
    <div class="top" style="  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%); height: 10px; "></div>
    <div class="container" >
      <div class="row">
        <div class="col-md-12">
          <div class="navbar">
            <div class="subnav">
              <button class="subnavbtn"><i class="fa fa-bars" style="font-size: 20px;"></i> Menu </button>
              <div class="subnav-content"> <a href="#company">Company</a> <a href="#team">Team</a> <a href="#careers">Careers</a> </div>
            </div>
             <a href="#line">|</a> <a href="#contact">Advertising</a> <a href="#line">|</a> <a href="#contact">Promotions</a> <a href="#line">|</a> <a href="#contact">Videos</a> <a href="#line">|</a>  <a href="{{ url('/parts-finder')}}">Parts Finder</a> </div>
          </div>
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
                    @foreach($categories as $category)
                      <li><input type="radio" class="filter-category" name="category_id" value="{{$category->id}}"> {{$category->name}}</li>
                    @endforeach
                  </ul>
                  <h3 class="d-none">Ratings</h3>
                  <ul class="stars d-none">
                      <li><input type="radio" name="rating" class="filter-rating" value="5"> ⭐⭐⭐⭐⭐</li>
                      <li><input type="radio" name="rating" class="filter-rating" value="4"> ⭐⭐⭐⭐</li>
                      <li><input type="radio" name="rating" class="filter-rating" value="3"> ⭐⭐⭐</li>
                  </ul>
                  
                  <h3>Price</h3>
                  <div class="price-slider mb-2">
                      <input type="range" min="0" max="50000" value="50000" class="filter-price" id="priceRange">
                      <label for="priceRange"><b> Price:</b> <span id="priceMinValue">0</span> - <span id="priceMaxValue">50000</span></label>
                  </div>

                  <h3 class="d-none">Special Features</h3>
                  <ul class="d-none">
                      <li><input type="radio" class="filter-feature" value="insulation"> Insulation</li>
                      <li><input type="radio" class="filter-feature" value="density"> Density</li>
                      <li><input type="radio" class="filter-feature" value="environmental_friendliness"> Environmental friendliness</li>
                  </ul>
                  
                  <button class="clean-button">Clean</button>
              </div>
          </div>
        </div>
      <div class="col-md-9">
          <div class="products">
            <div class="wrapper">
              <div class="center-slider-top">
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="best_selling">ALL</button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="new_at">Fusion FX </button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img_1.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="ecologic">Fusion FX Gun</button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img_2.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="best_selling">ALL</button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="best_selling">Fusion FX</button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img_1.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="bottom_slider_content">
                    <div class="top_btn_sale">
                      <button class="new_at">Fusion FX Gun</button>
                      <img src="https://nexttech-dev.com/SPF/images/category_page_img_2.png"> </div>
                  </div>
                  <div class="buttons">
                    <div class="price"> <span class="old-price">$37,590.00</span> <br>
                      <span>$35,590.00</span> <span class="price_subscribers">Price for subscribers*</span> </div>
                    <div class="add_to_cart">
                      <button class="add-to-cart">Viewer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
        <h2 class="text-center mb-4">Products</h2>
        <div class="row g-4" id="product-list">
            @include('frontend.amazy.pages.product_list')
        </div>
          <!-- Load More Button -->
          @if($products->hasMorePages())
          <div class="text-center mt-4">
              <button id="load-more" style="background-color: #18371e; border-color: #18371e; padding: 10px 30px;" class="btn btn-primary" data-page="1" data-url="{{ route('frontend.all.products') }}">Load More</button>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.5.0/lazyload.min.js"></script> --}}

<script>
(function($){
    $(document).ready(function(){
        
        // Function to fetch filtered products with pagination
        function fetchFilteredProducts(page = 1) {
          $('#pre-loader').show();
            var category_id = $('input[name="category_id"]:checked').val();
            var rating = $('input[name="rating"]:checked').val();
            var price = $('#priceRange').val();
            var features = [];

            // Gather selected features
            $('.filter-feature:checked').each(function() {
                features.push($(this).val());
            });

            // AJAX request for filtering and pagination
            $.ajax({
                url: "{{ route('frontend.all.products') }}", // Route to the all products method
                method: "GET",
                data: {
                    category_id: category_id,
                    rating: rating,
                    min_price: 0,
                    max_price: price, 
                    features: features,
                    page: page // Pass the current page for pagination
                },
                beforeSend: function() {
                    // You can add a loader here if needed
                },
                success: function(response) {
                    if (page === 1) {
                        // If on the first page, replace the product list
                        $('#product-list').html(response.html);
                        $('#pre-loader').hide();
                    } else {
                        // Append new products for further pages
                        $('#product-list').append(response.html);
                        $('#pre-loader').hide();
                    }

                    // // Reinitialize lazy loading if needed
                    // if (typeof lazyLoadInstance !== 'undefined') {
                    //     lazyLoadInstance.update();
                    // } else {
                    //     new LazyLoad({
                    //         elements_selector: ".lazyload"
                    //     });
                    // }

                    // Handle pagination button
                    if (response.nextPageUrl) {
                        $('#load-more').data('page', page).data('url', response.nextPageUrl).show();
                    } else {
                        $('#load-more').hide(); // Hide "Load More" button if no more pages
                    }
                },
                error: function() {
                    alert('Failed to load products');
                }
            });
        }

        // Trigger the AJAX call on filter changes
        $('.filter-category, .filter-rating, .filter-price, .filter-feature').on('change', function() {
            fetchFilteredProducts(1); // Fetch from page 1 when filters change
        });
     // Update price value dynamically as the slider changes
        $('#priceRange').on('input', function() {
            var price = $(this).val();
            $('#priceMaxValue').text(price);  // Update the max price value displayed dynamically
        });
        // Reset filters and fetch products
        $('.clean-button').on('click', function() {
            $('input[type="checkbox"], input[type="radio"]').prop('checked', false); // Reset filters
            $('#priceRange').val(50000); // Reset price range
            fetchFilteredProducts(1); // Fetch from page 1 with cleared filters
        });

        // Handle "Load More" pagination button
        $(document).on('click', '#load-more', function() {
            var page = $(this).data('page') + 1; // Increment page number
         fetchFilteredProducts(page); // Fetch the next page of products
        });

    });
})(jQuery);

  
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

$(document).on('click', '.add_to_cart_btn', function(event){
    event.preventDefault();
    var showData = {
        'name' : "{{ @$product->product_name }}",
        'url' : "{{singleProductURL(@$product->seller->slug, @$product->slug)}}",
        'price': '$' + $('#final_price').val(),
        'thumbnail' : $('#thumb_image').val()
    };
    addToCart($('#product_sku_id').val(),$('#seller_id').val(),$('#qty').data('value'),$('#base_sku_price').val().trim(),$('#shipping_type').val(),'product',showData);
});
</script> 
@endpush
@include(theme('partials.add_to_cart_script'))
