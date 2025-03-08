@extends('frontend.amazy.layouts.app')

@push('styles')





<style>
/* old css */
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
.background {
  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);
}
/* old css */





</style>
@endpush

@section('content')
    <!-- home_banner::start  -->
    @php
        $headers = \Modules\Appearance\Entities\Header::all();
    @endphp
    <x-slider-component :headers="$headers"/>
<!-- home_banner::end  -->









 <!-- new -->
 <div class="background" >
  <div class="third_section" >
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h1>Unlock Growth with
            Transparency and 
            Fair Pricing</h1>asdf
          <p>Join SPF Open Market for exclusive, real-time 
            pricing on spray foam products. </p>
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
          <div class="logos_all_first"> <img src="{{asset('public/frontend/amazy/img/home/ncfi.png')}}"> </div>
          <div class="logos_all_second"><img src="{{asset('public/frontend/amazy/img/home/ambit.png')}}"> </div>
          <div class="logos_all_third"><img src="{{asset('public/frontend/amazy/img/home/graco.png')}}"> </div> 
          <div class="logos_all_forth"><img src="{{asset('public/frontend/amazy/img/home/nsf.png')}}"> </div>
          <div class="logos_all_fifth"><img src="{{asset('public/frontend/amazy/img/home/accu.png')}}"> </div> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-12">
          <div class="video_left"><img  src="{{asset('public/frontend/amazy/img/home/video.jpg')}}"></div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-12">
          <div class="right_text">
            <h2>Empower Your Business and
              Connect with Top Suppliers.</h2>
            <p>Always know you're getting the best deal with real-time pricing. </p>
            </div>
        </div>
      </div>
    </div>
  </div>





  <div class="fifth_section">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-lg-7 col-sm-6 col-6">
        <h1>Categories</h1>
      </div>
      <div class="col-md-1 col-lg-1 col-sm-3 col-3">
        <p class="filter">Filter <span class="filter_line">|</span> </p>
      </div>
      <div class="col-md-1 col-lg-1 col-sm-3 col-3">
        <div class="search-container">
          <input type="text" placeholder="Search" class="search-input">
          <button class="search-button"> <i class="fa fa-search"></i> </button>
        </div>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-8 col-8"> <a href="{{url('/category')}}" class="view-all-products-button"> View All Products
        <div class="arrow_button"><span class="arrow"></span></div>
        </a> </div>
      <div class="col-md-1 col-lg-1 col-sm-4 col-4">
        <div class="cart_image"><img src="{{asset('public/frontend/amazy/img/home/cart_1.png')}}"></div>
      </div>
    </div>
  </div>
  <div class="container mt-5">
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
  </div>
  <div class="container mt-3">
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
</div>






<div class="sixth_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Stop Overpaying for Foam and  Supplies</h1>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 mt-5">
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Transparency.png')}}" > </div>
          <div class="right_text_btm">
            <h4>Transparency</h4>
            <p>Eliminate guesswork with complete visibility into product pricing and market trends.</p>
          </div>
        </div>
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Fair_Pricing.png')}}" > </div>
          <div class="right_text_btm">
            <h4>Fair Pricing</h4>
            <p>Get the best deal with transparent, real-time pricing on all spray foam products.</p>
          </div>
        </div>
        <div class="image_and_text">
          <div class="left_image_btm"> <img src="{{asset('public/frontend/amazy/img/home/Exclusivity.png')}}" > </div>
          <div class="right_text_btm">
            <h4>Exclusivity</h4>
            <p>Join an elite, members-only club where only approved, accredited, and vetted professionals gain access to unparalleled growth opportunities. Stay ahead of the competition with the best wholesale pricing, available exclusively to our trusted members.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="center_image_main"> <img src="{{asset('public/frontend/amazy/img/home/center_image.png')}}" /></div>
      </div>
      <div class="col-md-4">
        <div class="center_image_main_paragraph">
          <p>Unlock unparalleled growth opportunities and outpace your competitors with SPF Open Market. By joining our exclusive members-only club, you'll eliminate guesswork from product purchasing and gain access to real-time pricing on all your favorite spray foam products. Experience transparency and fair pricing like never before, ensuring you always get the best deal. </p>
          <button>READ MORE</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- seventh_section -->

<div class="seventh_section">
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



<div class="background">
<div class="eight_section">
  <div class="eight_section_left">
    <h1>How it Works</h1>
    <img src="{{asset('public/frontend/amazy/img/home/how_its_work.png')}}"> </div>
  <div class="eight_section_right">
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/one.png')}}"> </div>
      <div class="right_texts_eight">
        <p><b>Create an account with us</b></p>
        <p>Create an account by signing up on our platform, providing your business details, and verifying your email address to start exploring membership benefits</p>
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/two.png')}}"> </div>
      <div class="right_texts_eight">
        <p><b>Discover our subscription plans</b></p>
        <p>Our tailored subscription plans, each offering unique advantages to enhance your business, with detailed descriptions and pricing.</p>
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/three.png')}}"> </div>
      <div class="right_texts_eight">
        <p><b>Choose the best plan that fits you </b></p>
        <p>The best plan that fits your business needs and budget, then subscribe securely.</p>
      </div>
    </div>
    <div class="eight_section_right_btm">
      <div class="left_numbers_eight"> <img src="{{asset('public/frontend/amazy/img/home/four.png')}}">  </div>
      <div class="right_texts_eight">
        <p><b>Unlock unbeatable wholesale pricing </b></p>
        <p>Exclusive wholesale pricing and unleash new growth opportunities for your business.</p>
      </div>
    </div>
  </div>
</div>







<div class="ninth_section">
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
    autoplay: true
  });
});
</script>









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
    <div class="video_left"><img src="{{asset('public/frontend/amazy/img/home/video_1.jpg')}}"></div>
    <div class="video_right">
      <h2>Reactor 3 GRACO</h2>
      <p>Using the Graco Reactor 3 has been a game-changer, saving our business $37,500 annually. Its advanced technology and reliability streamline our operations and reduce waste. A must-have for serious spray foam contractors. </p>
      <div class="client_data"><img src="{{asset('public/frontend/amazy/img/home/review.png')}}">
        <h6><b>Mike Kuscher</b><br>
          CEO</h6>
      </div>
    </div>
  </div>
  <div class="reviews_sections_1">
    <div class="video_right">
      <h2>About SPF Open Marketplace</h2>
      <p>Joining SPF Open Market has saved us a significant amount on foam and equipment. The transparent pricing and top suppliers make purchasing smooth and cost-effective. Highly recommend for cutting costs and boosting profits!</p>
      <div class="client_data"><img src="{{asset('public/frontend/amazy/img/home/review_1.png')}}">
        <h6><b>Mike Kuscher</b><br>
          CEO</h6>
      </div>
    </div>
    <div class="video_left"><img src="{{asset('public/frontend/amazy/img/home/video_2.jpg')}}"></div>
  </div>
  </div>
  </div>



@endsection


