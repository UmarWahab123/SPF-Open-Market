@extends('frontend.amazy.layouts.app')
@push('styles')
    <style>
        .pac-container {
            z-index: 10000 !important;
        }
        .primary_file_uploader button {
        font-size: 12px;
        background-color: transparent;
        border: 1px solid #F5F6F9;
        margin-right: 8px;
        border-radius: 4px;
        padding: 3px 10px;
        color: #212529;
        line-height: 1.5;
        text-transform: uppercase;
        }
        .primary_file_uploader button > * {
        color: currentColor;
        }
        .primary_file_uploader button:hover {
            background-color: var(--base_color);
            color: #fff;
            border-color: var(--base_color);
        }
        .primary_file_uploader input::placeholder{
            font-size: 12px;
        }
        .removeUpImage{
            border: 1px solid var(--base_color);
            background-color: var(--background_color);
            border-radius: 100%;
            font-size: 10px;
            --width:22px;
            width: var(--width);
            height: var(--width);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--base_color);
            position: absolute;
            top: -10px;
            right: -7px;
            z-index: 1;
            line-height: 1;
        }
    </style>
@endpush
@section('content')

<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="profile_white_box bg-white">
                    <ul class="nav profile_tabs mb_40" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info" type="button" role="tab" aria-controls="Info" aria-selected="true">{{__('common.basic_info') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Password-tab" data-bs-toggle="tab" data-bs-target="#Password" type="button" role="tab" aria-controls="Password" aria-selected="false">{{__('common.change_password') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="Address-tab" data-bs-toggle="tab" data-bs-target="#Address" type="button" role="tab" aria-controls="Address" aria-selected="false">{{__('common.address') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="language-tab" data-bs-toggle="tab" data-bs-target="#Language" type="button" role="tab" aria-controls="Language" aria-selected="false">{{__('common.language') }}</button>
                        </li>
                         {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="detailed-tab" data-bs-toggle="tab" data-bs-target="#detailed"  type="button" role="tab" aria-controls="detailed" aria-selected="false">Detailed Business Info</button>
                        </li> --}}
                         {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="equipment-tab" data-bs-toggle="tab" data-bs-target="#equipment"  type="button" role="tab" aria-controls="equipment" aria-selected="false">Equipment Info</button>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Info" role="tabpanel" aria-labelledby="Info-tab">
                            <!-- content ::start  -->
                            <div class="dashboard_account_wrapper mb_20">
                                <!-- form  -->
                                <form action="#" name="basic_info" method="POST" id="basic_info" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">Full Name<span>*</span></label>
                                            <input name="first_name" id="first_name" placeholder="{{__('common.first_name')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.first_name')}}'" class="primary_input3 style4" type="text" value="{{$user_info->first_name}}">
                                            <span class="text-danger info_error" id="error_first_name"></span>
                                        </div>
                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">{{__('common.last_name')}}</label>
                                            <input name="last_name" placeholder="{{__('common.last_name')}}" id="last_name" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.last_name')}}'" class="primary_input3 style4" type="text" value="{{$user_info->last_name}}">
                                        </div> --}}
                                        <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">{{__('common.email_address')}}</label>
                                            <input name="email" id="email" placeholder="{{__('common.email_address')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.email_address')}}'" class="primary_input3 style4" type="email" value="{{$user_info->email}}">
                                            <span class="text-danger info_error" id="error_email"></span>
                                        </div>
                                        <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">{{__('common.phone_number')}}</label>
                                            <input name="phone_number" id="phone_number" max="{{  app('general_setting')->max_digit }}" min="{{  app('general_setting')->min_digit }}" placeholder="01XX-XXX-XXX" onfocus="this.placeholder = ''" onblur="this.placeholder = '01XX-XXX-XXX'" class="primary_input3 style4" type="text" value="{{$user_info->Phone_number}}">
                                            <span class="text-danger" id="error_phone"></span>
                                        </div>
                                         {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">Company Name</label>
                                            <input name="company_name" id="company_name" class="primary_input3 style4"  placeholder="Company Name" type="text" value="{{$user_info->company_name}}">
                                            <span class="text-danger info_error" id="error_company_name"></span>
                                        </div> --}}



                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="commercial_or_residential">Commercial or Residential?</label>
                                            <select class="form-control primary_input3 radius_5px" id="commercial_or_residential" name="commercial_or_residential" required>
                                                <option value="commercial" {{ $user_info->commercial_or_residential == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                                <option value="residential" {{ $user_info->commercial_or_residential == 'residential' ? 'selected' : '' }}>Residential</option>
                                            </select>
                                        </div> --}}

                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="loading_dock">Loading Dock?</label>
                                            <select class="form-control primary_input3 radius_5px" id="loading_dock" name="loading_dock" required>
                                                <option value="yes" {{ $user_info->loading_dock == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $user_info->loading_dock == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> --}}

                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="forklift">Forklift?</label>
                                            <select class="form-control primary_input3 radius_5px" id="forklift" name="forklift" required>
                                                <option value="yes" {{ $user_info->forklift == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $user_info->forklift == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> --}}

                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="pallet_jack">Pallet Jack?</label>
                                            <select class="form-control primary_input3 radius_5px" id="pallet_jack" name="pallet_jack" required>
                                                <option value="yes" {{ $user_info->pallet_jack == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $user_info->pallet_jack == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> --}}

                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="call_ahead">Call Ahead?</label>
                                            <select class="form-control primary_input3 radius_5px" id="call_ahead" name="call_ahead" required>
                                                <option value="yes" {{ $user_info->call_ahead == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $user_info->call_ahead == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> --}}

                                        

                                        {{-- <div class="form-group col-md-6 mb_20">
                                            <label class="primary_label2" for="hours">Hours?</label>
                                            <select class="form-control primary_input3 radius_5px" id="hours" name="hours" required>
                                                <option value="yes" {{ $user_info->hours == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $user_info->hours == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> --}}

                                         {{-- <div class="col-12 mb_30" style="display: none">
                                            <label class="primary_label2 style2 ">Hours</label>
                                            <input name="hours" placeholder="hours" id="hours" class="primary_input3 style4" type="text" value="{{$user_info->hours}}">
                                        </div> --}}




                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">Accounts payable number</label>
                                            <input name="accounts_payable_number" placeholder="Accounts payable number" id="accounts_payable_number"  class="primary_input3 style4" type="text" value="{{$user_info->accounts_payable_number}}">
                                        </div> --}}
                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">Accounts payable email</label>
                                            <input name="accounts_payable_email" placeholder="Accounts payable email" id="accounts_payable_email" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.accounts_payable_email')}}'" class="primary_input3 style4" type="text" value="{{$user_info->accounts_payable_email}}">
                                        </div> --}}

                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">General liability</label>
                                            <input name="general_liability" placeholder="General liability" id="general_liability"  class="primary_input3 style4" type="text" value="{{$user_info->general_liability}}">
                                        </div> --}}
                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">Preferred language</label>
                                            <input name="preferred_language" placeholder="Preferred language" id="preferred_language"  class="primary_input3 style4" type="text" value="{{$user_info->preferred_language}}">
                                        </div> --}}

                                        {{-- <div class="col-12 mb_30">
                                            <label class="primary_label2 style2 ">{{__('common.date_of_birth')}}</label>
                                            <input id="start_datepicker" name="date_of_birth" placeholder="06/23/1995" onfocus="this.placeholder = ''" onblur="this.placeholder = '06/23/1995'" class="primary_input3 style4 mb-0" value="{{date('m/d/Y',strtotime($user_info->date_of_birth))}}" type="text">
                                            <span class="text-danger" id="error_date_of_birth"></span>
                                        </div> --}}
                                        {{-- <div class="col-12 mb_25">
                                            <label class="primary_label2 style2 ">{{__('common.description')}}</label>
                                            <textarea id="special_instructions" name="special_instructions" placeholder="{{__('common.description')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.description')}}'" class="primary_textarea4 radius_5px">{{$user_info->special_instructions}}</textarea>
                                        </div> --}}
                                        @if(app('general_setting')->user_info_update == 1)
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="button"  class="amaz_primary_btn style2 rounded-0  text-uppercase  text-center min_200" id="update_info">{{__('common.update_now')}}</button>
                                            </div>
                                        @endif


                                    </div>
                                </form>
                                <!--/ form  -->
                                <div class="account_img_upload">
                                    <div class="showingImageDiv">
                                        <div class="removeUpImage {{$user_info->avatar ? "" : "d-none"}}">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="thumb mb_20">
                                        <img class="img-fluid" id="uploadImgShow" src="{{$user_info->avatar?showImage($user_info->avatar):showImage('frontend/default/img/avatar.jpg')}}" alt="{{@$user_info->first_name}} {{@$user_info->last_name}}" title="{{@$user_info->first_name}} {{@$user_info->last_name}}" id="avaterShow">
                                        </div>
                                    </div>
                                    <div class="primary_file_uploader d-flex align-items-center">
                                        <button type="button">
                                            <label class="primary-btn small fix-gr-bg" for="clickAndUpload">{{__("common.browse")}} </label>
                                            <input type="file" class="d-none setCustomeImageUploadClass" accept="image/*" name="image" id="clickAndUpload" data-name="#linkImageClickId" data-view="#uploadImgShow">
                                        </button>
                                        <input class="primary-input border-0 p-0 ml-2" type="text" id="linkImageClickId" placeholder="{{__('common.browse_image_file')}}" readonly="">
                                    </div>
                                    <label class="primary_input_label font_12" for="">({{ getNumberTranslate(200) }} X
                                        {{ getNumberTranslate(200) }}){{ __('common.px') }}</label>
                                    @error('filter_category_image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>

                            <!-- content ::end  -->
                        </div>
                        <div class="tab-pane fade " id="Password" role="tabpanel" aria-labelledby="Password-tab">
                            <!-- content ::start  -->
                            <form action="#" name="basic_info" method="POST" id="update_pass">
                                <div class="row">
                                    <div class="col-12 mb_30">
                                        <label class="primary_label">{{__('common.current')}} {{__('common.password')}}</label>
                                        <input name="current_password" id="currentPassword" placeholder="{{__('common.current')}} {{__('common.password')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.current')}} {{__('common.password')}}'" class="primary_input3 style3" type="password">
                                        <span class="validation-old-pass-error text-danger error" ></span>
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label">{{__('common.new')}} {{__('common.password')}}</label>
                                        <input name="name" placeholder="{{__('common.new')}} {{__('common.password')}}" id="newPass" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.new')}} {{__('common.password')}}'" class="primary_input3 style3" type="password">
                                        <span class="validation-new-pass-error text-danger error"></span>
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label">{{__('common.re_enter')}} {{__('common.new')}} {{__('common.password')}}</label>
                                        <input name="new_password_confirmation" id="rePass" placeholder="{{__('common.re_enter')}} {{__('common.new')}} {{__('common.password')}}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('common.re_enter')}} {{__('common.new')}} {{__('common.password')}}'" class="primary_input3 style3" type="password">
                                        <span class="validation-new-pass-confirm-error text-danger error"></span>
                                    </div>
                                    <div class="col-12">
                                        <button class="amaz_primary_btn style2 rounded-0  text-uppercase  text-center min_200 change_password">{{__('common.update_now')}}</button>
                                    </div>
                                </div>
                            </form>
                            <!-- content ::end  -->
                        </div>



                        <div class="tab-pane fade" id="equipment" role="tabpanel" aria-labelledby="equipment-tab">
                            <!-- content ::start  -->
                            <form action="#" name="equipment_info" method="POST" id="equipment_info" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Preferred rig type</label>
                                        <input name="preferred_rig_type" placeholder="Preferred rig type" id="preferred_rig_type" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Preferred rig type'" class="primary_input3 style4" type="text" value="{{$user_info->preferred_rig_type}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Shore Power or Diesel Generator</label>
                                        <input name="power_source" placeholder="Power source" id="power_source" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Power source'" class="primary_input3 style4" type="text" value="{{$user_info->power_source}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Proportioner brand</label>
                                        <input name="proportioner_brand" placeholder="Proportioner brand" id="proportioner_brand" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Proportioner brand'" class="primary_input3 style4" type="text" value="{{$user_info->proportioner_brand}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Proportioner model</label>
                                        <input name="proportioner_model" placeholder="Proportioner model" id="proportioner_model" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Proportioner model'" class="primary_input3 style4" type="text" value="{{$user_info->proportioner_model}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Preferred spray gun</label>
                                        <input name="preferred_spray_gun" placeholder="Preferred spray gun" id="preferred_spray_gun" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Preferred spray gun'" class="primary_input3 style4" type="text" value="{{$user_info->preferred_spray_gun}}">
                                    </div>
                                    @if(app('general_setting')->user_info_update == 1)
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="amaz_primary_btn style2 rounded-0 text-uppercase text-center min_200" id="update_equipment">{{__('common.update_now')}}</button>
                                    </div>
                                    @endif
                                </div>
                            </form>
                            <!-- content ::end  -->
                        </div>


                        
                       <div class="tab-pane fade" id="detailed" role="tabpanel" aria-labelledby="detailed-tab">
                            <!-- content ::start  -->
                            <form action="#" name="detailed_info" method="POST" id="detailed_info" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Years in Business</label>
                                        <input name="years_in_business" placeholder="Years in Business" id="years_in_business" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Years in Business'" class="primary_input3 style4" type="text" value="{{$user_info->years_in_business}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Number of Locations</label>
                                        <input name="number_of_locations" placeholder="Number of Locations" id="number_of_locations" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Number of Locations'" class="primary_input3 style4" type="text" value="{{$user_info->number_of_locations}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Primary Business Function</label>
                                        <input name="primary_business_function" placeholder="Primary Business Function" id="primary_business_function" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary Business Function'" class="primary_input3 style4" type="text" value="{{$user_info->primary_business_function}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Number of Rigs</label>
                                        <input name="number_of_rigs" placeholder="Number of Rigs" id="number_of_rigs" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Number of Rigs'" class="primary_input3 style4" type="text" value="{{$user_info->number_of_rigs}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Monthly Volume</label>
                                        <input name="monthly_volume" placeholder="Monthly Volume" id="monthly_volume" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Monthly Volume'" class="primary_input3 style4" type="text" value="{{$user_info->monthly_volume}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Open Cell Volume</label>
                                        <input name="open_cell_volume" placeholder="Open Cell Volume" id="open_cell_volume" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Open Cell Volume'" class="primary_input3 style4" type="text" value="{{$user_info->open_cell_volume}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Closed Cell Volume</label>
                                        <input name="closed_cell_volume" placeholder="Closed Cell Volume" id="closed_cell_volume" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Closed Cell Volume'" class="primary_input3 style4" type="text" value="{{$user_info->closed_cell_volume}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Total Volume Previous Year</label>
                                        <input name="total_volume_previous_year" placeholder="Total Volume Previous Year" id="total_volume_previous_year" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Total Volume Previous Year'" class="primary_input3 style4" type="text" value="{{$user_info->total_volume_previous_year}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Preferred Foam Brand</label>
                                        <input name="preferred_foam_brand" placeholder="Preferred Foam Brand" id="preferred_foam_brand" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Preferred Foam Brand'" class="primary_input3 style4" type="text" value="{{$user_info->preferred_foam_brand}}">
                                    </div>
                                    @if(app('general_setting')->user_info_update == 1)
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="amaz_primary_btn style2 rounded-0 text-uppercase text-center min_200" id="update_detailed_info">{{__('common.update_now')}}</button>
                                    </div>
                                    @endif
                                </div>
                            </form>
                            <!-- content ::end  -->
                        </div>



                        <div class="tab-pane fade " id="Address" role="tabpanel" aria-labelledby="Address-tab">
                                    {{-- <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Billing Address</label>
                                        <input name="preferred_foam_brand"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Preferred Foam Brand'" class="primary_input3 style4" value="{{$user_info->billing_address}}">
                                    </div>
                                    <div class="col-12 mb_30">
                                        <label class="primary_label2 style2">Shipping Address</label>
                                        <input name="preferred_foam_brand"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Preferred Foam Brand'" class="primary_input3 style4"  value="{{$user_info->shipping_address}}">
                                    </div> --}}
                            <!-- content ::start  -->
                            <div class="table-responsive mb_30">
                                <table class="table amazy_table style6 mb-0" id="address_table">
                                    @include('frontend.amazy.pages.profile.partials._table')
                                </table>
                            </div>
                            <a href="#" class="add_new_address amaz_primary_btn style2 rounded-0 text-uppercase text-center min_200">{{__('common.add_new_address')}}</a>
                            <!-- content ::end  -->
                        </div>

                        <div class="tab-pane fade " id="Language" role="tabpanel" aria-labelledby="language-tab">
                            @php
                                $langs = app('langs');
                                $currencies = app('currencies');
                                $locale = app('general_setting')->language_code;
                                $currency_code = app('general_setting')->currency_code;
                                $ship = app('general_setting')->country_name;
                                if(\Session::has('locale')){
                                    $locale = \Session::get('locale');
                                }
                                if(\Session::has('currency')){
                                    $currency = \Modules\GeneralSetting\Entities\Currency::where('id', session()->get('currency'))->first();
                                    $currency_code = $currency->code;
                                }

                                if(auth()->check()){
                                    $currency_code = auth()->user()->currency_code;
                                    $locale = auth()->user()->lang_code;
                                }
                            @endphp
                            <!-- content ::start  -->
                            <form action="{{route('frontend.locale')}}" name="basic_info" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb_30">
                                        <div class="form-group input_div_mb">
                                            <label class="primary_label2 style4">{{ __('defaultTheme.language') }} <span>*</span></label>
                                            <select class="theme_select style2 wide" name="lang" autocomplete="off">
                                                <option value="">{{__('defaultTheme.select_from_options')}}</option>
                                                @foreach($langs as $key => $lang)
                                                    <option {{ $locale == $lang->code?'selected':'' }} value="{{$lang->code}}">
                                                    {{$lang->native}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger" id="error_country"></span>
                                    </div>
                                    <div class="col-12 mb_30">
                                        <div class="form-group input_div_mb">
                                            <label class="primary_label2 style4">{{ __('defaultTheme.currency') }} <span>*</span></label>
                                            <select class="theme_select style2 wide" name="currency" autocomplete="off">
                                                <option value="">{{__('defaultTheme.select_from_options')}}</option>
                                                @foreach($currencies as $key => $item)
                                                <option {{$currency_code==$item->code?'selected':'' }}
                                                    value="{{$item->id}}">
                                                    {{$item->name}} ({{$item->symbol}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger" id="error_country"></span>
                                    </div>
                                    <div class="col-12">
                                        <button class="amaz_primary_btn style2 rounded-0  text-uppercase  text-center min_200">{{ __('defaultTheme.save_change') }}</button>
                                    </div>
                                </div>
                            </form>
                            <!-- content ::end  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.amazy.partials._delete_modal_for_ajax',['item_name' => __('common.address'),'form_id' => 'adrs_delete_form','modal_id' => 'adrs_delete_modal'])
</div>
@include('frontend.amazy.pages.profile.partials._form')
<div id="address_form_div_edit"></div>
@endsection
@push('scripts')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click','#remove_image',function(e){
                    e.preventDefault();
                  $('#deleteCP').removeAttr('src');
                  $('#deleteCP').setAttr('src','delete');
                });
                $(document).on('click','#update_info',function(e){
                    e.preventDefault();

                    var formElement = $('#basic_info').serializeArray();
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "{{ csrf_token() }}");
                    let avatar = $('#clickAndUpload')[0].files[0];
                    if (avatar) {
                        formData.append('avatar', avatar)
                    }

                    $('#pre-loader').show();
                        basic_info_remove_validate_error();
                        $.ajax({
                            url: "{{route('customer.update.info')}}",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                $('.info_error').text('');
                                $('#first_name').val(response.first_name);
                                $('#last_name').val(response.last_name);
                               // $('#accounts_payable_email').val(response.accounts_payable_email);
                               // $('#commercial_or_residential').val(response.commercial_or_residential);
                               // $('#general_liability').val(response.general_liability);
                               // $('#preferred_language').val(response.preferred_language);
                               // $('#accounts_payable_number').val(response.accounts_payable_number);
                               // $('#call_ahead').val(response.call_ahead);
                              //  $('#pallet_jack').val(response.pallet_jack);
                              //  $('#forklift').val(response.forklift);
                             //   $('#loading_dock').val(response.loading_dock);
                             //   $('#company_name').val(response.company_name);
                                $('#email').val(response.email);
                              //  $('#phone').val(response.phone);
                              //  $('#special_instructions').text(response.special_instructions);
                                if(avatar){
                                    if(response.avatar.includes('amazonaws.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('digitaloceanspaces.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('drive.google.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('wasabisys.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('backblazeb2.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('dropboxusercontent.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('storage.googleapis.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('contabostorage.com')){
                                        var image_path = response.avatar;
                                    }else if(response.avatar.includes('b-cdn.net')){
                                        var image_path = sku.variant_image;
                                    }else{
                                        var image_path="{{asset(asset_path(''))}}" + "/"+response.avatar;
                                    }
                                    if (image_path != '') {
                                        $('#customerMiniImage').attr('src',image_path);
                                    }else{
                                        $('#customerMiniImage').attr('src',"{{ showImage('frontend/default/img/avatar.jpg') }}");
                                    }
                                    $('#customer_avater').attr('src',image_path);
                                }
                                $('#file').val('');
                                toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                                $('#pre-loader').hide();
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                basic_info_update_validate_error(response);
                                $('#pre-loader').hide();
                            }
                        });

                });
                function basic_info_update_validate_error(response){
                    $('.info_error').text('');
                    $('#error_first_name').text(response.responseJSON.errors.first_name);
                    $('#error_accounts_payable_email').text(response.responseJSON.errors.accounts_payable_email);
                    $('#loading_dock').text(response.responseJSON.errors.loading_dock);
                    $('#error_commercial_or_residential').text(response.responseJSON.errors.commercial_or_residential);
                    $('#error_general_liability').text(response.responseJSON.errors.general_liability);
                    $('#error_preferred_language').text(response.responseJSON.errors.preferred_language);
                    $('#error_special_instructions').text(response.responseJSON.errors.special_instructions);
                    $('#error_accounts_payable_number').text(response.responseJSON.errors.accounts_payable_number);
                    $('#error_call_ahead').text(response.responseJSON.errors.call_ahead);
                    $('#error_pallet_jack').text(response.responseJSON.errors.pallet_jack);
                    $('#error_forklift').text(response.responseJSON.errors.forklift);
                    $('#error_company_name').text(response.responseJSON.errors.company_name);
                    $('#error_email').text(response.responseJSON.errors.email);
                    $('#error_phone').text(response.responseJSON.errors.phone);
                    $('#error_date_of_birth').text(response.responseJSON.errors.date_of_birth);
                    $('#error_avatar').text(response.responseJSON.errors.avatar);
                }
                function basic_info_remove_validate_error(){
                    $('#error_first_name').text('');
                    $('#error_email').text('');
                    $('#error_phone').text('');
                    $('#error_date_of_birth').text('');
                    $('#error_avatar').text('');
                }


              
                $(document).on('click','#update_equipment',function(e){
                    e.preventDefault();

                    var formElement = $('#equipment_info').serializeArray();
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "{{ csrf_token() }}");
                    $('#pre-loader').show();
                        
                        $.ajax({
                            url: "{{route('customer.equipmentupdate.info')}}",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                $('.info_error').text('');
                                $('#preferred_rig_type').val(response.preferred_rig_type);
                                $('#power_source').val(response.power_source);
                                $('#proportioner_brand').val(response.proportioner_brand);
                                $('#proportioner_model').val(response.proportioner_model);
                                $('#preferred_spray_gun').val(response.preferred_spray_gun);

                                $('#file').val('');
                                toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                                $('#pre-loader').hide();
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                $('#pre-loader').hide();
                            }
                        });
                });
                

                $(document).on('click','#update_detailed_info',function(e){
                    e.preventDefault();

                    var formElement = $('#detailed_info').serializeArray();
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "{{ csrf_token() }}");
                    $('#pre-loader').show();
                        
                        $.ajax({
                            url: "{{route('customer.detailed.info')}}",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function(response) {
                                $('.info_error').text('');
                                $('#years_in_business').val(response.years_in_business);
                                $('#number_of_locations').val(response.number_of_locations);
                                $('#primary_business_function').val(response.primary_business_function);
                                $('#number_of_rigs').val(response.number_of_rigs);
                                $('#monthly_volume').val(response.monthly_volume);
                                $('#open_cell_volume').val(response.open_cell_volume);
                                $('#closed_cell_volume').val(response.closed_cell_volume);
                                $('#total_volume_previous_year').val(response.total_volume_previous_year);
                                $('#preferred_foam_brand').val(response.preferred_foam_brand);

                                $('#file').val('');
                                toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                                $('#pre-loader').hide();
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                $('#pre-loader').hide();
                            }
                        });
                });








                $(document).on('click','.change_password', function(e){
                    e.preventDefault();
                    $('#pre-loader').show();
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('current_password',$('#currentPassword').val());
                    formData.append('new_password',$('#newPass').val());
                    formData.append('new_password_confirmation',$('#rePass').val());
                    $.ajax({
                        url: "{{route('cusotmer.update.password')}}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('.error').text('');
                            $("#update_pass").trigger("reset");
                            toastr.success(response, "{{__('common.success')}}");
                            $('#pre-loader').hide();

                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            $('.error').text('');
                            if (response.responseJSON.errors.current_password) {
                                $('.validation-old-pass-error').text(response.responseJSON.errors.current_password);
                            }
                            if (response.responseJSON.errors.new_password) {
                                $('.validation-new-pass-error').text(response.responseJSON.errors.new_password);
                            }
                            if (response.responseJSON.errors.new_password_confirmation) {
                                $('.validation-new-pass-confirm-error').text(response.responseJSON.errors.new_password_confirmation);
                            }
                            $('#pre-loader').hide();
                        }
                    });
                });
                //address
                $(document).on('click','.add_new_address',function(e){
                    e.preventDefault();
                    $('#Address_modal').modal('show');
                });
                $(document).on('click','.default_setup_shipping',function(){
                    var c_id= $("input[name='dft_adrs_shipping']:checked").attr('c_id');
                    var c_list_id= $("input[name='dft_adrs_shipping']:checked").attr('c_list_id');
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('c_id', c_id);
                    formData.append('c_list_id', c_list_id);
                    $.ajax({
                        url: "{{ route('customer.address.default.shipping') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#address_table').html(response.addressList);
                            $('#default_shipping_adrs').html(response.addressListForShipping);
                            $('#default_billing_adrs').html(response.addressListForBilling);

                            $('#default_shipping_adrs').addClass('d-none');
                            $('#address_list').removeClass('d-none');
                            toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                });
                $(document).on('click','.default_setup_billing',function(){
                    var c_id= $("input[name='dft_adrs_billing']:checked").attr('c_id');
                    var c_list_id= $("input[name='dft_adrs_billing']:checked").attr('c_list_id');
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('c_id', c_id);
                    formData.append('c_list_id', c_list_id);
                    $.ajax({
                        url: "{{ route('customer.address.default.billing') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#address_table').html(response.addressList);
                            $('#default_billing_adrs').html(response.addressListForBilling);
                            $('#default_billing_adrs').addClass('d-none');
                            $('#address_list').removeClass('d-none');
                            toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                        }
                    });
                });
                //store address
                $(document).on('submit', '#address_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').show();
                    removeValidateError('#address_form');
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    var formElement = $(this).serializeArray()
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    $.ajax({
                        url: "{{ route('customer.address.store') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $('#address_table').html(response.addressList);
                            $('#Address_modal').modal('hide');
                            $('#pre-loader').hide();
                            $('#address_form')[0].reset();
                            toastr.success("{{__('common.added_successfully')}}", "{{__('common.success')}}");
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            showValidateError('#address_form', response.responseJSON.errors);
                            $('#pre-loader').hide();
                        }
                    });
                });
                //update address
                $(document).on('submit', '#address_form_edit', function(event) {
                    event.preventDefault();
                    $('#pre-loader').show();
                    removeValidateError('#address_form_edit');
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    var formElement = $(this).serializeArray()
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    $.ajax({
                        url: "{{ route('customer.address.update') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {

                            $('#address_table').html(response.addressList);
                            $('#default_shipping_adrs').html(response.addressListForShipping);
                            $('#default_billing_adrs').html(response.addressListForBilling);
                            $('#Address_edit_modal').modal('hide');
                            $('#address_form_div_edit').html('');

                            toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                            $('#pre-loader').hide();
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            showValidateError('#address_form_edit', response.responseJSON.errors);
                            $('#pre-loader').hide();
                        }
                    });
                });
                $(document).on('submit', '#adrs_delete_form', function(event) {
                    event.preventDefault();
                    $('#pre-loader').show();
                    $('#adrs_delete_modal').modal('hide');
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('id', $('#delete_item_id').val());
                    $.ajax({
                        url: "{{ route('customer.address.delete') }}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            if(response == 'is_used'){
                                toastr.error("{{__('customer_panel.address_already_used_for_shipping_or_billing_address')}}", "{{__('common.error')}}");
                                $('#pre-loader').hide();
                            }
                            else if(response == 'is_default'){
                                toastr.error("{{__('customer_panel.address_already_set_for_default_shipping_or_billing_change_first')}}", "{{__('common.error')}}");
                                $('#pre-loader').hide();
                            }
                            else{
                                toastr.success("{{__('common.deleted_successfully')}}");
                                $('#address_table').html(response.addressList);
                                $('#pre-loader').hide();
                            }
                        },
                        error: function(response) {
                            if(response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                                return false;
                            }
                            toastr.error("{{__('common.address_already_used')}}", "{{__('common.error')}}");
                            $('#pre-loader').hide();
                        }
                    });
                });

                $(document).on('change', '#country', function(event){
                    let country = $('#country').val();
                    $('#pre-loader').show();
                    if(country){
                        let base_url = $('#url').val();
                        let url = base_url + '/seller/profile/get-state?country_id=' +country;
                        $('#state').empty();
                        $('#state').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $('#state').niceSelect('update');
                        $('#city').empty();
                        $('#city').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $('#city').niceSelect('update');
                        $.get(url, function(data){
                            $.each(data, function(index, stateObj) {
                                $('#state').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                            });
                            $('#state').niceSelect('update');
                            $('#pre-loader').hide();
                        });
                    }
                });
                $(document).on('change', '#country_edit', function(event){
                    let country = $('#country_edit').val();
                    $('#pre-loader').show();
                    if(country){
                        let base_url = $('#url').val();
                        let url = base_url + '/seller/profile/get-state?country_id=' +country;
                        $('#state_edit').empty();
                        $('#state_edit').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $('#state_edit').niceSelect('update');
                        $('#city_edit').empty();
                        $('#city_edit').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $('#city_edit').niceSelect('update');
                        $.get(url, function(data){
                            $.each(data, function(index, stateObj) {
                                $('#state_edit').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                            });
                            $('#state_edit').niceSelect('update');
                            $('#pre-loader').hide();
                        });
                    }
                });
                $(document).on('change', '#state', function(event){
                    let state = $('#state').val();
                    $('#pre-loader').show();
                    if(state){
                        let base_url = $('#url').val();
                        let url = base_url + '/seller/profile/get-city?state_id=' +state;
                        $('#city').empty();
                        $('#city').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $.get(url, function(data){
                            $.each(data, function(index, cityObj) {
                                $('#city').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                            });
                            $('#city').niceSelect('update');
                            $('#pre-loader').hide();
                        });
                    }
                });
                $(document).on('change', '#state_edit', function(event){
                    let state = $('#state_edit').val();
                    $('#pre-loader').show();
                    if(state){
                        let base_url = $('#url').val();
                        let url = base_url + '/seller/profile/get-city?state_id=' +state;
                        $('#city_edit').empty();
                        $('#city_edit').append(
                            `<option value="">{{__("common.select_from_options")}}</option>`
                        );
                        $.get(url, function(data){
                            $.each(data, function(index, cityObj) {
                                $('#city_edit').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                            });
                            $('#city_edit').niceSelect('update');
                            $('#pre-loader').hide();
                        });
                    }
                });
                $(document).on('change', '.profile_image', function(event){
                    imageChangeWithFile($(this)[0],'#avaterShow');
                    getFileName2($(this).val(),'#file_name_text');
                });

                function getFileName2(value, placeholder){
                    if (value) {
                        var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
                        var filename = value.substring(startIndex);
                        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                            filename = filename.substring(1);
                        }
                        $(placeholder).text('');
                        $(placeholder).text(filename);
                    }
                }

                $(document).on('click', '.edit_address', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    editAddress(id);
                });

                function editAddress(c_id){
                    $('#pre-loader').show();
                    let base_url = $('#url').val();
                    let url = base_url + '/customer/address/edit/'+c_id;
                    $.ajax({
                        url: url,
                        type: "GET",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#address_form_div_edit').html(response);
                            $('#Address_edit_modal').modal('show');
                            $('#country_edit').niceSelect();
                            $('#state_edit').niceSelect();
                            $('#city_edit').niceSelect();
                            $('#address_list').addClass('d-none');
                            if (response.is_shipping_default==1 || response.is_billing_default==1) {
                                $('#dlt_adrs').addClass('d-none');
                            }
                            else{
                                $('#dlt_adrs').removeClass('d-none');
                            }
                            $('#pre-loader').hide();
                            initAutocompleteEdit();
                        },
                        error: function(response) {
                            toastr.error('{{__("common.error_message")}}','{{__("common.error")}}')
                            $('#pre-loader').hide();
                        }

                    });

                }

                $(document).on('click', '.delete_address_btn', function(event){
                    event.preventDefault();
                    let id = $(this).data('id');
                    $('#delete_item_id').val(id);
                    $('#adrs_delete_modal').modal('show');
                });

                function showValidateError(formId, errors){
                    $(formId + ' #error_name').text(errors.name);
                    $(formId + ' #error_email').text(errors.email);
                    $(formId + ' #error_phone').text(errors.phone);
                    $(formId + ' #error_address').text(errors.address);
                    $(formId + ' #error_country').text(errors.country);
                    $(formId + ' #error_state').text(errors.state);
                    $(formId + ' #error_city').text(errors.city);
                    $(formId + ' #error_postcode').text(errors.postal_code);
                }

                function removeValidateError(formId){
                    $(formId + ' #error_name').text('');
                    $(formId + ' #error_email').text('');
                    $(formId + ' #error_phone').text('');
                    $(formId + ' #error_address').text('');
                    $(formId + ' #error_country').text('');
                    $(formId + ' #error_state').text('');
                    $(formId + ' #error_city').text('');
                    $(formId + ' #error_postcode').text('');
                }

            });
        })(jQuery);


    </script>
    <script>
        $(document).on('change', '.setCustomeImageUploadClass', function(event){
            let name = $(this).data('name');
            let view = $(this).data('view');
            getFileName($(this).val(),name);
            imageChangeWithFile($(this)[0], view);
            $('.removeUpImage').removeClass('d-none');
        });

        $(".removeUpImage").click(function(){
            var img_src = $('#uploadImgShow').attr('src');
            if (img_src == '') {
                return false;
            }
            $('#pre-loader').show();
            $('#linkImageClickId').attr('placeholder', '{{__('common.browse_image_file')}}');
            $('.removeUpImage').addClass('d-none');
            $('#uploadImgShow').attr("src","{{ showImage('frontend/default/img/avatar.jpg') }}");
            $('#customerMiniImage').attr("src","{{ showImage('frontend/default/img/avatar.jpg') }}");
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('image',img_src);
            $.ajax({
                    url: "{{ route('customer.profile.image.delete') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                            toastr.success("{{__('common.deleted_successfully')}}");
                            $('#pre-loader').hide();
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').hide();
                            return false;
                        }
                        toastr.error("{{__('common.address_already_used')}}", "{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                    }
                });
        });
    </script>

