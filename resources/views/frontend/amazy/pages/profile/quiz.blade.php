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
@section('content')

<div class="amazy_login_area"  style="grid-template-columns: 100% ;">
    <div class="amazy_login_area_left d-flex align-items-center justify-content-center"  style="width:100%;">
        <div class="amazy_login_form" style="width:100%;max-width: 100%;">
        <div class="container"> 
        <div class ="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                    <div class="row"> 
    
                        <div class="col-md-12 text-center">
                    
                            <div class="error-container text-right" style="display: none; background-color: #f8d7da; padding: 10px; border-radius: 5px; color: #721c24; position: relative;">
                                <button class="close-button" style="background: none; border: none; color: #721c24; position: absolute; top: 10px; right: 10px; cursor: pointer;">&times;</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="text-align: start;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        <h3 class=" mb-4">Buyer Form</h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            @if(empty($user->quiz_approved))
                                {{-- Show nothing if quiz_approved is null --}}
                            @elseif($user->quiz_approved === 'approved')
                                {{-- <p>Your quiz is approved</p> --}}
                            @elseif($user->quiz_approved === 'pending')
                                <p class="text-danger">Your Form is submitted, please wait for admin approval.</p>
                            @endif
                        </div>
                        @if($user->quiz_approved === 'approved'  || ($user->quiz_approved === 'pending'))
                         <div class="white_box_50px box_shadow_white">
                            <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="basic-business-info">
                                                <h4>Basic Business Info</h4>
                                                @if(@$user->quiz_approved)
                                                <table class="table table-borderless customer_view">
                                                    <tr><td>{{__('Full Name')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->first_name}}</td></tr>
                                                    <tr><td>{{__('Email')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->email}}</td></tr>
                                                    <tr><td>{{__('Company Name')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->company_name}}</td></tr>
                                                    <tr><td>{{__('Phone Number')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->Phone_number}}</td></tr>
                                                    <tr><td>{{__('Billing Address')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->billing_address}}</td></tr>
                                                    <tr><td>{{__('Shipping Address')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->shipping_address}}</td></tr>
                                                    <tr><td>{{__('Commercial or Residential?')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->commercial_or_residential}}</td></tr>
                                                    <tr><td>{{__('Loading Dock?')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->loading_dock}}</td></tr>
                                                    <tr><td>{{__('Forklift?')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->forklift}}</td></tr>
                                                    <tr><td>{{__('Pallet Jack?')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->pallet_jack}}</td></tr>
                                                    <tr><td>{{__('Call Ahead?')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->call_ahead}}</td></tr>
                                                    <tr><td>{{__('Special Instructions for Deliveries?')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->special_instructions}}</td></tr>
                                                    <tr><td>{{__('Payable Contact Name')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->accounts_payable_contact_name}}</td></tr>
                                                    <tr><td>{{__('Payable Number')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->accounts_payable_number}}</td></tr>
                                                    <tr><td>{{__('Payable Email')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->accounts_payable_email}}</td></tr>
                                                    <tr><td>{{__('Liability Insurance Provider')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->general_liability}}</td></tr>
                                                    <tr><td>{{__('Preferred Language')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->preferred_language}}</td></tr>
                                                </table>
                                                @else
                                                    <p>{{ __('No Quiz found.') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="basic-business-info">
                                                <h4>Detailed Business Info</h4>
                                                @if(@$user->quiz_approved)
                                                <table class="table table-borderless customer_view">
                                                    <tr><td>{{__('Years in Business')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->years_in_business}}</td></tr>
                                                    
                                                    <tr><td>{{__('Number of Locations')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->number_of_locations}}</td></tr>
                                                    <tr><td>{{__('Primary Business Function')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->primary_business_function}}</td></tr>
                                                    <tr><td>{{__('Number of Rigs')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->number_of_rigs}}</td></tr>
                                                    <tr><td>{{__('Monthly Volume')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->monthly_volume}}</td></tr>
                                                    <tr><td>{{__('Open Cell Volume')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->open_cell_volume}}</td></tr>
                                                    <tr><td>{{__('Closed Cell Volume')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->closed_cell_volume}}</td></tr>
                                                    <tr><td>{{__('Total Volume Previous Year')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->total_volume_previous_year}}</td></tr>
                                                    <tr><td>{{__('Preferred Foam Brand')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->preferred_foam_brand}}</td></tr>
                                                </table>
                                                @else
                                                    <p>{{ __('No Quiz found.') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="basic-business-info">
                                                <h4>Equipment Info</h4>
                                                @if(@$user->quiz_approved)
                                                <table class="table table-borderless customer_view">
                                                    <tr><td>{{__('Preferred Rig Type')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->preferred_rig_type}}</td></tr>
                                                    
                                                    <tr><td>{{__('Shore Power or Diesel Generator')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->power_source}}</td></tr>
                                                    <tr><td>{{__('What Brand Proportioners')}}</td>
                                                        <td>: <span class="ml-1"></span>{{@$user->proportioner_brand}}</td></tr>
                                                    <tr><td>{{__('What Model Proportions')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->proportioner_model}}</td></tr>
                                                    <tr><td>{{__('Preferred Spray Gun Brand and Modele')}}</td>
                                                    <td>: <span class="ml-1"></span>{{@$user->preferred_spray_gun}}</td></tr>
                                                    {{-- <tr><td>{{__('common.is_approved')}}</td>
                                                        <td>: <span class="ml-1"></span><label class="switch_toggle" for="active_checkbox{{ @$user->id }}">
                                                            <input type="checkbox" id="active_checkbox{{ @$user->id }}" @if (@$user->quiz_approved == "approved") checked @endif value="{{ @$user->id }}" class="update_approved_quiz">
                                                            <div class="slider round"></div>
                                                        </label></td>
                                                        </tr> --}}
                                                </table>
                                                @else
                                                    <p>{{ __('No Quiz found.') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>


                     @elseif(empty($user->quiz_approved))
                    <div class="mt-5 d-flex justify-content-between"> 
                    <div class="col-md-12"> 
                     
                    <div class="left_side_form">
                    <form action="{{ route('frontend.profile.quiz.store') }}" method="POST"  id="register_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <input type="hidden" name="quiz_approved" value="pending">
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
                                            </div>fCompany Name
            
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
                                {{-- flex div end --}}
                            <div class="d-flex">
                            <div class="step" id="step-1">   
                                   

                                   <h2>Basic Business Info</h2>
                                   <div class="row">
                                   <div class="col-md-6 mb_20">
                                        <label class="primary_label2">Full Name <span>*</span> </label>
                                        <input name="first_name" id="first_name" value="{{ old('first_name', @$user->first_name) }}"  onfocus="this.placeholder = ''"  class="primary_input3 radius_5px" type="text">
                                        {{-- <input name="first_name" id="first_name" value="{{@$user->first_name}}" placeholder="{{ __('common.first_name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.first_name') }}'" class="primary_input3 radius_5px" type="text"> --}}
                                        <span class="text-danger" >{{ $errors->first('first_name') }}</span> <span class="text-danger" id="first_name_error"></span>
                                    </div>
                                    {{-- <div class="col-md-6 mb_20">
                                        <label class="primary_label2">{{__('common.last_name')}}</label>
                                        <input name="last_name" id="last_name" value="{{ old('last_name', @$user->last_name) }}"  onfocus="this.placeholder = ''"  class="primary_input3 radius_5px" type="text">
                                        <span class="text-danger" >{{ $errors->first('last_name') }}</span> <span class="text-danger" id="last_name_error"></span>
                                    </div> --}}
            
                                     @if(isModuleActive('Otp') && otp_configuration('otp_activation_for_customer') || app('business_settings')->where('type', 'email_verification')->first()->status == 0)
                                    <div class="col-md-6 mb_20">
                                        <label class="primary_label2">{{__('common.email')}} <span>*</span></label>
                                        <input name="email" id="email" value="{{ old('email',@$user->email) }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email_or_phone') }}'" class="primary_input3 radius_5px" type="text">
                                        {{-- <input name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('common.email_or_phone') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email_or_phone') }}'" class="primary_input3 radius_5px" type="text"> --}}
                                        <span class="text-danger" >{{ $errors->first('email') }}</span> <span class="text-danger" id="email_error"></span>
                                    </div>
                                    @else
                                    <div class="col-md-6 mb_20">
                                        <label class="primary_label2">{{__('common.email')}} <span>*</span></label>
                                        <input name="email" id="email" value="{{ old('email',@$user->email) }}"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email') }}'" class="primary_input3 radius_5px" type="text">
                                        {{-- <input name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('common.email') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ __('common.email') }}'" class="primary_input3 radius_5px" type="text"> --}}
                                        <span class="text-danger" >{{ $errors->first('email') }}</span> <span class="text-danger" id="email_error"></span>
                                    </div>
                                    @endif
                                    
                                  
                                    {{-- <div class="col-md-6 mb_20">
                                        <label class="primary_label2">{{ __('common.password') }} <span>*</span></label>
                                        <input name="password" id="password"  onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password">
                                        <span class="text-danger" >{{ $errors->first('password') }}</span> <span class="text-danger" id="password_error"></span>
                                    </div>
                                    <div class="col-md-6 mb_20">
                                        <label class="primary_label2" for="password-confirm">{{ __('common.confirm_password') }} <span>*</span></label>
                                        <input name="password_confirmation" id="password-confirm" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('amazy.Min. 8 Character')}}'" class="primary_input3 radius_5px" type="password">
                                          <span class="text-danger" id="password-confirm_error"></span>
                                    </div> --}}
                                    {{@$user->Company_name}}
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="Company_name">Company Name</label>
                                        <input type="text" value="{{ old('Company_name',@$user->company_name) }}" class="form-control primary_input3 radius_5px" id="Company_name" name="Company_name" required>
                                        <span class="text-danger" >{{ $errors->first('Company_name') }}</span> <span class="text-danger" id="Company_name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="Phone_number">Phone Number</label>
                                        <input type="text" value="{{ old('Phone_number',@$user->Phone_number) }}" class="form-control primary_input3 radius_5px" id="Phone_number" name="Phone_number" required>
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
                                        <input type="text" value="{{ old('Billing_address',@$user->billing_address) }}" placeholder="{{ __('Please enter your ZIP code') }}" class="form-control primary_input3 radius_5px" id="Billing_address" name="Billing_address" required onchange="fetchAddressData1()">
                                        <span class="text-danger" id="Billing_address_error"></span>  <span class="text-danger" >{{ $errors->first('Billing_address') }}</span>
                                    </div>
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="Shipping_address">Shipping Address</label>
                                        <input type="text" value="{{ old('Shipping_address',@$user->shipping_address) }}" placeholder="{{ __('Please enter your ZIP code') }}" class="form-control primary_input3 radius_5px" id="Shipping_address" name="Shipping_address"  required  onchange="fetchAddressData()">
                                        <span class="text-danger" id="Shipping_address_error"></span> <span class="text-danger" >{{ $errors->first('Shipping_address') }}</span>
                                    </div>
            
                                     <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="commercial_or_residential">Commercial or Residential?</label>
                                        <select value="{{ old('commercial_or_residential', @$user->commercial_or_residential) }}"  class="form-control primary_input3 radius_5px" id="commercial_or_residential" name="commercial_or_residential" required  >
                                            <option value="commercial">Commercial</option>
                                            <option value="residential">Residential</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="loading_dock">Loading Dock?</label>
                                        <select value="{{ old('loading_dock',@$user->loading_dock) }}" class="form-control primary_input3 radius_5px" id="loading_dock" name="loading_dock" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                   <div  class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="forklift">Forklift?</label>
                                        <select value="{{ old('forklift',@$user->forklift) }}" class="form-control primary_input3 radius_5px" id="forklift" name="forklift" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
            
                                     <div  class="form-group col-md-6 mb_20">
                                        <label class="primary_label2" for="pallet_jack">Pallet Jack?</label>
                                        <select value="{{ old('pallet_jack',@$user->pallet_jack) }}" class="form-control primary_input3 radius_5px" id="pallet_jack" name="pallet_jack" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
            
                                       <div  class="form-group col-md-6 mb_20" style='display:none;'>
                                            <label class="primary_label2" for="hours">Hours?</label>
                                            <select value="{{ old('hours',@$user->hours) }}" class="form-control primary_input3 radius_5px" id="hours" name="hours" >
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
                                            <select  value="{{ old('call_ahead',@$user->call_ahead) }}" class="form-control primary_input3 radius_5px" id="call_ahead" name="call_ahead" required>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
            
                                        <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="special_instructions">Special Instructions for Deliveries?</label>
                                            <textarea id="special_instructions" class="form-control primary_input3 radius_5px" name="special_instructions" style="resize: none; height: 60px;">{{ old('special_instructions',@$user->special_instructions) }}</textarea>
                                            <span class="text-danger" >{{ $errors->first('special_instructions') }}</span> <span class="text-danger" id="special_instructions_error"></span>
                                        </div>
            
            
                                        <div  class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="accounts_payable_contact_name">Accounts Payable Contact Name</label>
                                            <input  value="{{ old('accounts_payable_contact_name',@$user->accounts_payable_contact_name) }}" type="text" id="accounts_payable_contact_name" class="form-control primary_input3 radius_5px" name="accounts_payable_contact_name" required>
                                            <span class="text-danger" >{{ $errors->first('accounts_payable_contact_name') }}</span> <span class="text-danger" id="accounts_payable_contact_name_error"></span>
                                        </div>
            
                                        <div  class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="accounts_payable_number">Accounts Payable Number</label>
                                            <input  value="{{ old('accounts_payable_number',@$user->accounts_payable_number) }}" type="text" id="accounts_payable_number" class="form-control primary_input3 radius_5px" name="accounts_payable_number" required>
                                            <span class="text-danger" >{{ $errors->first('accounts_payable_number') }}</span> <span class="text-danger" id="accounts_payable_number_error"></span>
                                        </div>
            
                                          <div  class="form-group col-md-6 mb_20">
                                            <label  class="primary_label2" for="accounts_payable_email">Accounts Payable Email</label>
                                            <input  value="{{ old('accounts_payable_email',@$user->accounts_payable_email) }}" type="email"  class="form-control primary_input3 radius_5px" id="accounts_payable_email" name="accounts_payable_email" required>
                                            <span class="text-danger" >{{ $errors->first('accounts_payable_email') }}</span> <span class="text-danger" id="accounts_payable_email_error"></span>
                                        </div>
                                         <div  class="form-group col-md-6 mb_20">
                                            <label  class="primary_label2" for="general_liability">Current General Liability Insurance Provider</label>
                                            <input  value="{{ old('general_liability',@$user->general_liability) }}" type="text"  class="form-control primary_input3 radius_5px" id="general_liability" name="general_liability" >
                                            {{-- <input  value="{{ old('general_liability') }}" type="text"  class="form-control primary_input3 radius_5px" id="general_liability" name="general_liability" placeholder="Enter insurance provider"> --}}
                                            <span class="text-danger" >{{ $errors->first('general_liability') }}</span> <span class="text-danger" id="general_liability_error"></span>
                                        </div>
                                        {{-- <div class="form-group col-md-4">
                                            <label for="certifications">List of Current Certifications (Insulation/Roofing)</label>
                                            <input type="file" id="certifications" name="certifications">
                                        </div> --}}
                                          <div  class="form-group col-md-6 mb_20">
                                            <label  class="primary_label2" for="preferred_language">Preferred Language</label>
                                            <input value="{{ old('preferred_language',@$user->preferred_language) }}" type="text"  class="form-control primary_input3 radius_5px" id="preferred_language" name="preferred_language">
                                            {{-- <input value="{{ old('preferred_language') }}" type="text"  class="form-control primary_input3 radius_5px" id="preferred_language" name="preferred_language" placeholder="Enter preferred language"> --}}
                                            <span class="text-danger" >{{ $errors->first('preferred_language') }}</span> <span class="text-danger" id="preferred_language_error"></span>
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
                                                <input value="{{ old('years_in_business',@$user->years_in_business) }}"  type="number" class="form-control primary_input3 radius_5px" id="years_in_business" name="years_in_business" required>
                                                <span class="text-danger" >{{ $errors->first('years_in_business') }}</span> <span class="text-danger" id="years_in_business_error"></span>
                                            </div>
                                            <div  class="form-group col-md-6 mb_20">
                                                <label  class="primary_label2" for="number_of_locations">Number of Locations</label>
                                                <input value="{{ old('number_of_locations',@$user->number_of_locations) }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_locations" name="number_of_locations">
                                                <span class="text-danger" >{{ $errors->first('preferred_rig_type') }}</span> <span class="text-danger" id="number_of_locations_error"></span>
                                            </div>
                                            <div  class="form-group col-md-6 mb_20">
                                                <label  class="primary_label2" for="primary_business_function">Primary Business Function</label>
                                                <input value="{{ old('primary_business_function',@$user->primary_business_function) }}"  type="text" class="form-control primary_input3 radius_5px" id="primary_business_function" name="primary_business_function">
                                                <span class="text-danger" >{{ $errors->first('primary_business_function') }}</span> <span class="text-danger" id="primary_business_function_error"></span>
                                            </div>
            
                                            <div  class="form-group col-md-6 mb_20">
                                                <label class="primary_label2" for="number_of_rigs">Number of Rigs</label>
                                                <input value="{{ old('number_of_rigs',@$user->number_of_rigs) }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_rigs" name="number_of_rigs" >
                                                {{-- <input value="{{ old('number_of_rigs') }}"  type="number" class="form-control primary_input3 radius_5px" id="number_of_rigs" name="number_of_rigs" placeholder="Enter number of rigs"> --}}
                                                <span class="text-danger" >{{ $errors->first('number_of_rigs') }}</span> <span class="text-danger" id="number_of_rigs_error"></span>
                                            </div>
                                            <div  class="form-group col-md-6 mb_20">
                                                <label class="primary_label2" for="monthly_volume">Monthly Volume</label>
                                                <input value="{{ old('monthly_volume',@$user->monthly_volume) }}"  type="number" class="form-control primary_input3 radius_5px" id="monthly_volume" name="monthly_volume" >
                                                {{-- <input value="{{ old('monthly_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="monthly_volume" name="monthly_volume" placeholder="Enter monthly volume"> --}}
                                                <span class="text-danger" >{{ $errors->first('monthly_volume') }}</span> <span class="text-danger" id="monthly_volume_error"></span>
                                            </div>
                                            <div  class="form-group col-md-6 mb_20">
                                                <label class="primary_label2" for="open_cell_volume">Open Cell Volume</label>
                                                <input value="{{ old('open_cell_volume',@$user->open_cell_volume) }}"  type="number" class="form-control primary_input3 radius_5px" id="open_cell_volume" name="open_cell_volume" >
                                                {{-- <input value="{{ old('open_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px" id="open_cell_volume" name="open_cell_volume" placeholder="Enter open cell volume"> --}}
                                                <span class="text-danger" >{{ $errors->first('open_cell_volume') }}</span> <span class="text-danger" id="open_cell_volume_error"></span>
                                            </div>
            
                                            <div class="form-group col-md-6 mb_20">
                                                <label  class="primary_label2" for="closed_cell_volume">Closed Cell Volume</label>
                                                <input value="{{ old('closed_cell_volume',@$user->closed_cell_volume) }}"  type="number" class="form-control primary_input3 radius_5px"  id="closed_cell_volume" name="closed_cell_volume" >
                                                {{-- <input value="{{ old('closed_cell_volume') }}"  type="number" class="form-control primary_input3 radius_5px"  id="closed_cell_volume" name="closed_cell_volume" placeholder="Enter closed cell volume"> --}}
                                                <span class="text-danger" >{{ $errors->first('closed_cell_volume') }}</span> <span class="text-danger" id="closed_cell_volume_error"></span>
                                            </div>
                                            <div  class="form-group col-md-6 mb_20">
                                                <label class="primary_label2" for="total_volume_previous_year">Total Volume Previous Year</label>
                                                <input value="{{ old('total_volume_previous_year',@$user->total_volume_previous_year) }}"  type="number" class="form-control primary_input3 radius_5px"  id="total_volume_previous_year" name="total_volume_previous_year" >
                                                {{-- <input value="{{ old('total_volume_previous_year') }}"  type="number" class="form-control primary_input3 radius_5px"  id="total_volume_previous_year" name="total_volume_previous_year" placeholder="Enter total volume"> --}}
                                                <span class="text-danger" >{{ $errors->first('total_volume_previous_year') }}</span> <span class="text-danger" id="total_volume_previous_year_error"></span>
                                            </div>
                                            <div class="form-group col-md-6 mb_20">
                                                <label  class="primary_label2" for="preferred_foam_brand">Preferred Foam Brand</label>
                                                <input value="{{ old('preferred_foam_brand',@$user->preferred_foam_brand) }}"  type="text" class="form-control primary_input3 radius_5px"  id="preferred_foam_brand" name="preferred_foam_brand" >
                                                {{-- <input value="{{ old('preferred_foam_brand') }}"  type="text" class="form-control primary_input3 radius_5px"  id="preferred_foam_brand" name="preferred_foam_brand" placeholder="Enter preferred foam brand"> --}}
                                                <span class="text-danger" >{{ $errors->first('preferred_foam_brand') }}</span> <span class="text-danger" id="preferred_foam_brand_error"></span>
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
                                                    <input  value="{{ old('preferred_rig_type',@$user->preferred_rig_type) }}" type="text" class="form-control primary_input3 radius_5px" id="preferred_rig_type" name="preferred_rig_type">
                                                    <span class="text-danger" id="preferred_rig_type_error"></span>
                                                    <span class="text-danger" >{{ $errors->first('preferred_rig_type') }}</span> 
                                                </div>
                                               <div class="form-group col-md-6 mb_20">
                                                    <label class="primary_label2" for="power_source">Shore Power or Diesel Generator</label>
                                                    <input  value="{{ old('power_source',@$user->power_source) }}" type="text" class="form-control primary_input3 radius_5px" id="power_source" name="power_source">
                                                    <span class="text-danger" id="power_source_error"></span>
                                                    <span class="text-danger" >{{ $errors->first('power_source') }}</span> 
                                                </div>
                                                <div class="form-group col-md-6 mb_20">
                                                    <label class="primary_label2" for="proportioner_brand">What Brand Proportioners</label>
                                                    <input  value="{{ old('proportioner_brand',@$user->proportioner_brand) }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_brand" name="proportioner_brand">
                                                    <span class="text-danger" id="proportioner_brand_error"></span>
                                                    <span class="text-danger" >{{ $errors->first('proportioner_brand') }}</span> 
                                                </div>
            
                                                <div class="form-group col-md-6 mb_20">
                                                    <label   class="primary_label2"  for="proportioner_model">What Model Proportions</label>
                                                    <input  value="{{ old('proportioner_model',@$user->proportioner_model) }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_model" name="proportioner_model"    >
                                                    <span class="text-danger" id="proportioner_model_error"></span>
                                                    <span class="text-danger" >{{ $errors->first('proportioner_model') }}</span> 
                                                    {{-- <input  value="{{ old('proportioner_model') }}" type="text" class="form-control primary_input3 radius_5px" id="proportioner_model" name="proportioner_model" placeholder="Enter model"> --}}
                                                </div>
                                                <div class="form-group col-md-6 mb_20">
                                                    <label class="primary_label2" for="preferred_spray_gun">Preferred Spray Gun Brand and Model</label>
                                                    <input  value="{{ old('preferred_spray_gun',@$user->preferred_spray_gun) }}" type="text" class="form-control primary_input3 radius_5px" id="preferred_spray_gun" name="preferred_spray_gun" >
                                                    <span class="text-danger" id="preferred_spray_gun_error"></span>
                                                    <span class="text-danger" >{{ $errors->first('preferred_spray_gun') }}</span> 
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
                                        {{-- <button type="submit">Submit</button> --}}
                                        
                                       <div class="col-md-2" >
                                            @if(env('NOCAPTCHA_INVISIBLE') == "true")
                                            <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-size="invisible" data-callback="onSubmit" >Submit</button>
                                            {{-- <button type="button" class="g-recaptcha amaz_primary_btn style2 radius_5px w-100 text-uppercase text-center" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}" data-size="invisible" data-callback="onSubmit" >{{__('auth.Sign Up')}}</button> --}}
                                            @else
                                            <button class=" radius_5px  text-uppercase text-center col-md-2" style="width:210px; background:#103020; color:white; font-weight: bold; height: 54px; border:none;" id="sign_in_btn" >Submit</button>
                                            @endif
                                        </div>
            
            
            
                                    </div>
                                </div>
            
                                <!--<div class="col-12">-->
                                <!--    <p class="sign_up_text">{{__('auth.Already have an Account?')}}  <a href="{{url('/login')}}">{{__('auth.Sign In')}}</a></p>   -->
                                <!--</div>-->
                                
                       </div>
                </div> 
                        {{-- flex div end --}}
                                    
                </div>
            
                           
                            </div>
                        </form>
                    </div> 
                    </div>
                    @endif
            
                    <div class="center_space" style="width: 1px; height: 250px; background-color: #d5d5d5; margin: 20px 20px; display: none; color:white;">.</div>
                    {{-- <div class="center_space" style="width: 1px; height: 250px; background-color: #d5d5d5; margin: 20px 20px; display: inline-block; color:white;">.</div> --}}
            
                    <div class="col-md-3" style="display:none;"> 
                    <div class="right_side_google">
                    {{-- <a href="{{url('/')}}" class="logo mb_50 d-block">
                            <img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}">
                        </a>--}}
                       
                       {{-- <p class="support_text">{{__('auth.See your growth and get consulting support!')}}</p> --}}
            
                        {{-- @if (app('general_setting')->google_status)
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
                        @endif --}}
            
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
async function fetchAddressData() {
    const zipCode = document.getElementById('Shipping_address').value.trim(); // Trim spaces

    if (!zipCode) {
        alert("Please enter a ZIP code.");
        return;
    }

    console.log("ZIP Code Entered:", zipCode);

    const apiKey = 'AIzaSyAUGjdw38Nxt7xbysl0TzoM9kHtj04AJE8'; // Secure your API Key
    const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(zipCode)},US&key=${apiKey}`;

    console.log("Fetching data from URL:", url);

    try {
        const response = await fetch(url, { cache: "no-cache" }); // Prevent caching issues
        const data = await response.json();
        console.log("API Response:", data);

        if (data.status !== "OK" || !data.results.length) {
            alert("Invalid ZIP code or location not found.");
            return;
        }

        const formattedAddress = data.results[0]?.formatted_address || '';
        console.log("Formatted Address:", formattedAddress);

        document.getElementById('Shipping_address').value = formattedAddress;

    } catch (error) {
        console.error("Error fetching data:", error);
        alert("Error fetching address data. Please try again.");
    }
}
</script>

<script>
async function fetchAddressData1() {
    const zipCode = document.getElementById('Billing_address').value;
    
    
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
        const formattedAddress1 = data.results[0]?.formatted_address || '';

        // Populate the corresponding fields
        //document.getElementById('address_line1').value = formattedAddress; // Full formatted address
        document.getElementById('Billing_address').value = formattedAddress1;           // State/Region           // City/Town
       // document.getElementById('appartment_building_suite_other').value = ""; // Clear apartment/building field
    } catch (error) {
        console.error("Error fetching data:", error);
        alert("Error fetching address data: " + error.message);
    }
}


</script>

{{-- <script>
    let currentStep = 1;

    function showStep(step) {
        // Hide all steps
        const steps = document.querySelectorAll('.step');
        steps.forEach((element) => {
            element.style.display = 'none';
        });

        // Show the current step
        document.getElementById(`step-${step}`).style.display = 'block';
    }

    function nextStep() {
        currentStep++;
        showStep(currentStep);
    }

    function prevStep() {
        currentStep--;
        showStep(currentStep);
    }

    // Initialize the first step
    document.addEventListener("DOMContentLoaded", function () {
        showStep(currentStep);
    });
</script> --}}

<script>

let currentStep = {{$currentStep}};

let isInitialLoad = true;

function showStep(step, direction) {
    const steps = document.querySelectorAll('.step');

    // Hide all steps and reset their styles
    steps.forEach((element) => {
        element.style.transition = 'none';
        element.style.opacity = 0;
        element.style.transform = 'translateX(100%)';
        element.style.display = 'none';
    });

    const currentElement = document.getElementById(`step-${step}`);

    // Skip animation if it's the initial load
    if (isInitialLoad) {
        currentElement.style.opacity = 1;
        currentElement.style.transform = 'translateX(0)';
        currentElement.style.display = 'block';
        isInitialLoad = false; // Ensure this only happens once
        return;
    }

    // Determine the direction of the slide animation
    if (direction === 'next') {
        currentElement.style.transform = 'translateX(100%)';
    } else {
        currentElement.style.transform = 'translateX(-100%)';
    }

    // Show the current step with a slide effect
    currentElement.style.display = 'block';
    setTimeout(() => {
        currentElement.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
        currentElement.style.opacity = 1;
        currentElement.style.transform = 'translateX(0)';
    }, 10);
}

function nextStep() {
    currentStep++;
    showStep(currentStep, 'next');
}

function prevStep() {
    currentStep--;
    showStep(currentStep, 'prev');
}

// Initialize the first step without animation
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
              //  { id: 'last_name', name: 'Last Name' },
                { id: 'email', name: 'Email',  type: 'email' },
                { id: 'Company_name', name: 'Company Name' },
                { id: 'Phone_number', name: 'Phone Number' },
               // { id: 'password', name: 'Password' },
               // { id: 'password-confirm', name: 'Confirm Password' },   
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

    function checkFillstep5() {
        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(element) {
            element.textContent = '';
        });

        let isValid = true;

        // Validate fields
        const fields = [

                { id: 'preferred_rig_type', name: 'Billing Address' },
                { id: 'power_source', name: 'Billing Address' },
                { id: 'proportioner_brand', name: 'Billing Address' },
                { id: 'proportioner_model', name: 'Billing Address' },
                { id: 'preferred_spray_gun', name: 'Billing Address' },
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
        }
    }


    function performButtonAction() {
    // Here you can place your button's functionality
    console.log("Button action executed.");
    // For example, if it's a form submission:
    // document.getElementById('yourFormId').submit(); // Replace with your form ID
}







    

// $(document).ready(function() {
//     $('#register_form').submit(function(e) {
//         e.preventDefault();
//         checkFillstep5(); 

//         var token = $('input[name=_token]').val();
//         var formdata = $('#register_form').serialize(); // Serialize the form data correctly

//         $.ajax({
//             type: "post",
//             headers: {'X-CSRF-TOKEN': token},
//             url: "{{ route('register') }}",
//             data: formdata, // Send serialized data
//             dataType: "json",
//             success: function(data) {
//             if(data.success){
//                window.location.href = '{{ route("thankyou_page") }}';
//             }
//             },
//             // error: function(xhr, status, error) {
//             //     Swal.fire('An error occurred: ' + error); // Handle errors
//             // }
//             error: function(xhr, status, error) {
//             //    alert('An error occurred: ' + error);
//             }
//         });
//     });
// });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errors = @json($errors->all()); // Get all error messages as a JavaScript array
        var errorContainer = document.querySelector('.error-container');
        var closeButton = document.querySelector('.close-button');

        if (errors.length > 0) {
            errorContainer.style.display = 'block'; // Show the error container
        }

        // Add click event to the close button
        if (closeButton) {
            closeButton.addEventListener('click', function () {
                errorContainer.style.display = 'none'; // Hide the error container
            });
        }
    });
</script>
@endpush
