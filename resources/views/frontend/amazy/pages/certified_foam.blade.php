@extends('frontend.amazy.layouts.app')
@push('styles')

<style>
button.become_certified_btn {
  background-color: #00ff30 !important;
  padding: 10px 30px!important;
  color: black!important;
  border: none!important;
  border-radius: 10px!important;
  font-size: 25px!important;
  font-weight: 500!important;
  font-style: italic!important;
  margin-top: 20px!important;
  line-height: initial !important;
  font-family: inherit !important;
}
.three_icons_certified h4{
  color:"#ffffff";
}
    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    

<div class="single_product_page" style="background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">
<div class="top_main_lines_bg">
  <div class="certified_foam_second_section">
    <div class="celler_left_txt">
      <h2>Become a Certified <br>
        Spray Foam Installer <br>
        with SPF Exchange</h2>
      <p>Unlock the benefits of becoming a certified spray foam installer. Our comprehensive training program prepares you for real-world applications, giving you the skills, credibility, and market edge you need.</p>
      <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
    </div>
    <div class="celler_right_img"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_img.png')}}"></div>
  </div>
  <div class="benefits_of_being">
   <div class="width_controller">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Benefits of Being an SPF Certified Installer</h1>
            <p>Certified installers are respected for their expertise and enjoy enhanced job security and competitive pay. The construction industry is actively seeking certified SPF installers, and our program prepares you for success with in-depth training and ongoing support.</p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-4 col-lg-4 col-sm-12 col-12">
            <div class="three_icons_certified"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno.png')}}"></div>
          </div>
          <div class="col-md-8">
            <div class="three_icons_certified_parag mt-3">
              <p>In-Depth Training: From basic theory to advanced application techniques, our training covers it all.</p>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-4 col-lg-4 col-sm-12 col-12">
            <div class="three_icons_certified"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno1.png')}}"></div>
          </div>
          <div class="col-md-8">
            <div class="three_icons_certified_parag mt-3">
              <p>Nationwide Recognition: Your certification is valid and respected across North America, recognized by leading industry organizations.</p>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-4 col-lg-4 col-sm-12 col-12">
            <div class="three_icons_certified"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno2.png')}}"></div>
          </div>
          <div class="col-md-8">
            <div class="three_icons_certified_parag mt-3">
              <p>Exclusive Career Opportunities: Join a network of contractors who prefer working with certified professionals.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="certified_third_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="certified_third_box">
          <div class="three_icons_certified" style="text-align:right;"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno4.png')}}"></div>
              <h4>Why Get Certified?</h4>
              <p >Certification with SPF Exchange not only validates your skills but also opens doors to premium projects, making you a preferred choice for contractors.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="certified_third_box  mt-5">
          <div class="three_icons_certified" style="text-align:right;"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno3.png')}}"></div>
              <h4>Why Get Certified?</h4>
              <p>Certification with SPF Exchange not only validates your skills but also opens doors to premium projects, making you a preferred choice for contractors.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="certified_third_box">
          <div class="three_icons_certified" style="text-align:right;"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno5.png')}}"></div>
              <h4>Why Get Certified?</h4>
              <p>Certification with SPF Exchange not only validates your skills but also opens doors to premium projects, making you a preferred choice for contractors.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="certified_third_box mt-5">
          <div class="three_icons_certified" style="text-align:right;"><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno6.png')}}"></div>
              <h4>Why Get Certified?</h4>
              <p>Certification with SPF Exchange not only validates your skills but also opens doors to premium projects, making you a preferred choice for contractors.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="unlock_your_potential">
          <h2>Unlock Your Potential with SPF Certification</h2>
          <p>Our certification not only validates your skills but connects you to an exclusive network, opens doors to prestigious projects, and equips you with hands-on training.</p>
          <p><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno7.png')}}"> Stand out as the top choice for contractors </p>
          <p><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno7.png')}}"> Gain access to opportunities </p>
          <p><img src="{{asset('public/frontend/amazy/img/home/certified_foam_icno7.png')}}"> Take your expertise to the next level </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="benefits_of_being">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="certified_page_slider">
          <h1>Get Certified in 3 Easy Steps</h1>
          <div class="wrapper">
            <div class="top-slider-seller-center">
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                     <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider1.png')}}" > </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-4 col-4">
                    <div class="slider_images"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_slider2.png')}}" > </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="slider_images">
                      <h5>Register for Training</h5>
                      <p>Enroll in our program to get access to the course that qualifies you to install spray foam products from our partner brands.</p>
                      <div class="celler_left_txt mt-3">
                        <button class="become_certified_btn">Become a Certified Spray Foam Installer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="what_to_expect_after">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>What to Expect After Registration?</h1>
        </div>
      </div>
      <div class="row pt-2 pb-3 align-items-center" style="border-bottom:2px solid white;">
        <div class="col-md-1">
          <h2 style="color:#00ff4f !important;">01</h2>
        </div>
        <div class="col-md-5">
          <h3>Course Configration</h3>
        </div>
        <div class="col-md-6">
          <p>Receive confirmation with details on the course format and dates.</p>
        </div>
      </div>
      <div class="row pt-4 pb-3 align-items-center" style="border-bottom:2px solid white;">
        <div class="col-md-1">
          <h2 style="color:#00ff4f !important;">02</h2>
        </div>
        <div class="col-md-5">
          <h3>Course Configration</h3>
        </div>
        <div class="col-md-6">
          <p>Receive confirmation with details on the course format and dates.</p>
        </div>
      </div>
      <div class="row pt-4 pb-3 align-items-center" style="border-bottom:2px solid white;">
        <div class="col-md-1">
          <h2 style="color:#00ff4f !important;">03</h2>
        </div>
        <div class="col-md-5">
          <h3>Course Configration</h3>
        </div>
        <div class="col-md-6">
          <p>Receive confirmation with details on the course format and dates.</p>
        </div>
      </div>
      <div class="celler_left_txt mt-3">
        <button class="become_certified_btn" tabindex="0">Unlock Your Potential with SPF Certification</button>
      </div>
    </div>
  </div>
