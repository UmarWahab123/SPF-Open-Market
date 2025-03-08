@extends('frontend.amazy.layouts.app')
@push('styles')

    <style>
 .primary_input3::placeholder {
    color: white !important; /* Placeholder color */
    font-size: 20px; /* Increase placeholder font size */
    opacity: 1; /* Ensure placeholder is fully visible */
  }
     input[type="radio"] {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px solid #00b234;
      background-color: transparent;
      position: relative;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    /* Inner circle (active state) */
    input[type="radio"]:checked::after {
      content: '';
      position: absolute;
      top: 2px;
      left: 3px;
      width: 12px;
      height: 12px;
      background-color: #00b234;
      border-radius: 50%;
    }

    /* Hover state */
    input[type="radio"]:hover {
      border-color: #00b234;
    }
   .amazy_login_form {
    max-width: 600px !important;
}
.top_logo_div_seller{
        display:flex; 
        justify-content: space-between;
    }
@media screen and (min-device-width: 300px) and (max-device-width: 767px) {
        .top_logo_div_seller{
        display:inline-block; 
        justify-content: space-between;
    }
    }
    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    

{{-- new start --}}
{{-- OTP section --}}






<div class="amazy_login_area" style="display: initial;">
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center" style="background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">   
        <div class="amazy_login_form" style="max-width: 600px;">
       
            
            <!-- Logo -->
            <a href="{{url('/')}}" class="logo mb_50 d-block d-none">
                <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
            </a>
            
            <!-- Header with Title and Logo -->
            <div class="top_logo_div_seller">
                <h3 class="m-0 mb-3" style="color: #01c701;">SPF Seller Central</h3>
                <img style="height: 39px; width: auto; margin-bottom:20px;" src="{{asset('public/frontend/amazy/img/home/logo-spf-09.png')}}">
            </div>
            
            <!-- Support Text -->
            <p class="support_text d-none">{{__('auth.See your growth and get consulting support!')}}</p>
            <div style="border: 3px solid white; padding: 30px 40px; border-radius: 20px; width:100%;">
            <!-- Form Start -->
            <form id="registerForm" method="POST" action="{{ url('/seller-detail/flat-rate') }}" class="register_form" >
            {{-- <form id="registerForm" action="{{ route('frontend.sellermerchant-register', ['id' => 'seller']) }}" method="POST" class="register_form"> --}}
                @csrf
                <div class="row">   
                    
                    <!-- Email Verification Header -->
                    <h1 style="color: #01c701;">Verify Email Address</h1>
                    <p style="color: white; margin-bottom: 20px;">
                        To Verify Your Email, We've Sent A One Time Password (OTP) To <strong>{{ session('useremail') }} - {{ session('otp') }}</strong> .
                    </p>
                    
                    <!-- OTP Input -->
                    <div class="col-lg-12 mb_20">
                        <label style="color: white; font-size: 20px; font-weight: 600;" class="primary_label2">Enter OTP</label>
                        <input 
                            style="background: transparent; border: 2px solid white; color: white; font-size: 20px; height: 35px;" 
                            {{-- type="text"  --}}
                            name="otp" 
                            id="Shop" 
                            {{-- value="{{old('name')}}"  --}}
                            placeholder="" 
                            onfocus="this.placeholder = ''" 
                            onblur="this.placeholder = ''" 
                            class="primary_input3 radius_5px"
                            required>
                            @error('otp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    
                    <!-- Verify Button -->
                    <div class="col-12">
                        @if(env('NOCAPTCHA_INVISIBLE') == "true")
                            <button 
                                type="button" 
                                style="margin-bottom:-15px;color: black;font-size: 20px;padding: 2px 0px;"
                                class="g-recaptcha amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center mb_25" 
                                data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" 
                                data-size="invisible" 
                                data-callback="onSubmit">
                                Verify
                            </button>
                        @else
                            <button 
                                type="submit" 
                                style="margin-bottom:-15px;color: black;font-size: 20px;padding: 2px 0px;"
                                class="amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center mb_25" 
                                id="submitBtn">
                                Verify
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        <!-- Resend OTP -->
            <form id="resendOtpForm" action="{{ route('frontend.resend-otpmerchant-register', ['id' => 'flat-rate']) }}" method="POST">
                 @csrf <!-- CSRF token for security -->
                <button type="button" id="resendOtpButton" class="btn w-100" style="text-align: center; color: white; cursor: pointer; background: none; border: none;margin-top:20px;">
                    Resend OTP
                </button>
            </form>

         </div>
        </div>
    </div>
</div>




{{-- new end --}}
@endsection



@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
{{-- <script>
    function onSubmit(token) {
        document.getElementById("registerForm").submit();
    }
</script> --}}
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $(document).on('click','#termCheck',function(event){

                if($("#termCheck").prop('checked') == true){
                    //do something
                    $('#submitBtn').prop('disabled', false);
                }else{
                    $('#submitBtn').prop('disabled', true);
                }
            });

            $('.select_box').niceSelect();
        });
    })(jQuery);



    $(document).ready(function () {
    $('#resendOtpButton').on('click', function () {
        // Show loading state, disable button or anything you want to do before sending the request
        $(this).prop('disabled', true).text('Sending OTP...');

        // Send the AJAX request
        $.ajax({
            url: $('#resendOtpForm').attr('action'),  // Get the action URL from the form
            type: 'POST',  // Send as POST
            data: $('#resendOtpForm').serialize(),  // Serialize the form data (CSRF token, etc.)
            success: function (response) {
                // On success, show success message
                Toastr.success(response.message);  // Assuming the server sends a message
                // You can reset the button if needed
                $('#resendOtpButton').prop('disabled', false).text('Resend OTP');
            },
            error: function (xhr, status, error) {
                // On error, show error message
                Toastr.error('Failed to resend OTP. Please try again later.');
                $('#resendOtpButton').prop('disabled', false).text('Resend OTP');
            }
        });
    });
});

</script>
@endpush
