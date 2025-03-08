<?php

namespace App\Http\Controllers\Auth;
use Exception;
use App\Traits\Otp;
use App\Models\User;
use App\Rules\RealEmail;
use App\Models\UsersRegisteredBusiness;
use App\Models\RegisteredBusinessPhoneNumbers;
use App\Models\UsersPhoneNumbers;
use App\Models\UserPaymentBillingAddresses;
use App\Models\UserPaymentsInfo;
use App\Traits\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\ImageStore;
use App\Traits\GenerateSlug;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nwidart\Modules\Facades\Module;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\FrontendCMS\Entities\Pricing;
use Modules\RolePermission\Entities\Role;
use \Modules\FrontendCMS\Services\FaqService;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Modules\FrontendCMS\Services\QueryService;
use Modules\MultiVendor\Entities\SellerAccount;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\SidebarManager\Entities\Backendmenu;
use \Modules\FrontendCMS\Services\BenefitService;
use \Modules\FrontendCMS\Services\PricingService;
use Modules\FrontendCMS\Entities\MerchantContent;
use Modules\MultiVendor\Rules\SellerValidateRule;
use App\Traits\Notification as TraitsNotification;
use Modules\MultiVendor\Entities\SellerBankAccount;
use Modules\MultiVendor\Entities\SellerSubcription;
use Modules\SidebarManager\Entities\BackendmenuUser;
use Modules\MultiVendor\Entities\SellerReturnAddress;
use Modules\GeneralSetting\Entities\EmailTemplateType;
use Modules\MultiVendor\Events\SellerShippingRateEvent;
use \Modules\FrontendCMS\Services\WorkingProcessService;
use Modules\GeneralSetting\Entities\NotificationSetting;
use Modules\MultiVendor\Entities\SellerWarehouseAddress;
use Modules\MultiVendor\Events\SellerCarrierCreateEvent;
use \Modules\FrontendCMS\Services\MerchantContentService;
use \Modules\MultiVendor\Repositories\MerchantRepository;
use Modules\MultiVendor\Events\SellerShippingConfigEvent;
use Modules\MultiVendor\Repositories\CommisionRepository;
use Modules\MultiVendor\Entities\SellerBusinessInformation;
use Modules\MultiVendor\Events\SellerPickupLocationCreated;
use Modules\GeneralSetting\Entities\UserNotificationSetting;
use Modules\FormBuilder\Repositories\FormBuilderRepositories;
use Carbon\Carbon;
// use Modules\MultiVendor\Entities\SellerSubcription;

class MerchantRegisterController extends Controller
{
    use RegistersUsers, TraitsNotification, SendMail, Otp, GenerateSlug;
    protected $merchantContentService;
    protected $benefitService;
    protected $faqService;
    protected $workingProcessService;
    protected $pricingService;
    protected $queryService;

    public function __construct(
        MerchantContentService $merchantContentService,
        BenefitService $benefitService,
        WorkingProcessService $workingProcessService,
        FaqService $faqService,
        PricingService $pricingService,
        QueryService $queryService
    ) {
        $this->middleware('maintenance_mode');

        $this->merchantContentService = $merchantContentService;
        $this->benefitService = $benefitService;
        $this->faqService = $faqService;
        $this->workingProcessService = $workingProcessService;
        $this->pricingService = $pricingService;
        $this->queryService = $queryService;

    }


    protected function redirectTo()
    {
        if (app('business_settings')->where('type', 'email_verification')->first()->status == 1 && !isModuleActive('Otp') && !otp_configuration('otp_activation_for_seller')) {
            return redirect('/user-email-verify');
        }
        if(session()->has('pricing_id')){
            return  redirect('/seller/seller-subscription-payment-select/'.encrypt(session()->get('seller_pricing')));
        }
        return redirect('/seller/dashboard');
    }