<?php if (config('app.map_api_status') == "true") { ?>
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.map_api_key')}}&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
    <script>

        let autocomplete;
        let address1Field;
        let postalField;
        function initAutocomplete() {
            address1Field = document.querySelector("#address");
            postalField = document.querySelector("#postal_code");
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
                componentRestrictions: { country: [@if(config('app.map_api_country_1') != "" ) "{{config('app.map_api_country_1')}}" @endif @if(config('app.map_api_country_2') != "" ) ,"{{config('app.map_api_country_2')}}" @endif @if(config('app.map_api_country_3') != "" ) ,"{{config('app.map_api_country_3')}}" @endif @if(config('app.map_api_country_4') != "" ) ,"{{config('app.map_api_country_4')}}" @endif @if(config('app.map_api_country_5') != "" ) ,"{{config('app.map_api_country_5')}}" @endif] },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });
            address1Field.focus();
            autocomplete.addListener("place_changed", fillInAddress);
        }
        function fillInAddress() {
            const place = autocomplete.getPlace();
            let address1 = "";
            let postal_code = "";
            let countryId = "";
            let state_list = [];
            let city_list = [];
            postalField.value = postal_code;

            for (const component of place.address_components) {
                const componentType = component.types[0];

                if ( componentType == 'country') {
                    const country = component.long_name;
                    $("#country option").each(function(i,e)
                    {
                        if (country == e.innerHTML ) {
                            countryId = e.value;
                            $(this).attr('selected', true);
                        }else{
                            $(this).attr('selected', false);
                        }

                    })
                    $('#country').niceSelect('update');
                    $('#pre-loader').show();
                    //change country
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-state?country_id=' + countryId;

                    $('#state').empty();

                    $('#state').append(
                        `<option value="">{{__("common.select_from_options")}}</option>`
                    );
                    $('#state').niceSelect('update');
                    $('#city').empty();
                    $('#city').append(
                        `<option value="">{{__("common.select_from_options")}}</option>`
                    );
                    $('#city').niceSelect('update');
                    $.get(url, function(data) {

                        $.each(data, function(index, stateObj) {
                            $('#state').append('<option value="' + stateObj
                                .id + '">' + stateObj.name + '</option>');
                            state_list.push(stateObj.name);
                        });
                        $('#state').niceSelect('update');
                        $('#pre-loader').hide();
                        for (const component of place.address_components) {
                            const componentType = component.types[0];
                            if ( componentType == 'locality' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state').niceSelect('update');

                                getAndSelectCity(stateId);

                            }
                            else if ( componentType == 'administrative_area_level_2' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state').niceSelect('update');

                                // get city list
                                getAndSelectCity(stateId);
                            }
                            else if ( componentType == 'administrative_area_level_1' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state').niceSelect('update');

                                // get city list
                                getAndSelectCity(stateId);
                            }
                        }
                    });
                }
                if(componentType == 'postal_code'){
                    postalField.value = component.long_name;
                }


            }

            function getAndSelectCity(stateId){
                // get city list
                let base_url = $('#url').val();
                let url = base_url + '/seller/profile/get-city?state_id=' +stateId;

                $('#city').empty();
                $('#city').append(
                    `<option value="">{{__("common.select_from_options")}}</option>`
                );
                $('#pre-loader').show();
                $.get(url, function(data){

                    $.each(data, function(index, cityObj) {
                        $('#city').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                        city_list.push(cityObj.name);
                    });

                    $('#city').niceSelect('update');
                    $('#pre-loader').hide();

                    for (const component of place.address_components) {
                        const componentType = component.types[0];
                        if ( componentType == 'sublocality_level_2' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }
                        else if ( componentType == 'sublocality_level_1' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }
                        else if ( componentType == 'locality' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }
                        else if ( componentType == 'locality' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }
                        else if ( componentType == 'administrative_area_level_2' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }
                        else if ( componentType == 'administrative_area_level_1' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city').niceSelect('update');
                        }

                    }
                });
            }
        }
        window.initAutocomplete = initAutocomplete;


    </script>
    <script>

        let autocompleteEdit;
        let address1FieldEdit;
        let postalFieldEdit;
        function initAutocompleteEdit() {
            address1FieldEdit = document.querySelector("#address_edit");
            postalFieldEdit = document.querySelector("#postal_code_edit");
            autocompleteEdit = new google.maps.places.Autocomplete(address1FieldEdit, {
                componentRestrictions: { country: [@if(config('app.map_api_country_1') != "" ) "{{config('app.map_api_country_1')}}" @endif @if(config('app.map_api_country_2') != "" ) ,"{{config('app.map_api_country_2')}}" @endif @if(config('app.map_api_country_3') != "" ) ,"{{config('app.map_api_country_3')}}" @endif @if(config('app.map_api_country_4') != "" ) ,"{{config('app.map_api_country_4')}}" @endif @if(config('app.map_api_country_5') != "" ) ,"{{config('app.map_api_country_5')}}" @endif] },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });
            address1FieldEdit.focus();
            autocompleteEdit.addListener("place_changed", fillInAddressEdit);
        }
        function fillInAddressEdit() {
            const place = autocompleteEdit.getPlace();
            let address1 = "";
            let postal_code = "";
            let countryId = "";
            let state_list = [];
            let city_list = [];
            postalField.value = postal_code;

            for (const component of place.address_components) {
                const componentType = component.types[0];

                if ( componentType == 'country') {
                    const country = component.long_name;
                    $("#country_edit option").each(function(i,e)
                    {
                        if (country == e.innerHTML ) {
                            countryId = e.value;
                            $(this).attr('selected', true);
                        }else{
                            $(this).attr('selected', false);
                        }

                    })
                    $('#country_edit').niceSelect('update');
                    $('#pre-loader').show();
                    //change country
                    let base_url = $('#url').val();
                    let url = base_url + '/seller/profile/get-state?country_id=' + countryId;

                    $('#state_edit').empty();

                    $('#state_edit').append(
                        `<option value="">{{__("common.select_from_options")}}</option>`
                    );
                    $('#state_edit').niceSelect('update');
                    $('#city_edit').empty();
                    $('#city_edit').append(
                        `<option value="">{{__("common.select_from_options")}}</option>`
                    );
                    $('#city_edit').niceSelect('update');
                    $.get(url, function(data) {

                        $.each(data, function(index, stateObj) {
                            $('#state_edit').append('<option value="' + stateObj
                                .id + '">' + stateObj.name + '</option>');
                            state_list.push(stateObj.name);
                        });
                        $('#state_edit').niceSelect('update');
                        $('#pre-loader').hide();
                        for (const component of place.address_components) {
                            const componentType = component.types[0];
                            if ( componentType == 'locality' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state_edit option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state_edit').niceSelect('update');

                                getAndSelectCityEdit(stateId);

                            }
                            else if ( componentType == 'administrative_area_level_2' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state_edit option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state_edit').niceSelect('update');

                                // get city list
                                getAndSelectCityEdit(stateId);
                            }
                            else if ( componentType == 'administrative_area_level_1' && state_list.includes(component.long_name)) {
                                state = component.long_name
                                $("#state_edit option").each(function(i,e)
                                {
                                    if (state == e.innerHTML ) {
                                        stateId = e.value;
                                        $(this).attr('selected', true);
                                    }else{
                                        $(this).attr('selected', false);
                                    }
                                })
                                $('#state_edit').niceSelect('update');

                                // get city list
                                getAndSelectCityEdit(stateId);
                            }
                        }
                    });
                }
                if(componentType == 'postal_code'){
                    postalField.value = component.long_name;
                }


            }

            function getAndSelectCityEdit(stateId){
                // get city list
                let base_url = $('#url').val();
                let url = base_url + '/seller/profile/get-city?state_id=' +stateId;

                $('#city_edit').empty();
                $('#city_edit').append(
                    `<option value="">{{__("common.select_from_options")}}</option>`
                );
                $('#pre-loader').show();
                $.get(url, function(data){

                    $.each(data, function(index, cityObj) {
                        $('#city_edit').append('<option value="'+ cityObj.id +'">'+ cityObj.name +'</option>');
                        city_list.push(cityObj.name);
                    });

                    $('#city_edit').niceSelect('update');
                    $('#pre-loader').hide();

                    for (const component of place.address_components) {
                        const componentType = component.types[0];
                        if ( componentType == 'sublocality_level_2' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }
                        else if ( componentType == 'sublocality_level_1' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }
                        else if ( componentType == 'locality' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }
                        else if ( componentType == 'locality' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }
                        else if ( componentType == 'administrative_area_level_2' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }
                        else if ( componentType == 'administrative_area_level_1' && city_list.includes(component.long_name)) {
                            city = component.long_name
                            $("#city_edit option").each(function(i,e)
                            {
                                if (city == e.innerHTML ) {
                                    cityId = e.value;
                                    $(this).attr('selected', true);
                                }else{
                                    $(this).attr('selected', false);
                                }
                            })
                            $('#city_edit').niceSelect('update');
                        }

                    }
                });
            }
        }


    </script>
<?php } ?>
@endpush
