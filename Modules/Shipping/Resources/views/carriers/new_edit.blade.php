@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<style>
.input-with-percent {
    position: relative;
    display: inline-block;
    width: 100%;
}

.primary_input_field {
    width: 100%;
    padding-right: 35px; /* Space for the percent sign */
    border: 1px solid #ccc;
    height: 40px; /* Adjust height if needed */
    /* border-radius: 5px; */
}

.percent-sign {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: #e5e5e5; /* Gray background */
    color: #333; /* Text color */
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    border-left: 1px solid #ccc;
    font-weight: bold;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    font-size: 14px;
}

</style>
<div class="modal fade admin-query" id="edit_carrier_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('shipping.update_carrier')}}</h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_form" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$row->id}}" id="rowId">
                    <div class="row">
                        @if(isModuleActive('FrontendMultiLang'))
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                                    @foreach ($LanguageList as $key => $language)
                                        <li class="nav-item lang_code" data-id="{{$language->code}}">
                                            <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#element{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($LanguageList as $key => $language)
                                        <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="element{{$language->code}}">
                                            <div class="col-lg-12">
                                                <div class="primary_input mb-15">
                                                    <label class="primary_input_label" for="name_{{$language->code}}"> {{__('common.name')}} <span class="required_mark_theme">*</span></label>
                                                    <input class="primary_input_field" id="name_{{$language->code}}" name="name[{{$language->code}}]" placeholder="{{__('common.name')}}" type="text" value="{{isset($row)?$row->getTranslation('name',$language->code):old('name.'.$language->code)}}">
                                                    <span class="text-danger" id="error_name_{{$language->code}}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="name"> {{__('common.name')}} <span class="required_mark_theme">*</span></label>
                                    <input class="primary_input_field" id="name" name="name" placeholder="{{__('common.name')}}" type="text" value="{{$row->name}}">
                                    <span class="text-danger" id="error_name"></span>
                                </div>
                            </div>
                        @endif
                         <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="handling_charges">
                                    {{ __('Handling Charges') }} <span class="required_mark_theme">*</span>
                                </label>
                                <div class="input-with-percent">
                                    <input 
                                        class="primary_input_field" 
                                        id="handling_charges" 
                                        name="handling_charges" 
                                        placeholder="Enter Handling Charges" 
                                        type="text" 
                                        value="{{$row->handling_charges}}">
                                    <span class="percent-sign">%</span>
                                </div>
                                <span class="text-danger" id="error_handling_charges"></span>
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="package_type">{{ __('Package Type') }} <span class="required_mark_theme">*</span></label>
                                <select class="primary_input_field" id="package_type" name="package_type">
                                    <option value="">Select Package Type</option>
                                    <option value="01,UPS Express Envelope" {{ $row->package_type == '01,UPS Express Envelope' ? 'selected' : '' }}>EXPRESS_ENVELOPES</option>
                                    <option value="01,UPS Legal Window Envelope" {{ $row->package_type == '01,UPS Legal Window Envelope' ? 'selected' : '' }}>LEGAL_WINDOW_ENVELOPES</option>
                                    <option value="01,UPS Express Reusable Envelope" {{ $row->package_type == '01,UPS Express Reusable Envelope' ? 'selected' : '' }}>EXPRESS_REUSABLE_ENVELOPES</option>
                                    <option value="01,UPS Legal Express Reusable Envelope" {{ $row->package_type == '01,UPS Legal Express Reusable Envelope' ? 'selected' : '' }}>LEGAL_EXPRESS_REUSABLE_ENVELOPES</option>
                                    <option value="04,UPS Express Pak" {{ $row->package_type == '04,UPS Express Pak' ? 'selected' : '' }}>EXPRESS_PAKS</option>
                                    <option value="04,UPS Express Pad Pak" {{ $row->package_type == '04,UPS Express Pad Pak' ? 'selected' : '' }}>EXPRESS_PAD_PAKS</option>
                                    <option value="04,UPS Express Hard Pak" {{ $row->package_type == '04,UPS Express Hard Pak' ? 'selected' : '' }}>EXPRESS_HARD_PAKS</option>
                                    <option value="2a,UPS Express Box Small" {{ $row->package_type == '2a,UPS Express Box Small' ? 'selected' : '' }}>EXPRESS_BOXES_SMALL</option>
                                    <option value="2b,UPS Express Box Medium" {{ $row->package_type == '2b,UPS Express Box Medium' ? 'selected' : '' }}>EXPRESS_BOXES_MEDIUM</option>
                                    <option value="2c,UPS Express Box Large" {{ $row->package_type == '2c,UPS Express Box Large' ? 'selected' : '' }}>EXPRESS_BOXES_LARGE</option>
                                    <option value="21,UPS Express Box" {{ $row->package_type == '21,UPS Express Box' ? 'selected' : '' }}>EXPRESS_BOX</option>
                                    <option value="24,UPS 25KG Box" {{ $row->package_type == '24,UPS 25KG Box' ? 'selected' : '' }}>EXPRESS_25KG_BOX</option>
                                    <option value="25,UPS 10KG Box" {{ $row->package_type == '25,UPS 10KG Box' ? 'selected' : '' }}>EXPRESS_10KG_BOX</option>
                                    <option value="03,UPS Express Tube" {{ $row->package_type == '03,UPS Express Tube' ? 'selected' : '' }}>EXPRESS_TUBE</option>
                                    <option value="02,Custom" {{ $row->package_type == '02,Custom' ? 'selected' : '' }}>CUSTOM</option>
                                </select>
                                <span class="text-danger" id="error_package_type"></span>
                            </div>
                        </div>
                        <!-- Client ID Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="client_id">{{ __('Client ID') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="client_id" name="client_id" placeholder="Enter client ID" type="text" value="{{$row->client_id}}">
                                <span class="text-danger" id="error_client_id"></span>
                            </div>
                        </div>

                        <!-- Client Secret Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="client_secret">{{ __('Client Secret') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="client_secret" name="client_secret" placeholder="Enter client secret" type="text" value="{{$row->client_secret}}">
                                <span class="text-danger" id="error_client_secret"></span>
                            </div>
                        </div>

                        <!-- Audience Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="audience">{{ __('Audience') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="audience" name="audience" placeholder="{{ __('Enter audience') }}" type="text" value="{{$row->audience}}">
                                <span class="text-danger" id="error_audience"></span>
                            </div>
                        </div>
                        <!-- Auth URL Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="auth_url">{{ __('Speedship Auth URL') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="auth_url" name="auth_url" placeholder="{{ __('Enter auth URL') }}" type="text" value="{{$row->auth_url}}">
                                <span class="text-danger" id="error_auth_url"></span>
                            </div>
                        </div>

                        <!-- URL Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="url">{{ __('Speedship URL') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="url" name="url" placeholder="{{ __('Enter URL') }}" type="text" value="{{$row->url}}">
                                <span class="text-danger" id="error_url"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-check"></i>{{__('common.update') }}</button>
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><i class="ti-check"></i>{{__('common.cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
