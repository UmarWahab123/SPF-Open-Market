@extends('frontend.amazy.layouts.app')
@section('title')
    {{ $content->mainTitle }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset(asset_path('frontend/amazy/css/page_css/marchant.css')) }}" />
    <style>
        .seller_center_second_section .celler_rihgt_txt p {
          font-family: 'Roboto-Regular' !important;
          font-weight: 600 !important;
          color: currentcolor;
      }
    </style>
@endpush
@section('content')

{{-- new start --}}

<body class="single_product_page" style="background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">
<div class="top_main_lines_bg">
  <div class="seller_center_slider_top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="wrapper">
            <div class="top-slider-seller-center">
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
              <div>
                <h1>Welcome to SPF Seller Central</h1>
                 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting....</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="seller_center_second_section">
  <div class="celler_left_img"><img src="{{asset('public/frontend/amazy/img/home/seller_center.png')}}"></div>
  <div class="celler_rihgt_txt">
    <h2>Why Sell on SPF Exchange?</h2>
    <p>1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    <p>2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    <p>3. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    <div class="signup-button">
      <div class="left-section">Sign up for an SPF<br>
        Seller Central account</div>
            @if(app('general_setting')->disable_seller_plan==0)
            @foreach ($commissions->where('status', 1)->where('slug', 'commission') as $key => $commission)
             <a href="{{ route('frontend.merchant-register', $commission->slug) }}" class="right-section">Sign up*</a>

            @endforeach
            @endif
            @if(app('general_setting')->disable_seller_plan==1)
            @foreach ($commissions->where('status', 1)->where('slug', 'commission') as $key => $commission)
            <a href="{{ route('frontend.merchant-register', $commission->slug) }}" class="right-section">Sign up*</a>
            @endforeach
            @endif
    </div>
  </div>
</div>
<div class="seller_center_third_section">
  <div class="celler_left_txt">
    <h2 class="text-white">How it Works</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="seller_center_third_box text-white">
          <h3>01</h3>
          <h4 class="text-white">Create an Account</h4>
          <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <a href="#" class="text-white">View details</a> </div>
      </div>
      <div class="col-md-6 text-white">
        <div class="seller_center_third_box text-white">
          <h3>02</h3>
          <h4 class="text-white">Complete Verification</h4>
          <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <a href="#" class="text-white">View details</a> </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 text-white">
        <div class="seller_center_third_box text-white">
          <h3>03</h3>
          <h4 class="text-white">Create an Account</h4>
          <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <a href="#" class="text-white">View details</a> </div>
      </div>
      <div class="col-md-6 text-white">
        <div class="seller_center_third_box text-white">
          <h3>04</h3>
          <h4 class="text-white">Complete Verification</h4>
          <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <a href="#" class="text-white">View details</a> </div>
      </div>
    </div>
  </div>
  <div class="celler_right_img"> <img src="{{asset('public/frontend/amazy/img/home/seller_center_second.png')}}"></div>
  {{-- <div class="celler_right_img"> <img src="images/seller_center_second.png"> </div> --}}
  
</div>
<div class="seller_tools_benefits">
  <div class="top_heading_seller_tools">
    <h1>Seller Tools & Benefits</h1>
  </div>
  {{-- <div class="celler_left_img"> <img src="images/seller_center_third.png"> </div> --}}
  <div class="celler_left_img"> <img src="{{asset('public/frontend/amazy/img/home/seller_center_third.png')}}"> </div>
  <div class="celler_rihgt_txt">
    <div class="description_toggle">
      <div class="section open">
        <div class="section-header" onclick="toggleSection(this)"> <span>Subscription Management</span> <span class="toggle-icon"><img src="https://nexttech-dev.com/SPF/images/down_arrow.png" alt="Minus Sign"></span> </div>
        <div class="section-content">
          <p>Count on the Reactor 2 E-XP2 proportioner for advanced technology in applying fast-curing polyurea coatings. Because it's a Reactor 2 series proportioner... </p>
        </div>
      </div>
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)"> <span>Subscription Management 1</span> <span class="toggle-icon"><img src="https://nexttech-dev.com/SPF/images/down_arrow.png"></span> </div>
        <div class="section-content">
          <p>Specifications details go here...</p>
        </div>
      </div>
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)"> <span>Subscription Management 2</span> <span class="toggle-icon"><img src="https://nexttech-dev.com/SPF/images/down_arrow.png"></span>  </div>
        <div class="section-content">
          <p>Characteristics details go here...</p>
        </div>
      </div>
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)"> <span>Subscription Management 3</span> <span class="toggle-icon"><img src="https://nexttech-dev.com/SPF/images/down_arrow.png"></span>  </div>
        <div class="section-content">
          <p>Characteristics details go here...</p>
        </div>
      </div>
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)"> <span>Subscription Management 4</span> <span class="toggle-icon"><img src="https://nexttech-dev.com/SPF/images/down_arrow.png"></span>  </div>
        <div class="section-content">
          <p>Characteristics details go here...</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="seller_center_subscription_plans">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Subscription Plans</h1>
        <p>Choose the plan that best fits your business needs:</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"> </div>
      <div class="col-md-4">
        <div class="subscription_plans_box">
          <h2>Basic <br>
            Seller Plan:</h2>
          <h5>Ideal for small businesses starting out </h5>
          <button>$500/month.</button>
          <p>See all features</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="subscription_plans_box next">
          <h2>Premium <br>
            Seller Plan:</h2>
          <h5>For established sellers looking to <br>
            maximize exposure and access <br>
            premium tools</h5>
          <button>$1,000/month.</button>
          <p>See all features</p>
        </div>
      </div>
      <div class="col-md-2"> </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="mt-5">Each plan includes exclusive pricing tools, priority cusomer suppot, and enhanced data analytics.</p>
      </div>
    </div>
  </div>
