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
                    <div style="width: 30px; height: 30px; background-color: #01c701; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #17361f; font-weight: bold;">✔</div>
                    <span style="margin-top: 5px; display: block;">Seller Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
               
                <!-- Step 4 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">3</div>
                    <span style="margin-top: 5px; display: block;">Store</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                 <!-- Step 3 -->
                <div class="Progress_steps_inner">
                                     <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">4</div>
                   <span style="margin-top: 5px; display: block;">Billing</span>
                </div>
               {{-- <div  class="Progress_steps_inner_line"></div>
                <!-- Step 5 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">5</div>
                    <span style="margin-top: 5px; display: block;">Verification</span>
                </div> --}}
            </div>
             <!-- End Progress Steps -->
                <div class="amazy_login_form">
                    <h3 class="m-0 mb-3" style="color: #01c701;">Seller Stores Information</h3>
                    <?php 
                        // Fetch the business data once
                        $user = \App\Models\User::where('id', session('user_id'))->first(); 
                    ?>
                    
                    {{-- {{dd($stores_list->List_locations_states);}} --}}
                    <!-- Form Start -->
                    @php
                        $locations = json_decode($stores_list->List_locations_states, true);
                    @endphp
                    @if(is_array($locations))
                    <form style="width: 100%;" class="register_form" method="POST" id="registerForm">
                        @csrf
                        <div class="step" style="border: 3px solid white; padding: 30px 60px; border-radius: 20px;">
                            @foreach ($locations as $index => $location)
                                <div style="margin-bottom: 20px;">
                                    <label class="form-label" style="margin-bottom: 10px; display: block;">
                                        {{ $index + 1 }}: {{ htmlspecialchars($location) }}
                                    </label>
                                    <div style="display: flex; gap: 20px;">
                                        <div style="flex: 1;">
                                            <input
                                                type="text"
                                                id="name_{{ $index }}"
                                                name="name_{{ $index }}"
                                                placeholder="Stores Name"
                                                class="form-input">
                                            <span class="text-danger" id="Registered_business_address_error_{{ $index }}"></span>
                                        </div>
                                        <div style="flex: 1;">
                                            <input
                                                type="text"
                                                id="address_{{ $index }}"
                                                name="address_{{ $index }}"
                                                placeholder="Street Address, City, State, and Zip Code"
                                                class="form-input">
                                            <span class="text-danger" id="zip_postal_code_error_{{ $index }}"></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <p class="fill_error text-danger" style="display:none">Please complete all the required fields above. </p>
                            <input type="hidden" class="storedata" name="storedata"  value="hidden" id="storedata">
                            <label class="checkbox_design" style="margin-top:40px;">
                                I Confirm I Am Acting On My Own Behalf Or On Behalf Of A Registered Business, And I Commit To Updating The Beneficial Ownership Information Whenever A Change Has Been Made.
                                <input type="checkbox" value="Confirm" name="Confirm" id="Confirm" onchange="collectStoreData()">
                                <span class="checkmark" ></span>
                                <p class="checkinput text-danger" style="display:none">This field is required</p>
                            </label>
                        </div>
                        <div style="text-align: center; margin-top: 15px; display: flex; justify-content: center; gap: 10px;">
                            <button type="submit" style="height: 33px; margin-left: 100px; width: 120px; font-weight: 700; background: white; border: none; border-radius: 5px;">Next</button>
                        </div>
                    </form>
                    <button class="previous_btn" style="margin-top:-49px;"
                        type="button"  
                        onclick="location.href='{{ route('frontend.preview_sellerinformation', ['id' => 'flat-rate']) }}'">
                        Previous
                    </button>
                    @else
                        <p>Invalid JSON data.</p>
                    @endif
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
function collectStoreData() {
    let storeData = [];
    let allFieldsFilled = true;
    const errorMessage = document.querySelector('.fill_error');
     const checkbox = document.getElementById('Confirm');

    // Loop through the number of locations
    document.querySelectorAll('.form-input').forEach(input => {
        // Check if any field is empty
        if (!input.value.trim()) {
            allFieldsFilled = false;
        }

        const inputType = input.id.split('_')[0];
        const index = parseInt(input.id.split('_')[1]);

        if (!storeData[index]) {
            storeData[index] = { index: index + 1, name: '', address: '' };
        }

        if (inputType === 'name') {
            storeData[index].name = input.value;
        } else if (inputType === 'address') {
            storeData[index].address = input.value;
        }
    });

    // Show/hide error message based on validation
    if (!allFieldsFilled) {
        errorMessage.style.display = 'block';
        checkbox.checked = false;
        return false; // Return false if validation fails
    } else {
        errorMessage.style.display = 'none';
    }

    // Filter out any undefined values in the array
    storeData = storeData.filter(item => item !== undefined);

    // Store the JSON string in the hidden input field
    document.getElementById('storedata').value = JSON.stringify(storeData);
    return true; // Return true if validation passes
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();
        
        var checkbox = $('#Confirm');
        var errorMessage = $('.checkinput');
        
        if (!checkbox.is(':checked')) {
            errorMessage.show();
            return false;
        }
        
        errorMessage.hide();
        
       
        
       
        
        // Get the form data
        var formData = $(this).serialize();
        console.log('Form Data:', formData); // Debug log
        
        $.ajax({
            url: "{{ route('frontend.seller_stores_info_save', ['id' => 'flat-rate']) }}",
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              // If the response status is true, redirect to the payment page
              if(response.status == true) {
                  window.location.href = "{{ route('frontend.show_paymnet') }}";
              }
              // If the response status is false, redirect to the thank you page
              else if(response.status == false) {
                  window.location.href = '{{ route("seller_thankyou_page") }}';
              }
          },
          error: function(xhr, status, error) {
              // Handle any errors that occur during the AJAX request
              console.log('An error occurred, please try again.');
              console.error("Error details:", error); // Optionally log more detailed error information for debugging
          }
        });
    });
});
</script>

@endpush
