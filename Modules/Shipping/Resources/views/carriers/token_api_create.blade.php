@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<div class="modal fade admin-query" id="access_token_add_carrier_modal">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('shipping.add_new_carrier')}}</h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="create_form" enctype="multipart/form-data">
                    <div class="row">
                          <!-- Grant Type Field -->
                        {{-- <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="grant_type">{{ __('Grant Type') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="grant_type" name="grant_type" placeholder="{{ __('Enter grant type') }}" type="text" value="">
                                <span class="text-danger" id="error_grant_type"></span>
                            </div>
                        </div> --}}

                        <!-- Client ID Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="client_id">{{ __('Client ID') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="client_id" name="client_id" placeholder="Enter client ID" type="text" value="">
                                <span class="text-danger" id="error_client_id"></span>
                            </div>
                        </div>

                        <!-- Client Secret Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="client_secret">{{ __('Client Secret') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="client_secret" name="client_secret" placeholder="Enter client secret" type="text" value="">
                                <span class="text-danger" id="error_client_secret"></span>
                            </div>
                        </div>

                        <!-- Audience Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="audience">{{ __('Audience') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="audience" name="audience" placeholder="{{ __('Enter audience') }}" type="text" value="">
                                <span class="text-danger" id="error_audience"></span>
                            </div>
                        </div>
                        <!-- Auth URL Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="auth_url">{{ __('Auth URL') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="auth_url" name="auth_url" placeholder="{{ __('Enter auth URL') }}" type="text" value="">
                                <span class="text-danger" id="error_auth_url"></span>
                            </div>
                        </div>

                        <!-- URL Field -->
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="url">{{ __('URL') }} <span class="required_mark_theme">*</span></label>
                                <input class="primary_input_field" id="url" name="url" placeholder="{{ __('Enter URL') }}" type="text" value="">
                                <span class="text-danger" id="error_url"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center">
                                <button class="primary-btn semi_large2  fix-gr-bg mr-10"  type="submit"><i class="ti-check"></i>{{__('common.submit') }}</button>
                                <button class="primary-btn semi_large2  fix-gr-bg" id="save_button_parent" data-dismiss="modal" type="button"><i class="ti-check"></i>{{__('common.cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
