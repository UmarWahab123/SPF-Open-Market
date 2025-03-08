@extends('backEnd.master')

@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('backend/css/backend_page_css/staff_create.css'))}}" />
@endsection

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30">{{ __('common.update') }} {{ __('common.customer') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST" id="staff_addForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">{{ __('common.basic_info') }}</h3>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.first_name') }} <span
                                            class="text-danger">*</span></label>
                                    <input name="first_name" class="primary_input_field name"
                                        placeholder="{{ __('common.first_name') }}" type="text"
                                        value="{{old('first_name')?old('first_name'):$customer->first_name}}">
                                    <span class="text-danger">{{$errors->first('first_name')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.last_name') }}</label>
                                    <input name="last_name" class="primary_input_field name"
                                        placeholder="{{ __('common.last_name') }}" type="text"
                                        value="{{old('last_name')?old('last_name'):$customer->last_name}}">
                                    <span class="text-danger">{{$errors->first('last_name')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.email_or_phone') }} <span class="text-danger">*</span></label>
                                    <input name="email" class="primary_input_field user_id name"
                                        placeholder="{{ __('common.email_or_phone') }}" type="text" value="@if(old('email')) {{old('email')}} @else{{$customer->email?$customer->email:$customer->username}}@endif">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                                <p class="text-danger user_id_row d-none">{{__('common.your_user_id_is')}} : <span
                                        class="generated_user_id"></span></p>
                            </div>

                             <div class="form-group col-md-4">
                                <label for="Company_name">Company Name</label>
                                <input type="text" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->company_name}}" id="Company_name" name="Company_name" required>
                                {{-- <input type="text" class="primary_input_field form-control"  placeholder="Enter your company name"  id="Company_name" name="Company_name" required> --}}
                                  <span class="text-danger">{{$errors->first('Company_name')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Phone_number">Phone Number</label>
                                <input type="text"class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->Phone_number}}" id="Phone_number" name="Phone_number" required>
                                {{-- <input type="text"class="primary_input_field form-control" value="{{old('Phone_number')}}" placeholder="Enter your phone number" id="Phone_number" name="Phone_number" required> --}}
                                <span class="text-danger">{{$errors->first('Phone_number')}}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="Billing_address">Billing Address</label>
                                <input type="text" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->billing_address}}" id="Billing_address" name="Billing_address" required>
                                {{-- <input type="text" class="primary_input_field form-control" value="{{old('Billing_address')}}" placeholder="Enter your billing address" id="Billing_address" name="Billing_address" required> --}}
                                <span class="text-danger">{{$errors->first('Billing_address')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Shipping_address">Shipping Address</label>
                                <input type="text" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->shipping_address}}"  id="Shipping_address" name="Shipping_address" required>
                                {{-- <input type="text" class="primary_input_field form-control" value="{{old('Shipping_address')}}" placeholder="Enter your shipping address" id="Shipping_address" name="Shipping_address" required> --}}
                                <span class="text-danger">{{$errors->first('Shipping_address')}}</span>
                            </div> 
                            

                             <div class="form-group col-md-4">
                                <label for="commercial_or_residential">Commercial or Residential?</label>
                                <select class="primary_input_field form-control" id="commercial_or_residential" name="commercial_or_residential" required>
                                    <option value="commercial" {{ (old('commercial_or_residential') ? old('commercial_or_residential') : $customer->commercial_or_residential) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                    <option value="residential" {{ (old('commercial_or_residential') ? old('commercial_or_residential') : $customer->commercial_or_residential) == 'residential' ? 'selected' : '' }}>Residential</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="loading_dock">Loading Dock?</label>
                                <select class="primary_input_field form-control" id="loading_dock" name="loading_dock" required>
                                    <option value="yes" {{ (old('loading_dock') ? old('loading_dock') : $customer->loading_dock) == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ (old('loading_dock') ? old('loading_dock') : $customer->loading_dock) == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="forklift">Forklift?</label>
                                <select class="primary_input_field form-control" id="forklift" name="forklift" required>
                                    <option value="yes" {{ (old('forklift') ? old('forklift') : $customer->forklift) == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ (old('forklift') ? old('forklift') : $customer->forklift) == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="pallet_jack">Pallet Jack?</label>
                                <select id="pallet_jack" name="pallet_jack" class="primary_input_field form-control" required>
                                    <option value="yes" {{ (old('pallet_jack') ? old('pallet_jack') : $customer->pallet_jack) == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ (old('pallet_jack') ? old('pallet_jack') : $customer->pallet_jack) == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="hours">Hours?</label>
                                <select id="hours" name="hours" class="primary_input_field form-control" required>
                                    <option value="yes" {{ (old('hours') ? old('hours') : $customer->hours) == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ (old('hours') ? old('hours') : $customer->hours) == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>


                                <div class="form-group col-md-4">
                                    <label for="call_ahead">Call Ahead?</label>
                                    <select id="call_ahead" name="call_ahead" class="primary_input_field form-control" required>
                                        <option value="yes" {{ (old('call_ahead') ? old('call_ahead') : $customer->call_ahead) == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ (old('call_ahead') ? old('call_ahead') : $customer->call_ahead) == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="special_instructions">Special Instructions for Deliveries?</label>
                                    <textarea id="special_instructions" class="primary_input_field form-control"  name="special_instructions">{{old('last_name')?old('last_name'):$customer->special_instructions}}</textarea>
                                    {{-- <textarea id="special_instructions" class="primary_input_field form-control"  placeholder="Special instructions for deliveries" name="special_instructions">{{old('special_instructions')}}</textarea> --}}
                                     <span class="text-danger">{{$errors->first('special_instructions')}}</span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="accounts_payable_contact_name">Accounts Payable Contact Name</label>
                                    <input type="text" id="accounts_payable_contact_name" value="{{old('last_name')?old('last_name'):$customer->accounts_payable_contact_name}}"  class="primary_input_field form-control"  name="accounts_payable_contact_name" required>
                                    {{-- <input type="text" id="accounts_payable_contact_name" value="{{old('accounts_payable_contact_name')}}"  class="primary_input_field form-control"  placeholder="Name of your accounts payable contact" name="accounts_payable_contact_name" required> --}}
                                    <span class="text-danger">{{$errors->first('accounts_payable_contact_name')}}</span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="accounts_payable_number">Accounts Payable Number</label>
                                    {{-- <input type="text" id="accounts_payable_number" class="primary_input_field form-control"  value="{{old('accounts_payable_number')}}"  placeholder="Phone number for accounts payable" name="accounts_payable_number" required> --}}
                                    <input type="text" id="accounts_payable_number" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->accounts_payable_number}}"   name="accounts_payable_number" required>
                                     <span class="text-danger">{{$errors->first('accounts_payable_number')}}</span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="accounts_payable_email">Accounts Payable Email</label>
                                    <input type="email" id="accounts_payable_email" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->accounts_payable_email}}" name="accounts_payable_email" required>
                                    {{-- <input type="email" id="accounts_payable_email" class="primary_input_field form-control" value="{{old('accounts_payable_email')}}" placeholder="Email for accounts payable" name="accounts_payable_email" required> --}}
                                    <span class="text-danger">{{$errors->first('accounts_payable_email')}}</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="general_liability">Current General Liability Insurance Provider</label>
                                    <input type="text" id="general_liability" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->general_liability}}" name="general_liability" >
                                    {{-- <input type="text" id="general_liability" class="primary_input_field form-control" value="{{old('general_liability')}}"  placeholder="Current general liability insurance provider" name="general_liability" placeholder="Enter insurance provider"> --}}
                                    <span class="text-danger">{{$errors->first('general_liability')}}</span>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="certifications">List of Current Certifications (Insulation/Roofing)</label>
                                    <input type="file" id="certifications" name="certifications">
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="preferred_language">Preferred Language</label>
                                    <input type="text" id="preferred_language" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->preferred_language}}"  name="preferred_language" >
                                    {{-- <input type="text" id="preferred_language" class="primary_input_field form-control"  value="{{old('preferred_language')}}" name="preferred_language" placeholder="Enter preferred language"> --}}
                                    <span class="text-danger">{{$errors->first('preferred_language')}}</span>
                                </div>
                                

    <!-- Detailed Business Info -->
                            <div class="col-xl-12">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">Detailed Business Info</h3>
                                </div>
                            </div>
                            <hr>


                        <div class="form-group col-md-4">
                            <label for="years_in_business">Years in Business</label>
                            <input type="number" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->years_in_business}}" id="years_in_business" name="years_in_business" required>
                            {{-- <input type="number" class="primary_input_field form-control" value="{{old('years_in_business')}}" id="years_in_business" name="years_in_business" required> --}}
                            <span class="text-danger">{{$errors->first('years_in_business')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="number_of_locations">Number of Locations</label>
                            <input type="number" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->number_of_locations}}" id="number_of_locations" name="number_of_locations">
                            {{-- <input type="number" class="primary_input_field form-control" value="{{old('number_of_locations')}}" id="number_of_locations" name="number_of_locations"> --}}
                            <span class="text-danger">{{$errors->first('number_of_locations')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="primary_business_function">Primary Business Function</label>
                            <input type="text" class="primary_input_field form-control"value="{{old('last_name')?old('last_name'):$customer->primary_business_function}}" id="primary_business_function" name="primary_business_function">
                            {{-- <input type="text" class="primary_input_field form-control" value="{{old('primary_business_function')}}" id="primary_business_function" name="primary_business_function"> --}}
                            <span class="text-danger">{{$errors->first('primary_business_function')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="number_of_rigs">Number of Rigs</label>
                            <input type="number" id="number_of_rigs" name="number_of_rigs" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->number_of_rigs}}">
                            {{-- <input type="number" id="number_of_rigs" name="number_of_rigs" class="primary_input_field form-control" value="{{old('number_of_rigs')}}"> --}}
                            <span class="text-danger">{{$errors->first('number_of_rigs')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="monthly_volume">Monthly Volume</label>
                            <input type="number" id="monthly_volume" name="monthly_volume" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->monthly_volume}}">
                            {{-- <input type="number" id="monthly_volume" name="monthly_volume" class="primary_input_field form-control" value="{{old('monthly_volume')}}"> --}}
                            <span class="text-danger">{{$errors->first('monthly_volume')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="open_cell_volume">Open Cell Volume</label>
                            <input type="number" id="open_cell_volume" name="open_cell_volume" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->open_cell_volume}}">
                            {{-- <input type="number" id="open_cell_volume" name="open_cell_volume" class="primary_input_field form-control" value="{{old('open_cell_volume')}}"> --}}
                            <span class="text-danger">{{$errors->first('open_cell_volume')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="closed_cell_volume">Closed Cell Volume</label>
                            <input type="number" id="closed_cell_volume" name="closed_cell_volume" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->closed_cell_volume}}">
                            {{-- <input type="number" id="closed_cell_volume" name="closed_cell_volume" class="primary_input_field form-control" value="{{old('closed_cell_volume')}}"> --}}
                            <span class="text-danger">{{$errors->first('closed_cell_volume')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="total_volume_previous_year">Total Volume Previous Year</label>
                            <input type="number" id="total_volume_previous_year" name="total_volume_previous_year" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->total_volume_previous_year}}">
                            {{-- <input type="number" id="total_volume_previous_year" name="total_volume_previous_year" class="primary_input_field form-control" value="{{old('total_volume_previous_year')}}"> --}}
                            <span class="text-danger">{{$errors->first('total_volume_previous_year')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="preferred_foam_brand">Preferred Foam Brand</label>
                            <input type="text" id="preferred_foam_brand" name="preferred_foam_brand" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->preferred_foam_brand}}">
                            {{-- <input type="text" id="preferred_foam_brand" name="preferred_foam_brand" class="primary_input_field form-control" value="{{old('preferred_foam_brand')}}"> --}}
                            <span class="text-danger">{{$errors->first('preferred_foam_brand')}}</span>
                        </div>



                        <div class="col-xl-12">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">Equipment Info</h3>
                            </div>
                        </div>
                        <hr>




                            <div class="form-group col-md-4">
                                <label for="preferred_rig_type">Preferred Rig Type</label>
                                <input type="text" class="primary_input_field form-control" value="{{old('last_name')?old('last_name'):$customer->preferred_rig_type}}" id="preferred_rig_type" name="preferred_rig_type">
                                 <span class="text-danger">{{$errors->first('preferred_rig_type')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="power_source">Shore Power or Diesel Generator</label>
                                <input type="text" class="primary_input_field form-control" id="power_source"  value="{{old('last_name')?old('last_name'):$customer->power_source}}"  name="power_source">
                                 <span class="text-danger">{{$errors->first('power_source')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="proportioner_brand">What Brand Proportioners</label>
                                <input type="text" class="primary_input_field form-control" id="proportioner_brand"  value="{{old('last_name')?old('last_name'):$customer->power_source}}"  name="proportioner_brand">
                                 <span class="text-danger">{{$errors->first('proportioner_brand')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="proportioner_model">What Model Proportions</label>
                                <input type="text" id="proportioner_model" class="primary_input_field form-control"  value="{{old('last_name')?old('last_name'):$customer->proportioner_model}}" name="proportioner_model" >
                                 <span class="text-danger">{{$errors->first('proportioner_model')}}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="preferred_spray_gun">Preferred Spray Gun Brand and Model</label>
                                <input type="text" id="preferred_spray_gun" class="primary_input_field form-control"  value="{{old('last_name')?old('last_name'):$customer->preferred_spray_gun}}" name="preferred_spray_gun" >
                                 <span class="text-danger">{{$errors->first('preferred_spray_gun')}}</span>
                            </div>


                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.password') }}
                                        ({{__('common.minimum_8_charecter')}})</label>
                                    <input name="password" class="primary_input_field name"
                                        placeholder="{{ __('common.password') }}" value="{{old('password')}}" type="password" minlength="8">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.confirm_password') }}</label>
                                    <input name="password_confirmation" class="primary_input_field name"
                                        placeholder="{{ __('common.confirm_password') }}" type="password" minlength="8">
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input">
                                    <label class="primary_input_label" for="">{{ __('common.status') }}</label>
                                    <ul id="theme_nav" class="permission_list sms_list ">
                                        <li>
                                            <label data-id="bg_option" class="primary_checkbox d-flex mr-12 extra_width">
                                                <input name="status" id="status_active" value="1" {{$customer->is_active == 1?'checked':''}} class="active"
                                                    type="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>{{ __('common.active') }}</p>
                                        </li>
                                        <li>
                                            <label data-id="color_option" class="primary_checkbox d-flex mr-12 extra_width">
                                                <input name="status" value="0" id="status_inactive" class="de_active" type="radio" {{$customer->is_active == 0?'checked':''}}>
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>{{ __('common.inactive') }}</p>
                                        </li>
                                    </ul>
                                    <span class="text-danger" id="error_status"></span>
                                </div>
                            </div>
                            

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                        id="save_button_parent"><i class="ti-check"></i>{{ __('common.update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script type="text/javascript">
    (function($){
        "use strict";

        $(document).ready(function(){
            

        });

    })(jQuery);

</script>
@endpush
