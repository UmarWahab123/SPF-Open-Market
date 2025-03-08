<?php

namespace Modules\Customer\Http\Controllers;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Http\Requests\ProfileRequest;
use Modules\Customer\Http\Requests\CreateAddressRequest;
use Modules\Customer\Entities\CustomerAddress;
use Modules\Customer\Rules\MatchOldPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageStore;
use Modules\Customer\Services\CustomerService;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Setup\Entities\Country;
use Exception;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Stripe\Subscription;
use Modules\FrontendCMS\Entities\PricingPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\UserActivityLog\Traits\LogActivity;
use Yajra\DataTables\Facades\DataTables;
use Modules\UserActivityLog\Entities\LogActivity as LogActivityModel;
use Modules\FrontendCMS\Entities\CustomerSubscriptionPaymentInfo;
use Carbon\Carbon;

class CustomerController extends Controller
{
    use ImageStore;
    protected $customerService;
    private $apiContext;
    public function __construct(CustomerService  $customerService)
    {
        $this->middleware(['auth','maintenance_mode']);
        $this->middleware(['prohibited_demo_mode'])->only('updatePassword');
        $this->customerService = $customerService;

        //set the apiContext
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('services.paypal.settings'));
    }
    public function customer_index()
    {
        $data['customers'] = $this->customerService->getAll();
        return view('customer::customers.index', $data);
    }
    public function customer_index_get_data(){
        if(isset($_GET['table'])){
            $table = $_GET['table'];
            if($table == 'active_customer'){
                $customer = $this->customerService->getAll()->where('is_active',1);
            }
            elseif($table == 'inactive_customer'){
                $customer = $this->customerService->getAll()->where('is_active', 0);
            }elseif($table == 'all_customer'){
                $customer = $this->customerService->getAll()->whereNotIn('is_active', ['2']);
            }
            return DataTables::of($customer)
            ->addIndexColumn()
            ->addColumn('avatar', function($customer){
                return view('customer::customers.components._avatar_td',compact('customer'));
            })
            ->addColumn('name', function($customer){
                return view('customer::customers.components._name_td',compact('customer'));
            })
            // ->addColumn('phone', function($customer){
            //     return getNumberTranslate($customer->username);
            // })
            ->addColumn('phone', function($customer){
                if (is_null($customer->quiz_approved) || $customer->quiz_approved === 'pending') {
                    return 'Pending';
                }
                return 'Approved';
            })
            ->addColumn('status', function($customer){
                return view('customer::customers.components._status_td',compact('customer'));
            })
            ->addColumn('wallet_balance', function($customer){
                return single_price($customer->CustomerCurrentWalletAmounts);
            })
            ->addColumn('orders', function($customer){
                return getNumberTranslate(count($customer->orders));
            })
            ->addColumn('action',function($customer){
                return view('customer::customers.components._action_td',compact('customer'));
            })
            ->rawColumns(['avatar','status','action','name'])
            ->make(true);
        }else{
            return [];
        }
    }
    public function profile(ProfileRequest $request)
    {
         try {
             $customer_id=auth()->user()->id;
             $address_type=$request['address_type'];
             $match_data=['customer_id'=> $customer_id,'address_type' => $address_type];
             $form_data=[
                'name' => $request['name'],
                'address_one'=> $request['address_one'],
                'address_two' => $request['address_two'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
                'postal_code' => $request['postal_code']
             ];
             $data=CustomerAddress::updateOrCreate($match_data,$form_data);
             LogActivity::successLog('profile update');
             return response()->json($data);

         } catch (Exception $e) {
             LogActivity::errorLog($e->getMessage());
             Toastr::error(__('common.error_message'));
            return back();
         }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'same:new_password',
        ]);
        try {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            LogActivity::successLog('customer password update');
            return response()->json(__('common.updated_successfully'));
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            return back();
        }
    }
    public function create(){
        return view('customer::customers.create');
    }
    public function store(Request $request){
        $hubspotData = [
            'firstname' => $request['first_name'] . ' ' . $request['last_name'],
            'company' => $request['Company_name'],
            'email' => $request['email'],
            'tel' => $request['Phone_number'],
            'Billing_address' => $request['Billing_address'],
            'Shipping_address' => $request['Shipping_address'],
            'commercial_or_residential' => $request['commercial_or_residential'],
            'loading_dock' => $request['loading_dock'],
            'forklift' => $request['forklift'],
            'pallet_jack' => $request['pallet_jack'],
            // 'hours' => $request['hours'],
            'call_ahead' => $request['call_ahead'],
            'special_instructions' => $request['special_instructions'],
            'accounts_payable_contact_name' => $request['accounts_payable_contact_name'],
            'accounts_payable_number' => $request['accounts_payable_number'],
            'accounts_payable_email' => $request['accounts_payable_email'],
            'general_liability' => $request['general_liability'],
            'preferred_language' => $request['preferred_language'],
            'years_in_business' => $request['years_in_business'],
            'number_of_locations' => $request['number_of_locations'],
            'primary_business_function' => $request['primary_business_function'],
            'number_of_rigs' => $request['number_of_rigs'],
            'monthly_volume' => $request['monthly_volume'],
            'open_cell_volume' => $request['open_cell_volume'],
            'closed_cell_volume' => $request['closed_cell_volume'],
            'total_volume_previous_year' => $request['total_volume_previous_year'],
            'preferred_foam_brand' => $request['preferred_foam_brand'],
            'preferred_rig_type' => $request['preferred_rig_type'],
            'power_source' => $request['power_source'],
            'proportioner_brand' => $request['proportioner_brand'],
            'proportioner_model' => $request['proportioner_model'],
            'preferred_spray_gun' => $request['preferred_spray_gun'],
        ];

       $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => ['required', 'string', 'max:255', 'unique:users,email', 'check_unique_phone'],
            'password' => 'required|confirmed|min:8',
            'referral_code' => ['sometimes', 'nullable', Rule::exists('referral_codes', 'referral_code')->where('status', 1)],
            'status' => 'required',
            // 'Name' => 'required|string',
            
            'Company_name' => 'required|string',//new added
            'Phone_number' => 'required|string',//new added
            'Billing_address' => 'required|string',//new added
            'Shipping_address' => 'required|string',//new added
            'commercial_or_residential' => 'required|string',//new added
            'loading_dock' => 'required|string',//new added
            'forklift' => 'required|string',//new added
            'pallet_jack' => 'required|string',//new added
            // 'hours' => 'required|string',//new added
            'call_ahead' => 'required|string',//new added
            'special_instructions' => 'nullable|string',//new added
            'accounts_payable_contact_name' => 'required|string',//new added
            'accounts_payable_number' => 'required|string',//new added
            'accounts_payable_email' => 'required|email',//new added
            'general_liability' => 'required|string',//new added
            'preferred_language' => 'required|string',//new added
            'years_in_business' => 'required|integer',//new added
            'number_of_locations' => 'required|integer',//new added
            'primary_business_function' => 'required|string',//new added
            'number_of_rigs' => 'required|integer',//new added
            'monthly_volume' => 'required|integer',//new added
            'open_cell_volume' => 'required|integer',//new added
            'closed_cell_volume' => 'required|integer',//new added
            'total_volume_previous_year' => 'required|integer',//new added
            'preferred_foam_brand' => 'required|string',//new added
            'preferred_rig_type' => 'required|string',//new added
            'power_source' => 'required|string',//new added
            'proportioner_brand' => 'required|string',//new added
            'proportioner_model' => 'required|string',//new added
            'preferred_spray_gun' => 'required|string',//new added
        ]);
        

        try {
            // Attempt to submit to HubSpot
            $this->submit_to_hubspot($hubspotData);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.hubspot_error_message'), __('common.error'));
            return back();
        }

        try{
            $this->customerService->store($request->except('_token'));
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Customer Created Successfully.');
            return redirect()->route('cusotmer.list_active');
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));  
            return back();
        }
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

    public function edit($id){
        $customer = $this->customerService->find($id);
        return view('customer::customers.edit', compact('customer'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => ['required', 'string', 'max:255', 'unique:users,email,'.$id],
            'password' => 'sometimes|nullable|confirmed|min:8',
            'status' => 'required'
        ]);
        try{
            $this->customerService->update($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Customer Updated Successfully.');
            return redirect()->route('cusotmer.list_active');
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function destroy(Request $request, $id){
        $result = $this->customerService->destroy($id);
            if($result === true){
                Toastr::success(__('common.deleted_successfully'), __('common.success'));
            }else{
                Toastr::warning(__('hr.deleted_not_possible_for_this_customer'), __('common.warning'));
            }
            return redirect()->route('cusotmer.list_active');
        try{
            $result = $this->customerService->destroy($id);
            if($result === true){
                Toastr::success(__('common.deleted_successfully'), __('common.success'));
            }else{
                Toastr::warning(__('hr.deleted_not_possible_for_this_customer'), __('common.warning'));
            }
            return redirect()->route('cusotmer.list_active');


        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }
    public function show($id)
    {
        
        $data['customer'] = $this->customerService->find($id);
        $logins = LogActivityModel::where('user_id',$id)->where('login',1)->orderBy('id','DESC')->limit(20)->get();
        $data['logins'] = $logins;
        $data['customer_subscription_payment'] = CustomerSubscriptionPaymentInfo::with('pricingPlans', 'customerSubscription', 'transaction')
        ->where('customer_id', $id)
        ->where(function ($query) {
            $query->where('status', 'Pending')
                  ->orWhere('status', 'Active');
        })
        ->first();
        return view('customer::customers.show_details', $data);
    }

    public function getOrders($id){
        $customer = $this->customerService->find($id);
        $order = $customer->orders;
        return DataTables::of($order)
            ->addIndexColumn()
            ->addColumn('date', function($order){
                return dateConvert($order->created_at);
            })
            ->addColumn('order_number',function($order){
                return  getNumberTranslate($order->order_number);
            })
            ->addColumn('number_of_product',function($order){
                return  getNumberTranslate($order->packages->sum('number_of_product'));
            })
            ->addColumn('total_amount',function($order){
                return  single_price($order->grand_total);
            })
            ->addColumn('order_status', function($order){
                return view('customer::customers.components._show_order_status_td',compact('order'));
            })
            ->addColumn('is_paid', function($order){
                return view('customer::customers.components._show_order_is_paid_td',compact('order'));
            })
            ->addColumn('action',function($order){
                return view('customer::customers.components._show_order_action_td',compact('order'));
            })
            ->rawColumns(['order_status','is_paid','action'])
            ->make(true);
    }

    public function getWalletHistory($id){
        $customer = $this->customerService->find($id);
        $transaction = $customer->wallet_balances;
        return DataTables::of($transaction)
            ->addIndexColumn()
            ->addColumn('date', function($transaction){
                return dateConvert($transaction->created_at);
            })
            ->addColumn('user',function($transaction){
                return  $transaction->user->first_name;

            })
            ->addColumn('amount',function($transaction){
                return  single_price($transaction->amount);

            })
            ->addColumn('payment_method', function($transaction){
                return $transaction->GatewayName;

            })
            ->addColumn('approval', function($transaction){
                return view('customer::customers.components._wallet_approval_td',compact('transaction'));
            })
            ->rawColumns(['approval'])
            ->make(true);
    }


    public function updateInfo(Request $request)
    {
        if (auth()->user()->email) {
            $email = 'required|email|max:255|unique:users,email,'.auth()->user()->id;
        }else{
            $email = 'nullable|email|max:255|unique:users,email,'.auth()->user()->id;
        }
        if (auth()->user()->phone) {
            $phone = 'required|min:'.app('general_setting')->min_digit.'|max:'.app('general_setting')->max_digit.'|unique:users,phone,'.auth()->user()->id;
        }else{
            $phone = 'nullable|min:'.app('general_setting')->min_digit.'|max:'.app('general_setting')->max_digit.'|unique:users,username,'.auth()->user()->id;
        }
        $request->validate([
            'first_name' => 'required',
            'email' => $email,
            'avatar' => 'nullable|mimes:jpeg,jpg,png,bmp',
            // 'phone_number' => 'required',
            // 'phone' => $phone
        ],[
            "phone.min" => "Minimum ".app('general_setting')->min_digit." digits required on phone number"
        ]);
        try {
            $user=User::findOrFail(auth()->user()->id);
            $data=[
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'Phone_number'      => $request->phone_number,
                // 'Phone_number'      => $request->phone_number,
                //'accounts_payable_email'  => $request->accounts_payable_email,
               // 'commercial_or_residential'  => $request->commercial_or_residential,
               // 'accounts_payable_number'  => $request->accounts_payable_number,
               // 'general_liability'  => $request->general_liability,
               // 'preferred_language'  => $request->preferred_language,
              //  'call_ahead'  => $request->call_ahead,
              //  'pallet_jack'  => $request->pallet_jack,
              //  'forklift'  => $request->forklift,
              //  'loading_dock'  => $request->loading_dock,
                
                
              //  'Company_name'      => $request->company_name,
              //  'username'      => $request->phone,
              //  'date_of_birth' => $request->date_of_birth?date('Y-m-d',strtotime($request->date_of_birth)):null,
              //  'special_instructions'  => $request->special_instructions
             ];

             $file = $request->file('avatar');
             if ($request->hasFile('avatar')) {
                 if ($user->avatar) {
                     $this->deleteImage($user->avatar);
                 }
                 $data['avatar']=$this->saveImage($file,200,200);
            }

            $user->update($data);
            LogActivity::successLog('update info');
            return response()->json($user);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    //new
    public function updateEquipmentInfo(Request $request)
    {
        // $request->validate([
        //     'first_name' => 'required',
        //     'avatar' => 'nullable|mimes:jpeg,jpg,png,bmp',
        // ],[
        //     "phone.min" => "Minimum ".app('general_setting')->min_digit." digits required on phone number"
        // ]);
        try {
            $user=User::findOrFail(auth()->user()->id);
            $data=[
                'preferred_rig_type' => $request->preferred_rig_type,
                'power_source'  => $request->power_source,
                'proportioner_brand'  => $request->proportioner_brand,
                'proportioner_model'  => $request->proportioner_model,
                'preferred_spray_gun'  => $request->preferred_spray_gun
             ];
            //  $file = $request->file('avatar');
            //  if ($request->hasFile('avatar')) {
            //      if ($user->avatar) {
            //          $this->deleteImage($user->avatar);
            //      }
            //      $data['avatar']=$this->saveImage($file,200,200);
            // }
            $user->update($data);
            LogActivity::successLog('update info');
            return response()->json($user);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function updatedetailedInfo(Request $request)
    {
        try {
            $user=User::findOrFail(auth()->user()->id);
            $data=[
                'years_in_business' => $request->years_in_business,
                'number_of_locations'  => $request->number_of_locations,
                'primary_business_function'  => $request->primary_business_function,
                'number_of_rigs'  => $request->number_of_rigs,
                'monthly_volume'  => $request->monthly_volume,
                'open_cell_volume'  => $request->open_cell_volume,
                'total_volume_previous_year'  => $request->total_volume_previous_year,
                'monthly_volume'  => $request->monthly_volume,
                'preferred_foam_brand'  => $request->preferred_foam_brand
             ];
            $user->update($data);
            LogActivity::successLog('update info');
            return response()->json($user);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }
    // new

    public function storeAddress(CreateAddressRequest $request)
    {
        try {
            $data=[
                'customer_id'=>auth()->user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'state'=>$request->state,
                'country'=>$request->country,
                'postal_code'=>$request->postal_code
            ];
            if(isset($request->shipping_address)){
                CustomerAddress::where('is_shipping_default',1)->update(['is_shipping_default'=> 0]);
                $data['is_shipping_default'] = 1;
            }
            if(isset($request->billing_address)){
                CustomerAddress::where('is_billing_default',1)->update(['is_billing_default'=> 0]);
                $data['is_billing_default'] = 1;
            }
            $customer=CustomerAddress::create($data);
            $list=CustomerAddress::where('customer_id',$customer->customer_id)->get();
            if(count($list)<=1){
                $setDefaltData=CustomerAddress::find($customer->id);
                $setDefaltData->is_shipping_default=1;
                $setDefaltData->is_billing_default=1;
                $setDefaltData->save();
            }
            LogActivity::successLog('address added');
            return  $this->loadTableData();
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            return back();
        }
    }

    public function updateAddress(CreateAddressRequest $request){
        try {
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'state'=>$request->state,
                'country'=>$request->country,
                'postal_code'=>$request->postal_code
            ];
            if(isset($request->shipping_address)){
                CustomerAddress::where('is_shipping_default',1)->first()->update(['is_shipping_default'=> 0]);
                $data['is_shipping_default'] = 1;
            }
            if(isset($request->billing_address)){
                CustomerAddress::where('is_billing_default',1)->first()->update(['is_billing_default'=> 0]);
                $data['is_billing_default'] = 1;
            }
            $customer = CustomerAddress::findOrFail($request->address_id);
            $old_data = CustomerAddress::findOrFail($request->address_id);
            $customer->update($data);
            CustomerAddress::create([
                "customer_id" => $old_data->customer_id,
                "name" => $old_data->name,
                "email" => $old_data->email,
                "phone" => $old_data->phone,
                "address" => $old_data->address,
                "city" => $old_data->city,
                "state" => $old_data->state,
                "country" => $old_data->country,
                "postal_code" => $old_data->postal_code,
                "is_shipping_default" => $old_data->is_shipping_default,
                "is_billing_default" => $old_data->is_billing_default,
                "is_updated" => 1,
            ]);

            LogActivity::successLog('update address');
            return  $this->loadTableData();
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'));
            return back();
        }
    }

    public function setDefaultShipping(Request $request)
    {
       CustomerAddress::where('customer_id',$request->c_id)->update(['is_shipping_default'=> 0]);
       $customer=CustomerAddress::find($request->c_list_id);
       $customer->is_shipping_default=1;
       $customer->save();
       LogActivity::successLog('set default shipping.');
       return  $this->loadTableData();
    }

    public function setDefaultBilling(Request $request)
    {
       CustomerAddress::where('customer_id',$request->c_id)->update(['is_billing_default'=> 0]);
       $customer=CustomerAddress::find($request->c_list_id);
       $customer->is_billing_default = 1 ;
       $customer->save();
       LogActivity::successLog('set default billing.');
       return  $this->loadTableData();
    }

    public function editAddress($c_id){
        try {
            $address=CustomerAddress::findOrFail($c_id);
            $countries = Country::where('status', 1)->orderBy('name')->get();
            if (auth()->user()->role->type != 'customer') {
                return view('backEnd.pages.customer_data._edit_address_form',compact('address', 'countries'));
            }
            else {
                return view(theme('pages.profile.partials._edit_form'),compact('address', 'countries'));
            }

        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());

            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }

    public function deleteAddress(Request $request){
        try{
            $addressExist = Order::where('customer_id',auth()->user()->id)->where('customer_shipping_address', $request->id)->orWhere('customer_billing_address', $request->id)->first();
            if (!$addressExist) {
                $customer_address = CustomerAddress::where('id',$request->id)->where('customer_id', auth()->user()->id)->first();
                if($customer_address->is_shipping_default == 1 || $customer_address->is_billing_default == 1){
                    return 'is_default';
                }
                $customer_address->delete();
                LogActivity::successLog('address deleted');
                return $this->loadTableData();
            }else{
                return 'is_used';
            }

        }catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function imageDelete(Request $request){
        try{
            $this->customerService->imageDelete($request->except("_token"));
            LogActivity::successLog('address deleted');
            return true;
        }catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    private function loadTableData()
    {
        try {
            $addressList=CustomerAddress::where('customer_id',auth()->user()->id)->get();
            return response()->json([
                'addressList' =>  (auth()->user()->role->type != 'customer') ?(string)view('backEnd.pages.customer_data._table',compact('addressList')) : (string)view(theme('pages.profile.partials._table'),compact('addressList')),
                'addressListForShipping' =>  (auth()->user()->role->type != 'customer') ?(string)view('backEnd.pages.customer_data._shipping_address',compact('addressList')) : (string)view(theme('pages.profile.partials._shipping'), compact('addressList')),
                'addressListForBilling' =>  (auth()->user()->role->type != 'customer') ?(string)view('backEnd.pages.customer_data._billing_address',compact('addressList')) : (string)view(theme('pages.profile.partials._billing'), compact('addressList')),
            ]);

        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function update_active_status(Request $request)
    {
        try {
            $userRepo = new UserRepository;
            $userRepo->statusUpdate($request->all());
            LogActivity::successLog('customer update active status');
            return 1;
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }
    private function cancelPayPalAgreement($agreementId)
    {
        try {
            // Attempt to retrieve the agreement details
            $agreement = \PayPal\Api\Agreement::get($agreementId, $this->apiContext);
            Log::info("Agreement details: " . json_encode($agreement));
        
            // Check if the agreement is in an active state before canceling
            if ($agreement->getState() !== "Active") {
                Log::error("Agreement is not in an active state. Current state: " . $agreement->getState());
                return; // Stop further execution if agreement is not active
            }
    
            // Proceed with cancellation
            $agreementStateDescriptor = new \PayPal\Api\AgreementStateDescriptor();
            $agreementStateDescriptor->setNote("Customer canceled the agreement.");
            $agreement->cancel($agreementStateDescriptor, $this->apiContext);
    
            Log::info("Agreement canceled successfully.");
            LogActivity::successLog("PayPal agreement {$agreementId} canceled successfully.");
            
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Check if the error is a 404 not found
            $errorData = json_decode($ex->getData(), true);
            if ($ex->getCode() === 404) {
                Log::warning("PayPal agreement {$agreementId} not found or already canceled.");
                LogActivity::errorLog("PayPal agreement {$agreementId} not found or already canceled.");
            } else {
                // Handle other PayPal API connection errors
                Log::error("PayPal API connection error: " . $ex->getData());
                LogActivity::errorLog("PayPal API connection error: " . $ex->getData());
            }
            
        } catch (\Exception $e) {
            // Catch any other exceptions
            Log::error("Failed to cancel PayPal agreement: " . $e->getMessage());
            LogActivity::errorLog("Failed to cancel PayPal agreement: " . $e->getMessage());
        }
    }
     
    public function update_approved_status(Request $request)
    {
      try {
            $subscription_payment = CustomerSubscriptionPaymentInfo::find($request->id);
            $user = User::find($request->customer_id);
            // Check if the customer has an existing active subscription
     
            if ($request->is_approved == 1) {
                $canceledSubscriptions = CustomerSubscriptionPaymentInfo::where('customer_id', $request->customer_id)
                ->where('status', 'Cancel')
                ->whereNotNull('paypal_agreement_id')
                ->get();
                // Step 3: Cancel each PayPal agreement for the canceled subscriptions
                foreach ($canceledSubscriptions as $subscription) {
                    $this->cancelPayPalAgreement($subscription->paypal_agreement_id);
                }
                // Update the subscription status
                $subscription_payment->is_approved = 1;
                $subscription_payment->status = "Active"; 
                $subscription_payment->start_date = Carbon::now();
                $subscription_payment->expiration_date = Carbon::now()->addDays($subscription_payment->pricingPlans->expire_in);
                $subscription_payment->save();

                // Create PayPal Product
                $product_id = $this->createPayPalProduct($subscription_payment->pricingPlans->name, 'Product for ' . $subscription_payment->pricingPlans->name);
                // Create PayPal billing plan and agreement
                $billingPlan = $this->createPayPalBillingPlan($subscription_payment, $product_id);
                $agreement = $this->createPayPalBillingAgreement($billingPlan, $subscription_payment);

                // Store the agreement approval URL for the customer to approve it
                $approvalUrl = $agreement['links'][0]['href'];
                // Save the PayPal agreement ID and approval URL
                $subscription_payment->paypal_agreement_id = $agreement['id'];
                $subscription_payment->approval_url = $approvalUrl;
                $subscription_payment->save();

                $user->status = "Active";
                $user->save();
                $to_email = $user->email;
                // Send email notification with approval link
                $this->send_approval_email($to_email,'Approve Your Subscription Agreement','emails.mail_approval',$approvalUrl,$user);
        
                LogActivity::successLog('Subscription approved. Approval email sent to customer.');
                return 0;
            } else {
                $subscription_payment->is_approved = 0;
                $subscription_payment->status = "Pending";
                $subscription_payment->start_date = null;
                $subscription_payment->expiration_date = null;
                $subscription_payment->save();
                
                $user->status = "Pending";
                $user->save();
                LogActivity::successLog('Customer subscription approval status updated.');
                return 0;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }
    private function createPayPalProduct($name, $description)
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.secret');
        // Initialize the PayPal client
        $client = new \GuzzleHttp\Client();

        // Define the product details
        $productData = [
            'name' => $name,
            'description' => $description,
            'type' => 'SERVICE', // or 'DIGITAL' or 'PHYSICAL' based on your product type
            'category' => 'SOFTWARE', // Adjust this as needed
        ];
        // Send the request to PayPal API to create a product
        $response = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/catalogs/products', [
            'auth' => [$clientId, $clientSecret],
            'json' => $productData,
        ]);
        // Decode the response
        $product = json_decode($response->getBody(), true);

        if (isset($product['id'])) {
            return $product['id']; // Return the product ID
        } else {
            throw new \Exception('Error creating product: ' . json_encode($product));
        }
    }

    private function createPayPalBillingPlan($subscription_payment, $product_id)
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.secret');
    
        // Initialize the PayPal client
        $client = new \GuzzleHttp\Client();
    
        // Define the billing plan details with required fields
        $billingPlanData = [
            'product_id' => $product_id, // Ensure this is a valid product ID
            'name' => $subscription_payment->pricingPlans->name, // Subscription plan name
            'description' => 'Subscription for ' . $subscription_payment->pricingPlans->name, // Description of the subscription
            'status' => 'ACTIVE',
            'billing_cycles' => [
                [
                    'frequency' => [
                        'interval_unit' => 'MONTH', // Billing interval unit
                        'interval_count' => 1,       // Billing interval count (e.g., every month)
                    ],
                    'tenure_type' => 'REGULAR',    // Regular billing cycle
                    'sequence' => 1,               // Sequence order of the cycle
                    'total_cycles' => 12,          // Total cycles (12 months)
                    'pricing_scheme' => [
                        'fixed_price' => [
                            'currency_code' => 'USD',                // Currency for the pricing
                            'value' => (string) $subscription_payment->pricingPlans->plan_price // Price as a string
                        ]
                    ]
                ]
            ],
            'payment_preferences' => [
                'auto_bill_outstanding' => true, // Automatically bill outstanding amounts
                'setup_fee' => [
                    'currency_code' => 'USD',     // Currency for the setup fee
                    'value' => '0.00',            // Change this if there's a setup fee
                ],
                // 'cancel_url' => route('subscription.cancel'), // Your cancellation URL
                // 'return_url' => route('subscription.success'), // Your return URL
                'initial_fail_amount_action' => 'CONTINUE', // Action if the initial payment fails
                'payment_failure_threshold' => 3            // Number of failed attempts before canceling
            ]
        ];
    
        // Send the request to PayPal API
        $response = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/billing/plans', [
            'auth' => [$clientId, $clientSecret],
            'json' => $billingPlanData,
        ]);
    
        // Decode the response
        $billingPlan = json_decode($response->getBody(), true);
    
        if (isset($billingPlan['id'])) {
            return $billingPlan['id']; // Return the billing plan ID
        } else {
            throw new \Exception('Error creating billing plan: ' . json_encode($billingPlan));
        }
    }
    
    private function createPayPalBillingAgreement($billingPlanId, $subscription_payment)
    {
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.secret');
    
        // Initialize the PayPal client
        $client = new \GuzzleHttp\Client();
    
        // Define the subscription agreement details
        $subscriptionData = [
            'plan_id' => $billingPlanId,
            'start_time' => now()->addMinutes(10)->toIso8601String(), // Set the start time for the subscription
            'subscriber' => [
                'name' => [
                    'given_name' => $subscription_payment->customerSubscription->first_name, // Customer's first name
                    'surname' => $subscription_payment->customerSubscription->last_name,    // Customer's last name
                ],
                'email_address' => $subscription_payment->customerSubscription->email,        // Customer's email
            ],
            'application_context' => [
                'brand_name' => 'spfopenmarket',
                'locale' => 'en-US',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'SUBSCRIBE_NOW',
                // 'cancel_url' => route('subscription.cancel'),
                // 'return_url' => route('subscription.success'),
            ],
        ];
    
        // Send the request to PayPal API
        $response = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions', [
            'auth' => [$clientId, $clientSecret],
            'json' => $subscriptionData,
        ]);
    
        // Decode the response
        $subscription = json_decode($response->getBody(), true);
    
        if (isset($subscription['id'])) {
            return $subscription; // Return the subscription details
        } else {
            throw new \Exception('Error creating subscription: ' . json_encode($subscription));
        }
    }
    function send_approval_email($to_email,$subject,$template,$approvalUrl,$user)
    {
    //    dd($to_email,$subject,$template,$approvalUrl);
        Mail::send($template, ['approvalUrl'=>$approvalUrl,'user' => $user], function($message) use ($subject, $to_email) {
            $message->to($to_email,$subject)->subject($subject);
            $message->from('Admin@spfopenmarket.com',$subject);
        });
    }
    //In this, we are implemented Stripe recurring payments
    public function old_update_approved_status(Request $request)
    {
        try {
            $subscription_payment = CustomerSubscriptionPaymentInfo::where('id', $request->id)->first();
            $user = User::where('id', $request->customer_id)->first();

            if ($request->is_approved == 1) {
                $subscription_payment->is_approved = 1;
                $subscription_payment->status = "Active";
                $subscription_payment->start_date = Carbon::now(); // Set start date
                $subscription_payment->expiration_date = Carbon::now()->addDays($subscription_payment->pricingPlans->expire_in); // Set expiration date
                $subscription_payment->save();

                // Update customer current plan status
                $user->status = "Active";
                $user->save();

                LogActivity::successLog('Customer subscription approval status updated.');

                // Schedule next recurring payment before expiration
                // $this->schedulePaymentBeforeExpiration($subscription_payment);

                return 1;
            } else {
                $subscription_payment->is_approved = 0;
                $subscription_payment->status = "Pending";
                $subscription_payment->start_date = null;
                $subscription_payment->expiration_date = null;
                $subscription_payment->save();

                $user->status = "Pending";
                $user->save();

                LogActivity::successLog('Customer subscription approval status updated.');
                return 0;
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }
    public function schedulePaymentBeforeExpiration($subscription_payment)
    {
        $user = User::where('id', $subscription_payment->customer_id)->first();
        // Set the Stripe API key
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    
        try {
            // Attempt to retrieve the Stripe subscription using the subscription ID
            $subscription = \Stripe\Subscription::retrieve($subscription_payment->stripe_subscription_id);    
            // If the payment is successful, mark the subscription as 'Active'
            if ($subscription->status == 'active') {
                $subscription_payment->is_approved = 1;
                $subscription_payment->status = 'Active';
                $subscription_payment->start_date = Carbon::now(); // Set start date
                $subscription_payment->expiration_date = Carbon::now()->addDays($subscription_payment->pricingPlans->expire_in); // Set expiration date
                $user->status = "Active";
            } else {
                // If the payment fails, mark it as 'Expired'
                $subscription_payment->status = 'Expired';
                $user->status = "Expired";
            }
    
            // Save the updated subscription status to the database
            $subscription_payment->save();
            $user->save();
    
        } catch (\Exception $e) {
            // Log any errors encountered during the process
            \Log::error('Error charging subscription: ' . $e->getMessage());
        }
    }
    
    
    public function customerBulkUpload()
    {
        try {
            return view('customer::customers.bulk_upload');
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return 0;
        }
    }

    public function customerBulkUploadStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xls,xlsx|max:2048'
        ]);
        ini_set('max_execution_time', 0);
        DB::beginTransaction();
        try {
            $this->customerService->BulkUploadStore($request->except('_token'));
            DB::commit();
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Customer Bluk Upload Successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('common.duplicate_entry_is_exist_in_your_file'));
            } else {
                Toastr::error(__('common.invalid_csv_file'));
            }
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }
    public function update_approved_quiz(Request $request)
    {
        try {
            $customer = User::find($request->id);
            if (!$customer) {
                return response()->json(['error' => __('common.customer_not_found')], 404);
            }
    
            // Update quiz approval status
            $customer->quiz_approved = $request->quiz_approved;
            $customer->save();
    
            return response()->json(1); // Success
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
