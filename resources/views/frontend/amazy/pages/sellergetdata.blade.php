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
      left: 2px;
      width: 12px;
      height: 12px;
      background-color: #00b234;
      border-radius: 50%;
    }
      option {
        background-color: rgb(6 30 33);
        color: white; /* Ensure text is visible on the green background */
    }
     option:hover {
        background-color: #01c701;
        color: white; /* Ensure text is visible on the green background */
    }
    /* Hover state */
    input[type="radio"]:hover {
      border-color: #00b234;
    }
.amazy_login_form {
    max-width: 600px !important;
}
.form_wrapper{
    border: 3px solid white;
    padding: 30px 40px;
    border-radius: 20px;
    margin-left: 20px;
}
.step_number{
    width: 40px !important;
    height: 40px !important;
    background-color: #01c701;
    color: black;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    margin-right: 15px;
    font-size: 25px !important;
}
.verification_step {
    padding: 10px 30px !important;
}
    .step_title{
        font-size:20px !important;
    }
    button.next-btn.amazy-save-button {
    font-size: 17px;
    width: 30%;
    font-weight: 600;
}
.primary_checkbox .label_name{
    color:white !important;
}






.amazy_login_area_left_seller{
  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.amazy_login_form {
  max-width: 600px !important;
}

.login_top {
  text-align: center;
  margin-right: -30px;
}

.registered_email {
  color: white;
}

.highlighted_email {
  color: #01c701;
}

.welcome_title {
  color: #01c701;
}

.form_wrapper {
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
  margin-left: 20px;
}

.verification_step {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  border-radius: 5px;
  color: white;
}

.step_number {
  width: 25px;
  height: 30px;
  background-color: #01c701;
  color: black;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  margin-right: 15px;
}

.step_title {
  margin: 0;
  font-size: 16px;
  color: white;
}

.step_desc {
  margin: 0;
  font-size: 14px;
  color: white;
}

.verify_btn {
  width: 100%;
  text-align: center;
  margin-bottom: 25px;
}

.footer_text {
  color: white;
}

.footer_link {
  color: #01c701;
}

@media screen and (min-device-width: 300px) and (max-device-width: 767px) {
 .login_top{
    margin-right:0px;
 }
 .form_wrapper {
    padding: 5px;
    margin-left: 10px;
    margin-right: 10px;
}
.verification_step {
    padding: 10px !important;
}
.step_number {
    width: 40px !important;
    height: 30px !important;
    font-size: 20px !important;
}
.amazy-form-row {
    margin-left: 0px !important;
}
.amazy-login-divider {
    width: 100% !important;
    padding: 20px !important;
}
.amazy-login-title {
    margin: 20px !important;
}
.amazy-login-top {
    margin-right: 0px !important;
}
button.next-btn.amazy-save-button {
    font-size: 20px !important;
    width: 100% !important;
}
.amz_register_form {
    width: 100% !important;
}
.amz_top {
    text-align: center;
    margin-right: 0px  !important;
}
.amz_agreement_text, .amz_terms_text {
    padding: 10px;
}
.amz_button_container {
    margin-bottom: 20px;
}
}




/* Container for the login area */



/* Divider styling */
.amazy-login-divider {
   width: 600px;
   padding: 100px 0px;
}

/* Form styling */
.amazy-login-form {
    max-width: 600px;
}

/* Logo styling */
.amazy-logo {
    margin-bottom: 50px;
    display: none;
}

/* Header with Title */
.amazy-login-top {
    text-align: center;
    margin-right: -30px;
}

.amazy-login-title {
    margin: 0;
    margin-bottom: 3px;
    color: #01c701;
    margin: 90px 0px 20px 0px;
    font-size:28px;
}

/* Support text */
.amazy-support-text {
    display: none;
}

/* Form row styling */
.amazy-form-row {
    border: 3px solid white;
    padding: 20px;
    border-radius: 20px;
    margin-left: 20px;
}

/* Input styling */
.amazy-input {
    background: transparent;
    border: 2px solid white;
    color: white !important;
    font-size: 20px;
    height: 24px !important;
    width: 300px;
}

/* Button styling */
.amazy-button {
    width: 160px;
    background: #00b234;
    border: none;
    border-radius: 5px;
    text-align: end;
    padding: 10px;
    color: white;
}

/* Button hover effect */
.amazy-button:hover {
    background: #009924;
}










/* Form container styling */
.amazy-login-form {
  max-width: 600px;
}

/* Logo styling */
.amazy-logo {
  margin-bottom: 50px;
  display: none;
}

/* Header with Title */
.amazy-login-top {
  text-align: center;
  margin-right: -30px;
}

.amazy-login-title {
  margin: 0;
  margin-bottom: 3px;
  color: #01c701;
}

/* Support text */
.amazy-support-text {
  display: none;
}

/* Form Step Styling */
.amazy-form-step {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
  margin-bottom: 20px;
}

/* Header inside each step */
.amazy-step-header {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.amazy-step-title {
  color: white;
  margin: 0;
}

/* "Completed" badge styling */
.amazy-completed-badge {
  width: 95px;
  background: #00b234;
  border: none;
  border-radius: 5px;
  margin-left: 15px;
  text-align: center;
}

/* Paragraph for business location */
.amazy-business-location {
  color: white;
  margin: 10px 0 20px;
}

.amazy-business-location-highlight {
  color: #01C701;
}

/* Edit button styling */
.amazy-edit-button {
  border-radius: 10px;
  height: 27px;
  background: transparent;
  color: white;
  border: 2px solid #00B234;
  font-size: 16px;
  font-weight: bold;
}

/* Step 2 form styling */
.amazy-step2-form {
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
}

.amazy-step2-title {
  color: white;
  margin-bottom: 15px;
}

.amazy-radio-label {
  display: flex;
    align-items: center;
    color: white;
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: bold;
}

.amazy-radio-input {
  margin-right: 10px;
}

.amazy-radio-description {
  margin-left: 28px;
  margin-top: -10px;
  color: white;
}

.amazy-business-name-label {
  color: white;
  font-size: 14px;
  margin-bottom: 5px;
  display: block;
}

.amazy-business-name-input {
  background: transparent;
  border: 2px solid white;
  color: white;
  padding: 5px 10px;
  width: 100%;
  border-radius: 5px;
}

/* Save and Continue button */
.amazy-save-button {
  width: 160px;
  background: #00b234;
  border: none;
  border-radius: 5px;
}








.amz_divider {
  max-width: 600px;
}

.amz_logo {
  max-width: 600px;
}

.amz_top {
  text-align: center;
  margin-right: -30px;
}

.amz_header_text {
  color: #01c701;
  margin: 0 0 3rem 0;
}

.amz_register_form {
  width: 600px;
}

.amz_step {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
  margin-bottom: 20px;
}

.amz_header {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.amz_step_title {
  color: white;
  margin: 0;
}

.amz_completed {
  width: 95px;
  background: #00b234;
  border: none;
  border-radius: 5px;
  margin-left: 15px;
  text-align: center;
}

.amz_step_info {
  color: white;
  margin: 10px 0 20px;
}
.amz_step_info span{
  color:  #01C701;
}

.amz_highlighted_text {
  color: #01C701;
}

.amz_edit_button {
  border-radius: 10px;
  height: 27px;
  background: transparent;
  color: white;
  border: 2px solid #00B234;
  font-size: 16px;
  font-weight: bold;
}

.amz_info_box {
  background-color: #00ef001a;
  color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  font-family: Arial, sans-serif;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.amz_info_text {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 16px;
  color: white;
}

.amz_list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.amz_list_item {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
}

.amz_agreement_text {
  color: white;
  margin-top: 40px;
}

.amz_terms_text {
  color: white;
  margin-bottom: 29px;
  margin-top: 10px;
}

.amz_link {
  color: #00b234;
}

.amz_button_container {
  text-align: center;
}

.amz_submit_button {
  height: 33px;
  width: 160px;
  background: #00b234;
  border: none;
  border-radius: 5px;
}











.amazy-login-form {
  max-width: 600px;
}

.amazy-title {
  color: #01c701;
  margin-bottom: 15px;
}

.form-container {
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.form-label {
  color: white;
  font-weight: 600;
  font-size: 18px;
  margin-bottom: 5px;
  display: block;
}

.form-input {
  height: 30px;
    background: transparent;
    border: 2px solid white;
    color: white;
    padding: 10px;
    width: 100%;
    border-radius: 0px;
}

.form-row {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.radio-label {
  display: flex;
  align-items: center;
  color: white;
  margin-bottom: 10px;
}

.highlighted-text {
  color: #00b234;
}

.form-submit {
  text-align: center;
  margin-top: 15px;
}

.btn-next {
  height: 33px;
  font-weight: 700;
  width: 300px;
  background: #00b234;
  border: none;
  border-radius: 5px;
}












.amazy-login-form {
  max-width: 600px;
}

.section-heading {
  color: #01c701;
  margin: 0 0 1rem;
}
.form-group {
  color: white;
  font-family: Arial, sans-serif;
  border-radius: 8px;
  width: 100%;
}

.name-fields {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.name-fields label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: white;
}

.name-fields input {
  width: 100%;
  padding: 8px;
  border: 2px solid white;
  background: transparent;
  color: white;
  border-radius: 5px;
}

.instruction-text {
  margin-bottom: 20px;
  color: white;
}

.country-fields {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.country-fields select {
  width: 100%;
  padding: 8px;
  border: 2px solid white;
  background: transparent;
  color: white;
  border-radius: 5px;
}

.dob-fields {
  display: flex;
  gap: 5px;
}

.dob-fields select {
  flex: 1;
  padding: 8px;
  border: 2px solid white;
  background: transparent;
  color: white;
  border-radius: 5px;
}

.button-group {
  text-align: center;
  margin-top: 15px;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.btn {
  height: 33px;
  width: 120px;
  font-weight: 700;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-previous {
  background: #00b234;
  color: rgb(0, 0, 0);
}

.btn-next {
  background:  #00b234;
  color: #000000;
}











.divider {
  max-width: 600px;
  width: 100%;
}
.logo {
  display: block;
  margin-bottom: 50px;
  text-align: center;
}




/* Form Styling */
.amazy_login_form {
  width: 100%;
}
.form_title {
  color: #01c701;
  margin-bottom: 20px;
  text-align: center;
}
.form_step {
  border: 3px solid white;
  padding: 20px;
  border-radius: 20px;
  margin-bottom: 20px;
}
.form_row {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}
.form_group {
  flex: 1;
}
.form_label {
  display: block;
  margin-bottom: 10px;
  color: white;
  font-weight: bold;
}
.form_input, .form_select {
  width: 100%;
  padding: 8px;
  border: 2px solid white;
  background: transparent;
  color: white;
  border-radius: 5px;
}
.dob_fields {
  display: flex;
  gap: 10px;
}
.form_checkbox, .form_radio {
  display: flex;
  align-items: center;
  color: white;
  margin-bottom: 10px;
}
.form_buttons {
  display: flex;
  justify-content: center;
  gap: 10px;
}
.btn_previous, .btn_next {
  height: 36px;
  width: 120px;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.btn_previous {
  background: #00b234;
  color: white;
}
.btn_next {
  background: white;
  color: black;
}




    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    




<div class="amazy_login_area" style="display: initial;" id="step-1"> 
    <div class="amazy_login_area_left_seller">   
        <div class="amazy_login_form">
            
            <!-- Logo -->
            <a href="{{url('/')}}" class="logo mb_50 d-block d-none">
                <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
            </a>
            
            <!-- Header with Title and Logo -->
            <div class="login_top" style="margin-top: 80px;">
                <h5 class="m-0 mb-3 registered_email" style="font-size: 25px;">Registered email <span class="highlighted_email">{{ session('useremail') }}</span></h5>
                <h3 class="m-0 mb-3 welcome_title" style="font-size: 35px;">Welcome to SPF Seller Central</h3>
            </div>
            
            <!-- Support Text -->
            <p class="support_text d-none">{{__('auth.See your growth and get consulting support!')}}</p>
            
            <!-- Form Start -->
            <div id="registerForm" class="register_form">
                <div class="form_wrapper">   
                    
                    <!-- Email Verification Header -->
                    <div class="verification_step">
                        <div class="step_number">1</div>
                        <div>
                            <h4 class="step_title">Answer a few quick questions</h4>
                            <p class="step_desc">Your answers will help personalize the registration process.</p>
                        </div>
                    </div>

                    <div class="verification_step">
                        <div class="step_number">2</div>
                        <div>
                            <h4 class="step_title">Provide details and documents</h4>
                            <p class="step_desc">We use secure measures to protect your personal information.</p>
                        </div>
                    </div>


                    <div class="verification_step">
                        <div class="step_number">3</div>
                        <div>
                            <h4 class="step_title">Get verified and start selling</h4>
                            <p class="step_desc">After we verify your information, you're ready to start selling.</p>
                        </div>
                    </div>

                    <!-- Verify Button -->
                    <div class="col-12 mt-4">
                        @if(env('NOCAPTCHA_INVISIBLE') == "true")
                            <button 
                                type="button" 
                                style="color: black;font-size: 20px;padding: 2px 0px;"
                                onclick="nextStep()"
                                class="next-btn g-recaptcha verify_btn" 
                                data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" 
                                data-size="invisible" 
                                data-callback="onSubmit">
                                Verify
                            </button>
                        @else
                            <button 
                                id="next"
                                onclick="nextStep()"
                                style="color: black;font-size: 20px;padding: 2px 0px;"
                                class="next-btn amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center mb_25" 
                                id="submitBtn">
                                Get started 
                            </button>
                        @endif
                    </div>
                    
                    <!-- Resend OTP -->
                    <div class="col-12 mb_20">
                        <p class="footer_text">You are applying to sell on <a class="footer_link" href="https://spfopenmarket.com">spfopenmarket.com</a> (US). </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








<div class="amazy-login-area" style="display:none;" id="step-2">
    <div class="amazy_login_area_left_seller">
        <div class="amazy-login-divider">
            <div class="amazy-login-form">
                
                <!-- Logo -->
                <a href="{{url('/')}}" class="amazy-logo d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>
                
                <!-- Header with Title and Logo -->
                <div class="amazy-login-top">
                    <h5 class="amazy-login-title" style="">Answer A Few Questions To Get Started</h5>
                </div>
                
                <!-- Support Text -->
                <p class="amazy-support-text">{{__('auth.See your growth and get consulting support!')}}</p>
                
                <!-- Form Start -->
                <form id="registerForm" action="{{ route('frontend.sellermerchantsave-register', ['id' => 'flat-rate']) }}" class="register_form" method="post">
                    @csrf
                    <div class="amazy-form-row" style="margin-bottom: 15px;">
                        
                        <!-- Email Verification Header -->
                        <h4 style="color: white;">1. Where Is Your Business Registered?</h4>
                        <p style="color: white;">If you don't have a business, enter your county of residence.</p>

                          <?php 
                                $business = \App\Models\UsersRegisteredBusiness::where('user_id', session('user_id'))->first(); 
                            ?>
                            <div class="col-lg-12 mb_20 p-0 mt-3">
                                <input 
                                    type="text" 
                                    id="registerd_business_locations" 
                                    name="registerd_business_locations" 
                                    value="{{ $business ? $business->registerd_business_locations : '' }}"
                                    class="amazy-input primary_input3 radius_5px" >
                                    <span class="text-danger" >{{ $errors->first('registerd_business_locations') }}</span> <span class="text-danger" id="registerd_business_locations_error"></span>
                                {{-- @error('registerd_business_locations')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                        <div style="text-align: end;">
                            {{-- <button type="submit" class="amazy-button">Save and Continue</button> --}}
                            <button type="button" onclick="checkFillstep1()" class="next-btn amazy-save-button">Save and continue</button>
                        </div>
                    </div>
            </div>

            <div class="amazy-login-form">
                <div id="registerForm"class="register_form">
                    <div class="amazy-form-row">
                        <h4 style="color: white;">2. What Type Of Business Do You Have?</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="amazy_login_area" style="display:none;" id="step-3">
    <div class="amazy_login_area_left_seller">
        <div class="amazy-divider mt-5">
            <div class="amazy-login-form">
                
                <!-- Logo -->
                <a href="{{url('/')}}" class="amazy-logo d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>
                
                <!-- Header with Title and Logo -->
                <div class="amazy-login-top">
                    <h5 class="amazy-login-title">Answer a few questions to get started</h5>
                </div>
                
                <!-- Support Text -->
                <p class="amazy-support-text">{{__('auth.See your growth and get consulting support!')}}</p>
                
                <!-- Form Start -->
                <div id="registerFormStep1" class="register_form">
                    <div class="amazy-form-step">
                        <div>
                            <div class="amazy-step-header">
                                <h4 class="amazy-step-title">1. Where Is Your Business Registered?</h4>
                                <span class="amazy-completed-badge">Completed</span>
                            </div>
                            {{-- <p class="amazy-business-location">Business location: <span id="business-location-highlight" class="amazy-business-location-highlight">United States</span></p> --}}
                            <p class="amazy-business-location">Business location: <span class="amazy-business-location-highlight">United States</span></p>
                        </div>
                        <button type="button" onclick="prevStep(2)" class="prev-btn amazy-edit-button">Edit</button>
                    </div>
                </div>
            </div>

            <div class="amazy-login-form">
                
                <!-- Form Start -->
                <?php 
                    $business = \App\Models\UsersRegisteredBusiness::where('user_id', session('user_id'))->first(); 
                ?>
                {{-- <form id="registerFormStep2" action="{{ route('frontend.sellermerchantsave-register', ['id' => 'flat-rate']) }}" class="register_form"> --}}
                    {{-- @csrf --}}
                    <div class="amazy-step2-form">
                        <h4 class="amazy-step2-title">2. What Type Of Business Do You Have?</h4>
                        
                       <!-- Business Type Radio Buttons -->
                        <div style="margin-bottom: 20px;">
                            {{-- <label class="amazy-radio-label">
                                <input 
                                    type="radio" 
                                    name="business_type" 
                                    value="state_owned" 
                                    class="amazy-radio-input"
                                    {{ $business && $business->business_type === 'state_owned' ? 'checked' : '' }}>
                                State-owned business
                            </label> --}}
                            <label class="amazy-radio-label">
                                <input 
                                    type="radio" 
                                    name="business_type" 
                                    value="publicly_listed" 
                                    class="amazy-radio-input"
                                    {{ $business && $business->business_type === 'publicly_listed' ? 'checked' : '' }}>
                                Publicly-listed business
                            </label>
                            <label class="amazy-radio-label">
                                <input 
                                    type="radio" 
                                    name="business_type" 
                                    value="privately_owned" this is  
                                    class="amazy-radio-input"
                                    {{ $business && $business->business_type === 'privately_owned' ? 'checked' : '' }}>
                                Privately-owned business
                            </label>
                            <label class="amazy-radio-label" style="margin-top: -14px; margin-left: 25px;">
                                 <p style="color:white;font-size:15px;">You have selected to register as a privately-owned business, which is controlled and operated by private individuals. The business seller is registered in the context of a commercial or professional activity.</p>
                            </label>
                            <label class="amazy-radio-label">
                                <input 
                                    type="radio" 
                                    name="business_type" 
                                    value="individual" 
                                    class="amazy-radio-input"
                                    {{ $business && $business->business_type === 'individual' ? 'checked' : '' }}>
                                Individual (I don't have a registered business)
                            </label>
                            <span class="text-danger" id="business_type_error"></span> <!-- Error message for business type -->
                        </div>
                        
                        <!-- Business Name Input -->
                        <div style="margin-bottom: 20px;">
                            <label class="amazy-business-name-label">Business Name Used To Register With Your State Or Federal Government</label>
                            <input 
                                type="text" 
                                name="business_name" 
                                id="business_name" 
                                value="{{ $business ? $business->business_name : '' }}" 
                                placeholder="Business Name As It Appears On Business Registration Document" 
                                class="amazy-business-name-input">
                                <span class="text-danger" >{{ $errors->first('business_name') }}</span> <span class="text-danger" id="business_name_error"></span>
                        </div>
                        <div style="display: flex; gap: 20px;">
                          <div style="margin-bottom: 20px; flex: 1">
                              <label class="amazy-business-name-label">Name On Legal Documents</label>
                              <input
                                  type="text" 
                                  name="solo_business_name" 
                                  id="solo_business_name" 
                                  value="{{ $business ? $business->solo_business_name : '' }}" 
                                  placeholder="Business Name" 
                                  class="amazy-business-name-input">
                                <span class="text-danger" >{{ $errors->first('solo_business_name') }}</span> <span class="text-danger" id="solo_business_name_error"></span>
                          </div>
                          <div style="margin-bottom: 20px; flex: 1">
                              <label class="amazy-business-name-label">Goods And Services Type</label>
                              <input 
                                  type="text" 
                                  name="Good_services_type" 
                                  id="Good_services_type" 
                                  value="{{ $business ? $business->Good_services_type : '' }}" 
                                  placeholder="Good And Services Type" 
                                  class="amazy-business-name-input" required>
                                <span class="text-danger" >{{ $errors->first('Good_services_type') }}</span> <span class="text-danger" id="Good_services_type_error"></span>
                          </div>
                        </div>
                        <div style="display: flex; gap: 20px;">
                          <div style="margin-bottom: 20px; flex: 1">
                              <label class="amazy-business-name-label">Overall Transaction Volume Estimates</label>
                              <input
                                  type="text" 
                                  name="transaction_estimates" 
                                  id="transaction_estimates" 
                                  value="{{ $business ? $business->transaction_estimates : '' }}" 
                                  placeholder="Overall Transaction Volume Estimates" 
                                  class="amazy-business-name-input" required>
                                <span class="text-danger" >{{ $errors->first('transaction_estimates') }}</span> <span class="text-danger" id="transaction_estimates_error"></span>
                          </div>
                          <div style="margin-bottom: 20px; flex: 1">
                              <label class="amazy-business-name-label">How Many Locations</label>
                              <input 
                                  type="number" 
                                  name="How_many_locations" 
                                  id="How_many_locations" 
                                  value="{{ $business ? $business->How_many_locations : '' }}" 
                                  placeholder="Enter number of locations" 
                                  class="amazy-business-name-input">
                              <span class="text-danger">{{ $errors->first('How_many_locations') }}</span> 
                              <span class="text-danger" id="How_many_locations_error"></span>
                          </div>
                        </div>

                        {{-- <div style="margin-bottom: 20px;">
                            <label class="amazy-business-name-label">List Locations States</label>
                            <input 
                                type="text" 
                                name="List_locations_states" 
                                id="List_locations_states" 
                                value="{{ $business ? $business->List_locations_states : '' }}" 
                                placeholder="Enter States (e.g., California, Texas, New York)" 
                                class="amazy-business-name-input" required>
                              <span class="text-danger" >{{ $errors->first('List_locations_states') }}</span> <span class="text-danger" id="List_locations_states_error"></span>
                        </div> --}}
                        <div style="margin-bottom: 20px;">
                            <label class="amazy-business-name-label">List Locations States</label>
                            <div id="locations-container">
                                <!-- Dynamically generated location inputs will appear here -->
                            </div>
                            <span class="text-danger">{{ $errors->first('List_locations_states') }}</span> 
                            <span class="text-danger" id="List_locations_states_error"></span>
                            <input Type="hidden" class="allstates" id="allstates" name="List_locations_states">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label class="amazy-business-name-label">Company Description</label>
                            <textarea 
                                name="company_description" 
                                id="company_description" 
                                class="amazy-business-name-input" 
                                placeholder="Company Description" 
                                rows="4">{{ $business ? $business->company_description : '' }}</textarea>
                            <span class="text-danger">{{ $errors->first('company_description') }}</span> 
                            <span class="text-danger" id="company_description_error"></span>
                        </div>
                        
                        <!-- Submit Button -->
                        <div style="text-align: right;">
                            <button type="button" onclick="checkFillstep2()" class="next-btn amazy-save-button">Save And Continue</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="amazy_login_area" style="display:none;" id="step-4">
    <div class="amazy_login_area_left_seller d-flex align-items-center justify-content-center">
        <div class="amz_divider">
            <div class="amz_login_form">
                <!-- Logo -->
                <a href="{{url('/')}}" class="amz_logo mb_50 d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>

                <!-- Header with Title and Logo -->
                <div class="amz_top">
                    <h5 class="amz_header_text" style="margin: 90px 0px 20px 0px;font-size:28px;">Answer a few questions to get started</h5>
                </div>

                <!-- Support Text -->
                <p class="amz_support_text d-none">{{__('auth.See your growth and get consulting support!')}}</p>

                <!-- Form Start -->
                <div id="registerFormStep1" action="#" class="amz_register_form">
                    <div class="amz_step">
                        <div>
                            <div class="amz_header">
                                <h4 class="amz_step_title">1. Where Is Your Business Registered?</h4>
                                <span class="amz_completed">Completed</span> 
                            </div>
                             <p class="amazy-business-location">Business location: <span class="amazy-business-location-highlight">United States</span></p>
                        </div>
                        <button type="button" onclick="prevStep(2)" class="prev-btn amz_edit_button">Edit</button>
                    </div>
                </div>

                <div id="registerFormStep2"class="amz_register_form">
                    <div class="amz_step">
                        <div>
                            <div class="amz_header">
                                <h4 class="amz_step_title">2. What Type Of Business Do You Have?</h4>
                                <span class="amz_completed">Completed</span> 
                            </div>
                            <p class="amz_step_info">Business Type: <span class="amz_highlighted_text" id="business-type-highlight">Privately-owned business</span></p>
                            <p class="amz_step_info">Business Name Register With State Or Federal Government: <span class="amz_highlighted_text" id="business-name-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">Business Name: <span class="amz_highlighted_text" id="solo_business-name-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">Good Services Type: <span class="amz_highlighted_text" id="Good-services-type-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">Transaction Estimates: <span class="amz_highlighted_text" id="transaction-estimates-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">No Of Locations: <span class="amz_highlighted_text" id="How-many-locations-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">Lists Of Locations States: <span class="amz_highlighted_text"  id="List-locations-states-highlight">xxxxxx</span></p>
                            <p class="amz_step_info">Company Description: <span class="amz_highlighted_text" id="company-description-highlight">DESCRIPTION</span></p>
                        </div>
                        <button type="button" style="margin-top: 380px;" onclick="prevStep(3)" class="prev-btn amz_edit_button">Edit</button>
                    </div>
                </div>
            </div>

            <div class="amz_login_form">
                <!-- Form Start -->
                <div>
                    {{-- <div class="amz_info_box">
                        <p class="amz_info_text">
                            As a Privately-owned business from United States, you will need:
                        </p>
                        <ul class="amz_list">
                            <li class="amz_list_item">✅ <span>Valid government-issued ID or passport</span></li>
                            <li class="amz_list_item">✅ <span>Recent bank account or credit card statement</span></li>
                            <li class="amz_list_item">✅ <span>Chargeable credit or debit card</span></li>
                            <li class="amz_list_item">✅ <span>Valid government-issued ID or passport</span></li>
                        </ul>
                    </div> --}}
                    <div id="privately_owned_info" class="amz_info_box" style="display: none;">
                        <p class="amz_info_text">
                            <i class="fa fa-file-text" style="color:white;margin-right:10px;"></i> As a Privately-owned business from the United States, you will need:
                        </p>
                        <ul class="amz_list">
                            <li class="amz_list_item" style="color:#01C701;">✓ <span style="color:white;margin:0px 10px;"> Valid government-issued ID or passport and EIN <i class="fa fa-question-circle"></i></span></li>
                            <li class="amz_list_item" style="color:#01C701;">✓ <span style="color:white;margin:0px 10px;"> Recent bank account or credit card statement <i class="fa fa-question-circle"></i></span></li>
                            <li class="amz_list_item" style="color:#01C701;">✓ <span style="color:white;margin:0px 10px;"> Chargeable credit or debit card <i class="fa fa-question-circle"></i></span></li>
                            {{-- <li class="amz_list_item" style="color:#01C701;">✓ <span style="color:white;margin:0px 10px;"> Valid government-issued ID or passport</span></li> --}}
                        </ul>
                    </div>

                    <p class="amz_agreement_text">By clicking on 'Agree and continue', you agree to the <span class="amz_link">SPF Open Market Services Agreement</span> and SPF Open Market' Privacy Notice.</p>
                    <p class="amz_terms_text">You agree to the additional terms and conditions of Customer Service by SPF Open Market. To help you get started, we automatically enroll you for this service. 
                    You will benefit from our established customer service for your self-shipped orders SPF Open Market is available. We'll inform you of any potential fee in advance via your registered email. 
                    You can opt-out of SPF Open Market at any time.</p>
                     
                    <div class="col-12 mb_20">
                        <label class="primary_checkbox d-flex">
                            <input checked="" type="checkbox" id="termCheck" checked value="1" required>
                            <span class="checkmark mr_15"></span>
                            <span class="label_name f_w_400">
                            I confirm my business location and type are correct and I understand that this information cannot be changed later.
                            {{-- {{ __('defaultTheme.by_signing_up_you_agree_to_terms_of_service_and_privacy_policy') }} --}}
                            </span>
                        </label>
                    </div>
                    <div class="amz_button_container">
                        <button type="submit" class="amz_submit_button">Agree and continue</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- new end --}}
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("registerForm").submit();
    }
</script>

<script>
// List of U.S. states
const statesList = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 
    'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 
    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 
    'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 
    'West Virginia', 'Wisconsin', 'Wyoming'
];

const howManyLocationsInput = document.getElementById('How_many_locations');
const locationsContainer = document.getElementById('locations-container');
const allStatesInput = document.getElementById('allstates');
const List_locations_states_highlight = document.getElementById('List-locations-states-highlight');

howManyLocationsInput.addEventListener('input', function () {
    // Clear any existing location inputs
    locationsContainer.innerHTML = '';

    // Get the number of locations entered
    const numberOfLocations = parseInt(howManyLocationsInput.value);

    // Generate input fields based on the entered number, but limit to 50
    if (numberOfLocations > 0 && numberOfLocations < 51) {
        for (let i = 0; i < numberOfLocations; i++) {
            // Create a new <select> dropdown for each location
            const locationSelect = document.createElement('select');
            locationSelect.name = `List_locations_states[]`; // Use an array for the input name
            locationSelect.id = `List_locations_states_${i + 1}`;
            locationSelect.classList.add('amazy-business-name-input');
            locationSelect.style.marginBottom = '10px';
           // locationSelect.required = true;

            // Add a default placeholder option
            const defaultOption = document.createElement('option');
            defaultOption.text = `Select State ${i + 1}`;
            defaultOption.disabled = true;
            defaultOption.selected = true;
            locationSelect.appendChild(defaultOption);

            // Add all states to the dropdown
            statesList.forEach(state => {
                const option = document.createElement('option');
                option.value = state;
                option.text = state;
                locationSelect.appendChild(option);
            });

            // Add change event to update hidden input with JSON data
            locationSelect.addEventListener('change', updateAllStates);

            // Append the dropdown to the container
            locationsContainer.appendChild(locationSelect);
            locationsContainer.appendChild(document.createElement('br')); // Add line break for better spacing
        }
    }

    // Update hidden input if the number of locations changes
    updateAllStates();
});

function updateAllStates() {
    const selectedStates = [];
    const allSelects = document.querySelectorAll('#locations-container select');
    allSelects.forEach(select => {
        if (select.value && !select.disabled) {
            selectedStates.push(select.value);
        }
    });
   List_locations_states_highlight.textContent = selectedStates.join(', ');
    // Convert selected states to JSON and set it in the hidden input
    allStatesInput.value = JSON.stringify(selectedStates);
}
</script>
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

    document.addEventListener("DOMContentLoaded", function () {
    const radioButtons = document.querySelectorAll('input[name="business_type"]');
    const infoBox = document.getElementById("privately_owned_info");

    radioButtons.forEach((radio) => {
        radio.addEventListener("change", function () {
            if (this.value === "privately_owned" && this.checked) {
                infoBox.style.display = "block";
            } else {
                infoBox.style.display = "none";
            }
        });
    });
});

</script>


{{-- 
<script>
document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 1;
    const totalSteps = 4; // Total number of steps

    function showStep(step) {
        for (let i = 1; i <= totalSteps; i++) {
            const stepDiv = document.getElementById(`step-${i}`);
            if (stepDiv) {
                stepDiv.style.display = i === step ? "initial" : "none";
            }
        }
    }

    document.body.addEventListener("click", function (event) {
        if (event.target.classList.contains("next-btn")) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        }

        if (event.target.classList.contains("prev-btn")) {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }
    });

    // Initially show the first step
    showStep(currentStep);
});
</script> --}}
<script>

document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 1;
    const totalSteps = 4; // Total number of steps

    function showStep(step) {
        for (let i = 1; i <= totalSteps; i++) {
            const stepDiv = document.getElementById(`step-${i}`);
            if (stepDiv) {
                stepDiv.style.display = i === step ? "initial" : "none";
            }
        }
    }

    // Function to go to the next step
    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    }

    // Function to go to a specific previous step
    function prevStep(step) {
        if (step >= 1 && step < currentStep) {
            currentStep = step;
            showStep(currentStep);
        }
    }

    // Initially show the first step
    showStep(currentStep);

    // Expose the functions for HTML onclick
    window.nextStep = nextStep;
    window.prevStep = prevStep;
});





let dataArray = []; // Array to store the input values

function checkFillstep1() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(function (element) {
        element.textContent = '';
    });

    let isValid = true;

    // Validate fields
    const fields = [
        { id: 'registerd_business_locations', name: 'registerd_business_locations' },
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
            document.getElementById(`${field.id}_error`).textContent = `Please Fill This Field`;
            isValid = false;
        } else {
            // Update the array with the latest value
            dataArray[0] = input.value.trim(); // Storing only the latest value for simplicity
        }
    });

    if (isValid) {
        console.log("All fields are filled. Proceeding to the next step...");
        nextStep();
        // Display the updated value in the target span
        displayStoredData();
    }
}