    public function showRegisterFormStepFirst()
    {
        // dd("tet");
        if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status) {
            if (auth()->check() && auth()->user()->role->type == 'customer') {
                $commisionRepo = new CommisionRepository();
                $data['commissions'] = $commisionRepo->getAllActive();
                $data['content'] = MerchantContent::firstOrFail();
                $data['benefitList'] = $this->benefitService->getAllActive();
                $data['faqList'] = $this->faqService->getAllActive();
                $data['content'] = $this->merchantContentService->getAll();
                $data['pricingList'] = $this->pricingService->getAllActive();
                $data['workProcessList'] = $this->workingProcessService->getAllActive();
                $data['QueryList'] = $this->queryService->getAllActive();
                return view(theme('pages.marchant'), $data);
            } elseif (!auth()->check()) {
                $commisionRepo = new CommisionRepository();
                $data['commissions'] = $commisionRepo->getAllActive();
                $data['content'] = MerchantContent::firstOrFail();
                $data['benefitList'] = $this->benefitService->getAllActive();
                $data['faqList'] = $this->faqService->getAllActive();
                $data['content'] = $this->merchantContentService->getAll();
                $data['pricingList'] = $this->pricingService->getAllActive();
                $data['workProcessList'] = $this->workingProcessService->getAllActive();
                $data['QueryList'] = $this->queryService->getAllActive();
                return view(theme('pages.marchant'), $data);
            } else {
                return abort(404);
            }
        } else {
            Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
            return back();
        }
    }


    public function newshowRegisterFormStepFirst()
    {
        if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status) {
            if (auth()->check() && auth()->user()->role->type == 'customer') {
                $commisionRepo = new CommisionRepository();
                $data['commissions'] = $commisionRepo->getAllActive();
                $data['content'] = MerchantContent::firstOrFail();
                $data['benefitList'] = $this->benefitService->getAllActive();
                $data['faqList'] = $this->faqService->getAllActive();
                $data['content'] = $this->merchantContentService->getAll();
                $data['pricingList'] = $this->pricingService->getAllActive();
                $data['workProcessList'] = $this->workingProcessService->getAllActive();
                $data['QueryList'] = $this->queryService->getAllActive();
                return view(theme('pages.new_marchant'), $data);
            } elseif (!auth()->check()) {
                $commisionRepo = new CommisionRepository();
                $data['commissions'] = $commisionRepo->getAllActive();
                $data['content'] = MerchantContent::firstOrFail();
                $data['benefitList'] = $this->benefitService->getAllActive();
                $data['faqList'] = $this->faqService->getAllActive();
                $data['content'] = $this->merchantContentService->getAll();
                $data['pricingList'] = $this->pricingService->getAllActive();
                $data['workProcessList'] = $this->workingProcessService->getAllActive();
                $data['QueryList'] = $this->queryService->getAllActive();
                return view(theme('pages.new_marchant'), $data);
            } else {
                return abort(404);
            }
        } else {
            Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
            return back();
        }
    }
    // public function sendotpRegisterForm(Request $request, $id)
    // {
    //     return view(theme('pages.otp'));
    // }

    public function sellergetdataRegisterForm(Request $request)
    {
        return view(theme('pages.sellergetdata'));
    }


    public function showRegisterForm(Request $request, $id)
    {
        // dd("test");
        if(config('app')['sync'] && auth()->check()){
            if ($request->ajax()) {
                return response()->json(['error' => __('common.restricted_in_demo_mode')], 422);
            }
            Toastr::error(__('common.restricted_in_demo_mode'));
            return back();
        }
        if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status) {
            if (auth()->check() && auth()->user()->role->type == 'customer') {
                $commisionRepo = new CommisionRepository();
                $commission = $commisionRepo->findBySlug($id);
                if (session()->has('commission_id')) {
                    session()->forget('commission_id');
                    session()->forget('commission_rate');
                }
                session()->put('commission_id', $commission->id);
                session()->put('commission_rate', $commission->rate);
                if ($commission->id == 3) {
                    $data['pricing_plans'] = Pricing::where('status', 1)->get();
                    $data['content'] = MerchantContent::firstOrFail();
                    return view(theme('pages.merchant_create_by_subscription'), $data);
                } else {
                    session()->forget('pricing_id');
                }
                $registerRepo = new MerchantRepository();
                $registerRepo->customerToSellerConvert([
                    'commission_id' => session()->get('commission_id'),
                    'commission_rate' => session()->get('commission_rate'),
                ]);
                return redirect()->route('seller.dashboard');
            } elseif (!auth()->check()) {
                $commisionRepo = new CommisionRepository();
                $commission = $commisionRepo->findBySlug($id);
                if (session()->has('commission_id')) {
                    session()->forget('commission_id');
                    session()->forget('commission_rate');
                }
                session()->put('commission_id', $commission->id);
                session()->put('commission_rate', $commission->rate);

                $data['row'] = '';
                $data['form_data'] = '';
                if(Module::has('FormBuilder')){
                    if(Schema::hasTable('custom_forms')){
                        $formBuilderRepo = new FormBuilderRepositories();
                        $data['row'] = $formBuilderRepo->find(3);
                        if($data['row']->form_data){
                            $data['form_data'] = json_decode($data['row']->form_data);
                        }
                    }
                }
                if ($commission->id == 3) {
                    $data['pricing_plans'] = Pricing::where('status', 1)->get();
                    $data['content'] = MerchantContent::firstOrFail();
                    return view(theme('pages.merchant_create_by_subscription'), $data);
                } else {
                    session()->forget('pricing_id');
                }
                return view(theme('pages.merchant_create_step_two'), $data);
            } else {
                return abort(404);
            }
        } else {
            Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
            return back();
        }
    }

    public function showRegisterForm2(Request $request)
    {

        if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status) {
            if (auth()->check() && auth()->user()->role->type == 'customer') {
                if (session()->has('pricing_id')) {
                    session()->forget('pricing_id');
                    session()->forget('pricing_type');
                }
                session()->put('pricing_id', $request->id);
                session()->put('pricing_type', $request->type);
                $data['pricing_plans'] = Pricing::where('status', 1)->get(['name', 'id']);
                $registerRepo = new MerchantRepository();
                $registerRepo->customerToSellerConvert([
                    'commission_id' => session()->get('commission_id'),
                    'commission_rate' => session()->get('commission_rate'),
                    'pricing_id' => session()->get('pricing_id'),
                    'pricing_type' => session()->get('pricing_type'),
                ]);
                return redirect()->route('seller.dashboard');
            } elseif (!auth()->check()) {
                if (session()->has('pricing_id')) {
                    session()->forget('pricing_id');
                    session()->forget('pricing_type');
                }
                session()->put('pricing_id', $request->id);
                session()->put('pricing_type', $request->type);

                $data['row'] = '';
                $data['form_data'] = '';
                if(Module::has('FormBuilder')){
                    if(Schema::hasTable('custom_forms')){
                        $formBuilderRepo = new FormBuilderRepositories();
                        $data['row'] = $formBuilderRepo->find(3);
                        if($data['row']->form_data){
                            $data['form_data'] = json_decode($data['row']->form_data);
                        }
                    }
                }
                $data['pricing_plans'] = Pricing::where('status', 1)->get(['name', 'id']);
                return view(theme('pages.merchant_create_step_two'), $data);
            } else {
                return abort(404);
            }
        } else {
            Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
            return back();
        }
    }

    protected function validator(array $data)
    {
        if (env('NOCAPTCHA_FOR_REG') == "true" && app('theme')->folder_path == 'amazy') {
            $g_recaptcha = 'required';
        }else{
            $g_recaptcha = 'nullable';
        }


        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $email = ['required', 'string', 'max:255','email',new RealEmail(),'unique:users,email'];
         }elseif (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/",$data['email'])) {
             $email = ['required', 'string','min:7', 'max:16','unique:users,phone'];
         }else {
             $email = ['required', 'string', 'max:255','email',new RealEmail()];
         }

        return Validator::make(
            $data,
            [
                // 'name' => [ 'max:255','unique:seller_accounts,seller_shop_display_name',new SellerValidateRule($data['name'])],
                'email' => $email,
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'seller_name' => ['required' , 'max:255'],
                'company_name' => ['required' , 'max:255'],
                'g-recaptcha-response' =>$g_recaptcha,

            ],
            [
                // 'name.required' => 'This Name Filed is required',
                'seller_name.required' => 'Seller Name Filed is required',
                'company_name.required' => 'Company Name Filed is required',
                'email.required' => 'This Email is required',
                'email.email' => 'This is not a valid email',
                'email.unique' => 'Email has already taken',
                'password.required' => 'This Password Filed is required',
                'password.min' => 'The password field minimum 8 character.',
                'g-recaptcha-response.required' => 'The google recaptcha field is required.',
            ]
        );
    }



