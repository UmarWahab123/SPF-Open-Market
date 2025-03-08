@extends('frontend.amazy.layouts.app')
@push('styles')
    <style>
        .primary_bulet_checkbox .checkmark{
            top: 2px;
        }
        .term_link_set, .policy_link_set{
            color: var(--base_color);
        }
        
    </style>
    <style>
.step {
    display: none;
    width: 100%;
    transition: transform 0.5s ease, opacity 0.5s ease;
    opacity: 0;
}
.step.active {
    display: block;
    opacity: 1;
}
.step.slide-in-right {
}
.step.slide-in-left {
    transform: translateX(-100%);
}
.step.slide-out-left {
    transform: translateX(-100%);
    opacity: 0;
}
.step.slide-out-right {
    transform: translateX(100%);
    opacity: 0;
}
</style>
@section('content')
<div class="amazy_login_area"  style="grid-template-columns: 100% ;">
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center"  style="width:100%;">
        <div class="amazy_login_form" style="width:100%;max-width: 100%;">
        <div class="container"> 
         
         <div class="row"> 
        <div class="col-md-12 text-center"> 
        <h3 class="m-0">Buyer {{__('auth.Sign Up')}}</h3>
        </div>
        </div>
        <div class="mt-5 d-flex justify-content-between"> 
        <div class="col-md-12"> 
        <div class="left_side_form">
        <form action="{{ route('register') }}" method="POST" name="register" id="register_form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @if(!empty($row) && !empty($form_data))
                        @php
                            $default_field = [];
                            $custom_field = [];
                        @endphp

                         @foreach($form_data as $row)
                            @php
                                if($row->type != 'header' && $row->type !='paragraph'){
                                    if(property_exists($row,'className') && strpos($row->className, 'default-field') !== false){
                                        $default_field[] = $row->name;
                                    }else{
                                        $custom_field[] = $row->name;
                                    }
                                    $required = property_exists($row,'required');
                                    $type = property_exists($row,'subtype') ? $row->subtype : $row->type;
                                    $placeholder = property_exists($row,'placeholder') ? $row->placeholder : $row->label;
                                }
                            @endphp

                            @if($row->type =='header' || $row->type =='paragraph')
                                <div class="col-lg-12">
                                    <{{ $row->subtype }}>{{ $row->label }} </{{ $row->subtype }}>
                                </div>
                            @elseif($row->type == 'text' || $row->type == 'number' || $row->type == 'email' || $row->type == 'date')
                                <div class="col-12 mb_20">
                                    <label for="{{$row->name}}" class="primary_label2"> {{$row->label}} @if($required) <span class="text-danger">*</span> @endif</label>
                                    <input {{$required ? 'required' :''}} type="{{$type}}" id="{{$row->name}}" class="primary_input3 radius_5px @error($row->name) is-invalid @enderror" name="{{$row->name}}" value="{{ old($row->name) }}" placeholder="{{$placeholder}}">
                                    @error($row->name)
                                    <span class="text-danger" >{{ $message }}</span>
                                    @enderror
                                </div>
                            @elseif($row->type=='select')
                                <div class="col-xl-12 mb_25">
                                    <div class="form-group input_div_mb">
                                        <label class="primary_label2 style4" for={{$row->name}}>{{$row->label}}@if($required) <span class="text-danger">*</span> @endif</label>
                                        <select {{$required ? 'required' :''}} name="{{$row->name}}" id="{{$row->name}}" class=" theme_select style2 wide">
                                            @foreach($row->values as $value)
                                                <option value="{{$value->value}}" {{old($row->name) == $value->value? 'selected': ''}}>{{$value->label}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first($row->name)}}</span>
                                    </div>
                                </div>

                            @elseif($row->type == 'date')
                                <div class="col-12 mb_30">
                                    <label for="start_datepicker" class="primary_label2 style2 "> {{$row->label}} @if($required) <span class="text-danger">*</span> @endif</label>
                                    <input {{$required ? 'required' :''}} type="{{$type}}" id="start_datepicker" class="primary_input3 style4 mb-0 @error($row->name) is-invalid @enderror" name="{{$row->name}}" value="{{ old($row->name) }}" placeholder="{{$placeholder}}">
                                    @error($row->name)
                                    <span class="text-danger" >{{ $message }}</span>
                                    @enderror
                                </div>

                            @elseif($row->type=='textarea')
                                <div class="col-md-12 mb-10">
                                    <label for={{$row->name}}>{{$row->label}}@if($required) <span class="text-danger">*</span> @endif</label>
                                    <textarea class="form-control" {{$required ? 'required' :''}} name="{{$row->name}}" id="{{$row->name}}" placeholder="{{$placeholder}}">{{old($row->name)}}</textarea>
                                    <span class="text-danger">{{$errors->first($row->name)}}</span>
                                </div>

                            @elseif($row->type=="radio-group")
                                <div class="col-lg-12 mb_20">
                                    <label for="">{{ $row->label }}</label>
                                    <div class="d-flex radio-btn-flex">
                                        @foreach($row->values as $value)
                                            <label class="primary_bulet_checkbox">
                                                <input type="radio" name="{{ $row->name }}" class="payment_method" value="{{ $value->value }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            <a class="ml_10 mr_10 text_color">{{ $value->label }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($row->type=="checkbox-group")
                                <div class="col-12 mb_25">
                                    <label>{{@$row->label}}</label>
                                    @foreach($row->values as $value)
                                    <label class="primary_checkbox d-flex">
                                        <input value="{{ $value->value }}" id="term_check" name="{{ $row->name }}[]" checked type="checkbox">
                                        <span class="checkmark mr_15"></span>
                                        <span class="label_name f_w_400 ">{{$value->label}}</span>
                                        <span id="error_term_check" class="text-danger"></span>
                                    </label>
                                    @endforeach
                                </div>

                            @elseif($row->type =='file')
                                <div class="col-lg-12 mb_20">
                                    <label for="{{$row->name}}" class="primary_label2 style3">{{$row->label}}@if($required) <span class="text-danger">*</span> @endif</label>
                                    <input type="{{$type}}" accept="image/*" class="primary_input3 style4 radius_3px pd_12" name="{{$row->name}}" id="{{$row->name}}" >
                                </div>
                            @elseif($row->type =='checkbox')
                                <div class="col-md-12 mb_20 mt_10">
                                    <label class="primary_checkbox d-flex">
                                        <input id="policyCheck" type="checkbox" checked>
                                        <span class="checkmark mr_15"></span>
                                        <span class="label_name f_w_400 ">{!! $row->label !!}</span>
                                    </label>
                                </div>
                            @endif

                        @endforeach

                    @else

            <div class="step" id="step-1" >   
                      <h2>Basic Business Info</h2>
                       <div class="row">
                       <div class="col-md-6 mb_20">
                            <label class="primary_label2">{{__('common.first_name')}} <span>*</span> </label>
                            <input name="first_name" id="first_name" value="{{ old('first_name') }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.first_name') }}'" class="primary_input3 radius_5px" type="text">
                            {{-- <input name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="{{ __('common.first_name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.first_name') }}'" class="primary_input3 radius_5px" type="text"> --}}
                            <span class="text-danger" >{{ $errors->first('first_name') }}</span> <span class="text-danger" id="first_name_error"></span>
                        </div>
                        <div class="col-md-6 mb_20">
                            <label class="primary_label2">{{__('common.last_name')}}</label>
                            <input name="last_name" id="last_name" value="{{ old('last_name') }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.last_name') }}'" class="primary_input3 radius_5px" type="text">
                            {{-- <input name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="{{ __('common.last_name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.last_name') }}'" class="primary_input3 radius_5px" type="text"> --}}
                            <span class="text-danger" >{{ $errors->first('last_name') }}</span> <span class="text-danger" id="last_name_error"></span>
                        </div>

                         @if(isModuleActive('Otp') && otp_configuration('otp_activation_for_customer') || app('business_settings')->where('type', 'email_verification')->first()->status == 0)
                        <div class="col-md-6 mb_20">
                            <label class="primary_label2">{{__('common.email_or_phone')}} <span>*</span></label>
                            <input name="email" id="email" value="{{ old('email') }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email_or_phone') }}'" class="primary_input3 radius_5px" type="text">
                            {{-- <input name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('common.email_or_phone') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email_or_phone') }}'" class="primary_input3 radius_5px" type="text"> --}}
                            <span class="text-danger" >{{ $errors->first('email') }}</span> <span class="text-danger" id="email_error"></span>
                        </div>
                        @else
                        <div class="col-md-6 mb_20">
                            <label class="primary_label2">{{__('common.email')}} <span>*</span></label>
                            <input name="email" id="email" value="{{ old('email') }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email') }}'" class="primary_input3 radius_5px" type="text">
                            {{-- <input name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('common.email') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email') }}'" class="primary_input3 radius_5px" type="text"> --}}
                            <span class="text-danger" >{{ $errors->first('email') }}</span> <span class="text-danger" id="email_error"></span>
                        </div>
                        @endif
                        
                      
                        <div class="col-md-6 mb_20">
                            <label class="primary_label2">{{ __('common.password') }} <span>*</span></label>
                            <input name="password" id="password"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password">
                            {{-- <input name="password" id="password" placeholder="{{__('amazy.Min. 8 Character')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password"> --}}
                            <span class="text-danger" >{{ $errors->first('password') }}</span> <span class="text-danger" id="password_error"></span>
                        </div>
                        <div class="col-md-6 mb_20">
                            <label class="primary_label2" for="password-confirm">{{ __('common.confirm_password') }} <span>*</span></label>
                            <input name="password_confirmation" id="password-confirm" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password">
                            {{-- <input name="password_confirmation" id="password-confirm" placeholder="{{__('amazy.Min. 8 Character')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password"> --}}
                              <span class="text-danger" id="password-confirm_error"></span>
                        </div>
                        
                        <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="Company_name">Company Name</label>
                            <input type="text" value="{{ old('Company_name') }}" class="form-control primary_input3 radius_5px" id="Company_name" name="Company_name" required>
                            <span class="text-danger" >{{ $errors->first('Company_name') }}</span> <span class="text-danger" id="Company_name_error"></span>
                        </div>
                        <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="Phone_number">Phone Number</label>
                            <input type="text" value="{{ old('Phone_number') }}" class="form-control primary_input3 radius_5px" id="Phone_number" name="Phone_number" required>
                            <span class="text-danger" >{{ $errors->first('Phone_number') }}</span> <span class="text-danger" id="Phone_number_error"></span>
                        </div>

                        <div class="col-12 text-center">
                            <button type="button" class="btn col-md-4" style="background:#103020; color:white; font-weight: bold; height: 54px;" onclick="checkFillstep1();">Next</button>
                        </div>

                    </div>
                    
                         

            </div>
             <div class="step" id="step-2" style="display:none;">
             <div class="row">
                          <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="Billing_address">Billing Address</label>
                            <input type="text" value="{{ old('Billing_address') }}" class="form-control primary_input3 radius_5px" id="Billing_address" name="Billing_address" required>
                            <span class="text-danger" id="Billing_address_error"></span>
                        </div>
                        <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="Shipping_address">Shipping Address</label>
                            <input type="text" value="{{ old('Shipping_address') }}" class="form-control primary_input3 radius_5px" id="Shipping_address" name="Shipping_address" required>
                            <span class="text-danger" id="Shipping_address_error"></span>
                        </div>

                         <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="commercial_or_residential">Commercial or Residential?</label>
                            <select value="{{ old('commercial_or_residential') }}"  class="form-control primary_input3 radius_5px" id="commercial_or_residential" name="commercial_or_residential" required>
                                <option value="commercial">Commercial</option>
                                <option value="residential">Residential</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="loading_dock">Loading Dock?</label>
                            <select value="{{ old('loading_dock') }}" class="form-control primary_input3 radius_5px" id="loading_dock" name="loading_dock" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                       <div  class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="forklift">Forklift?</label>
                            <select value="{{ old('forklift') }}" class="form-control primary_input3 radius_5px" id="forklift" name="forklift" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                         <div  class="form-group col-md-6 mb_20">
                            <label class="primary_label2" for="pallet_jack">Pallet Jack?</label>
                            <select value="{{ old('pallet_jack') }}" class="form-control primary_input3 radius_5px" id="pallet_jack" name="pallet_jack" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                           <div  class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="hours">Hours?</label>
                                <select value="{{ old('hours') }}" class="form-control primary_input3 radius_5px" id="hours" name="hours" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                           
                             <div class="col-12 text-center">
                                <button type="button"  class="btn col-md-2" style="background:#6c757d; color:white; font-weight: bold; height: 54px; margin-right: 10px;" onclick="prevStep()">Back</button>
                                <button type="button" class="btn col-md-2" style="background:#103020; color:white; font-weight: bold; height: 54px;" onclick="checkFillstep2()">Next</button>
                            </div>
                        </div>
    
            </div>
             <div class="step" id="step-3" style="display: none;">
              <div class="row">
                            <div  class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="call_ahead">Call Ahead?</label>
                                <select  value="{{ old('call_ahead') }}" class="form-control primary_input3 radius_5px" id="call_ahead" name="call_ahead" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div  class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="special_instructions">Special Instructions for Deliveries?</label>
                                <textarea  id="special_instructions" class="form-control primary_input3 radius_5px"  name="special_instructions"> {{ old('special_instructions') }} </textarea>
                                <span class="text-danger" id="special_instructions_error"></span>
                            </div>

                            <div  class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="accounts_payable_contact_name">Accounts Payable Contact Name</label>
                                <input  value="{{ old('accounts_payable_contact_name') }}" type="text" id="accounts_payable_contact_name" class="form-control primary_input3 radius_5px" name="accounts_payable_contact_name" required>
                                <span class="text-danger" id="accounts_payable_contact_name_error"></span>
                            </div>

                            <div  class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="accounts_payable_number">Accounts Payable Number</label>
                                <input  value="{{ old('accounts_payable_number') }}" type="text" id="accounts_payable_number" class="form-control primary_input3 radius_5px" name="accounts_payable_number" required>
                                <span class="text-danger" id="accounts_payable_number_error"></span>
                            </div>

                            <div class="form-group col-md-6 mb_20">
                                <label class="primary_label2" for="accounts_payable_email">Accounts Payable Email</label>
                                <input 
                                    value="{{ old('accounts_payable_email') }}" 
                                    class="form-control primary_input3 radius_5px" 
                                    id="accounts_payable_email" 
                                    name="accounts_payable_email" 
                                    required
                                >
                                <span class="text-danger">{{ $errors->first('accounts_payable_email') }}</span>
                                <span class="text-danger" id="accounts_payable_email_error"></span>
                            </div>
                             <div  class="form-group col-md-6 mb_20">
                                <label  class="primary_label2" for="general_liability">Current General Liability Insurance Provider</label>
                                <input  value="{{ old('general_liability') }}" type="text"  class="form-control primary_input3 radius_5px" id="general_liability" name="general_liability" >
                                {{-- <input  value="{{ old('general_liability') }}" type="text"  class="form-control primary_input3 radius_5px" id="general_liability" name="general_liability" placeholder="Enter insurance provider"> --}}
                                <span class="text-danger" id="general_liability_error"></span>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                <label for="certifications">List of Current Certifications (Insulation/Roofing)</label>
                                <input type="file" id="certifications" name="certifications">
                            </div> --}}
                              <div  class="form-group col-md-6 mb_20">
                                <label  class="primary_label2" for="preferred_language">Preferred Language</label>
                                <input value="{{ old('preferred_language') }}" type="text"  class="form-control primary_input3 radius_5px" id="preferred_language" name="preferred_language">
                                {{-- <input value="{{ old('preferred_language') }}" type="text"  class="form-control primary_input3 radius_5px" id="preferred_language" name="preferred_language" placeholder="Enter preferred language"> --}}
                                <span class="text-danger" id="preferred_language_error"></span>
                            </div>
                            <div class="col-12 text-center">
                               <button type="button"  class="btn col-md-2" style="background:#6c757d; color:white; font-weight: bold; height: 54px; margin-right: 10px;" onclick="prevStep()">Back</button>
                                <button type="button" class="btn col-md-2" style="background:#103020; color:white; font-weight: bold; height: 54px;" onclick="checkFillstep3()">Next</button>
                            </div>
                        </div>
       
   
            </div>

         <div class="step" id="step-4" style="display: none;">
                             <h2>Detailed Business Info</h2>
                             <div class="row">
                                <div  class="form-group col-md-6 mb_20">
                                    <label  class="primary_label2" for="years_in_business">Years in Business</label>
                                    <input value="{{ old('years_in_business') }}"  type="number" class="form-control primary_input3 radius_5px" id="years_in_business" name="years_in_business" required>
                                    <span class="text-danger" id="years_in_business_error"></span>
                                </div>
                                <div  class="form-group col-md-6 mb_20">
                                    <label  class="primary_label2" for="number_of_locations">Number of Locations</label>
                                    <input value="{{ old('number_of_locations') }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_locations" name="number_of_locations">
                                    <span class="text-danger" id="number_of_locations_error"></span>
                                </div>
                                <div  class="form-group col-md-6 mb_20">
                                    <label  class="primary_label2" for="primary_business_function">Primary Business Function</label>
                                    <input value="{{ old('primary_business_function') }}"  type="text" class="form-control primary_input3 radius_5px" id="primary_business_function" name="primary_business_function">
                                    <span class="text-danger" id="primary_business_function_error"></span>
                                </div>

                                <div  class="form-group col-md-6 mb_20">
                                    <label class="primary_label2" for="number_of_rigs">Number of Rigs</label>
                                    <input value="{{ old('number_of_rigs') }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_rigs" name="number_of_rigs" >
                                    {{-- <input value="{{ old('number_of_rigs') }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_rigs" name="number_of_rigs" placeholder="Enter number of rigs"> --}}
                                    <span class="text-danger" id="number_of_rigs_error"></span>
                                </div>
                                <div  class="form-group col-md-6 mb_20">
                                    <label class="primary_label2" for="monthly_volume">Monthly Volume</label>
                                    <input value="{{ old('monthly_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="monthly_volume" name="monthly_volume" >
                                    {{-- <input value="{{ old('monthly_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="monthly_volume" name="monthly_volume" placeholder="Enter monthly volume"> --}}
                                    <span class="text-danger" id="monthly_volume_error"></span>
                                </div>
                                <div  class="form-group col-md-6 mb_20">
                                    <label class="primary_label2" for="open_cell_volume">Open Cell Volume</label>
                                    <input value="{{ old('open_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="open_cell_volume" name="open_cell_volume" >
                                    {{-- <input value="{{ old('open_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="open_cell_volume" name="open_cell_volume" placeholder="Enter open cell volume"> --}}
                                    <span class="text-danger" id="open_cell_volume_error"></span>
                                </div>

                                <div class="form-group col-md-6 mb_20">
                                    <label  class="primary_label2" for="closed_cell_volume">Closed Cell Volume</label>
                                    <input value="{{ old('closed_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px"  id="closed_cell_volume" name="closed_cell_volume" >
                                    {{-- <input value="{{ old('closed_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px"  id="closed_cell_volume" name="closed_cell_volume" placeholder="Enter closed cell volume"> --}}
                                    <span class="text-danger" id="closed_cell_volume_error"></span>
                                </div>
                                <div  class="form-group col-md-6 mb_20">
                                    <label class="primary_label2" for="total_volume_previous_year">Total Volume Previous Year</label>
                                    <input value="{{ old('total_volume_previous_year') }}"  type="number" class="form-control primary_input3 radius_5px"  id="total_volume_previous_year" name="total_volume_previous_year" >
                                    {{-- <input value="{{ old('total_volume_previous_year') }}"  type="number" class="form-control primary_input3 radius_5px"  id="total_volume_previous_year" name="total_volume_previous_year" placeholder="Enter total volume"> --}}
                                    <span class="text-danger" id="total_volume_previous_year_error"></span>
                                </div>
                                <div class="form-group col-md-6 mb_20">
                                    <label  class="primary_label2" for="preferred_foam_brand">Preferred Foam Brand</label>
                                    <input value="{{ old('preferred_foam_brand') }}"  type="text" class="form-control primary_input3 radius_5px"  id="preferred_foam_brand" name="preferred_foam_brand" >
                                    {{-- <input value="{{ old('preferred_foam_brand') }}"  type="text" class="form-control primary_input3 radius_5px"  id="preferred_foam_brand" name="preferred_foam_brand" placeholder="Enter preferred foam brand"> --}}
                                    <span class="text-danger" id="preferred_foam_brand_error"></span>
                                </div>
                                <div class="col-12 text-center">
                                <button type="button"  class="btn col-md-2" style="background:#6c757d; color:white; font-weight: bold; height: 54px; margin-right: 10px;" onclick="prevStep()">Back</button>
                                <button type="button" class="btn col-md-2" style="background:#103020; color:white; font-weight: bold; height: 54px;" onclick="checkFillstep4()">Next</button>
                            </div>
                            </div>
        
    </div>
            <div class="step" id="step-5" style="display: none;">
                                <h2>Equipment Info</h2>
                                <div class="row">
                                    <div class="form-group col-md-6 mb_20">
                                        <label   class="primary_label2" for="preferred_rig_type">Preferred Rig Type</label>
                                        <input  value="{{ old('preferred_rig_type') }}" type="text" class="form-control primary_input3 radius_5px" id="preferred_rig_type" name="preferred_rig_type">
                                    </div>
                                   <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="power_source">Shore Power or Diesel Generator</label>
                                        <input  value="{{ old('power_source') }}" type="text" class="form-control primary_input3 radius_5px" id="power_source" name="power_source">
                                    </div>
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="proportioner_brand">What Brand Proportioners</label>
                                        <input  value="{{ old('proportioner_brand') }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_brand" name="proportioner_brand">
                                    </div>

                                    <div class="form-group col-md-6 mb_20">
                                        <label   class="primary_label2"  for="proportioner_model">What Model Proportions</label>
                                        <input  value="{{ old('proportioner_model') }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_model" name="proportioner_model"    >
                                        {{-- <input  value="{{ old('proportioner_model') }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_model" name="proportioner_model" placeholder="Enter model"> --}}
                                    </div>
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="preferred_spray_gun">Preferred Spray Gun Brand and Model</label>
                                        <input  value="{{ old('preferred_spray_gun') }}" type="text" class="form-control primary_input3 radius_5px" id="preferred_spray_gun" name="preferred_spray_gun" >
                                        {{-- <input  value="{{ old('preferred_spray_gun') }}" type="text" class="form-control primary_input3 radius_5px" id="preferred_spray_gun" name="preferred_spray_gun" placeholder="Enter spray gun brand and model"> --}}
                                    </div>
                                


                        {{-- <div class="col-12 mb_20">
                            <label for="referral_code" class="primary_label2">{{__('common.referral_code_(optional)')}}</label>
                            <input name="referral_code" id="referral_code" value="{{ old('referral_code') }}" placeholder="{{ __('common.referral_code') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.referral_code') }}'" class="primary_input3 radius_5px" type="text">
                            <span class="text-danger" >{{ $errors->first('referral_code') }}</span>
                        </div> --}}

                        <div class="col-lg-12 mb_20 mt_10">
                            <label class="primary_checkbox d-flex">
                                <input id="policyCheck" type="checkbox" checked>
                                <span class="checkmark mr_15"></span>
                                <p class="label_name f_w_400">{{ __('defaultTheme.by_signing_up_you_agree_to_terms_of_service_and_privacy_policy') }}</p>
                            </label>
                        </div>
                    @endif

                    
                   <div class="col-12 ">
                        @if(env('NOCAPTCHA_FOR_REG') == "true")
                        <div class="col-8 mb_20">
                            @if(env('NOCAPTCHA_INVISIBLE') != "true")
                            <div class="g-recaptcha" data-callback="callback" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                            @endif
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        </div>
                        @endif

                        <div class="d-flex justify-content-center w-100">
                            <button type="button" class="btn col-md-2" style="background:#6c757d; color:white; font-weight: bold; height: 54px;" onclick="prevStep()">Back</button>
                            
                            <div class="col-md-2">
                                @if(env('NOCAPTCHA_INVISIBLE') == "true")
                                <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-size="invisible" data-callback="onSubmit">{{__('auth.Sign Up')}}</button>
                                @else
                                <button class=" radius_5px  text-uppercase text-center col-md-2" style="width:210px; background:#103020; color:white; font-weight: bold; height: 54px; border:none;" id="sign_in_btn">{{__('auth.Sign Up')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <p class="sign_up_text">{{__('auth.Already have an Account?')}}  <a href="{{url('/login')}}">{{__('auth.Sign In')}}</a></p>
                           
                    </div>
                    
                    </div>
                        
    </div>

               
                </div>
            </form>
        </div> 
        </div>

        <div class="center_space" style="width: 1px; height: 250px; background-color: #d5d5d5; margin: 20px 20px; display: none; color:white;">.</div>
        {{-- <div class="center_space" style="width: 1px; height: 250px; background-color: #d5d5d5; margin: 20px 20px; display: inline-block; color:white;">.</div> --}}

        <div class="col-md-3" style="display:none;"> 
        <div class="right_side_google">
        {{-- <a href="{{url('/')}}" class="logo mb_50 d-block">
                <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
            </a>--}}
           
           {{-- <p class="support_text">{{__('auth.See your growth and get consulting support!')}}</p> --}}

            @if (app('general_setting')->google_status)
            <a href="{{url('/login/google')}}" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="{{url('/')}}/public/frontend/amazy/img/svg/google_icon.svg" alt="{{__('auth.Sign up with Google')}}" title="{{__('auth.Sign up with Google')}}">
                <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Google')}}</h5>
            </a>
            @endif
            @if (app('general_setting')->facebook_status)
            <a href="{{url('/login/facebook')}}" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="{{url('/')}}/public/frontend/amazy/img/svg/facebook_icon.svg" alt="{{__('auth.Sign up with Facebook')}}" title="{{__('auth.Sign up with Facebook')}}">
                <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Facebook')}}</h5>
            </a>
            @endif
            @if (app('general_setting')->twitter_status)
            <a href="{{url('/login/twitter')}}" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="{{url('/')}}/public/frontend/amazy/img/svg/twitter_icon.svg" alt="{{__('auth.Sign up with Twitter')}}" title="{{__('auth.Sign up with Twitter')}}">
                <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with Twitter')}}</h5>
            </a>
            @endif
            @if (app('general_setting')->linkedin_status)
            <a href="{{url('/login/linkedin')}}" class="google_logIn d-flex align-items-center justify-content-center">
                <img src="{{url('/')}}/public/frontend/amazy/img/svg/linkedin_icon.svg" alt="{{__('auth.Sign up with LinkedIn')}}" title="{{__('auth.Sign up with LinkedIn')}}">
                <h5 class="m-0 font_16 f_w_500">{{__('auth.Sign up with LinkedIn')}}</h5>
            </a>
            @endif

            {{-- <div class="form_sep2 d-flex align-items-center">
                <span class="sep_line flex-fill"></span>
                <span class="form_sep_text font_14 f_w_500 ">{{__('auth.Sign up with Email or Phone')}}</span>
                <span class="sep_line flex-fill"></span>
            </div> --}}
        </div>
        </div>
        </div>
        </div>
        
       
         
           
            
        </div>
    </div>
    {{--   --}}
</div>
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("register_form").submit();
    }
</script>
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $(document).on('submit', '#register_form', function(event){
                if($("#policyCheck").prop('checked')!=true){
                    event.preventDefault();
                    toastr.error("{{__('common.please_agree_with_our_policy_privacy')}}","{{__('common.error')}}");
                    return false;
                }
            });
        });
    })(jQuery);
</script>


<script>
let currentStep = 1;
const totalSteps = 5; // Assuming there are 5 steps in total
function showStep(step) {
    // Hide all steps
    const steps = document.querySelectorAll('.step');
    steps.forEach((element, index) => {
        element.classList.remove('active', 'slide-in-left', 'slide-in-right', 'slide-out-left', 'slide-out-right');
        if (index + 1 === step) {
            element.classList.add('active');
        } else {
            element.style.display = 'none';
        }
    });
    setTimeout(() => {
        // Ensure the new active step is displayed with animation
        document.getElementById(`step-${step}`).style.display = 'block';
    }, 10);
}
function nextStep() {
    if (currentStep < totalSteps) {
        const currentElement = document.getElementById(`step-${currentStep}`);
        currentElement.classList.add('slide-out-left');
        currentStep++;
        const nextElement = document.getElementById(`step-${currentStep}`);
        nextElement.style.display = 'block';
        nextElement.classList.add('slide-in-right', 'active');
        setTimeout(() => {
            currentElement.style.display = 'none';
        }, 500); // Duration of the animation
    }
}
function prevStep() {
    if (currentStep > 1) {
        const currentElement = document.getElementById(`step-${currentStep}`);
        currentElement.classList.add('slide-out-right');
        currentStep--;
        const prevElement = document.getElementById(`step-${currentStep}`);
        prevElement.style.display = 'block';
        prevElement.classList.add('slide-in-left', 'active');
        setTimeout(() => {
            currentElement.style.display = 'none';
        }, 500); // Duration of the animation
    }
}
// Initialize the first step on page load
document.addEventListener("DOMContentLoaded", function () {
    showStep(currentStep);
});
</script>

<script>
 function checkFillstep1() {
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(element) {
            element.textContent = '';
        });

        let isValid = true;

        // Validate fields
        const fields = [

                { id: 'first_name', name: 'First Name' },
                { id: 'last_name', name: 'Last Name' },
                { id: 'email', name: 'Email' },
                { id: 'Company_name', name: 'Company Name' },
                { id: 'Phone_number', name: 'Phone Number' },
                { id: 'password', name: 'Password' },
                { id: 'password-confirm', name: 'Confirm Password' },
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            if (!input.value.trim()) {
                document.getElementById(`${field.id}_error`).textContent = `Please fill this field`;
                isValid = false;
            }
        });

        if (isValid) {
            // Proceed to the next step
            console.log("All fields are filled. Proceeding to the next step...");
            nextStep();
        }
    }

     function checkFillstep2() {
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(element) {
            element.textContent = '';
        });

        let isValid = true;

        // Validate fields
        const fields = [

                { id: 'Billing_address', name: 'Billing Address' },
                { id: 'Shipping_address', name: 'Shipping Aaddress' },
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            if (!input.value.trim()) {
                document.getElementById(`${field.id}_error`).textContent = `Please fill this field`;
                isValid = false;
            }
        });

        if (isValid) {
            // Proceed to the next step
            console.log("All fields are filled. Proceeding to the next step...");
            nextStep();
        }
    }

     function checkFillstep3() {
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(element) {
            element.textContent = '';
        });

        let isValid = true;

        // Validate fields
        const fields = [
            { id: 'special_instructions', name: 'Billing Address' },
            { id: 'accounts_payable_contact_name', name: 'Billing Address' },
            { id: 'accounts_payable_number', name: 'Billing Address' },
            { id: 'accounts_payable_email', name: 'Accounts Payable Email', type: 'email' }, // Specify fields that require email validation
            { id: 'general_liability', name: 'Billing Address' },
            { id: 'preferred_language', name: 'Billing Address' },
            { id: 'preferred_language', name: 'Shipping Address' }
        ];


            fields.forEach(field => {
                const input = document.getElementById(field.id);
                const errorElement = document.getElementById(`${field.id}_error`);

                if (!input.value.trim()) {
                    errorElement.textContent = `Please fill this field`;
                    isValid = false;
                } else {
                    // Check if the field requires email validation
                    if (field.type === 'email') {
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email regex
                        if (!emailPattern.test(input.value.trim())) {
                            errorElement.textContent = `Invalid email format`;
                            isValid = false;
                        } else {
                            errorElement.textContent = ''; // Clear error if email is valid
                        }
                    } else {
                        errorElement.textContent = ''; // Clear error if field is valid
                    }
                }
            });

        if (isValid) {
            // Proceed to the next step
            console.log("All fields are filled. Proceeding to the next step...");
            nextStep();
        }
    }

     function checkFillstep4() {
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(element) {
            element.textContent = '';
        });

        let isValid = true;

        // Validate fields
        const fields = [

                { id: 'years_in_business', name: 'Billing Address' },
                { id: 'number_of_locations', name: 'Billing Address' },
                { id: 'primary_business_function', name: 'Billing Address' },
                { id: 'number_of_rigs', name: 'Billing Address' },
                { id: 'monthly_volume', name: 'Billing Address' },
                { id: 'open_cell_volume', name: 'Billing Address' },
                { id: 'closed_cell_volume', name: 'Billing Address' },
                { id: 'total_volume_previous_year', name: 'Billing Address' },
                { id: 'preferred_foam_brand', name: 'Billing Address' },
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            if (!input.value.trim()) {
                document.getElementById(`${field.id}_error`).textContent = `Please fill this field`;
                isValid = false;
            }
        });

        if (isValid) {
            // Proceed to the next step
            console.log("All fields are filled. Proceeding to the next step...");
            nextStep();
        }
    }
</script>
@endpush
