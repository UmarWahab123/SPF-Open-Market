@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<style>
.input-group {
    display: flex;
}

.primary_input_field {
    border-radius: 0.375rem 0 0 0.375rem; /* Match border radius */
}

.input-group-append .input-group-text {
    border-radius: 0 0.375rem 0.375rem 0; /* Match border radius */
}
.custom-price-field-style {
    background:#e9ecef !important; /* Gradient background */
    color: #495057 !important; /* Change text color for better visibility */
    border: 1px solid #ced4da !important; /* Optional: adjust border to match Bootstrap */
}
</style>
<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="{{$form_id}}">
    @csrf
    <div class="white-box">
        <div class="add-visitor">
            <div class="row">
                <input type="hidden" id="item_id" name="id" value="" />
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="start_price">{{__('frontendCms.start_price')}} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-price-field-style">$</span> <!-- Dollar sign with gradient -->
                            </div>
                            <input class="primary_input_field form-control" type="number" step="{{step_decimal()}}" name="start_price" id="start_price" min="0" autocomplete="off" value="0">
                        </div>
                        <span class="text-danger" id="error_start_price"></span>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="end_price">{{__('frontendCms.end_price')}} <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text custom-price-field-style">$</span> <!-- Dollar sign with gradient -->
                            </div>
                            <input class="primary_input_field form-control" type="number" step="{{step_decimal()}}" name="end_price" id="end_price" min="0" autocomplete="off" value="0">
                        </div>
                        <span class="text-danger" id="error_end_price"></span>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <label class="primary_input_label" for="Plan">{{__('frontendCms.Plan')}} </label>
                    <select name="pricing_plan_id" id="pricing_plan_id" class="primary_select mb-15">
                        <option disabled selected>{{ __('common.select') }}</option>
                        @foreach($pricingPlan as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger" id="error_pricing_plan"></span>
                </div>
                <div class="col-lg-12">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="discount">{{ __('common.discount') }}</label>
                        <div class="input-group"> 
                            <input class="primary_input_field form-control" type="number" id="discount" value="0" step="{{ step_decimal() }}" min="0" max="100" name="discount" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <span class="text-danger" id="error_discount"></span>
                    </div>
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
            </div>

            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                <button id="{{ $btn_id }}" type="submit" class="primary-btn fix-gr-bg" data-toggle="tooltip" title="" data-original-title=""><span class="ti-check"></span>{{$button_name}} </button>
                </div>
            </div>
        </div>
    </div>
</form>