//     public function StoreBillingAddress(Request $request)
// {
//     $validatedData = $request->validate([
//         'billing_address' => 'required|string',
//     ]);

//     $billingAddress = new UserPaymentBillingAddresses();
//     $billingAddress->billing_address = $validatedData['billing_address'];
//     $billingAddress->save();

//     return response()->json(['message' => 'Billing address saved successfully!']);
// }


  public function storeMobileNumber(Request $request)
{
    // Validate the mobile number
    $request->validate([
        'mobile_number' => 'required',  // You can adjust the validation as needed
    ]);

    // Retrieve the user_id from the session
    $userId = session('user_id');  // Assuming user_id is stored in the session

    // Create a new entry in the UsersPhoneNumbers table
    $userMobileNo = new \App\Models\UsersPhoneNumbers();  // Create a new model instance
    $userMobileNo->user_id = $userId;  // Set the user_id
    $userMobileNo->phone_number = $request->mobile_number;  // Set the mobile number
    $userMobileNo->save();  // Save the record

    // Return success response
    return response()->json(['success' => true]);
}

  public function registeredBusinessPhoneNumbers(Request $request)
{
    // Validate the mobile number
    $request->validate([
        'mobile_number' => 'required',  // You can adjust the validation as needed
    ]);

    // Retrieve the user_id from the session
    $userId = session('user_id');  // Assuming user_id is stored in the session
    $businessid = session('business_id');  // Assuming user_id is stored in the session
    
    // Create a new entry in the UsersPhoneNumbers table
    $userMobileNo = new RegisteredBusinessPhoneNumbers();  // Create a new model instance
    $userMobileNo->user_registered_business_id = $businessid;  // Set the user_id
    $userMobileNo->phone_number = $request->mobile_number;  // Set the mobile number
    $userMobileNo->save();  // Save the record

    // Return success response
    return response()->json(['success' => true]);
}



    // public function register(Request $request)
    // {
    //     if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status == 0) {
    //         Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
    //         return back();
    //     }

    //     $this->validator($request->all())->validate();

    //     if (isModuleActive('Otp') && otp_configuration('otp_activation_for_seller')) {
    //         try {
    //             if (!$this->sendOtpForSeller($request)) {
    //                 Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
    //                 return back();
    //             }
    //             return view(theme('auth.otp_seller'), compact('request'));
    //         } catch (Exception $e) {
    //             LogActivity::errorLog($e->getMessage());
    //             Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
    //             return back();
    //         }
    //     }

    //     event(new Registered($user = $this->create($request)));

    //     if (auto_approve_seller()) {
    //         $this->guard()->login($user);
    //     } else {
    //         Toastr::success(__('common.successfully_registered') . ' ' . __('auth.wait_for_approval'), __('common.success'));
    //         return back();
    //     }

    //     Toastr::success(__('common.successfully_registered') . ' ' . __('auth.please_verify_your_email'), __('common.success'));

    //     if ($response = $this->registered($request, $user)) {

    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new Response('', 201)
    //         : $this->redirectTo();
    // }


    public function register(Request $request)
    {
        // dd($request->all());
        // Check if multi-vendor system is enabled
        if (app('business_settings')->where('category_type', 'vendor_configuration')->where('type', 'Multi-Vendor System Activate')->first()->status == 0) {
            Toastr::error(__('auth.multi_vendor_system_is_temporary_disabled'));
            return back();
        }
    
        // Validate the registration data
        $this->validator($request->all())->validate();
    
        event(new Registered($user = $this->create($request)));

        $userId = $user->id;
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
    
        // Store OTP in session with an expiration time (e.g., 10 minutes)
        session(['otp' => $otp]);
        session(['user_id' => $userId]);
        session(['useremail' => $request->email]);
        session(['otp_time' => now()]);
    
        // Send OTP via email using the previous send_approval_email function
        try {
            // Send the OTP email using the adapted method
            // $this->send_approval_email($request->email, 'Verify Your OTP', 'emails.otpemail', $otp);
    
            // Proceed to OTP verification view
            return view(theme('pages.otp'), compact('request'));
        } catch (Exception $e) {
            // dd($e->getMessage());
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('otp.something_wrong_on_otp_send'), __('common.error'));
            return back();
        }
    }




    public function seller_card_info(Request $request)
    {
        
        // $validatedData = $request->validate([
        //     'payment.card_number' => ['required', 'numeric'], // Example for a 16-digit card number 
        //     'payment.card_holder_name' => ['required', 'string', 'max:255'], // Ensure the name is a valid string
        // ]);
        try {
            // dd($request->all());
            $data = $request->all();
            $sellerInfo = $data['seller'];
            // $paymentInfo = $data['payment'];
            // Retrieve the user using session ID
            $user = User::where('id', session('user_id'))->first();
            $data_of_birth = $sellerInfo['date_of_birth_year'] . '-' . $sellerInfo['date_of_birth_month'] . '-' . $sellerInfo['date_of_birth_day'];
            if ($user) {
                // Update the user with seller info 
                $user->update([
                    'primary_first_name' => $sellerInfo['first_name'] ?? $user->primary_first_name,
                    'all_owner_data' => $sellerInfo['allvalues'] ?? $user->primary_first_name,
                    'primary_middle_name' => $sellerInfo['middle_name'] ?? $user->primary_middle_name,
                    'primary_last_name' => $sellerInfo['last_name'] ?? $user->primary_last_name,
                    'country_of_citizenship' => $sellerInfo['country_of_citizenship'] ?? $user->country_of_citizenship,
                    'country_of_birth' => $sellerInfo['country_of_birth'] ?? $user->country_of_birth,
                    'date_of_birth' => $data_of_birth ?? $user->date_of_birth,
                    'zip_postal_code' => $sellerInfo['zip_postal_code'] ?? $user->zip_postal_code,
                    'address_line1' => $sellerInfo['address_line1'] ?? $user->address_line1,
                    'appartment_building_suite_other' => $sellerInfo['appartment_building_suite_other'] ?? $user->appartment_building_suite_other,
                    'city_town' => $sellerInfo['city_town'] ?? $user->city_town,
                    'state_region' => $sellerInfo['state_region'] ?? $user->state_region,
                    // 'beneficial_owner_check' => $sellerInfo['beneficial_owner_check'] ?? $user->beneficial_owner_check,
                    // 'legal_representative_check' => $sellerInfo['legal_representative_check'] ?? $user->legal_representative_check,
                    'beneficial_owner_check' => isset($sellerInfo['beneficial_owner_check']) ? 1 : 0,
                    'legal_representative_check' => isset($sellerInfo['legal_representative_check']) ? 1 : 0,   


                    'primary_contact_person_check' => $sellerInfo['primary_contact_person_check'] ?? $user->primary_contact_person_check,
                ]);

                // $expire_in = $paymentInfo['expire_in_month'] . '-' . $paymentInfo['expire_in_year'];
                // $UserPaymwntInfo = UserPaymentsInfo::create([
                //     'user_id' => $user->id,
                //     'card_number' =>$paymentInfo['card_number'],
                //     'card_holder_name' =>$paymentInfo['card_holder_name'],
                //     'expire_in' => $expire_in,
                //     // 'card_number' => $validatedData['payment']['card_number'],
                //     // 'card_holder_name' => $validatedData['payment']['card_holder_name'],
                // ]);

                // $payment_info_id = $UserPaymwntInfo->id;
                // session(['payment_info_id' => $payment_info_id]);
                

                // $billingAddress = new UserPaymentBillingAddresses();
                // $billingAddress->billing_address = $request->saller_billing_address;
                // $billingAddress->user_payment_info_id = session('payment_info_id');
                // $billingAddress->save();


                // $userMobileNo = new UsersPhoneNumbers();  // Create a new model instance
                // $userMobileNo->user_id = session('user_id');  // Set the user_id
                // $userMobileNo->phone_number = $request->mobilenobydatabase;  // Set the mobile number
                // $userMobileNo->save();  // Save the record

                
              
                return redirect()->route('frontend.seller_stores_info' , ['id' => 'flat-rate'] )->with('success', 'User details updated successfully.');
                // return redirect()->route('seller_thankyou_page')->with('success', 'User details updated successfully.');
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        } catch (\Exception $e) {
            // Log error if update fails
            \Log::error('Error updating user details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the user details.');
        }
    }
    
    public function show_seller_stores_info(){
       
        $stores_list = UsersRegisteredBusiness::where('user_id', session('user_id'))->first();
        if ($stores_list) {
            return view(theme('pages.sellergetdata_stores'), compact('stores_list'));
        } else {
            return back()->with('error', 'No store information found.');
        }
        // $stores_list = UsersRegisteredBusiness::where('user_id', session('user_id'))->first();
        // return view(theme('pages.sellergetdata_stores'));
    }
    
    public function show_paymnet(){
        $sellerSubscriptionPlan = Pricing::where('status', 1)->first();
        $planMonthlyCost = $sellerSubscriptionPlan ? $sellerSubscriptionPlan->monthly_cost : 0; // Handle null case
        $planId = $sellerSubscriptionPlan->id;
        // dd($planId);
        return view(theme('pages.sellerget_payment'), [
            'planMonthlyCost' => $planMonthlyCost,
            'planId' => $planId,
        ]);        
    }
    public function seller_stores_info_save(Request $request)
    {
        // Fetch the business record for the logged-in user
            $business_table = UsersRegisteredBusiness::where('user_id', session('user_id'))->first();
    
            // Update the existing record with the new store data
            $business_table->update([
                'all_stores_data' => $request->storedata ?? $business_table->all_stores_data
            ]);
            
            // Find the active subscription plan for the seller
            $sellerSubscriptionPlan = Pricing::where('status', 1)->first();
            
            if ($sellerSubscriptionPlan) {
                return response()->json(['status' => true]);
            } else {
                SellerSubcription::create([
                    'seller_id' => session('user_id'),
                    'is_paid' => 0,
                    'last_payment_date' => Carbon::now()->format('Y-m-d'),
                    'expiry_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                ]);
                return response()->json(['status' => false]);
            }
    }
    

    public function showPreviousPage()
{
    return view(theme('pages.sellergetdata_second'));
}
    public function preview_show_sellerinformation()
{
    return view(theme('pages.sellergetdata_third'));
}

    public function users_registered_business(Request $request)
    {
        // dd($request->all());
        // Validate the input
        $request->validate([
            'registerd_business_locations' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|in:state_owned,publicly_listed,privately_owned,individual',
            'business_name' => 'nullable|string|max:255',
            'solo_business_name' => 'nullable|string|max:255',
            'company_registration_number' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_postal_code' => 'nullable|string|max:20',
            'address_line1' => 'nullable|string|max:255',
            'appartment_building_suite_other' => 'nullable|string|max:255',
            'city_town' => 'nullable|string|max:255',
            'state_region' => 'nullable|string|max:255',

            'business_name' => 'nullable|string|max:255',
            'company_registration_number' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_postal_code' => 'nullable|string|max:20',
            'address_line1' => 'nullable|string|max:255',
            'appartment_building_suite_other' => 'nullable|string|max:255',
            'city_town' => 'nullable|string|max:255',
            'state_region' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|in:state_owned,publicly_listed,privately_owned,individual',
            
        ], [
            'registerd_business_locations.string' => 'The business location must be a valid string.',
            'registerd_business_locations.max' => 'The business location must not exceed 255 characters.',
            'business_type.in' => 'Please select a valid    .',
            'business_name.max' => 'The business name must not exceed 255 characters.',
            'company_registration_number.max' => 'The company registration number must not exceed 255 characters.',
            'country.max' => 'The country must not exceed 255 characters.',
            'zip_postal_code.max' => 'The zip/postal code must not exceed 20 characters.',
            'address_line1.max' => 'The address line 1 must not exceed 255 characters.',
            'appartment_building_suite_other.max' => 'The apartment/building/suite/other field must not exceed 255 characters.',
            'city_town.max' => 'The city/town must not exceed 255 characters.',
            'state_region.max' => 'The state/region must not exceed 255 characters.',
        ]);
    
        try {
            // Check if the record already exists for the user
            $business = UsersRegisteredBusiness::where('user_id', session('user_id'))->first();
            $view = ''; // Initialize a variable to determine which view to return
            
            if ($business) {
                // Update the existing record with new fields
                $business->update([
                    'registerd_business_locations' => $request->registerd_business_locations ?? $business->registerd_business_locations,
                    'business_type' => $request->business_type ?? $business->business_type,
                    'business_name' => $request->business_name ?? $business->business_name,

                    'solo_business_name' => $request->solo_business_name ?? $business->solo_business_name,
                    'Good_services_type' => $request->Good_services_type ?? $business->Good_services_type,
                    'transaction_estimates' => $request->transaction_estimates ?? $business->transaction_estimates,
                    'How_many_locations' => $request->How_many_locations ?? $business->How_many_locations,
                    'List_locations_states' => $request->List_locations_states ?? $business->List_locations_states,
                    'company_description' => $request->company_description ?? $business->company_description,

                    'company_registration_number' => $request->company_registration_number ?? $business->company_registration_number,
                    'country' => $request->country ?? $business->country,
                    'zip_postal_code' => $request->zip_postal_code ?? $business->zip_postal_code,
                    'address_line1' => $request->address_line1 ?? $business->address_line1,
                    'appartment_building_suite_other' => $request->appartment_building_suite_other ?? $business->appartment_building_suite_other,
                    'city_town' => $request->city_town ?? $business->city_town,
                    'state_region' => $request->state_region ?? $business->state_region,
                ]);
                $view = 'pages.sellergetdata_third'; // Set view for update
            } else {
                // Create a new record if it doesn't exist
                $registeredBusiness =  UsersRegisteredBusiness::create([
                    'registerd_business_locations' => $request->registerd_business_locations,
                    'business_type' => $request->business_type,
                    'business_name' => $request->business_name,
                    
                    'solo_business_name' => $request->solo_business_name ,
                    'Good_services_type' => $request->Good_services_type ,
                    'transaction_estimates' => $request->transaction_estimates ,
                    'How_many_locations' => $request->How_many_locations ,
                    'List_locations_states' => $request->List_locations_states ,
                    'company_description' => $request->company_description,

                    'company_registration_number' => $request->company_registration_number,
                    'country' => $request->country,
                    'zip_postal_code' => $request->zip_postal_code,
                    'address_line1' => $request->address_line1,
                    'appartment_building_suite_other' => $request->appartment_building_suite_other,
                    'city_town' => $request->city_town,
                    'state_region' => $request->state_region,
                    'user_id' => session('user_id'),
                ]);
                $business_id = $registeredBusiness->id;
                session(['business_id' => $business_id]);
                $view = 'pages.sellergetdata_second'; // Set view for new record
            }
    
            // Return the appropriate view based on the operation
            return view(theme($view), ['success' => 'Business details saved successfully.']);
    
        } catch (\Exception $e) {
            // Log the error if needed
            \Log::error('Error saving business details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the business details.');
        }
    }
    
    



    public function send_approval_email($to_email, $subject, $template, $otp)
    {
        Mail::send($template, ['otp' => $otp], function ($message) use ($subject, $to_email) {
            $message->to($to_email, $subject)->subject($subject);
            $message->from('Admin@spfopenmarket.com', $subject); // Adjust the 'from' email as needed
        });
    }
    


    



    public function verifyOtp(Request $request)
    {
         
            // Check if the OTP in the session has expired (e.g., after 3 minutes)
            if (now()->diffInMinutes(session('otp_time')) > 3) {
                Toastr::error(__('otp.otp_expired'), __('common.error'));
                return redirect()->back(); // Redirect back on OTP expiration
            } 


            // Validate the OTP entered by the user
            // $request->validate([
            //     'otp' => 'required|numeric|digits:6', // Ensure the OTP is required, numeric, and 6 digits long
            // ]);

            // Check if the OTP matches the one in the session
            if ($request->otp == session('otp')) {
             
                // OTP is correct, proceed with registration
                // dd($request->all());
                // Destroy the OTP and its timestamp from the session
                session()->forget(['otp', 'otp_time']);

                Toastr::success(__('verified successfully'));
                // Redirect to the desired page after successful OTP verification
                return view(theme('pages.sellergetdata')); // Redirect to the correct page or route
            } else {
                // dd($request->all());
                // OTP does not match
                Toastr::error(__('invalid otp'), __('common.error'));

                // Return back to the form with validation errors
                return view(theme('pages.otp'))->withErrors(['otp' => 'Invalid OTP. Please try again.']);  // Pass the error message
            }
        }


public function resendOtp(Request $request)
{
    // Check if an email is stored in the session
    if (!session('useremail')) {
        Toastr::error(__('otp.email_not_found'), __('common.error'));
        return response()->json(['message' => __('otp.email_not_found')], 400);  // Send error message in JSON
    }

    // Generate a new 6-digit OTP
    $otp = rand(100000, 999999);

    // Update OTP and time in session
    session(['otp' => $otp]);
    session(['otp_time' => now()]);

    // Resend the OTP email
    try {
        $this->send_approval_email(session('useremail'), 'Resend OTP Verification', 'emails.otpemail', $otp);
        
        // Return success message as JSON
        return response()->json(['message' => __('otp.otp_resent_successfully')], 200);
    } catch (Exception $e) {
        LogActivity::errorLog($e->getMessage());
        Toastr::error(__('otp.something_wrong_on_otp_resend'), __('common.error'));
        
        // Return failure message as JSON
        return response()->json(['message' => __('otp.something_wrong_on_otp_resend')], 500);
    }
}





    protected function othersFieldValue($data)
    {
        return json_encode($data);
    }

    protected function create($data)
    {
        $c_data = [];
        if($data->has('custom_field')){
            foreach (json_decode($data['custom_field']) as  $key => $f){
                if($data->hasFile($f)){
                    $file = ImageStore::saveImage($data[$f], 165, 165);
                    $c_data[$f] = $file;
                }else{
                    $c_data[$f] = $data[$f];
                }
            }
        }
        $role = Role::where('type', 'seller')->first();
        $user =  User::create([
            'first_name' => $data['seller_name'],
            'seller_company_name' => $data['company_name'],
            'email' => $data['email'],
            'role_id' => $role->id,
            'username' => $data['phone'],
            'phone' => $data['phone'],
            'verify_code' => sha1(time()),
            'password' => Hash::make($data['password']),
            'others' => $this->othersFieldValue($c_data),
            'currency_id' => app('general_setting')->currency,
            'lang_code' => app('general_setting')->language_code,
            'currency_code' => app('general_setting')->currency_code,
        ]);
        // Auto approve check
        if (auto_approve_seller()) {
            $user->is_active = 1;
        } else {
            $user->is_active = 0;
        }
        $user->slug = $this->productSlug($data['seller_name']);
        $user->save();
        // User Notification Setting Create
        (new UserNotificationSetting())->createForRegisterUser($user->id);
        $this->adminNotificationUrl = '/admin/merchants';
        $this->routeCheck = 'admin.merchants_list';
        $this->typeId = EmailTemplateType::where('type', 'seller_create_email_template')->first()->id; //register email templete typeid
        $notification = NotificationSetting::where('slug','seller-created')->first();
        if ($notification) {
            $this->notificationSend($notification->id, $user->id);
        }

        $seller_account = SellerAccount::create([
            'user_id' => $user['id'],
            'seller_id' => 'BDEXCJ' . rand(99999, 10000000),
            'seller_commission_id' => (session()->has('commission_id')) ? session()->get('commission_id') : 1,
            'commission_rate' => (session()->has('commission_rate')) ? session()->get('commission_rate') : 0,
            'subscription_type' => 'yearly',
            'seller_shop_display_name' => $data['name'],
            'sellername' => $data['name'],
            'seller_phone' => $data['phone']
        ]);

        SellerBusinessInformation::create([
            'user_id' => $user['id']
        ]);
        SellerBankAccount::create([
            'user_id' => $user['id'],
            'business_country' => app('general_setting')->default_country,
            'business_state' => app('general_setting')->default_state
        ]);
        if (session()->has('pricing_id')) {
          $pricing =  SellerSubcription::create([
                'seller_id' => $user['id'],
                'pricing_id' => session()->get('pricing_id')
            ]);
            if (session()->get('pricing_type') == null) {
                $seller_account->update([
                    'subscription_type' => 'yearly'
                ]);
            }

            session()->put('seller_pricing',$pricing->id);
        }
        SellerWarehouseAddress::create([
            'user_id' => $user['id'],
            'warehouse_country' => app('general_setting')->default_country,
            'warehouse_state' => app('general_setting')->default_state
        ]);
        SellerReturnAddress::create([
            'user_id' => $user['id'],
            'return_country' => app('general_setting')->default_country,
            'return_state' => app('general_setting')->default_state
        ]);
        if(!isModuleActive('Otp') && !otp_configuration('otp_activation_for_seller')){
            if (app('business_settings')->where('type', 'email_verification')->first()->status == 1) {
                $code = '<a class="btn btn-success" href="' . url('/verify?code=') . $user['verify_code'] . '">Click Here To Verify Your Account</a>';
                $this->sendSellerVerificationMail($user, $code);
            }
        }
        Event::dispatch(new SellerCarrierCreateEvent($user['id']));
        Event::dispatch(new SellerPickupLocationCreated($user['id']));
        Event::dispatch(new SellerShippingRateEvent($user['id']));
        Event::dispatch(new SellerShippingConfigEvent($user['id']));
        $this->setupSidebar($user);
        return $user;
    }

    public function setupSidebar($user)
    {
        $role_id = $user->role->type;
        if ($role_id == 'seller') {
            $backend_menus = Backendmenu::where(function($q){
                $q->where('user_id', auth()->id())->orWhereNull('user_id');
            })->where('is_seller', 1)->get();
        }else{
            $backend_menus = Backendmenu::where(function($q){
                $q->where('user_id', auth()->id())->orWhereNull('user_id');
            })->where('is_admin', 1)->get();

        }
        $backendMenuUser = BackendmenuUser::with('backendMenu')->where('user_id', $user->id)->get();
            if($backendMenuUser->count() != $backend_menus->count()){

                $backend_menu_not_exsist = $backend_menus->whereNotIn('id', $backendMenuUser->pluck('backendmenu_id')->toArray());
                foreach($backend_menu_not_exsist as $menu){

                    $parent_id = null;
                    $position = 0;
                    if($menu->parent_id){
                        $parentMenu = BackendmenuUser::where('backendmenu_id', $menu->parent_id)->where('user_id', $user->id)->first();
                        if($parentMenu){
                            $parent_id  = $parentMenu->id;
                            $position = BackendmenuUser::where('parent_id', $parent_id)->where('user_id', $user->id)->count() + 1;
                        }
                    }

                    BackendmenuUser::create(['parent_id' => $parent_id, 'user_id' => $user->id, 'backendmenu_id' => $menu->id, 'position' => $position]);
                }
            }
    }

    public function otp_check_for_seller(Request $request)
    {
        try {
            $otp = Session::get('otp');
            $validation_time = Session::get('validation_time');
            if ($otp != $request->otp) {
                Toastr::error(__('otp.invalid_otp'));
                Session::put('code_validation_time', $request->code_validation_time);
                return view(theme('auth.otp_seller'), compact('request'));
            } elseif (date('Y-m-d H:i:s') > $validation_time) {
                Session::put('code_validation_time', 1);
                Toastr::error(__('otp.otp_validation_time_expired'));
                return view(theme('auth.otp_seller'), compact('request'));
            } else {
                Session::forget('otp');
                Session::forget('validation_time');
                Session::forget('code_validation_time');
                event(new Registered($user = $this->create($request)));
                $user->update(['is_verified' => 1]);
                if (auto_approve_seller()) {
                    Toastr::success(__('common.successfully_registered'), __('common.success'));
                    $this->guard()->login($user);
                } else {
                    Toastr::success(__('common.successfully_registered') . ' ' . __('auth.wait_for_approval'), __('common.success'));
                    return redirect()->route('register');
                }
                if ($response = $this->registered($request, $user)) {
                    return $response;
                }
                return $request->wantsJson()? new Response('', 201) : $this->redirectTo();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return redirect()->route('register');
        }
    }

}
