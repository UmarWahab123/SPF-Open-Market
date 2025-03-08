<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\AuthRepository;
use App\Rules\RealEmail;
use App\Traits\ImageStore;
use App\Traits\Notification;
use App\Traits\Otp;
use App\Traits\SendMail;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Affiliate\Repositories\AffiliateRepository;
use Modules\FormBuilder\Repositories\FormBuilderRepositories;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\GeneralSetting\Entities\UserNotificationSetting;
use Modules\Marketing\Entities\ReferralCodeSetup;
use Modules\Marketing\Entities\ReferralUse;
use Modules\Marketing\Entities\ReferralCode;
use Modules\UserActivityLog\Traits\LogActivity;
use Nwidart\Modules\Facades\Module;
use Exception;
use Modules\FrontendCMS\Entities\LoginPage;
use Modules\GeneralSetting\Entities\NotificationSetting;
use App\Rules\RealEmaill;
class RegisterController extends Controller
{
    use Notification, Otp, SendMail, RegistersUsers;

    protected function redirectTo()
    {
        if (app('business_settings')->where('type', 'email_verification')->first()->status == 1) {
            return '/user-email-verify';
        }
        if(session()->has('from_checkout')){
            $next_url = session()->get('from_checkout');
            session()->forget('from_checkout');
            return $next_url;
        }
        return '/profile/dashboard';
    }

    public function __construct()
    {
        $this->middleware(['guest', 'maintenance_mode']);
        $this->middleware(['prohibited_demo_mode'])->only('register');
    }