</div>
<div class="seller_center_ready_to_start">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Ready to Start?</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting...</p>
        <div class="signup-button">
            @if(app('general_setting')->disable_seller_plan==0)
            @foreach ($commissions->where('status', 1)->where('slug', 'commission') as $key => $commission)
                <a href="{{ route('frontend.merchant-register', $commission->slug) }}" class="right-section">Sign up Today</a>

            @endforeach
            @endif
            @if(app('general_setting')->disable_seller_plan==1)
            @foreach ($commissions->where('status', 1)->where('slug', 'commission') as $key => $commission)
            <a href="{{ route('frontend.merchant-register', $commission->slug) }}" class="right-section">Sign up Today</a>
            @endforeach
            @endif
          <div class="left-section">and take the first step towards a <br>
            more profitable business journey</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="tweleve_section" style="display:none;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>Condiciones de uso | Aviso de privacidad | Aviso de Privacidad de Datos de Salud del Consumidor | Tus opciones de privacidad de los anuncios </p>
        <p><strong>© 1996-2024 SPF.com, Inc. o sus afiliados</strong></p>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="script.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> 
<script type="text/javascript">
    $('.top-slider-seller-center').slick({
  slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    arrows: true,
    dots: false,
    speed: 300,
//    centerPadding: '150px',
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
        icon.innerHTML = '<img src="https://nexttech-dev.com/SPF/images/down_arrow.png" alt="Down Arrow">';  // Down arrow image for closed state

    } else {

        // Open section
        content.style.maxHeight = content.scrollHeight + "px";
        content.style.padding = "10px";  // Set padding back to default
        section.classList.add('open');
        icon.innerHTML = '<img src="https://nexttech-dev.com/SPF/images/minus.png" alt="Minus Sign">';  // Minus sign image for open state
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
</body>
{{-- new stop --}}
    <!-- marcent top content -->
    <section class="marcent_content section_padding bg-white pb-0" style="display:none;>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9">
                    <div class="marcent_content_iner">
                        <h5>{{ $content->subTitle }}</h5>
                        @php echo $content->Maindescription; @endphp
                        @if(app('general_setting')->disable_seller_plan==0)
                        @foreach ($commissions->where('status', 1)->where('slug', 'flat-rate') as $key => $commission)
                        <a href="{{ route('frontend.merchant-register', $commission->slug) }}"
                            class="amaz_primary_btn style3 text-nowrap mt_40">Become a Seller12341234</a>
                        <span class="mt_20">{{ $content->pricing }}</span>
                        @endforeach
                        @endif
                        @if(app('general_setting')->disable_seller_plan==1)
                       @foreach ($commissions->where('status', 1)->where('slug', 'flat-rate') as $key => $commission)
                        <a href="{{ route('frontend.merchant-register', $commission->slug) }}"
                            class="amaz_primary_btn style3 text-nowrap mt_40">Become a Seller12341234</a>
                        <span class="mt_20">{{ $content->pricing }}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- marcent top content end -->
    <!-- Benefits part -->
   
    <!-- Benefits part end -->
    <!-- work process part here -->
    <section class="work_process section_padding bg-white" style="display:none;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->howitworkTitle }}</h2>
                        @php echo $content->howitworkDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div id="timeline">
                        @foreach ($workProcessList as $key => $item)
                            <div class="timeline-item">
                                <div
                                    class="timeline-content work_process_single {{ $item->position == 1 ? 'left_float' : 'right_float' }}">
                                    <div class="work_img_div">
                                        <img src="{{ showImage($item->image) }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                                    </div>
                                    <h4 class="f_w_700 font_16">{{ $item->title }}</h4>
                                    @php echo $item->description; @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- work process part end -->
    <!-- Benefits part -->
    @if(app('general_setting')->disable_seller_plan==0)
    <section class="pricing_part section_padding bg-white" id="register" style="display:none;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->sellerRegistrationTitle }}</h2>
                        @php echo $content->sellerRegistrationDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $total_commission = $commissions->where('status', 1)->count();
                    if($total_commission == 1){
                        $column = 'col-lg-4 offset-lg-4 col-md-6 offset-md-3';
                    }elseif($total_commission == 2){
                        $column = 'col-lg-4 offset-lg-1 col-md-6';
                    }else {
                        $column = 'col-lg-4 col-md-6';
                    }
                @endphp
                @foreach ($commissions->where('status', 1)->where('slug','!=','none') as $key => $commission)
                    <div class="{{$column}}">
                        <div class="single_pricing_part @if ($commission->id == 1) product_tricker @endif">
                            @if ($commission->id == 1)
                                <span class="product_tricker_text">{{__('defaultTheme.best value')}}</span>
                            @endif
                            <div class="pricing_header">
                                <h5>{{ $commission->name }}</h5>
                                <h2>
                                    @if ($commission->id == 1)
                                        {{ $commission->rate }} %
                                    @endif
                                </h2>
                                <p>{{ $commission->description }}</p>
                            </div>
                            <a href="javascript:void(0" class="amaz_primary_btn3 mb_20  w-100 text-center justify-content-center">{{ __('defaultTheme.choose_plan') }}</a>
                            {{-- <a href="{{ route('frontend.merchant-register', $commission->slug) }}"
                                class="amaz_primary_btn3 mb_20  w-100 text-center justify-content-center">{{ __('defaultTheme.choose_plan') }}</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Benefits part end -->
    <!-- accordion part here -->
    <section class="ferquently_question_part section_padding" style="display:none;>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_tittle">
                        <h2>{{ $content->faqTitle }}</h2>
                        @php echo $content->faqDescription; @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-6">
                    <div class="ferquently_question_iner">
                        @foreach ($faqList as $key => $item)
                            <div class="single_ferquently_question">
                                <button class="accordion show-accordion" data-id='#{{ $key."id" }}'>{{ $item->title }}</button>
                                <div id="{{ $key."id" }}" class="panel">
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- accordion part end -->
    <!-- send query part here -->
    <section class="send_query section_padding" style="display:none;>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <div class="section_tittle">
                        <h2>{{ $content->queryTitle }}</h2>
                        @php echo $content->queryDescription @endphp
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <form action="#" id="contactForm" name="#" class="send_query_form">
                        <div class="row">
                            <div class="col-xl-12">
                                <input name="name" id="name" placeholder="{{ __('defaultTheme.enter_name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('defaultTheme.enter_name') }}'"
                                    class="primary_line_input style4 mb_10" type="text">
                                <span class="text-danger" id="error_name"></span>
                            </div>
                            <div class="col-xl-12">
                                <input type="email" id="email" name="email" placeholder="{{ __('defaultTheme.enter_email_address') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('defaultTheme.enter_email_address') }}'"
                                    class="primary_line_input style4 mb_10">
                                    <span class="text-danger" id="error_email"></span>
                            </div>
                            <div class="col-xl-12">
                                <select class="amaz_select2 style2 wide mb_30" name="query_type" id="query_type">
                                    <option value="" selected disable>{{ __('defaultTheme.inquery_type') }}</option>
                                    @foreach ($QueryList as $key => $item)
                                        <option  value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error_query_type"></span>
                            </div>
                            <div class="col-xl-12">
                                <textarea class="primary_line_textarea style4 mb_40" name="message" id="message" placeholder="{{ __('defaultTheme.write_messages') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = '{{ __('defaultTheme.write_messages') }}'"></textarea>
                                    <span class="text-danger" id="error_message"></span>
                            </div>
                        </div>
                        <div class="send_query_btn">
                            <button id="contactBtn" type="submit"
                                class="amaz_primary_btn style3 text-nowrap">{{ __('defaultTheme.send_message') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- send query part end -->
@endsection
@push('scripts')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#contactForm').on('submit', function(event) {
                event.preventDefault();
                $("#contactBtn").prop('disabled', true);
                $('#contactBtn').text('{{ __('common.submitting') }}');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('contact.store') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        toastr.success(
                            "{{ __('defaultTheme.message_sent_successfully') }}",
                            "{{ __('common.success') }}");
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text(
                            "{{ __('defaultTheme.send_message') }}");
                        resetErrorData();
                    },
                    error: function(response) {
                        $("#contactBtn").prop('disabled', false);
                        $('#contactBtn').text(
                            "{{ __('defaultTheme.send_message') }}");
                        showErrorData(response.responseJSON.errors)
                    }
                });
            });
            $('#pricingToggle').on('change', function() {
                this.value = this.checked ? 1 : 0;
                if (this.value == 1) {
                    $('.monthly_price_div').addClass('d-none');
                    $('.yearly_price_div').removeClass('d-none');
                }
                if (this.value == 0) {
                    $('.yearly_price_div').addClass('d-none');
                    $('.monthly_price_div').removeClass('d-none');
                }
            });
            function showErrorData(errors) {
                $('#contactForm #error_name').text(errors.name)
                $('#contactForm #error_email').text(errors.email)
                $('#contactForm #error_query_type').text(errors.query_type)
                $('#contactForm #error_message').text(errors.message)
            }
            function resetErrorData() {
                $('#contactForm')[0].reset();
                $('#contactForm #error_name').text('')
                $('#contactForm #error_email').text('')
                $('#contactForm #error_query_type').text('')
                $('#contactForm #error_message').text('')
            }

            $(document).on('click','.show-accordion',function(){
               let id = $(this).attr('data-id');
               $(id).toggleClass('change-height');
               $(this).toggleClass('acc-active');

            });



        });
    })(jQuery);
</script>
@endpush