// Function to display the stored data
function displayStoredData() {
    const targetSpans = document.querySelectorAll('.amazy-business-location-highlight');
    if (dataArray.length > 0) {
        targetSpans.forEach(span => {
            span.textContent = dataArray[0]; // Update all matching elements
        });
    }
}

let step2Data = {}; // Object to store the business type and business name

function checkFillstep2() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(function (element) {
        element.textContent = '';
    });

    let isValid = true;

    // Validate the business name field
    const businessNameInput = document.getElementById('business_name');
    if (!businessNameInput.value.trim()) {
        document.getElementById('business_name_error').textContent = 'Please Fill This Field';
        isValid = false;
    } else {
        // Store the business name
        step2Data.businessName = businessNameInput.value.trim();
    }

     // Validate the solo business name field
    const solobusinessName = document.getElementById('solo_business_name');
    if (!solobusinessName.value.trim()) {
        document.getElementById('solo_business_name_error').textContent = 'Business Name Field Required';
        isValid = false;
    } else {
        // Store the business name
        step2Data.solobusinessName = solobusinessName.value.trim();
    } 


    // Validate the Good_services_type field
    const Good_services_type_save = document.getElementById('Good_services_type');
    if (!Good_services_type_save.value.trim()) {
        document.getElementById('Good_services_type_error').textContent = 'Good And Services Type Field Required';
        isValid = false;
    } else {
        // Store the business name
        step2Data.Good_services_type = Good_services_type_save.value.trim();
    }

    // Validate the solo transaction_estimates_save  field
    const transaction_estimates_save = document.getElementById('transaction_estimates');
    if (!transaction_estimates_save.value.trim()) {
        document.getElementById('transaction_estimates_error').textContent = 'Transaction Estimates Field Required';
        isValid = false;
    } else {
        // Store the business name
        step2Data.transaction_estimates = transaction_estimates_save.value.trim();
    }

    // Validate the solo How_many_locations field
    const How_many_locations_save = document.getElementById('How_many_locations');
    if (!How_many_locations_save.value.trim()) {
        document.getElementById('How_many_locations_error').textContent = 'No Of Locations Field Required';
        isValid = false;
    } else {
        // Store the business name
        step2Data.How_many_locations = How_many_locations_save.value.trim();
    }

    // Validate the solo List_locations_states field
   // const List_locations_states_save = document.getElementById('List_locations_states');
    //if (!List_locations_states_save.value.trim()) {
      //  document.getElementById('List_locations_states_error').textContent = 'List Locations States Field Required';
       // isValid = false;
   // } else {
        // Store the business name
     //   step2Data.List_locations_states = List_locations_states_save.value.trim();
    //}
    
    // Validate the solo How_many_locations field
    const company_description_save = document.getElementById('company_description');
    if (!company_description_save.value.trim()) {
        document.getElementById('company_description_error').textContent = 'Company Description Is Required';
        isValid = false;
    } else {
        // Store the business name
        step2Data.company_description = company_description_save.value.trim();
    }


    // Validate if a business type is selected
    const businessTypeRadioButtons = document.getElementsByName('business_type');
    const selectedBusinessType = Array.from(businessTypeRadioButtons).find(radio => radio.checked);

    if (!selectedBusinessType) {
        document.getElementById('business_type_error').textContent = 'Please Select A Business Type';
        isValid = false;
    } else {
        // Store the selected business type
        step2Data.businessType = selectedBusinessType.value;
    }

    // If all validations pass, update the display and proceed
    if (isValid) {
        // Update the displayed values
        displayStep2Data();

        // Proceed to the next step
        console.log("All fields are filled. Proceeding to the next step...");
        nextStep();
    }
}

