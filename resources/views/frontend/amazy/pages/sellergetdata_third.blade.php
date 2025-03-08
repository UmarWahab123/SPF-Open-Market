@extends('frontend.amazy.layouts.app')
@push('styles')

    <style>
 .primary_input3::placeholder {
    color: white !important; /* Placeholder color */
    font-size: 20px; 
    font-weight:20px;/* Increase placeholder font size */
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

    /* Hover state */
    option {
        background-color: rgb(6 30 33);
        color: white; /* Ensure text is visible on the green background */
    }
     option:hover {
        background-color: #01c701;
        color: white; /* Ensure text is visible on the green background */
    }
    .amazy-login-form {
    max-width: 1000px !important;
}
.divider {
    max-width: 1000px !important;
    width: 100%;
}
/* The container */
.checkbox_design {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: white;
}

/* Hide the browser's default checkbox */
.checkbox_design input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eeeeee00;
    border: 1px solid white;
}

/* On mouse-over, add a grey background color */
.checkbox_design:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkbox_design input:checked ~ .checkmark {
  background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkbox_design input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkbox_design .checkmark:after {
  left: 6px;
    top: 3px;
    width: 6px;
    height: 10px;
    border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
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
    color: white;
    font-size: 20px;
    height: 24px;
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
.Progress_steps{
margin-bottom: 20px;
display: flex;
align-items:center;
justify-content: center;
 gap: 30px; 
 margin-top: 20px;
 color: white; 
 font-family: Arial, sans-serif;
}
.Progress_steps_inner{
text-align: center;
text-align: -webkit-center; 
margin-bottom: 25px;
}
.Progress_steps_inner_line {
border: 1px solid #00b234;
min-width: 60px; 
margin-bottom: 55px;
}
#save_mobile_number_btn{
    height: 33px; 
    margin-left: 488px; 
    margin-top: -35px; 
    width: 70px; 
    font-weight: 700; 
    background: #00b234; 
    border: none; 
    border-radius: 5px;
    
}
.previous_btn{
    height: 33px; 
    margin-left: 361px;
    margin-top: -49px;
    width: 120px; 
    font-weight: 700; 
    background: #00b234; 
    border: none; 
    border-radius: 5px;
}
.top_three_input_fields{
     display: flex; 
     gap: 10px; 
     margin-bottom: 20px;
}
.monthly_subscriptation{
   margin-bottom: 15px;
   width: 1000px; 
   background-color: #00ef001a; 
   color: #ffffff; 
   padding: 20px; 
   border-radius: 8px; 
   font-family: Arial, sans-serif; 
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.amazy_login_form{
     max-width: 1000px !important;
}
.step.external_css{
    border: 3px solid white; 
    padding: 20px; 
    border-radius: 20px; 
    width: 1000px; 
    margin-bottom: 20px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 767px) {
.Progress_steps {
    gap: 0px;
}
.Progress_steps_inner_line {
    min-width: 10px;
}
.Progress_steps_inner {
    width: 65px;
}
#save_mobile_number_btn{
    margin-left: 0px !important; 
    float:right;
}
.previous_btn{
    margin-left: 59px !important; 
}
.top_three_input_fields{
     display: inline-block!important; 
     width: 100%;
}
.monthly_subscriptation{
   width: 100% !important;
}
.amazy_login_form{
     max-width: 100% !important;
}
.step.external_css{
     width: 100% !important;
}
}

    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    








<div class="amazy_login_area" style="display:initial;" id="step-1">
    <div class="amazy_login_area_left_seller d-flex align-items-center justify-content-center" style="background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">   
        <div class="divider">
            <div class="amazy_login_form">
                
                <!-- Logo -->
                <a href="{{url('/')}}" class="logo mb_50 d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>
                
                <!-- Header with Title and Logo -->
                
                <!-- Support Text -->
                <p class="support_text d-none">{{__('auth.See your growth and get consulting support!')}}</p>
            </div>
<!-- Progress Steps -->
            <div class="Progress_steps">
                <!-- Step 1 -->
                <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: #01c701; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #17361f; font-weight: bold;">✔</div>
                    <span style="margin-top: 5px; display: block;">Business <br> Information</span>
                </div>
                <div class="Progress_steps_inner_line"></div>
                <!-- Step 2 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">2</div>
                    <span style="margin-top: 5px; display: block;">Seller Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 3 -->
                <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">3</div>
                    <span style="margin-top: 5px; display: block;">Billing</span>
                </div>
               <div  class="Progress_steps_inner_line"></div>
                <!-- Step 4 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">4</div>
                    <span style="margin-top: 5px; display: block;">Store</span>
                </div>
                {{-- <div  class="Progress_steps_inner_line"></div> --}}
                {{-- <!-- Step 5 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">5</div>
                    <span style="margin-top: 5px; display: block;">Verification</span>
                </div> --}}
            </div>
             <!-- End Progress Steps -->
                <div class="amazy_login_form">
                    <h3 class="m-0 mb-3" style="color: #01c701;">Primary Contact Person Information</h3>
                    <?php 
                        // Fetch the business data once
                        $user = \App\Models\User::where('id', session('user_id'))->first(); 
                    ?>
                    <!-- Form Start -->
                    <form style="width: 100%;"   action="{{ route('frontend.seller_card_info_save-register', ['id' => 'flat-rate']) }}"  class="register_form" method="POST">
                    @csrf
                    <div class="step" style="border: 3px solid white; padding: 20px; border-radius: 20px;">
                            <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            </div>

                        <div style="color: white; font-family: Arial, sans-serif; border-radius: 8px;">
                            <!-- Name Fields -->
                            <div class="top_three_input_fields">
                                <div style="flex: 1;">
                                    <label class="form-label">First Name</label>
                                    <input type="text" id="first_name" name="seller[first_name]" value="{{ $user ? $user->primary_first_name : '' }}" placeholder="First name" class="form-input">
                                    <span class="text-danger" id="first_name_error"></span>
                                </div>
                                <div style="flex: 1;">
                                    <label class="form-label">Middle Name(s)</label>
                                    <input type="text" id="middle_name" name="seller[middle_name]" value="{{ $user ? $user->primary_middle_name : '' }}" placeholder="Middle Name(s)" class="form-input">
                                    <span class="text-danger" id="middle_name_error"></span>
                                </div>
                                <div style="flex: 1;">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" id="last_name"  name="seller[last_name]" value="{{ $user ? $user->primary_last_name : '' }}" placeholder="Last Name" class="form-input">
                                    <span class="text-danger" id="last_name_error"></span>
                                </div>
                            </div>

                            <!-- Instruction -->
                            <p style="margin-bottom: 20px; color: white;">Enter Your Complete Name, As It Appears On The Passport Or ID</p>

                            <!-- Country Fields -->

                            <div style="flex: 1;">
                                <label class="form-label">Country Of Citizenship</label>
                                <select name="seller[country_of_citizenship]" id="country_of_citizenship" 
                                    style="width: 49%; padding: 8px; border: 2px solid white; background: transparent; color: white; border-radius: 5px;">
                                    <option value="" disabled {{ !$user || !$user->country_of_citizenship ? 'selected' : '' }}>Select Country</option>
                                    @foreach(\Modules\Setup\Entities\Country::all() as $country)
                                        <option value="{{ $country->name }}" {{ $user && $user->country_of_citizenship == $country->name ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>

                                 <span id="country_of_citizenship_error" class="text-danger" style="color: red;"></span> <!-- Error span -->
                            </div>
                            <div class="top_three_input_fields">

                                <div style="flex: 1;">
                                    <label class="form-label">Country Of Birth</label>	
                                    <select name="seller[country_of_birth]" id="country_of_birth" 
                                            style="width: 100%; padding: 8px; border: 2px solid white; background: transparent; color: white; border-radius: 5px;">
                                        <option disabled value="" disabled {{ !$user || !$user->country_of_birth ? 'selected' : '' }}>Select Country</option>
                                        @foreach(\Modules\Setup\Entities\Country::all() as $country)
                                            <option value="{{ $country->name }}" 
                                                    {{ old('seller.country_of_birth', @$seller->country_of_birth) == $country->name ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="country_of_birth_error" class="text-danger" style="color: red;"></span> <!-- Error span -->
                                </div>
                                @php
                                    // Extract year, month, and day from the user's date_of_birth
                                    $birthDate = $user && $user->date_of_birth ? explode('-', $user->date_of_birth) : [null, null, null];
                                    $birthYear = $birthDate[0];
                                    $birthMonth = $birthDate[1];
                                    $birthDay = $birthDate[2];
                                @endphp
                                <div style="flex: 1;">
                                    <label class="form-label">Date Of Birth</label>
                                    <div style="display: flex; gap: 5px;">
                                        <select name="seller[date_of_birth_day]" id="date_of_birth_day" style="flex: 1; padding: 8px; border: 2px solid white; background: transparent; color: white; border-radius: 5px;" required>
                                              <option value="" {{ !$birthDay ? 'selected' : '' }}>Day</option>
                                              <option value="01" {{ $birthDay == '01' ? 'selected' : '' }}>01</option>
                                              <option value="02" {{ $birthDay == '02' ? 'selected' : '' }}>02</option>
                                              <option value="03" {{ $birthDay == '03' ? 'selected' : '' }}>03</option>
                                              <option value="04" {{ $birthDay == '04' ? 'selected' : '' }}>04</option>
                                              <option value="05" {{ $birthDay == '05' ? 'selected' : '' }}>05</option>
                                              <option value="06" {{ $birthDay == '06' ? 'selected' : '' }}>06</option>
                                              <option value="07" {{ $birthDay == '07' ? 'selected' : '' }}>07</option>
                                              <option value="08" {{ $birthDay == '08' ? 'selected' : '' }}>08</option>
                                              <option value="09" {{ $birthDay == '09' ? 'selected' : '' }}>09</option>
                                              <option value="10" {{ $birthDay == '10' ? 'selected' : '' }}>10</option>
                                              <option value="11" {{ $birthDay == '11' ? 'selected' : '' }}>11</option>
                                              <option value="12" {{ $birthDay == '12' ? 'selected' : '' }}>12</option>
                                              <option value="13" {{ $birthDay == '13' ? 'selected' : '' }}>13</option>
                                              <option value="14" {{ $birthDay == '14' ? 'selected' : '' }}>14</option>
                                              <option value="15" {{ $birthDay == '15' ? 'selected' : '' }}>15</option>
                                              <option value="16" {{ $birthDay == '16' ? 'selected' : '' }}>16</option>
                                              <option value="17" {{ $birthDay == '17' ? 'selected' : '' }}>17</option>
                                              <option value="18" {{ $birthDay == '18' ? 'selected' : '' }}>18</option>
                                              <option value="19" {{ $birthDay == '19' ? 'selected' : '' }}>19</option>
                                              <option value="20" {{ $birthDay == '20' ? 'selected' : '' }}>20</option>
                                              <option value="21" {{ $birthDay == '21' ? 'selected' : '' }}>21</option>
                                              <option value="22" {{ $birthDay == '22' ? 'selected' : '' }}>22</option>
                                              <option value="23" {{ $birthDay == '23' ? 'selected' : '' }}>23</option>
                                              <option value="24" {{ $birthDay == '24' ? 'selected' : '' }}>24</option>
                                              <option value="25" {{ $birthDay == '25' ? 'selected' : '' }}>25</option>
                                              <option value="26" {{ $birthDay == '26' ? 'selected' : '' }}>26</option>
                                              <option value="27" {{ $birthDay == '27' ? 'selected' : '' }}>27</option>
                                              <option value="28" {{ $birthDay == '28' ? 'selected' : '' }}>28</option>
                                              <option value="29" {{ $birthDay == '29' ? 'selected' : '' }}>29</option>
                                              <option value="30" {{ $birthDay == '30' ? 'selected' : '' }}>30</option>
                                              <option value="31" {{ $birthDay == '31' ? 'selected' : '' }}>31</option>
                                        </select>
                                        

                                        <select name="seller[date_of_birth_month]" id="date_of_birth_month" style="flex: 1; padding: 8px; border: 2px solid white; background: transparent; color: white; border-radius: 5px;" required>
                                            <option value="" {{ !$birthMonth ? 'selected' : '' }}>Month</option>
                                            <!-- Add options for months -->
                                          <option value="1" {{ $birthMonth == 1 ? 'selected' : '' }}>January</option>
                                          <option value="2" {{ $birthMonth == 2 ? 'selected' : '' }}>February</option>
                                          <option value="3" {{ $birthMonth == 3 ? 'selected' : '' }}>March</option>
                                          <option value="4" {{ $birthMonth == 4 ? 'selected' : '' }}>April</option>
                                          <option value="5" {{ $birthMonth == 5 ? 'selected' : '' }}>May</option>
                                          <option value="6" {{ $birthMonth == 6 ? 'selected' : '' }}>June</option>
                                          <option value="7" {{ $birthMonth == 7 ? 'selected' : '' }}>July</option>
                                          <option value="8" {{ $birthMonth == 8 ? 'selected' : '' }}>August</option>
                                          <option value="9" {{ $birthMonth == 9 ? 'selected' : '' }}>September</option>
                                          <option value="10" {{ $birthMonth == 10 ? 'selected' : '' }}>October</option>
                                          <option value="11" {{ $birthMonth == 11 ? 'selected' : '' }}>November</option>
                                          <option value="12" {{ $birthMonth == 12 ? 'selected' : '' }}>December</option>
                                        </select>

                                        <select name="seller[date_of_birth_year]" id="date_of_birth_year" style="flex: 1; padding: 8px; border: 2px solid white; background: transparent; color: white; border-radius: 5px;" required>
                                            <option value="" {{ !$birthYear ? 'selected' : '' }}>Year</option>
                                            <option value="1930" {{ $birthYear == '1930' ? 'selected' : '' }}>1930</option>
                                            <option value="1931" {{ $birthYear == '1931' ? 'selected' : '' }}>1931</option>
                                            <option value="1932" {{ $birthYear == '1932' ? 'selected' : '' }}>1932</option>
                                            <option value="1933" {{ $birthYear == '1933' ? 'selected' : '' }}>1933</option>
                                            <option value="1934" {{ $birthYear == '1934' ? 'selected' : '' }}>1934</option>                                          
                                            <option value="1935" {{ $birthYear == '1935' ? 'selected' : '' }}>1935</option>
                                            <option value="1936" {{ $birthYear == '1936' ? 'selected' : '' }}>1936</option>
                                            <option value="1937" {{ $birthYear == '1937' ? 'selected' : '' }}>1937</option>
                                            <option value="1938" {{ $birthYear == '1938' ? 'selected' : '' }}>1938</option>
                                            <option value="1939" {{ $birthYear == '1939' ? 'selected' : '' }}>1939</option>
                                            <option value="1940" {{ $birthYear == '1940' ? 'selected' : '' }}>1940</option>
                                            <option value="1941" {{ $birthYear == '1941' ? 'selected' : '' }}>1941</option>
                                            <option value="1942" {{ $birthYear == '1942' ? 'selected' : '' }}>1942</option>
                                            <option value="1943" {{ $birthYear == '1943' ? 'selected' : '' }}>1943</option>
                                            <option value="1944" {{ $birthYear == '1944' ? 'selected' : '' }}>1944</option>
                                            <option value="1945" {{ $birthYear == '1945' ? 'selected' : '' }}>1945</option>
                                            <option value="1946" {{ $birthYear == '1946' ? 'selected' : '' }}>1946</option>
                                            <option value="1947" {{ $birthYear == '1947' ? 'selected' : '' }}>1947</option>
                                            <option value="1948" {{ $birthYear == '1948' ? 'selected' : '' }}>1948</option>
                                            <option value="1949" {{ $birthYear == '1949' ? 'selected' : '' }}>1949</option>
                                            <option value="1950" {{ $birthYear == '1950' ? 'selected' : '' }}>1950</option>
                                            <option value="1951" {{ $birthYear == '1951' ? 'selected' : '' }}>1951</option>
                                            <option value="1952" {{ $birthYear == '1952' ? 'selected' : '' }}>1952</option>
                                            <option value="1953" {{ $birthYear == '1953' ? 'selected' : '' }}>1953</option>
                                            <option value="1954" {{ $birthYear == '1954' ? 'selected' : '' }}>1954</option>
                                            <option value="1955" {{ $birthYear == '1955' ? 'selected' : '' }}>1955</option>
                                            <option value="1956" {{ $birthYear == '1956' ? 'selected' : '' }}>1956</option>
                                            <option value="1957" {{ $birthYear == '1957' ? 'selected' : '' }}>1957</option>
                                            <option value="1958" {{ $birthYear == '1958' ? 'selected' : '' }}>1958</option>
                                            <option value="1959" {{ $birthYear == '1959' ? 'selected' : '' }}>1959</option>
                                            <option value="1960" {{ $birthYear == '1960' ? 'selected' : '' }}>1960</option>
                                            <option value="1961" {{ $birthYear == '1961' ? 'selected' : '' }}>1961</option>
                                            <option value="1962" {{ $birthYear == '1962' ? 'selected' : '' }}>1962</option>
                                            <option value="1963" {{ $birthYear == '1963' ? 'selected' : '' }}>1963</option>
                                            <option value="1964" {{ $birthYear == '1964' ? 'selected' : '' }}>1964</option>
                                            <option value="1965" {{ $birthYear == '1965' ? 'selected' : '' }}>1965</option>
                                            <option value="1966" {{ $birthYear == '1966' ? 'selected' : '' }}>1966</option>
                                            <option value="1967" {{ $birthYear == '1967' ? 'selected' : '' }}>1967</option>
                                            <option value="1968" {{ $birthYear == '1968' ? 'selected' : '' }}>1968</option>
                                            <option value="1969" {{ $birthYear == '1969' ? 'selected' : '' }}>1969</option>
                                            <option value="1970" {{ $birthYear == '1970' ? 'selected' : '' }}>1970</option>
                                            <option value="1971" {{ $birthYear == '1971' ? 'selected' : '' }}>1971</option>
                                            <option value="1972" {{ $birthYear == '1972' ? 'selected' : '' }}>1972</option>
                                            <option value="1973" {{ $birthYear == '1973' ? 'selected' : '' }}>1973</option>
                                            <option value="1974" {{ $birthYear == '1974' ? 'selected' : '' }}>1974</option>
                                            <option value="1975" {{ $birthYear == '1975' ? 'selected' : '' }}>1975</option>
                                            <option value="1976" {{ $birthYear == '1976' ? 'selected' : '' }}>1976</option>
                                            <option value="1977" {{ $birthYear == '1977' ? 'selected' : '' }}>1977</option>
                                            <option value="1978" {{ $birthYear == '1978' ? 'selected' : '' }}>1978</option>
                                            <option value="1979" {{ $birthYear == '1979' ? 'selected' : '' }}>1979</option>
                                            <option value="1980" {{ $birthYear == '1980' ? 'selected' : '' }}>1980</option>
                                            <option value="1981" {{ $birthYear == '1981' ? 'selected' : '' }}>1981</option>
                                            <option value="1982" {{ $birthYear == '1982' ? 'selected' : '' }}>1982</option>
                                            <option value="1983" {{ $birthYear == '1983' ? 'selected' : '' }}>1983</option>
                                            <option value="1984" {{ $birthYear == '1984' ? 'selected' : '' }}>1984</option>
                                            <option value="1985" {{ $birthYear == '1985' ? 'selected' : '' }}>1985</option>
                                            <option value="1986" {{ $birthYear == '1986' ? 'selected' : '' }}>1986</option>
                                            <option value="1987" {{ $birthYear == '1987' ? 'selected' : '' }}>1987</option>
                                            <option value="1988" {{ $birthYear == '1988' ? 'selected' : '' }}>1988</option>
                                            <option value="1989" {{ $birthYear == '1989' ? 'selected' : '' }}>1989</option>
                                            <option value="1990" {{ $birthYear == '1990' ? 'selected' : '' }}>1990</option>
                                            <option value="1991" {{ $birthYear == '1991' ? 'selected' : '' }}>1991</option>
                                            <option value="1992" {{ $birthYear == '1992' ? 'selected' : '' }}>1992</option>
                                            <option value="1993" {{ $birthYear == '1993' ? 'selected' : '' }}>1993</option>
                                            <option value="1994" {{ $birthYear == '1994' ? 'selected' : '' }}>1994</option>
                                            <option value="1995" {{ $birthYear == '1935' ? 'selected' : '' }}>1995</option>
                                            <option value="1996" {{ $birthYear == '1996' ? 'selected' : '' }}>1996</option>
                                            <option value="1997" {{ $birthYear == '1997' ? 'selected' : '' }}>1997</option>
                                            <option value="1998" {{ $birthYear == '1998' ? 'selected' : '' }}>1998</option>
                                            <option value="1999" {{ $birthYear == '1999' ? 'selected' : '' }}>1999</option>
                                            <option value="2000" {{ $birthYear == '2000' ? 'selected' : '' }}>2000</option>
                                            <option value="2001" {{ $birthYear == '2001' ? 'selected' : '' }}>2001</option>
                                            <option value="2002" {{ $birthYear == '2002' ? 'selected' : '' }}>2002</option>
                                            <option value="2003" {{ $birthYear == '2003' ? 'selected' : '' }}>2003</option>
                                            <option value="2004" {{ $birthYear == '2004' ? 'selected' : '' }}>2004</option>
                                            <option value="2005" {{ $birthYear == '2005' ? 'selected' : '' }}>2005</option>
                                            <option value="2006" {{ $birthYear == '2006' ? 'selected' : '' }}>2006</option>
                                            <option value="2007" {{ $birthYear == '2007' ? 'selected' : '' }}>2007</option>
                                            <option value="2008" {{ $birthYear == '2008' ? 'selected' : '' }}>2008</option>
                                            <option value="2009" {{ $birthYear == '2009' ? 'selected' : '' }}>2009</option>
                                            <option value="2010" {{ $birthYear == '2010' ? 'selected' : '' }}>2010</option>
                                            <option value="2011" {{ $birthYear == '2011' ? 'selected' : '' }}>2011</option>
                                            <option value="2012" {{ $birthYear == '2012' ? 'selected' : '' }}>2012</option>
                                            <option value="2013" {{ $birthYear == '2013' ? 'selected' : '' }}>2013</option>
                                            <option value="2014" {{ $birthYear == '2014' ? 'selected' : '' }}>2014</option>
                                            <option value="2015" {{ $birthYear == '2015' ? 'selected' : '' }}>2015</option>
                                            <option value="2016" {{ $birthYear == '2016' ? 'selected' : '' }}>2016</option>
                                            <option value="2017" {{ $birthYear == '2017' ? 'selected' : '' }}>2017</option>
                                            <option value="2018" {{ $birthYear == '2018' ? 'selected' : '' }}>2018</option>
                                            <option value="2019" {{ $birthYear == '2019' ? 'selected' : '' }}>2019</option>
                                            <option value="2020" {{ $birthYear == '2020' ? 'selected' : '' }}>2020</option>
                                            <option value="2021" {{ $birthYear == '2021' ? 'selected' : '' }}>2021</option>
                                            <option value="2022" {{ $birthYear == '2022' ? 'selected' : '' }}>2022</option>
                                            <option value="2023" {{ $birthYear == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value="2024" {{ $birthYear == '2024' ? 'selected' : '' }}>2024</option>
                                        </select>

                                    </div>
                                    <span id="date_of_birth_day_error" class="text-danger" style="color: red;"></span>
                                </div>
                            </div>
                        </div>




                        

                        
                                    <label class="form-label">
                                        Registered Business Address
                                    </label>
                          <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                 <!-- First Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        value="United States"
                                        id="Registered_business_address"
                                        name="seller[Registered_business_address]" 
                                        placeholder="United States"
                                       class="form-input">
                                        <span class="text-danger" id="Registered_business_address_error"></span>
                                </div>

                                <!-- Second Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        name="seller[zip_postal_code]" 
                                        id="zip_postal_code" 
                                        value="{{ $user ? $user->zip_postal_code : '' }}" 
                                        placeholder=" ZIP/Postal Code"
                                        class="form-input"
                                        name="alternate_business_name" onchange="fetchAddressData()">
                                        <span class="text-danger" id="zip_postal_code_error"></span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                 <!-- First Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        name="seller[address_line1]"
                                        id="address_line1" 
                                        placeholder="Address Line 1" 
                                        value="{{ $user ? $user->address_line1 : '' }}" 
                                        class="form-input"
                                        name="business_name">
                                        <span class="text-danger" id="address_line1_error"></span>
                                </div>

                                <!-- Second Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        name="seller[appartment_building_suite_other]"
                                        id="appartment_building_suite_other"
                                        placeholder="Apartment/Building/Suite/Other"
                                        value="{{ $user ? $user->appartment_building_suite_other : '' }}" 
                                        class="form-input"
                                        name="alternate_business_name">
                                        <span class="text-danger" id="appartment_building_suite_other_error"></span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                 <!-- First Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        placeholder="City/Town"
                                        name="seller[city_town]"
                                        value="{{ $user ? $user->city_town : '' }}" 
                                        id="city_town"
                                        class="form-input"
                                        name="business_name">
                                        <span class="text-danger" id="city_town_error"></span>
                                </div>

                                <!-- Second Label and Input -->
                                <div style="flex: 1;">
                                    <input
                                        type="text"
                                        placeholder="State / Region"
                                        name="seller[state_region]"
                                        value="{{ $user ? $user->state_region : '' }}" 
                                        id="state_region" 
                                        class="form-input" required>
                                        <span class="text-danger" id="state_region_error"></span>
                                </div>
                            </div>
                          
                            <?php 
                               $no = \App\Models\RegisteredBusinessPhoneNumbers::where('user_registered_business_id', session('business_id'))->latest('created_at')->first();
                            ?>
                            <p class="highlighted-text">Phone Number For Verification</p>
                              
                                <span id="formError" style="color: red;"></span>
                                <label class="radio-label">
                                    {{-- <input type="radio" name="mobilenobydatabase" value="{{ $no->phone_number  }}" id="mobileno_radio" required checked> --}}
                                    <input type="radio" name="mobilenobydatabase" value="{{ $no->phone_number ?? '' }}" id="mobileno_radio" required {{ isset($no) ? 'checked' : '' }}>

                                    {{-- <div id="saved_mobile_number" style="color: white; padding: 10px;"> {{ $no->phone_number }}</div> --}}
                                    <div id="saved_mobile_number" style="color: white; padding: 10px;">
                                        {{ $no->phone_number ?? 'No phone number available' }}
                                    </div>
                                </label>
                          
                            

                            {{-- <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;">
                                @if($no)
                                    <input type="radio" value="privately_owned" style="margin-right: 10px;">
                                    {{ $no->phone_number }}
                                @endif
                            </label> --}}
                            

                            <p style="color: #00b234; cursor: pointer;" id="addMobileNumberText">+ Add A New Mobile Number</p>

                            <div class="add_mobile_no" style="display: none;">
                            <div style="flex: 1;">
                                <input
                                    type="text"
                                    placeholder="New Mobile Number"
                                    id="mobile_number" 
                                    style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 50%; border-radius: 5px;">
                                <span class="text-danger" id="mobile_number_error"></span>
                            </div>
                            <button type="button" id="save_mobile_number_btn">Save
                            </button>
                        </div>



                    </div>

                    <div class="step" style="margin-top:15px; align-items: center; border: 3px solid white; padding: 20px; border-radius: 20px; margin-bottom: 20px;">
                        {{-- <div>
                            <h4 style="color:#00b234"> Confirm If Primary Contact Person<h4>
                           
                            <label class="checkbox_design"> Is A Beneficial Owner Of The Business 
                            <input type="checkbox" value="beneficial_owner_check"  {{ $user ? $user->beneficial_owner_check  : '' }}  name="seller[beneficial_owner_check]">
                            <span class="checkmark"></span>
                            </label>
                            <label class="checkbox_design">  Is A Legal Representative Of The Business
                             <input type="checkbox" value="legal_representative_check" {{ $user ? $user->legal_representative_check  : '' }}  name="seller[legal_representative_check]">
                            <span class="checkmark"></span>
                            </label>
                        </div> --}}
                        <div>
                            <h4 style="color:#00b234">Confirm If Primary Contact Person</h4>
                            
                            <label class="checkbox_design">
                                Is A Beneficial Owner Of The Business
                                <input type="checkbox" value="1" 
                                    name="seller[beneficial_owner_check]"
                                    {{ $user && $user->beneficial_owner_check == 1 ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                            
                            <label class="checkbox_design">
                                Is A Legal Representative Of The Business
                                <input type="checkbox" value="1" 
                                    name="seller[legal_representative_check]"
                                    {{ $user && $user->legal_representative_check == 1 ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <span class="text-danger" id="beneficial_owner_error"></span>
                    </div>


                    <div class="step" style="margin-top:15px; align-items: center; border: 3px solid white; padding: 20px; border-radius: 20px; margin-bottom: 20px;">
                        <div>
                            {{-- <h4 style="color:#00b234"> Primary contact person is the only beneficial owner of the business</h4>
                            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; color: white;">
                                <label style="display: flex; align-items: center; color: white;">
                                    <input type="radio" name="seller[primary_contact_person_check]" value="1" style="margin-right: 10px;">
                                    Yes
                                </label>
                                <label style="display: flex; align-items: center; color: white;">
                                    <input type="radio" name="seller[primary_contact_person_check]" value="0" style="margin-right: 10px;">
                                    No
                                </label> --}}
                                <h4 style="color:#00b234">Primary Contact Person Is The Only Beneficial Owner Of The Business</h4>
                                  <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; color: white;">
                                      <label style="display: flex; align-items: center; color: white;">
                                          <input type="radio" name="seller[primary_contact_person_check]" value="1" style="margin-right: 10px;" onclick="toggleOwnerInput()">
                                          Yes
                                      </label>
                                    <label style="display: flex; align-items: center; color: white;">
                                        <input type="radio" name="seller[primary_contact_person_check]" value="0" style="margin-right: 10px;" onclick="toggleOwnerInput()">
                                        No
                                    </label>
                                     <input type="hidden" id="allvalues" name="seller[allvalues]">
                            </div>
                        </div>
                      <label class="form-label" style="display:none;" id="owner_percentage_label">
                          How Many Owners And Percentage Of Ownership
                          <div id="owner_percentage_container" style="width: 60%; display: flex; flex-direction: column;">
                              <!-- The initial input field with + icon -->
                              <div class="owner-percentage-group" style="display: flex; align-items: center; margin-bottom: 10px; color: #00b543;">
                                  <input
                                  style="width: 87%; margin-right: 10px;"
                                      type="text"
                                      placeholder="Owners Name"
                                      name="OwnersName[]"
                                      id="OwnersName_1"
                                      class="form-input">
                                  <input
                                  style="width: 87%;"
                                      type="number"
                                      placeholder="Percentage Of Ownership"
                                      name="percentage[]"
                                      id="percentage_1"
                                      class="form-input">
                                  <span class="text-danger" id="percentage_error"></span>
                                  <!-- + icon to add more fields -->
                                  <span style="font-size: 20px; cursor: pointer; margin-left: 10px;" class="add-icon">&#43;</span>
                              </div>
                          </div>
                      </label>
                        <span class="text-danger" id="input_empty_error"></span>
                        <span class="text-danger" id="primary_contact_error"></span>

                    </div>


                    <div class="step" style="margin-top:15px; align-items: center; border: 3px solid white; padding: 20px; border-radius: 20px; margin-bottom: 20px;">
                       <div>
                            {{-- <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;">
                                <input type="checkbox" name="business_type" value="privately_owned" style="margin-right: 10px;">
                                I confirm I am acting on my own behalf or on behalf of a registered business,
                                and I commit to updating the beneficial ownership information whenever a change has been made.
                            </label> --}}

                            <label class="checkbox_design">I Confirm I Am Acting On My Own Behalf Or On Behalf 
                            Of A Registered Business, And I Commit To Updating The Beneficial Ownership Information Whenever A Change Has Been Made.
                            {{-- <input type="checkbox" value="confirm" name="confirm" > --}}
                            <input type="checkbox" value="confirm" name="confirm" onchange="checkFillstep1()" required>
                            <span class="checkmark"></span>
                        </div>
                        <span class="text-danger" id="business_type_error"></span>
                    </div>
                    <div style="text-align: center; margin-top: 15px; display: flex; justify-content: center; gap: 10px; margin-left: 110px;">
                        <button type="submit" class="next-btn"  style="height: 33px; width: 120px; font-weight: 700; background: white; border: none; border-radius: 5px;">Next</button>
                    </div>
                </form>
                </div>
                 <button  class="previous_btn"
                    type="button" 
                    onclick="location.href='{{ route('frontend.previewsave-register', ['id' => 'flat-rate']) }}'">
                    Previous
                </button>
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
async function fetchAddressData() {
    const zipCode = document.getElementById('zip_postal_code').value;
    const apiKey = 'AIzaSyAUGjdw38Nxt7xbysl0TzoM9kHtj04AJE8'; // Replace with your actual API key
    const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${zipCode},US&key=${apiKey}`;

    console.log("Fetching data for URL:", url);

    try {
        const response = await fetch(url);
        const data = await response.json();
        console.log(data);
        console.log("API Response:", data);

        if (data.status !== "OK") {
          return;
        }

        const addressComponents = data.results[0]?.address_components || [];

        // Extract city, state, and other components
        const city = addressComponents.find(c => c.types.includes("locality"))?.long_name || '';
        const state = addressComponents.find(c => c.types.includes("administrative_area_level_1"))?.long_name || '';
        const formattedAddress = data.results[0]?.formatted_address || '';

        // Populate the corresponding fields
        //document.getElementById('address_line1').value = formattedAddress; // Full formatted address
        document.getElementById('state_region').value = state;           // State/Region
        document.getElementById('city_town').value = city;              // City/Town
       // document.getElementById('appartment_building_suite_other').value = ""; // Clear apartment/building field
    } catch (error) {
        console.error("Error fetching data:", error);
        alert("Error fetching address data: " + error.message);
    }
}


</script>
{{-- <script>
    const cardNumberInput = document.getElementById('card_number');
    const errorMessage = document.getElementById('error-message');

    cardNumberInput.addEventListener('keydown', function(event) {
        // Check if the entered character is a digit or space
        const regex = /^[0-9\s]*$/;
        const newValue = cardNumberInput.value + event.key;

        // Allow backspace and spaces, but prevent other non-numeric characters
        if (!regex.test(newValue) && event.key !== 'Backspace') {
            event.preventDefault(); // Prevent invalid input
            errorMessage.style.display = 'block'; // Show error message
        } else {
            errorMessage.style.display = 'none'; // Hide error message
        }
    });
</script> --}}
{{-- 
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
</script> --}}

{{-- <script>
document.getElementById('address_save_button').addEventListener('click', function() {
    // Get values from input fields
    const newaddedaddressLine1 = document.getElementById('newaddedaddress_line1').value;
    const newaddedbuilder = document.getElementById('newaddedbuilder').value;
    const newaddedcity = document.getElementById('newaddedcity').value;
    const newaddedstate = document.getElementById('newaddedstate').value;
    const newaddedzipcode = document.getElementById('newaddedzipcode').value;
    const newaddedcountry = document.getElementById('newaddedcountry').value;

     const addressValue = `${newaddedaddressLine1}, ${newaddedbuilder}, ${newaddedcity}, ${newaddedstate}, ${newaddedzipcode}, ${newaddedcountry}`;

    // Update the displayed data in the appropriate span elements
    document.getElementById('newadded-address_line_1').innerText = newaddedaddressLine1;
    document.getElementById('newadded-apartment_building').innerText = newaddedbuilder;
    document.getElementById('newadded-city_town').innerText = newaddedcity;
    document.getElementById('newadded-state_region').innerText = newaddedstate;
    document.getElementById('newadded-zip_code').innerText = newaddedzipcode;
    document.getElementById('newadded-country_name').innerText = newaddedcountry;

    document.getElementById('newadded-billing-address').value = addressValue;
    document.getElementById('display_data').style.display = 'block';
});

</script> --}}
{{-- <script>
    // New function to toggle the visibility of the specific saved address section
    function toggleNewAddress() {
        var addressForm = document.getElementById('new_saved_address'); // Changed ID here
        // Toggle the display style between none (hidden) and block (shown)
        if (addressForm.style.display === 'none') {
            addressForm.style.display = 'block';
        } else {
            addressForm.style.display = 'none';
        }
    }
</script>

<script>
    // Function to toggle the visibility of the add_new_address div
    function toggleAddressForm() {
        var addressForm = document.getElementById('add_new_address');
        // Toggle the display style between none and block
        if (addressForm.style.display === 'none') {
            addressForm.style.display = 'block';
        } else {
            addressForm.style.display = 'none';
        }
    }
</script> --}}
<script>
let count = 1; // Counter to create unique IDs for each new input field

// Event listener for the container to handle add and remove actions for input fields
document.getElementById('owner_percentage_container').addEventListener('click', function(event) {
    // If the clicked target is an add icon
    if (event.target && event.target.classList.contains('add-icon')) {
        addInputField();
    }
    // If the clicked target is a remove icon
    if (event.target && event.target.classList.contains('remove-icon')) {
        removeInputField(event.target);
    }
});

// Function to add a new input field group
function addInputField() {
    const container = document.getElementById('owner_percentage_container');

    // Validate that all existing input fields are filled
    const currentInputs = container.querySelectorAll('input.form-input');
     const currentInputsError = document.getElementById('input_empty_error');
     
    for (let input of currentInputs) {
        if (input.value.trim() === '') {
            currentInputsError.innerText = 'Please fill all existing input fields before adding a new one.';
            input.focus(); // Focus on the first empty input field
            return;
        }else{
          currentInputsError.innerText = '';
        }

    }

    function check_inputfields(){
        const currentallInputs = container.querySelectorAll('input.form-input');
        for (let input of currentInputs) {
          if (input.value.trim() === '') {
              currentallInputs.innerText = 'Please fill all existing input fields.';
              return;
          }
       }
    }

    
    // Check if there are already 10 input groups
    const currentInputGroups = container.querySelectorAll('.owner-percentage-group');
    if (currentInputGroups.length >= 10) {
        return;
    }

    count++; // Increment the counter to give each new field a unique ID

    // Create a new div to hold the input and icons
    const newGroup = document.createElement('div');
    newGroup.classList.add('owner-percentage-group');
    newGroup.style.display = 'flex';
    newGroup.style.width = '103%';
    newGroup.style.alignItems = 'center';
    newGroup.style.marginBottom = '10px';

    // Create the new input field
    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.style.marginRight = '10px';
    newInput.placeholder = 'Owners Name';
    newInput.name = 'OwnersName[]';
    newInput.id = `OwnersName${count}`;
    newInput.classList.add('form-input');

     // Create the second new input field
    const secondnewInput = document.createElement('input');
    secondnewInput.type = 'number';
    secondnewInput.placeholder = 'Percentage Of Ownership'; 
    secondnewInput.name = 'percentage[]';
    secondnewInput.id = `percentage_${count}`;
    secondnewInput.classList.add('form-input');

    // Create the add icon (+)
    const addIcon = document.createElement('span');
    addIcon.innerHTML = '&#43;';
    addIcon.style.fontSize = '20px';
    addIcon.style.cursor = 'pointer';
    addIcon.style.marginLeft = '10px';
    addIcon.style.color = '#00b543';
    addIcon.classList.add('add-icon');

    // Create the remove icon (-)
    const removeIcon = document.createElement('span');
    removeIcon.innerHTML = '&#45;';
    removeIcon.style.fontSize = '20px';
    removeIcon.style.cursor = 'pointer';
    removeIcon.style.marginLeft = '10px';
    removeIcon.style.color = '#e52121';
    removeIcon.classList.add('remove-icon');

    // Append the input, remove icon, and add icon to the new group
    newGroup.appendChild(newInput);
    newGroup.appendChild(secondnewInput);
    newGroup.appendChild(addIcon);
    newGroup.appendChild(removeIcon);

    // Append the new input group to the container
    container.appendChild(newGroup);
}

// Function to remove an input field group
function removeInputField(removeButton) {
    const parentDiv = removeButton.closest('.owner-percentage-group');
    if (parentDiv) {
        parentDiv.remove();
    }
}


// Function to collect all owner data with index numbers
function collectOwnerData() {
    const container = document.getElementById('owner_percentage_container');
    const ownerGroups = container.querySelectorAll('.owner-percentage-group');
    const allValues = [];

    // Iterate through each owner group
    ownerGroups.forEach((group, index) => {
        const ownerName = group.querySelector('input[name="OwnersName[]"]').value.trim();
        const percentage = group.querySelector('input[name="percentage[]"]').value.trim();
        
        // Only add to array if both fields have values
        if (ownerName && percentage) {
            allValues.push({
                index: index + 1,  // Adding index starting from 1
                ownerName: ownerName,
                percentage: percentage
            });
        }
    });

    // Store in hidden input
    const hiddenInput = document.getElementById('allvalues');
    hiddenInput.value = JSON.stringify(allValues);

    // Log to console for verification
    console.log('Collected Owner Data:', allValues);

    return allValues;
}

</script>



{{-- <script>
function saveAndDisplaySpecificData() {
    // Collect data from input fields
    const data = {
        registeredBusinessAddress: document.getElementById('Registered_business_address').value,
        zipPostalCode: document.getElementById('zip_postal_code').value,
        addressLine1: document.getElementById('address_line1').value,
        apartmentBuildingSuite: document.getElementById('appartment_building_suite_other').value,
        cityTown: document.getElementById('city_town').value,
        stateRegion: document.getElementById('state_region').value
    };

    const allValues = [
        data.addressLine1,
        data.apartmentBuildingSuite,
        data.cityTown,
        data.stateRegion,
        data.zipPostalCode,
        data.registeredBusinessAddress
    ];

   const addressString = allValues.join(', ');
    const radioButton = document.getElementById('billing-address');
    radioButton.value = addressString;

    // Display specific data in specific divs by their IDs
    document.getElementById('display-registered-address').textContent = data.registeredBusinessAddress;
    document.getElementById('display-zip_code').textContent = data.zipPostalCode;
    document.getElementById('display-address_line1').textContent = data.addressLine1;
    document.getElementById('display-appartment_building').textContent = data.apartmentBuildingSuite;
    document.getElementById('display-city_town').textContent = data.cityTown;
    document.getElementById('display-state_region').textContent = data.stateRegion;
}

</script> --}}
<script>

function checkFillstep1() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(function (element) {
        element.textContent = '';
    });
    const checkbox = document.getElementById('Confirm');


    let isValid = true;

    // Validate text fields
    const fields = [
        { id: 'first_name', name: "seller[first_name]" },
        { id: "last_name", name: "seller[last_name]" },
        { id: "state_region", name: "seller[state_region]" },
        { id: "city_town", name: "seller[city_town]" },
        { id: "appartment_building_suite_other", name: "seller[appartment_building_suite_other]" },
        { id: "address_line1", name: "seller[address_line1]" },
        { id: "zip_postal_code", name: "seller[zip_postal_code]" },
        { id: "Registered_business_address", name: "seller[Registered_business_address]" },
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
            document.getElementById(`${field.id}_error`).textContent = `Please fill this field`;
            isValid = false;
        }
    });

  
   

    // Validate checkboxes
    const beneficialOwnerCheckbox = document.querySelector('input[name="seller[beneficial_owner_check]"]:checked');
    const legalRepresentativeCheckbox = document.querySelector('input[name="seller[legal_representative_check]"]:checked');
    
    if (!beneficialOwnerCheckbox && !legalRepresentativeCheckbox) {
        const errorElement = document.getElementById('beneficial_owner_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = 'Please select at least one option.';
        }
        isValid = false;
    }

    // Validate radio buttons
    const primaryContactRadio = document.querySelector('input[name="seller[primary_contact_person_check]"]:checked');
    if (!primaryContactRadio) {
        const errorElement = document.getElementById('primary_contact_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = 'Please select an option.';
        }
        isValid = false;
    }

    // Validate checkbox for confirming beneficial ownership
    const businessTypeCheckbox = document.querySelector('input[name="business_type"]:checked');
    if (!businessTypeCheckbox) {
        const errorElement = document.getElementById('business_type_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = '';
        }
    }

     


        // Validate Country of citizenship
      const countryField = document.getElementById('country_of_citizenship'); // Get the dropdown
      const countryError = document.getElementById('country_of_citizenship_error'); // Get the error span
      if (!countryField.value) { // Check if a country is selected
            countryError.textContent = 'Please select your country of citizenship.';
            isValid = false;
        }

          // Validate Country of birth
      const birthField = document.getElementById('country_of_birth'); // Get the dropdown
      const birthError = document.getElementById('country_of_birth_error'); // Get the error span
      if (!birthField.value) { // Check if a country is selected
            birthError.textContent = 'Please select your country of birth';
            isValid = false;
        }

         // Validate select fields
     const selectDay = document.getElementById('date_of_birth_day');
      const selectMonth = document.getElementById('date_of_birth_month');
      const selectYear = document.getElementById('date_of_birth_year');
      const selectError = document.getElementById('date_of_birth_day_error');

        // Validate the dropdown fields
        const day = parseInt(selectDay.value, 10);
        const month = parseInt(selectMonth.value, 10);

        if (!day || !month || !selectYear.value) {
            selectError.textContent = 'Please select day, month, and year.';
            isValid = false;
        } else {
            // Check for invalid day values for February (month 2)
            if (month === 2 && (day === 30 || day === 31)) {
                selectError.textContent = 'Please select a proper date of birth (February has at most 29 days).';
                isValid = false;
            }
            // Add other checks for months with 30 days (April, June, September, November)
            else if ([4, 6, 9, 11].includes(month) && day === 31) {
                selectError.textContent = 'Please select a proper date of birth (this month has at most 30 days).';
                isValid = false;
            }
        }

       collectOwnerData();

      
    if (isValid) {
        console.log("All fields are filled. Proceeding to the next step...");
       
       }
}
</script>
{{-- 
<script>
document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 1;
    const totalSteps = 2; // Total number of steps

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

    // Function to go to the previous step
    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    // Initially show the first step
    showStep(currentStep);

    // Expose nextStep and prevStep globally to use them in HTML onclick
    window.nextStep = nextStep;
    window.prevStep = prevStep;
});




function checkFillstep1() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(function (element) {
        element.textContent = '';
    });
    const checkbox = document.getElementById('Confirm');


    let isValid = true;

    // Validate text fields
    const fields = [
        { id: 'first_name', name: "seller[first_name]" },
        { id: "last_name", name: "seller[last_name]" },
        { id: "state_region", name: "seller[state_region]" },
        { id: "city_town", name: "seller[city_town]" },
        { id: "appartment_building_suite_other", name: "seller[appartment_building_suite_other]" },
        { id: "address_line1", name: "seller[address_line1]" },
        { id: "zip_postal_code", name: "seller[zip_postal_code]" },
        { id: "Registered_business_address", name: "seller[Registered_business_address]" },
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
            document.getElementById(`${field.id}_error`).textContent = `Please fill this field`;
            isValid = false;
        }
    });

  
   

    // Validate checkboxes
    const beneficialOwnerCheckbox = document.querySelector('input[name="seller[beneficial_owner_check]"]:checked');
    const legalRepresentativeCheckbox = document.querySelector('input[name="seller[legal_representative_check]"]:checked');
    
    if (!beneficialOwnerCheckbox && !legalRepresentativeCheckbox) {
        const errorElement = document.getElementById('beneficial_owner_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = 'Please select at least one option.';
        }
        isValid = false;
    }

    // Validate radio buttons
    const primaryContactRadio = document.querySelector('input[name="seller[primary_contact_person_check]"]:checked');
    if (!primaryContactRadio) {
        const errorElement = document.getElementById('primary_contact_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = 'Please select an option.';
        }
        isValid = false;
    }

    // Validate checkbox for confirming beneficial ownership
    const businessTypeCheckbox = document.querySelector('input[name="business_type"]:checked');
    if (!businessTypeCheckbox) {
        const errorElement = document.getElementById('business_type_error'); // Ensure you add this error span in your HTML
        if (errorElement) {
            errorElement.textContent = '';
        }
    }

     


        // Validate Country of citizenship
      const countryField = document.getElementById('country_of_citizenship'); // Get the dropdown
      const countryError = document.getElementById('country_of_citizenship_error'); // Get the error span
      if (!countryField.value) { // Check if a country is selected
            countryError.textContent = 'Please select your country of citizenship.';
            isValid = false;
        }

          // Validate Country of birth
      const birthField = document.getElementById('country_of_birth'); // Get the dropdown
      const birthError = document.getElementById('country_of_birth_error'); // Get the error span
      if (!birthField.value) { // Check if a country is selected
            birthError.textContent = 'Please select your country of birth';
            isValid = false;
        }

         // Validate select fields
     const selectDay = document.getElementById('date_of_birth_day');
      const selectMonth = document.getElementById('date_of_birth_month');
      const selectYear = document.getElementById('date_of_birth_year');
      const selectError = document.getElementById('date_of_birth_day_error');

        // Validate the dropdown fields
        const day = parseInt(selectDay.value, 10);
        const month = parseInt(selectMonth.value, 10);

        if (!day || !month || !selectYear.value) {
            selectError.textContent = 'Please select day, month, and year.';
            isValid = false;
        } else {
            // Check for invalid day values for February (month 2)
            if (month === 2 && (day === 30 || day === 31)) {
                selectError.textContent = 'Please select a proper date of birth (February has at most 29 days).';
                isValid = false;
            }
            // Add other checks for months with 30 days (April, June, September, November)
            else if ([4, 6, 9, 11].includes(month) && day === 31) {
                selectError.textContent = 'Please select a proper date of birth (this month has at most 30 days).';
                isValid = false;
            }
        }

       collectOwnerData();

      
    if (isValid) {
        console.log("All fields are filled. Proceeding to the next step...");
       saveAndDisplaySpecificData()
        nextStep();
    }
}




</script> --}}


<script>
function toggleOwnerInput() {
    const primaryContactCheck = document.querySelector('input[name="seller[primary_contact_person_check]"]:checked');
    const ownerPercentageLabel = document.getElementById('owner_percentage_label');
    const hiddenInput = document.getElementById('allvalues');
    
    // If "No" is selected, show the input field for owners and percentage
    if (primaryContactCheck && primaryContactCheck.value === "0") {
        ownerPercentageLabel.style.display = "block";
        return 'no';
    } else {
        // If "Yes" is selected, hide the input field for owners and percentage
        ownerPercentageLabel.style.display = "none";
        hiddenInput.value = 'none';
        return 'yes';
    }
}</script>
<script>
document.getElementById('addMobileNumberText').addEventListener('click', function() {
    const addMobileDiv = document.querySelector('.add_mobile_no');
    
    // Toggle the visibility of the div
    if (addMobileDiv.style.display === 'none' || addMobileDiv.style.display === '') {
        addMobileDiv.style.display = 'block'; // Show the div
    } else {
        addMobileDiv.style.display = 'none'; // Hide the div
    }
});

</script>

<script>

$(document).ready(function() {
    $('#save_mobile_number_btn').click(function() {
        var mobileNumber = $('#mobile_number').val();

        // Validate mobile number (optional)
        if (mobileNumber === '') {
            $('#mobile_number_error').text('Mobile number is required.');
            return;
        } else {
            $('#mobile_number_error').text('');  // Clear any previous error
        }

        $.ajax({
            url: '/store-mobile-number',  // Use the correct URL for your route
            method: 'POST',
            data: {
                mobile_number: mobileNumber,
                _token: '{{ csrf_token() }}'  // CSRF token for Laravel
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Mobile number saved successfully!');
                    $('.add_mobile_no').hide();

                    $('.radio-label').show(); 
                    $('#saved_mobile_number').text(mobileNumber);
                    $('#mobileno_radio').val(mobileNumber);
                } else {
                    toastr.error('Failed to save mobile number.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                toastr.error('An error occurred while saving the mobile number.');
            }
        });
    });
});


</script>

@endpush
