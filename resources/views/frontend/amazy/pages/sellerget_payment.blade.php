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
    margin-top: -33px; 
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

/* #buttons-containers{
  text-align: -webkit-center !important;
} */
}

    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    

<div class="amazy_login_area"  style="display:initial;">
    <div class="amazy_login_area_left_seller d-flex align-items-center justify-content-center" style="background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">
        <div class="divider">
            <div class="amazy_login_form">
                <!-- Logo -->
                <a href="{{url('/')}}" class="logo mb_50 d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>
                <!-- Support Text -->
                <p class="support_text d-none">{{__('auth.See your growth and get consulting support!')}}</p>
            </div>

            <!-- Progress Steps -->
            <div class="Progress_steps">
                <!-- Step 1 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: #01c701; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #17361f; font-weight: bold;">✔</div>
                    <span style="margin-top: 5px; display: block;">Business Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 2 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: #01c701; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #17361f; font-weight: bold;">✔</div>
                    <span style="margin-top: 5px; display: block;">Seller Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 4 -->
                <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: #01c701; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #17361f; font-weight: bold;">✔</div>
                    <span style="margin-top: 5px; display: block;">Store</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 3 -->
                <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">4</div>
                    <span style="margin-top: 5px; display: block;">Billing</span>
                </div>
               {{-- <div  class="Progress_steps_inner_line"></div> --}}
                <!-- Step 5 -->
                {{-- <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">5</div>
                    <span style="margin-top: 5px; display: block;">Verification</span>
                </div> --}}
            </div>
             <!-- End Progress Steps -->

            <!-- Payment Information -->
            <div class="amazy_login_form">
                <h3 class="m-0 mb-3" style="color: #01c701;">Payment Information</h3>
                <p class="m-0 mb-3" style="color: white;">Credit Or Debit Card Details</p>
                <div class="monthly_subscriptation">
                    <h2 style="color: white;">Monthly Subscription Fee</h2>
                    <p style="color: white;">You will be charged a Professional selling subscription fee of 39.99 USD for the first month. You will continue to be charged this fee each month if you have active listings. If you do not have active listings, you will not be charged a subscription fee in that month. If you expand to sell in other stores, you will pay the equivalent of 39.99 USD per month, split proportionately across each country or region in which you have an active listing and charged separately in each local currency. You can downgrade at any time. For more information, see <span style="color: #01c701;">this page.</span></p>
                </div>
     
               <div class="payment-form" 
                 style="
                      background-color: #f9f9f9; 
                      border: 1px solid #ddd; 
                      border-radius: 10px; 
                      padding: 20px; 
                      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
                      text-align: center;">
                 <div id="paypal-button-container" style="margin-left: 125px;" class="mt-4"></div>

                </div>
               {{-- <div id="paypal-button-container" style="margin-left: 125px;" class="mt-4"></div> --}}
               

                <!-- Form Start -->
                    <div class="step external_css d-none">
                        <!-- Card Information -->
                        <div style="margin-bottom: 20px; color: white;">
                            <label style="color: white; font-weight: 500; font-size: 16px; margin-bottom: 5px; display: block;">Registered Business Address</label>
                            <div style="display: flex; gap: 20px;">
                                <!-- Card Number -->
                                {{-- <div style="flex: 1; width: 50%;">
                                    <label style="display: block; font-weight: 500; margin-bottom: 5px; color:white;">Card Number</label>
                                    <input type="text" placeholder="Enter card number" name="payment[card_number]" style="height: 28px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;" required>
                                </div> --}}
                                <div style="flex: 1; width: 50%;">
                                    <label style="display: block; font-weight: 500; margin-bottom: 5px; color:white;">Card Number</label>
                                    <input type="text" placeholder="Enter Card Number" name="payment[card_number]" id="card_number" 
                                          style="height: 28px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;" 
                                          required>
                                    <span id="error-message" style="color: red; display: none;">Please enter a valid card number (numbers only).</span>
                                </div>
                                <!-- Expire On -->
                                <div style="flex: 1; width: 25%;">
                                <label style="display: block; font-weight: 500; margin-bottom: 5px; color:white;">Expire On</label>
                                <select name="payment[expire_in_month]" style="height: 30px; background: transparent; border: 2px solid white; color: white; width: 100%; border-radius: 5px;" required>
                                    <option value="" disabled selected>MM</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                                <!-- Year -->
                                <div style="flex: 1; width: 25%;">
                                    <label style="display: block; font-weight: 500; margin-bottom: 5px; visibility: hidden;">Year</label>
                                    <select name="payment[expire_in_year]" style="height: 28px; background: transparent; border: 2px solid white; color: white; width: 100%; border-radius: 5px;" required>
                                      <option value="">Year</option>
                                      <option value="2024">2024</option>
                                      <option value="2025">2025</option>
                                      <option value="2026">2026</option>
                                      <option value="2027">2027</option>
                                      <option value="2028">2028</option>
                                      <option value="2029">2029</option>
                                      <option value="2030">2030</option>
                                      <option value="2031">2031</option>
                                      <option value="2032">2032</option>
                                      <option value="2033">2033</option>
                                      <option value="2034">2034</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Business Name -->
                        <div style="margin-bottom: 20px;">
                            <label style="color: white;font-weight: 500; font-size: 16px; margin-bottom: 5px; display: block;">Card Holder Name</label>
                            <input type="text" name="payment[card_holder_name]" placeholder="Enter Card Holder Name" style="height: 30px; width: 100%; background: transparent; border: 2px solid white; color: white; padding: 10px; border-radius: 5px;" required>
                        </div>
                    </div>
            </div>

            <!-- Billing Address -->
            <div class="amazy_login_form d-none">
                    @csrf
                    <div class="step external_css">

                      <?php 
                             $address = \App\Models\UsersRegisteredBusiness::where('user_id', session('user_id'))->first(); 
                      ?>
                        <p style="color: #00b234;">Billing Address</p>

                       <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;"  required>
                            <input type="radio" name="saller_billing_address"
                                value="{{ $address ? $address->address_line1 . ', ' . $address->appartment_building_suite_other . ', ' . $address->city_town . ', ' . $address->state_region . ' ' . $address->zip_postal_code . ', ' . $address->country : '' }}"
                                style="margin-right: 10px;" checked required>
                            {{ $address ? $address->address_line1 : '' }} 
                            {{ $address ? $address->appartment_building_suite_other : '' }}  
                            {{ $address ? $address->city_town : '' }}  
                            {{ $address ? $address->state_region : '' }}
                            {{ $address ? $address->zip_postal_code : '' }}
                            {{ $address ? $address->country : '' }}
                        </label>
                        <div id="display_data" style="display: none;">
                            <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;">
                                <input type="radio" name="saller_billing_address" id="newadded-billing-address" style="margin-right: 10px;" required>
                                <span id="newadded-address_line_1" style="margin-right: 5px;"></span>
                                <span id="newadded-apartment_building" style="margin-right: 5px;"></span>
                                <span id="newadded-city_town" style="margin-right: 5px;"></span>
                                <span id="newadded-state_region" style="margin-right: 5px;"></span>
                                <span id="newadded-zip_code" style="margin-right: 5px;"></span>
                                <span id="newadded-country_name" style="margin-right: 5px;"></span>
                            </label>
                        </div>

                        <p style="color: #00b234; cursor: pointer; " onclick="toggleAddressForm()">+ Add A New Address</p>

                            <!-- Hidden Address Form -->
                            <div id="add_new_address" class="add_new_address" style="display: none;">
                               <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                  <input
                                      type="text"
                                      id="newaddedaddress_line1"
                                      name="address_line1" 
                                      placeholder="Address Line 1"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="address_line1_error"></span>

                                  <input
                                      type="text"
                                      name="builder"
                                      id="newaddedbuilder"
                                      placeholder="Apartment/Building/Suite/Other"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="builder_error"></span>
                              </div>

                              <!-- Second Row: City and State -->
                              <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                  <input
                                      type="text"
                                      name="city"
                                      id="newaddedcity"
                                      placeholder="City"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="city_error"></span>

                                  <input
                                      type="text"
                                      name="state"
                                      id="newaddedstate"
                                      placeholder="State"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="state_error"></span>
                              </div>

                              <!-- Third Row: Zipcode and Country -->
                              <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                  <input
                                      type="text"
                                      name="zipcode"
                                      id="newaddedzipcode"
                                      placeholder="ZIP/Postal Code"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="zipcode_error"></span>

                                  <input
                                      type="text"
                                      name="country"
                                      id="newaddedcountry"
                                      placeholder="Country"
                                      style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 100%; border-radius: 5px;">
                                  <span class="text-danger" id="country_error"></span>
                              </div>

                              <button type="button" id="address_save_button"
                                  style="height: 33px; margin-top: -12px; margin-bottom: 10px; width: 70px; font-weight: 700; background: #00b234; border: none; border-radius: 5px;">
                                  Save
                              </button>
                            </div>


                          <p style="color: #00b234; cursor: pointer;" onclick="toggleNewAddress()">View All Saved Addresses</p>

                              

                                <div id="new_saved_address" class="saved_address" style="display: none;"> <!-- Changed ID here -->
                                    
                                    <!-- Address 1 -->
                                    <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;">
                                        <input type="radio" name="saller_billing_address"  value="{{ $address ? $address->address_line1 . ', ' . $address->appartment_building_suite_other . ', ' . $address->city_town . ', ' . $address->state_region . ' ' . $address->zip_postal_code . ', ' . $address->country : '' }}"
                                             style="margin-right: 10px;"  required>
                                            {{ $address ? $address->address_line1 : '' }} 
                                            {{ $address ? $address->appartment_building_suite_other : '' }}  
                                            {{ $address ? $address->city_town : '' }}  
                                            {{ $address ? $address->state_region : '' }}
                                            {{ $address ? $address->zip_postal_code : '' }}
                                            {{ $address ? $address->country : '' }}
                                    </label>


                                    <!-- Address 2 -->
                                    <label style="display: flex; align-items: center; color: white; margin-bottom: 10px;">
                                        <input type="radio" name="saller_billing_address" id="billing-address" style="margin-right: 10px;" required>
                                        <span id="display-address_line1" style="margin-right: 5px;"></span>
                                        <span id="display-appartment_building" style="margin-right: 5px;"></span>
                                        <span id="display-city_town" style="margin-right: 5px;"></span>
                                        <span id="display-state_region" style="margin-right: 5px;"></span>
                                        <span id="display-zip_code" style="margin-right: 5px;"></span>
                                        <span id="display-registered-address" style="margin-right: 5px;"></span>
                                    </label>



                             
                                </div>


                    </div>
                    <!-- Buttons -->
                    <div style="text-align: center; margin-top: 15px; display: flex; justify-content: center; gap: 10px;">
                        <button type="button"  style="height: 33px; width: 120px; font-weight: 700; background: #00b234; border: none; border-radius: 5px;">Previous</button>
                        <button type="submit" class="next-btn"  style="height: 33px; width: 120px; font-weight: 700; background: white; border: none; border-radius: 5px;">Next</button>
                    </div>
                </form>
            </div>
           

        </div>
    </div>