</div>
<div class="spf_exchange_certification">
  <div class="container">
    <div class="row">
      <div class="col-md-5"> <img src="{{asset('public/frontend/amazy/img/home/certified_foam_btm.png')}}"> </div>
      <div class="col-md-7">
        <div class="spf_exchange_right_txt">
          <h3>SPF Exchange: Your Certification Partner Across North America</h3>
          <p>We are recognized as one of the top certification providers, with ISO accreditation and nationwide acceptance. Our Certification Program aligns with North American building codes and standards, ensuring you meet all industry requirements. With us, you gain skills that are respected and recognized across North America.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="spf_certification">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>SPF Certification Program Details</h1>
        <p style="color:#000000 !important;">Our program covers everything you need to become proficient in spray foam installation:</p>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4 col-lg-4 col-sm-12 col-12 mt-3">
        <div class="spf_certification_boxes">
          <img src="{{asset('public/frontend/amazy/img/home/certified_foam_cv.png')}}">
          <p><b>Curriculum: </b> Comprehensive lessons on SPF theory, practical installation techniques, and industry standards.</p>
        </div>
      </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mt-3">
        <div class="spf_certification_boxes">
          <img src="{{asset('public/frontend/amazy/img/home/certified_foam_cv1.png')}}">
          <p><b>Hands-On Training:</b>  Gain practical experience with the guidance of industry experts.</p>
        </div>
      </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mt-3">
        <div class="spf_certification_boxes">
          <img src="{{asset('public/frontend/amazy/img/home/certified_foam_cv2.png')}}">
          <p><b>Certification Validity: </b> Certified for 5 years, with an annual renewal option to keep your credentials active and current.</p>
        </div>
      </div>
    </div>
      <div class="row mt-4">
      <div class="col-md-12">
        <div class="celler_left_txt mt-3 text-center">
        <button class="become_certified_btn" tabindex="0">View Curriculum</button>
      </div>
      </div>
    </div>
  </div>
</div>
  <div class="benefits_of_being last">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="certified_page_slider_second">
              <h1>Hear From Our Certified Installers</h1>
              <div class="wrapper">
                <div class="top-slider-seller-center">
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                  <div>
                      <img src="{{asset('public/frontend/amazy/img/home/google_btn.png')}}" >
                    <p>"SPF Exchange made certification easy. The remote setup was seamless, and the evaluators provided valuable feedback. Now, I’m working with top contractors, and my certification is widely respected."<br><br><b>— Certified Installer from California, USA</b></p>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>


{{-- new end --}}
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    $('.top-slider-seller-center').slick({
  slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
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
        icon.innerHTML = '<img src="images/down_arrow.png" alt="Down Arrow">';  // Down arrow image for closed state

    } else {

        // Open section
        content.style.maxHeight = content.scrollHeight + "px";
        content.style.padding = "10px";  // Set padding back to default
        section.classList.add('open');
        icon.innerHTML = '<img src="images/minus.png" alt="Minus Sign">';  // Minus sign image for open state
    }
}



    // Automatically open the first section (Description) on page load

    document.addEventListener('DOMContentLoaded', function() {

        const firstSection = document.querySelector('.section.open');

        const content = firstSection.querySelector('.section-content');

        content.style.maxHeight = content.scrollHeight + "px"; // Set initial height

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
    </script>

@endpush
