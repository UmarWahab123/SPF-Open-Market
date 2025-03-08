@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<style>
.custom-price-field-style {
    background:#e9ecef !important; /* Gradient background */
    color:#495057 !important; /* Change text color for better visibility */
    border: 1px solid #ced4da !important; /* Optional: adjust border to match Bootstrap */
}

</style>
<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="{{$form_id}}">
    @csrf
    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
                <input type="hidden" id="item_id" name="id" value="" />
                    @if(isModuleActive('FrontendMultiLang'))
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                            @foreach ($LanguageList as $key => $language)
                                <li class="nav-item lang_code" data-id="{{$language->code}}">
                                    <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#element{{$pricing_plane}}{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($LanguageList as $key => $language)
                                <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="element{{$pricing_plane}}{{$language->code}}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="primary_input mb-25">
                                                <label class="primary_input_label" for="name">{{__('common.name')}} <span class="text-danger">*</span></label>
                                                <input class="primary_input_field" type="text" id="name_{{$language->code}}" name="name[{{$language->code}}]" autocomplete="off" placeholder="{{__('common.name')}}">
                                                <span class="text-danger" id="error_name_{{$language->code}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="name">{{__('common.name')}} <span class="text-danger">*</span></label>
                            <input class="primary_input_field" type="text" id="name" name="name" autocomplete="off" placeholder="{{__('common.name')}}">
                            <span class="text-danger" id="error_name"></span>
                        </div>
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="plan_price">{{__('frontendCms.plan_price')}} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-price-field-style">$</span> <!-- Dollar sign added here -->
                            </div>
                            <input class="primary_input_field form-control" type="number" step="{{step_decimal()}}" name="plan_price" id="plan_price" min="0" autocomplete="off" value="0">
                        </div>
                        <span class="text-danger" id="error_plan_price"></span>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="expire_in">{{__('frontendCms.expire_in')}} ({{ __('frontendCms.days') }}) <span class="text-danger">*</span></label>
                        <input class="primary_input_field" type="number" step="{{step_decimal()}}" name="expire_in" id="expire_in" min="0" autocomplete="off" value="0">
                        <span class="text-danger" id="error_expire_in"></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                       <label class="primary_input_label" for="best_for">{{__('frontendCms.best_for')}}</label>
                        <input class="primary_input_field" type="text" id="best_for" name="best_for" autocomplete="off" placeholder="{{__('frontendCms.best_for')}}">
                    </div>
                </div>

                <div class="col-xl-12 d-none">
                    <div class="primary_input">
                        <label class="primary_input_label" for="">{{ __('common.discount_type') }} <span class="text-danger">*</span></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="discount_type_amount" class="primary_checkbox d-flex mr-12">
                                    <input name="discount_type" value="0" id="discount_type_amount" checked="true" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('common.amount') }}</p>
                            </li>

                            <li>
                                <label data-id="discount_type_percentage" class="primary_checkbox d-flex mr-12">
                                    <input name="discount_type" id="discount_type_percentage" value="1"  class="active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('common.percentage') }}</p>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 d-none">
                    <div class="primary_input mb-25">
                       <label class="primary_input_label" for="discount">{{ __('common.discount') }}</label>
                       <input class="primary_input_field" type="number" id="discount" value="0" step="{{step_decimal()}}" min="0" max="100" name="discount" autocomplete="off">
                       <span class="text-danger" id="error_discount_fee"></span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <label class="primary_input_label" for="discount">{{ __('gst.gst_list') }}</label>
                    <select name="gst_id" id="gst_id" class="primary_select mb-15">
                        <option disabled selected>{{ __('common.select') }}</option>
                        @foreach($gst_taxes as $tax)
                            <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->tax_percentage }} %) </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-12">
                    <div class="primary_input">
                        <label class="primary_input_label" for="">{{ __('common.status') }} <span class="text-danger">*</span></label>
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                    <input name="status" id="status_active" value="1" checked="true" class="active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('common.active') }}</p>
                            </li>
                            <li>
                                <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                    <input name="status" value="0" id="status_inactive" class="de_active" type="radio">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('common.inactive') }}</p>
                            </li>
                        </ul>
                        <span class="text-danger" id="status_error"></span>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="primary_input mb-15">
                        <label class="primary_input_label" for="description">{{__('common.description')}}</label>
                        <textarea class="primary_textarea height_112 description summernote" id="description" placeholder="{{__('common.description')}}" name="description" spellcheck="false"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                       <label class="primary_input_label w-100" for="best_for">{{__('frontendCms.plan_image')}}</label>
                       <input type="file" name="image" >
                       <input type="hidden" name="old_image" id="old_image">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="primary_input">
                        <ul id="theme_nav" class="permission_list sms_list ">
                            <li>
                                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                    <input name="is_featured" id="is_featured" value="1" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <p>{{ __('frontendCms.is_featured') }}</p>
                            </li>
                        </ul>
                        <span class="text-danger" id="is_featured_error"></span>
                    </div>
                </div>

            </div>

            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                <button id="{{ $btn_id }}" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""><span class="ti-check"></span>{{$button_name}} </button>
                </div>
            </div>
        </div>
    </div>
</form>