</div>
<div id="paypal-data" data-monthly-cost="{{ @$planMonthlyCost }}" data-plan-id="{{@$planId}}"></div>





{{-- new end --}}
@endsection

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
<script>
$(document).ready(function () {
  const originalSubtotal = parseFloat($("#paypal-data").data("monthly-cost"));
  var pricing_plan_id = parseFloat($("#paypal-data").data('plan-id'));
  // $('#paypalModal').modal('show');
    function renderPayPalButton(totalAmount) {
        $("#paypal-button-container").html(''); // Clear any existing PayPal buttons
        paypal.Buttons({
            fundingSource: paypal.FUNDING.CARD,
            createOrder: function (data, actions) {
                // console.log("Creating order with total:", totalAmount);
                return actions.order.create({
                    purchase_units: [{
                        amount: { value: totalAmount }
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
                            type:'seller_subscription_payment'
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
                            if (data.success) {
                                toastr.success("Subscription payment successful", "{{__('common.success')}}");
                                window.location.href = '{{ route("seller_thankyou_page") }}';
                                // setTimeout(() => {
                                //     window.location.reload();
                                // }, 2000);
                            } else {
                            $('#pre-loader').hide();
                                toastr.error('Payment failed: ' + data.message, "{{__('common.error')}}");
                            }
                        }).catch(error => {
                            $('#pre-loader').hide();
                            toastr.error('An error occurred: ' + error.message, "{{__('common.error')}}");
                        });
                    });
                }
        }).render('#paypal-button-container');
    }

    // Render the PayPal button initially
    renderPayPalButton(originalSubtotal);
});
</script>

{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<script>
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
</script>
<script>
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
</script>


<script>
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
</script>





<script>
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

@endpush