// Function to display the stored data
function displayStep2Data() {
    // Update the business type
    const businessTypeHighlight = document.getElementById('business-type-highlight');
    if (step2Data.businessType) {
        businessTypeHighlight.textContent = step2Data.businessType;
    }

    // Update the business name
    const businessNameHighlight = document.getElementById('business-name-highlight');
    if (step2Data.businessName) {
        businessNameHighlight.textContent = step2Data.businessName;
    }

    const solobusinessNameHighlight = document.getElementById('solo_business-name-highlight');
    if (step2Data.businessName) {
        solobusinessNameHighlight.textContent = step2Data.solobusinessName;
    }

    const GoodservicestypeHighlight = document.getElementById('Good-services-type-highlight');
    if (step2Data.Good_services_type) {
        GoodservicestypeHighlight.textContent = step2Data.Good_services_type;
    }

    const transaction_estimatesHighlight = document.getElementById('transaction-estimates-highlight');
    if (step2Data.transaction_estimates) {
        transaction_estimatesHighlight.textContent = step2Data.transaction_estimates;
    }

    const How_many_locationsHighlight = document.getElementById('How-many-locations-highlight');
    if (step2Data.How_many_locations) {
        How_many_locationsHighlight.textContent = step2Data.How_many_locations;
    }
    
    //const List_locations_statesHighlight = document.getElementById('List-locations-states-highlight');
    //if (step2Data.List_locations_states) {
      //  List_locations_statesHighlight.textContent = step2Data.List_locations_states;
    //}
   
    const company_descriptionHighlight = document.getElementById('company-description-highlight');
    if (step2Data.company_description) {
        company_descriptionHighlight.textContent = step2Data.company_description;
    }


    
}


</script>
@endpush
