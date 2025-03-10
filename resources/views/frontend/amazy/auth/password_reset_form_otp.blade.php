@extends('frontend.amazy.layouts.app')
@section('styles')
    <style>
        .login_logo img {
            max-width: 140px;
            margin: 0 auto;
        }
        .register_part {
            background: var(--background_color) !important;
            min-height: 100vh !important;
        }
    </style>
@endsection
@section('content')
<section class="login_area register_part">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-4">
                <div class="register_form_iner">
                    <div class="login_logo text-center mb-3">
                        <a href="{{url('/')}}"><img src="{{showImage(app('general_setting')->logo)}}" alt="{{app('general_setting')->company_name}}" title="{{app('general_setting')->company_name}}"></a>
                    </div>
                    <h2>{{ __('defaultTheme.welcome_back') }}, <br>{{ __('defaultTheme.please_confirm_with_new_password') }}</h2>
                    <form method="POST" class="register_form" action="{{ route('otp_user_password_update') }}">
                        @csrf

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">{{ __('common.password') }}</label>
                                <input type="password" id="password" class="@error('password') is-invalid @enderror" name="password" required placeholder="{{ __('common.password') }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = ''" autocomplete="new-password">
                                <span class="text-danger" id="password_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm">{{ __('common.confirm_password') }}</label>
                                <input type="password" id="password_confirm" name="password_confirmation" required placeholder="{{ __('common.confirm_password') }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = ''" autocomplete="new-password">

                            </div>

                            <div class="col-md-12 text-center">
                                <div class="register_area">
                                    <button type="submit" class="btn_1">{{ __('common.reset_password') }}</button>
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
    <script>
        $(document).ready(function(){
            $(document).on('submit', '.register_form', function(event){
                $('#password_error').text("");
                let password = $('#password').val();
                let password_confirm = $('#password_confirm').val();
                if(password != password_confirm){
                    $('#password_error').text("Password didn't Match.");
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