    protected function validator(array $data)
    {
        // Determine the condition for Google Recaptcha based on environment settings
        if (env('NOCAPTCHA_FOR_REG') == "true" && app('theme')->folder_path == 'amazy') {
            $g_recaptcha = 'required';
        } else {
            $g_recaptcha = 'nullable';
        }

        // Custom email validation logic
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $email = ['required', 'string', 'max:255', 'email', new RealEmail(), 'unique:users,email'];
        } elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $data['email'])) {
            $email = ['required', 'string', 'min:7', 'max:16', 'unique:users,phone'];
        } else {
            $email = ['required', 'string', 'max:255', 'email', new RealEmail()];
        }

    
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => $email,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => $g_recaptcha,
            'referral_code' => ['sometimes', 'nullable', Rule::exists('referral_codes', 'referral_code')->where('status', 1)],

            // Adding the new validation rules
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'Company_name' => 'required|string',
            // 'Phone_number' => 'required|string',
            'Phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'Billing_address' => 'required',
            'Shipping_address' => 'required|string',
            'commercial_or_residential' => 'required|string',
            'loading_dock' => 'required|string',
            'forklift' => 'required|string',
            'pallet_jack' => 'required|string',
            'hours' => 'nullable',
            'call_ahead' => 'required|string',
            'special_instructions' => 'nullable|string',
            'accounts_payable_contact_name' => 'required|string',
            'accounts_payable_number' => 'required|string',
            'accounts_payable_email' => 'required|email',
            'general_liability' => 'nullable|string',
            'preferred_language' => 'nullable|string',
            'years_in_business' => 'required|integer',
            'number_of_locations' => 'nullable|integer',
            'primary_business_function' => 'nullable|string',
            'number_of_rigs' => 'nullable|integer',
            'monthly_volume' => 'nullable|integer',
            'open_cell_volume' => 'nullable|integer',
            'closed_cell_volume' => 'nullable|integer',
            'total_volume_previous_year' => 'nullable|integer',
            'preferred_foam_brand' => 'nullable|string',
            'preferred_rig_type' => 'required|string',
            'power_source' => 'required|string',
            'proportioner_brand' => 'required|string',
            'proportioner_model' => 'required|string',
            'preferred_spray_gun' => 'nullable|string',
        ], [
            'password.min' => 'The password field must have a minimum of 8 characters.',
            'g-recaptcha-response.required' => 'The Google Recaptcha field is required.',
            'Phone_number.unique' => 'The phone number you entered is already in use.',
        ]);
        
        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        
        //     // Determine the first error's step
        //     $firstErrorKey = array_key_first($errors->messages());
        //     $step = 1; // Default to step 1
        
        //     if (in_array($firstErrorKey, ['Billing_address', 'hours'])) {
        //         $step = 2;
        //     } elseif (in_array($firstErrorKey, ['call_ahead', 'preferred_language'])) {
        //         $step = 3;
        //     } elseif (in_array($firstErrorKey, ['years_in_business', 'preferred_foam_brand'])) {
        //         $step = 4;
        //     } else {
        //         $step = 5;
        //     }
        
        //     session(['currentStep' => $step]);
        //     dd(session('currentStep'));
        // }
    }






    protected function othersFieldValue($data)
    {
        return json_encode($data);
    }

    public function create($data)
    {
        $c_data = [];
        if($data->has('custom_field')){
            foreach (json_decode($data['custom_field']) as  $key => $f){
                if($data->hasFile($f)){
                    $file = ImageStore::saveImage($data[$f], 250, 250);
                    $c_data[$f] = $file;
                }else{
                    $c_data[$f] = $data[$f];
                }
            }
        }

        $field = $data['email'];
        $email = null;
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            $email= $field;
        }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $field)) {
            $phone= $field;
        }
            $user =User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => isset($phone) ? $phone : NULL,
                'email' => isset($email) ? $email : NULL,
                'verify_code' => sha1(time()),
                'password' => Hash::make($data['password']),
                'role_id' => 4,
                "is_active" => 1,
                'Phone_number' => $data['Phone_number'],
                'updated_at' => now()
            ]);


        //affiliate user
        if(isModuleActive('Affiliate')){
            $affiliateRepo = new AffiliateRepository();
            $affiliateRepo->affiliateUser($user->id);
        }
        //User Notification Setting Create
        (new UserNotificationSetting)->createForRegisterUser($user->id);
            $this->typeId = EmailTemplateType::where('type', 'register_email_template')->first()->id; //register email templete typeid
            $this->adminNotificationUrl = '/customer/active-customer-list';
            $this->routeCheck = 'cusotmer.list.get-data';
            $notification = NotificationSetting::where('slug','register')->first();
            if ($notification) {
                $this->notificationSend($notification->id, $user->id);
            }
        //for email verification
        if(!isModuleActive('Otp') && !otp_configuration('otp_activation_for_customer') && $email != null){
            if (app('business_settings')->where('type', 'email_verification')->first()->status == 1) {
                $code = '<a class="btn btn-success" href="' . url('/verify?code=') . $user['verify_code'] . '">Click Here To Verify Your Account</a>';
                $this->sendVerificationMail($user, $code);
            }
        }

        if (isset($data['referral_code'])) {
            $referralData = ReferralCodeSetup::first();
            $referralExist = ReferralCode::where('referral_code', $data['referral_code'])->first();
            if ($referralExist) {
                $referralExist->update(['total_used' => $referralExist->total_used + 1]);
                ReferralUse::create([
                    'user_id' => $user->id,
                    'referral_code' => $data['referral_code'],
                    'discount_amount' => $referralData->amount
                ]);
            }
        }

        if (app('business_settings')->where('type', 'email_verification')->first()->status == 1) {
            $code = '<a class="btn btn-success" href="' . url('/verify?code=') . $user['verify_code'] . '">Click Here To Verify Your Account</a>';
            $this->sendVerificationMail($user, $code);
        }
        // return redirect()->route('thankyou_page');
        

        // return dd('check');
        return $user;
        
    }

    public function submit_to_hubspot($hubdata)
    {
        $hubspot_form_guid = '797e42f6-4a78-4ab2-a866-9eff22ed8597';
        $hubspot_portal_id = '47751143';
        $hubspot_api_key = 'pat-na1-a43224be-6711-464c-84fe-5c72168b18d2';
        $url = "https://api.hsforms.com/submissions/v3/integration/submit/$hubspot_portal_id/$hubspot_form_guid";
    
        $postData = [
            'fields' => [
                ['name' => 'firstname', 'value' => $hubdata['firstname']],
                ['name' => 'company', 'value' => $hubdata['company']],
                ['name' => 'email', 'value' => $hubdata['email']],
                ['name' => 'phone', 'value' => $hubdata['tel']],
                ['name' => 'Billing_address', 'value' => $hubdata['Billing_address']],
                ['name' => 'Shipping_address', 'value' => $hubdata['Shipping_address']],
                ['name' => 'commercial_or_residential', 'value' => $hubdata['commercial_or_residential']],
                ['name' => 'loading_dock', 'value' => $hubdata['loading_dock']],
                ['name' => 'forklift', 'value' => $hubdata['forklift']],
                ['name' => 'pallet_jack', 'value' => $hubdata['pallet_jack']],
                // ['name' => 'hours', 'value' => $hubdata['hours']],
                ['name' => 'call_ahead', 'value' => $hubdata['call_ahead']],
                ['name' => 'special_instructions', 'value' => $hubdata['special_instructions']],
                ['name' => 'accounts_payable_contact_name', 'value' => $hubdata['accounts_payable_contact_name']],
                ['name' => 'accounts_payable_number', 'value' => $hubdata['accounts_payable_number']],
                ['name' => 'accounts_payable_email', 'value' => $hubdata['accounts_payable_email']],
                ['name' => 'general_liability', 'value' => $hubdata['general_liability']], // New field
                ['name' => 'preferred_language', 'value' => $hubdata['preferred_language']], // New field
                ['name' => 'years_in_business', 'value' => $hubdata['years_in_business']],
                ['name' => 'number_of_locations', 'value' => $hubdata['number_of_locations']], // New field
                ['name' => 'primary_business_function', 'value' => $hubdata['primary_business_function']], // New field
                ['name' => 'number_of_rigs', 'value' => $hubdata['number_of_rigs']], // New field
                ['name' => 'monthly_volume', 'value' => $hubdata['monthly_volume']], // New field
                ['name' => 'open_cell_volume', 'value' => $hubdata['open_cell_volume']], // New field
                ['name' => 'closed_cell_volume', 'value' => $hubdata['closed_cell_volume']], // New field
                ['name' => 'total_volume_previous_year', 'value' => $hubdata['total_volume_previous_year']], // New field
                ['name' => 'preferred_foam_brand', 'value' => $hubdata['preferred_foam_brand']], // New field
                ['name' => 'preferred_rig_type', 'value' => $hubdata['preferred_rig_type']],
                ['name' => 'power_source', 'value' => $hubdata['power_source']],
                ['name' => 'proportioner_brand', 'value' => $hubdata['proportioner_brand']],
                ['name' => 'proportioner_model', 'value' => $hubdata['proportioner_model']],
                ['name' => 'preferred_spray_gun', 'value' => $hubdata['preferred_spray_gun']],
            ],
            'context' => [
                'pageUri' => 'https://spfopenmarket.com/form',
                'pageName' => 'spfform'
            ]
        ];
    
        $options = [
            'http' => [
                'header' => [
                    "Content-type: application/json",
                    "Authorization: Bearer $hubspot_api_key"
                ],
                'method' => 'POST',
                'content' => json_encode($postData)
            ]
        ];
    
        // Suppress errors and handle them manually
        try {
            $context = stream_context_create($options);
            $response = @file_get_contents($url, false, $context);
    
            if ($response === FALSE) {
                return false;
            }
    
            $responseKeys = json_decode($response, true);
            return isset($responseKeys['inlineMessage']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error("HubSpot Submission Error: " . $e->getMessage());
            return false;
        }
    }
    protected function signupValidator(array $data)
    {
        // Determine the condition for Google Recaptcha based on environment settings
        if (env('NOCAPTCHA_FOR_REG') == "true" && app('theme')->folder_path == 'amazy') {
            $g_recaptcha = 'required';
        } else {
            $g_recaptcha = 'nullable';
        }

        // Custom email validation logic
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $email = ['required', 'string', 'max:255', 'email', new RealEmail(), 'unique:users,email'];
        } elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $data['email'])) {
            $email = ['required', 'string', 'min:7', 'max:16', 'unique:users,phone'];
        } else {
            $email = ['required', 'string', 'max:255', 'email', new RealEmail()];
        }
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => $email,
            'Phone_number' => 'required|string|unique:users,Phone_number',

            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ], [
            'password.min' => 'The password field minimum 8 character.',
        ]);
    }
    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
          $email = ['required', 'string', 'max:255','email',new RealEmail(),'unique:users,email'];
        }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->email)) {
            $email = ['required', 'string','min:7', 'max:16','unique:users,phone'];
        }else {
            $email = ['required', 'string', 'max:255','email'];
        }
        $request->validate( [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => $email,
            'Phone_number' => 'required|string',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'referral_code' => ['sometimes', 'nullable', Rule::exists('referral_codes', 'referral_code')->where('status', 1)]
        ], [
            'password.min' => 'The password field minimum 8 character.',
        ]);

        if(manualActivation()){
            $this->signupValidator($request->all())->validate();
            event(new Registered($user = $this->create($request)));
            $this->newUserRegistradEmailSend('new_user_registration_template',$user);
            if(!empty(app('general_setting')->registration_success_url)){
                $url =app('general_setting')->registration_success_url;
                return  redirect()->to($url);
            }else{
                Toastr::success(__('auth.successfully_registered_activation'), __('common.success'));
                return redirect()->route('thankyou_page');
            }
        }
        // dd("ttt");
        if (isModuleActive('Otp') && otp_configuration('otp_activation_for_customer')) {
            try {
                if (!$this->sendOtp($request)) {
                    Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
                    return back();
                }
                return view(theme('auth.otp'), compact('request'));
            } catch (Exception $e) {
                LogActivity::errorLog($e->getMessage());
                Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
                return back();
            }
        }
        // dd($request->all());

        $authRepos = new AuthRepository();
        $user_exist = $authRepos->getRegister($request->all());

        if($user_exist){
            $prev_session_id = session()->getId();
            $buy_it_now = session()->get('buy_it_now');
            $this->guard()->login($user_exist);
            $this->dataUpdateWhenLogin($prev_session_id, $buy_it_now);
            Toastr::success(__('auth.successfully_registered'), __('common.success'));
            LogActivity::addLoginLog(Auth::user()->id, Auth::user()->first_name . ' - logged in at : ' . Carbon::now());
            return $this->registered($request, $user_exist) ?: redirect($this->redirectPath());
        }

        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request)));
        $prev_session_id = session()->getId();
        $buy_it_now = session()->get('buy_it_now');
        $this->guard()->login($user);
        $this->dataUpdateWhenLogin($prev_session_id, $buy_it_now);
        Toastr::success(__('auth.successfully_registered'), __('common.success'));
        LogActivity::addLoginLog(Auth::user()->id, Auth::user()->first_name . ' - logged in at : ' . Carbon::now());
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    // public function buyerQuizStore(Request $request)
    // {
    //     // dd($request->all());
    //     if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
    //       $email = ['required', 'string', 'max:255','email',new RealEmail(),'unique:users,email'];
    //     }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $request->email)) {
    //         $email = ['required', 'string','min:7', 'max:16','unique:users,phone'];
    //     }else {
    //         $email = ['required', 'string', 'max:255','email'];
    //     }
    //     $request->validate( [
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'email' => $email,
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'Company_name' => 'required|string',
    //         'Phone_number' => 'required|string',
    //         'Billing_address' => 'required|string',
    //         'Shipping_address' => 'required|string',
    //         'commercial_or_residential' => 'required|string',
    //         'loading_dock' => 'required|string',
    //         'forklift' => 'required|string',
    //         'pallet_jack' => 'required|string',
    //         'hours' => 'required|string',
    //         'call_ahead' => 'required|string',
    //         'special_instructions' => 'required|string',
    //         'accounts_payable_contact_name' => 'required|string',
    //         'accounts_payable_number' => 'required|string',
    //         'accounts_payable_email' => 'required|email',
    //         'general_liability' => 'required|string',
    //         'preferred_language' => 'required|string',
    //         'years_in_business' => 'required|integer',
    //         'number_of_locations' => 'required|integer',
    //         'primary_business_function' => 'required|string',
    //         'number_of_rigs' => 'required|integer',
    //         'monthly_volume' => 'required|integer',
    //         'open_cell_volume' => 'required|integer',
    //         'closed_cell_volume' => 'required|integer',
    //         'total_volume_previous_year' => 'required|integer',
    //         'preferred_foam_brand' => 'required|string',
    //         'preferred_rig_type' => 'required|string',
    //         'power_source' => 'required|string',
    //         'proportioner_brand' => 'required|string',
    //         'proportioner_model' => 'required|string',
    //         'preferred_spray_gun' => 'required|string',
    //         'referral_code' => ['sometimes', 'nullable', Rule::exists('referral_codes', 'referral_code')->where('status', 1)]
    //     ], [
    //         'password.min' => 'The password field minimum 8 character.',
    //     ]);

      
    //     if(manualActivation()){
    //         $this->validator($request->all())->validate();
    //         event(new Registered($user = $this->create($request)));
    //         $this->newUserRegistradEmailSend('new_user_registration_template',$user);
    //         if(!empty(app('general_setting')->registration_success_url)){
    //             $url =app('general_setting')->registration_success_url;
    //             return  redirect()->to($url);
    //         }else{
    //             Toastr::success(__('auth.successfully_registered_activation'), __('common.success'));
    //             return back();
    //             // return redirect()->to('/thank-you');
    //         }
    //     }


    //     if (isModuleActive('Otp') && otp_configuration('otp_activation_for_customer')) {
    //         try {
    //             if (!$this->sendOtp($request)) {
    //                 Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
    //                 return back();
    //             }
    //             return view(theme('auth.otp'), compact('request'));
    //         } catch (Exception $e) {
    //             LogActivity::errorLog($e->getMessage());
    //             Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
    //             return back();
    //         }
    //     }
    //     $authRepos = new AuthRepository();
    //     $user_exist = $authRepos->getRegister($request->all());

    //     if($user_exist){
    //         $prev_session_id = session()->getId();
    //         $buy_it_now = session()->get('buy_it_now');
    //         $this->guard()->login($user_exist);
    //         $this->dataUpdateWhenLogin($prev_session_id, $buy_it_now);
    //         Toastr::success(__('auth.successfully_registered'), __('common.success'));
    //         LogActivity::addLoginLog(Auth::user()->id, Auth::user()->first_name . ' - logged in at : ' . Carbon::now());
    //         return $this->registered($request, $user_exist) ?: redirect($this->redirectPath());
    //     }

    //     $this->validator($request->all())->validate();
    //     event(new Registered($user = $this->create($request)));
    //     $prev_session_id = session()->getId();
    //     $buy_it_now = session()->get('buy_it_now');
    //     $this->guard()->login($user);
    //     $this->dataUpdateWhenLogin($prev_session_id, $buy_it_now);
    //     Toastr::success(__('auth.successfully_registered'), __('common.success'));
    //     LogActivity::addLoginLog(Auth::user()->id, Auth::user()->first_name . ' - logged in at : ' . Carbon::now());
    //     return $this->registered($request, $user) ?: redirect($this->redirectPath());
    // }

    public function showRegistrationForm()
    {
        // dd("ok");
        $row = '';
        $form_data = '';
        $currentStep = session('currentStep', 1); // Default to step 1 if no session data

        // Clear currentStep from session after using it, if you only want it available for a single request
        // session()->forget('currentStep');
    
        if(Module::has('FormBuilder')){
            if(Schema::hasTable('custom_forms')){
                $formBuilderRepo = new FormBuilderRepositories();
                $row = $formBuilderRepo->find(2);
                if($row->form_data){
                    $form_data = json_decode($row->form_data);
                }
            }
        }

        if(url()->previous() == url('/checkout') || url()->previous() == url('/checkout?checkout_type=YnV5X2l0X25vdw==')){
            session()->put('from_checkout',url()->previous());
        }

        $loginPageInfo = LoginPage::findOrFail(2);
        return view(theme('auth.register'),compact('row','form_data','loginPageInfo' ,'currentStep'));
    }

    private function dataUpdateWhenLogin($prev_session_id, $buy_it_now){
        if($buy_it_now == 'yes'){
            session()->put('but_it_now', 'yes');
        }
        $carts = Cart::where('session_id', $prev_session_id)->get();
        if ($carts->count()) {
            foreach ($carts as $key => $cartItem) {
                $cartData = Cart::where('product_id', $cartItem->product_id)->where('user_id', auth()->id())->where('seller_id', $cartItem->seller_id)->where('shipping_method_id', $cartItem->shipping_method_id)->where('product_type',$cartItem->product_type)->first();
                if ($cartData) {
                    $cartData->update([
                        'qty' => $cartItem->qty,
                        'total_price' => $cartItem->total_price,
                        'is_select' => 1
                    ]);
                    $cartItem->delete();
                } else {
                    $cartItem->update([
                        'user_id' => auth()->id(),
                        'session_id' => null
                    ]);
                }
            }
        }
    }




}
