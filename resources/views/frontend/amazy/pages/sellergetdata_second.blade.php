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

    /* Hover state */
    input[type="radio"]:hover {
      border-color: #00b234;
    }
    .amazy-login-form {
    max-width: 1000px !important;
}
.divider {
    max-width: 1000px !important;
    width: 100%;
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
}
    </style>
@section('title')
    {{ __('Merchant Register') }}
@endsection
@section('content')
    


<div class="amazy-login-area" style="display:initial;" >
    <div class="amazy_login_area_left_seller d-flex align-items-center justify-content-center">
        <div class="divider">
            <div class="amazy-login-form">
                <!-- Logo -->
                <a href="{{url('/')}}" class="logo mb-50 d-block d-none">
                    <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                </a>
            </div>
             <!-- Progress Steps -->
            <div class="Progress_steps">
                <!-- Step 1 -->
                <div class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">1</div>
                    <span style="margin-top: 5px; display: block;">Business Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 2 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">2</div>
                    <span style="margin-top: 5px; display: block;">Seller Information</span>
                </div>
                <div  class="Progress_steps_inner_line"></div>
                <!-- Step 3 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">3</div>
                    <span style="margin-top: 5px; display: block;">Billing</span>
                </div>
               <div  class="Progress_steps_inner_line"></div>
                <!-- Step 4 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">4</div>
                    <span style="margin-top: 5px; display: block;">Store</span>
                </div>
                {{-- <div  class="Progress_steps_inner_line"></div>
                <!-- Step 5 -->
                <div  class="Progress_steps_inner">
                    <div style="width: 30px; height: 30px; background-color: transparent; border: 2px solid #00b234; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #00b234; font-weight: bold;">5</div>
                    <span style="margin-top: 5px; display: block;">Verification</span>
                </div> --}}
            </div>
             <!-- End Progress Steps -->
            <div class="amazy-login-form">
                <h3 class="amazy-title">Business information</h3>
                <!-- Form Start -->
               <form id="registerFormStep2" action="{{ route('frontend.sellermerchantsave-register', ['id' => 'flat-rate']) }}" class="register-form" method="POST">
                    @csrf
                    <?php 
                        // Fetch the business data once
                        $business = \App\Models\UsersRegisteredBusiness::where('user_id', session('user_id'))->first(); 
                    ?>
                    <div class="step form-container" style="max-width: 1000px;">
                        <div class="form-group">
                            <label class="form-label">Business Name, Used To Register With Your State Or Federal Government</label>
                            <input type="text" class="form-input" value="{{ $business ? $business->business_name : '' }}" name="business_name" required>
                            @error('business_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company Registration Number / Tax ID / EIN </label>
                            <input type="text" class="form-input" value="{{ $business ? $business->company_registration_number : '' }}" name="company_registration_number" required>
                            @error('company_registration_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- {{dd($business->country);}} --}}
                        <label class="form-label">Registered Business Address</label>
                        <div class="form-row">
                            {{-- <input type="text" placeholder="United States" class="form-input" value="{{ $business ? $business->country : '' }}" name="country"required> --}}
                              <select name="country" id="business_country" class="form-input"
                                      style="padding: 0 0 0 10px;"
                                      required>
                                  <option value="" disabled selected>Select Country</option>
                                  <option {{ $business && $business->country == 'United States' ? 'selected' : '' }} value="United States">United States</option>
                                  <option {{ $business && $business->country == 'Canada' ? 'selected' : '' }} value="Canada">Canada</option>
                              </select>

                            <input type="text" placeholder="ZIP/Postal Code" class="form-input" id="zip_postal_code" value="{{ $business ? $business->zip_postal_code : '' }}" name="zip_postal_code" required onchange="fetchAddressData()">
                            @error('zip_postal_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <input type="text" placeholder="Address Line 1" class="form-input" id="address_line1" value="{{ $business ? $business->address_line1 : '' }}" name="address_line1" required>
                            <input type="text" placeholder="Apartment/Building/Suite/Other" id="appartment_building_suite_other" class="form-input" value="{{ $business ? $business->appartment_building_suite_other : '' }}" name="appartment_building_suite_other" required>
                        </div>
                        <div class="form-row">
                            <input type="text" placeholder="City/Town" class="form-input" id="city_town" value="{{ $business ? $business->city_town : '' }}" name="city_town" required>
                            <input type="text" placeholder="State / Region" class="form-input" id="state_region" value="{{ $business ? $business->state_region : '' }}" name="state_region" required>
                        </div>

                        <p class="highlighted-text">Phone Number For Verification</p>
                        <span id="mobile_number_error" style="color: red;"></span> <!-- Error message will be displayed here -->
                        <span id="formError" style="color: red; display: none;"></span>
                        <label class="radio-label" style="display: none;">
                            <input type="radio" name="mobileno" value="mobileno" id="mobileno_radio" required>
                            <div id="saved_mobile_number" style="color: white; padding: 10px;"></div>
                        </label>


                      

                         <?php 
                                $no = \App\Models\RegisteredBusinessPhoneNumbers::where('user_registered_business_id', session('user_id'))->first(); 
                        ?>

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
                                        placeholder="New mobile number"
                                        id="mobile_number"
                                        style="height: 36px; background: transparent; border: 2px solid white; color: white; padding: 10px; width: 50%; border-radius: 5px;">
                                    <span class="text-danger" id="mobile_number_error"></span>
                                </div>
                                <button type="button" id="save_mobile_number_btn">
                                    Save
                                </button>
                            </div>
                        <script>
                            document.getElementById("save_mobile_number_btn").addEventListener("click", function() {
                                    // Get the value from the input field
                                    var mobileNumber = document.getElementById("mobile_number").value;

                                    // Display the mobile number in the designated div
                                    document.getElementById("mobile_number_display").innerText = "Mobile Number: " + mobileNumber;
                                });
                        </script>
                    </div>
                    <div class="form-submit">
                        <button type="submit" id="saveButton" style="width: 300px;" class="next-btn amz_submit_button">NEXT</button>
                    </div>
                </form>
                
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

{{-- <script>
$(document).ready(function() {
    $('#saveButton').click(() => {
        let isValid = true;
        $('[required]').each(function() {
            if (!$(this).val().trim()) isValid = false;
        });
        $('#formError').text(isValid ? '' : 'Please Add Phone number for verification.').toggle(!isValid);
    });
});
</script> --}}
<script>
$(document).ready(function() {
    $('#saveButton').click(() => {
        let isValid = true;

        // Targeting the specific field: #mobileno_radio
        const mobilenoField = $('#mobileno_radio');
        const mobilenoError = $('#mobile_number_error');
        const formError = $('#formError');

        // Check if #mobileno_radio is visible and required
        if (!mobilenoField.is(':checked')) {
            isValid = false;
            mobilenoError.text('Phone number for verification is required.').show();
        } else {
            mobilenoError.text('').hide();
        }

        // Show or hide general form error
        formError.toggle(!isValid);
    });
});
</script>

<script>

$(document).ready(function() {
    // Toggle the visibility of the "Add a new mobile number" section when clicked
    $('#addMobileNumberText').click(function() {
        $('.add_mobile_no').toggle();  // This toggles the display of the input form
    });

    // Validation function
    function validateFields(mobileNumber) {
        const errorSpan = $('#mobile_number_error');
        const phoneNumberPattern = /^(\+?\(?\d{1,4}\)?[\s\-]?\d{1,4}[\s\-]?\d{1,4}[\s\-]?\d{1,4})$/;  // Example validation for a phone number (adjust pattern if needed)

        if (mobileNumber === '') {
            errorSpan.text('Mobile number is required.');
            return false;
        } else if (!phoneNumberPattern.test(mobileNumber)) {
            errorSpan.text('Enter a valid mobile number (10-15 digits).');
            return false;
        }

        errorSpan.text('');  // Clear any previous error
        return true;
    }

    // Save the mobile number on button click
    $('#save_mobile_number_btn').click(function() {
        var mobileNumber = $('#mobile_number').val();

        // Run validation function before proceeding
        if (!validateFields(mobileNumber)) {
            return;  // Exit if validation fails
        }

        $.ajax({
            url: '/store-Business-mobile-number',  // The same URL for storing the mobile number
            method: 'POST',
            data: {
                mobile_number: mobileNumber,
                _token: '{{ csrf_token() }}'  // CSRF token for Laravel
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Mobile number saved successfully!');
                    $('.add_mobile_no').hide();  // Hide the form after successful submission
                    $('#mobile_number').val('');  // Clear the input field

                    // Display the saved mobile number
                    $('.radio-label').show(); 
                    $('#saved_mobile_number').text(mobileNumber);
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
