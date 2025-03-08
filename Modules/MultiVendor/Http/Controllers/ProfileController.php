<?php

namespace Modules\MultiVendor\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Setup\Services\StateService;
use Modules\FrontendCMS\Entities\Pricing;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\MultiVendor\Services\ProfileService;
use Modules\MultiVendor\Entities\SellerSubcription;
use Modules\MultiVendor\Repositories\CommisionRepository;
use Modules\MultiVendor\Http\Requests\SellerAccountRequest;
use Modules\MultiVendor\Http\Requests\SellerBankAccountRequest;
use Modules\MultiVendor\Http\Requests\SellerReturnAddressRequest;
use Modules\MultiVendor\Http\Requests\SellerWarehouseAddressRequest;
use Modules\MultiVendor\Http\Requests\SellerBusinessInformationRequest;

use App\Models\User;
use App\Models\UsersRegisteredBusiness;
use App\Models\RegisteredBusinessPhoneNumbers;
use App\Models\UsersPhoneNumbers;
use App\Models\UserPaymentBillingAddresses;
use App\Models\UserPaymentsInfo;
class ProfileController extends Controller
{
    protected $seller;
    protected $stateService;

    public function __construct(ProfileService $seller, StateService $stateService)
    {
        $this->middleware('maintenance_mode');
        $this->seller = $seller;
        $this->stateService = $stateService;
    }

    public function index()
    {
        // dd("ok");
        $countries = $this->stateService->getCountries();

        if (Auth::check()) {
            $id = getParentSellerId();
            $seller = $this->seller->getData($id);
            $commissionRepo = new CommisionRepository();
            $commissions = $commissionRepo->getAll();
            $pricings = Pricing::where('status', 1)->get();
            // return view('multivendor::profile.index', compact('seller'));

            return view('multivendor::profile.index', compact('seller', 'countries', 'commissions', 'pricings'));
        } else {
            return abort(404);
        }
    } 
    //new update method 
    public function updateSellerProfileInfo(Request $request, $id)
    {
       
      if ($request->form_type == 'seller') {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'seller_company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255,' . $id,
        ]);
    
        try {
            // Find the seller by ID
            $seller = User::findOrFail($id);
    
            // Update seller account information
            $seller->update([
                'first_name' => $request->input('first_name'),
                'seller_company_name' => $request->input('seller_company_name'),
                'email' => $request->input('email'),
            ]);
    
            return redirect()->back()->with('success', 'Seller account updated successfully.');
    
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Seller not found.');
    
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the seller account.');
        }
      }
      if($request->form_type == 'question') {
        //  $request->validate([
        //     'registerd_business_locations' => 'required',
        //     'solo_business_name' => 'required',
        //     'Good_services_type' => 'required',
        //     'transaction_estimates' => 'required',
        //     'how_many_locations' => 'required',
        //     'List_locations_states' => 'required',
        //     'company_description' => 'required',
        //     'business_type' => 'required',
        // ]);
            // dd($request->all());
        if ($request->form_type == 'question') {
            // Find the business record
            $business = UsersRegisteredBusiness::findOrFail($request->business_id);
            $storesJson = json_encode($request->stores);
            if ($request->has('List_locations_states')) {
                $states = explode(',', $request->input('List_locations_states')); // Split by commas
                $states = array_map('trim', $states); // Trim extra spaces
                $jsonStates = json_encode($states); // Convert to JSON
            }
            
            // Update the business details
            $business->update([
                'registerd_business_locations' => $request->registerd_business_locations,
                'solo_business_name' => $request->solo_business_name,
                'Good_services_type' => $request->Good_services_type,
                'transaction_estimates' => $request->transaction_estimates,
                'how_many_locations' => $request->how_many_locations,
                'List_locations_states' => $jsonStates,
                'company_description' => $request->company_description,
                'business_type' => $request->business_type,
                'all_stores_data' => $storesJson,

            ]);
    
            // Redirect with success message
            return redirect()->back()->with('success', 'Business questions information updated successfully!');
        }
    
        // Handle other form types if necessary
        return redirect()->back()->with('error', 'Invalid form type!');
              
      }
      if($request->form_type == 'business'){
             // Validate form input
        $request->validate([
            'form_type' => 'required|in:business',
            'business_name' => 'required|string|max:255',
            'company_registration_number' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'zip_postal_code' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'appartment_building_suite_other' => 'nullable|string|max:255',
            'city_town' => 'required|string|max:255',
            'state_region' => 'required|string|max:255',
        ]);
    
        try {
           $RegisteredBusinessPhoneNumbers = RegisteredBusinessPhoneNumbers::where('user_registered_business_id', $request->business_id)->first();
            if ($RegisteredBusinessPhoneNumbers) {
                // Update the existing record
                $RegisteredBusinessPhoneNumbers->update(['phone_number' => $request->phone_number]);
            } else {
                // Create a new record if it doesn't exist
                RegisteredBusinessPhoneNumbers::create([
                    'user_registered_business_id' => $request->business_id,
                    'phone_number' => $request->phone_number,
                ]);
            }

            // Find the business and update its information in a single operation
            $business = UsersRegisteredBusiness::findOrFail($request->business_id);
            $business->update([
                'business_name' => $request->business_name,
                'company_registration_number' => $request->company_registration_number,
                'country' => $request->country,
                'zip_postal_code' => $request->zip_postal_code,
                'address_line1' => $request->address_line1,
                'appartment_building_suite_other' => $request->appartment_building_suite_other,
                'city_town' => $request->city_town,
                'state_region' => $request->state_region,
            ]);

    
            return redirect()->back()->with('success', 'Business information updated successfully!');
            } catch (ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'Business not found.');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'An error occurred while updating business information.');
            }
              
      }
      if($request->form_type == 'primary'){
           // Validate the form input
            $request->validate([
                'owners.*.ownerName' => 'required|string|max:255',
                'owners.*.percentage' => 'required|numeric|min:0|max:100',
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:15',
                'country_of_citizenship' => 'nullable|string|max:255',
                'country_of_birth' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'country' => 'nullable|string|max:255',
                'city_town' => 'nullable|string|max:255',
                'address_line1' => 'nullable|string|max:255',
                'zip_postal_code' => 'nullable|string|max:20',
                'appartment_building_suite_other' => 'nullable|string|max:255',
                'state_region' => 'nullable|string|max:255',
                'beneficial_owner_check' => 'nullable|boolean',
                'legal_representative_check' => 'nullable|boolean',
                'primary_contact_person_check' => 'nullable|boolean',
                'confirmation_check' => 'nullable|boolean',
            ]);

            $owners = $request->input('owners');
          if($request->form_type == 'primary'){
           $userPhoneNumbers = UsersPhoneNumbers::where('user_id', $id)->first();
            if ($userPhoneNumbers) {
                // Update the existing record
                $userPhoneNumbers->update(['phone_number' => $request->phone_number]);
            } else {
                // Create a new record if it doesn't exist
                UsersPhoneNumbers::create([
                    'user_id' => $id,
                    'phone_number' => $request->phone_number,
                ]);
            }
            $primaryContactPerson = User::findOrFail($id);
            $ownersJson = json_encode(array_values($owners)); 
            $primaryContactPerson->update([
                'all_owner_data' => $ownersJson,
                'primary_first_name' => $request->input('first_name'),
                'primary_last_name' => $request->input('last_name'),
                'country_of_citizenship' => $request->input('country_of_citizenship'),
                'country_of_birth' => $request->input('country_of_birth'),
                'date_of_birth' => $request->input('date_of_birth'),
                'city_town' => $request->input('city_town'),
                'address_line1' => $request->input('address_line1'),
                'zip_postal_code' => $request->input('zip_postal_code'),
                'appartment_building_suite_other' => $request->input('appartment_building_suite_other'),
                'state_region' => $request->input('state_region'),
                'beneficial_owner_check' => $request->input('beneficial_owner_check', 0),
                'legal_representative_check' => $request->input('legal_representative_check', 0),
                'primary_contact_person_check' => $request->input('primary_contact_person_check', 0),
                'confirmation_check' => $request->input('confirmation_check', 0),
            ]);
               return redirect()->back()->with('success', ' Primary contact person updated successfully.');
           }
   
        return redirect()->back()->with('error', 'An error occurred while updating primary contact person information.');
      }
      
      if($request->form_type == 'payment'){
                // Validate the form ipaymentnputs
        $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'card_number' => 'required|string',
            // 'expire_in' => 'required|string|regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/', // MM/YY format
            'billing_address' => 'required|string|max:255',
        ]);
        if($request->form_type == 'payment'){
        $UserPaymentsInfo = UserPaymentsInfo::findOrFail($request->payment_id);
        $UserPaymentsInfo->card_holder_name = $request->input('card_holder_name');
        $UserPaymentsInfo->card_number = $request->input('card_number'); // Encrypt sensitive data
        $UserPaymentsInfo->expire_in = $request->input('expire_in');
        $UserPaymentsInfo->save();
    
        // Update or create billing address
        $billingAddress = UserPaymentBillingAddresses::where('user_payment_info_id',$request->payment_id);
            if ($billingAddress) {
                // Update the existing record
                $billingAddress->update(['billing_address' => $request->billing_address]);
            } else {
                // Create a new record if it doesn't exist
                UserPaymentBillingAddresses::create([
                    'user_payment_info_id' => $request->payment_id,
                    'billing_address' =>  $request->billing_address,
                ]);
            }

    
          // Redirect back with a success message
           return redirect()->back()->with('success', 'Payment information updated successfully.');
            }
              return redirect()->back()->with('error', 'An error occurred while updating payment information  information.');
          }
         return redirect()->back()->with('error', 'An error occurred while updating information.');
    }
 
    public function sellerAccountUpdate(SellerAccountRequest $request, $id)
    {
        try {
            $this->seller->sellerAccountUpdate($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Seller account update successful.');
            $user  = getParentSeller();
            if ($user->role->type != 'superadmin' && $user->role->type != 'admin') {
                return redirect()->route('seller.profile.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }
    public function businessInformationUpdate(SellerBusinessInformationRequest $request, $id)
    {

        try {
            $this->seller->businessInformationUpdate($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Business information update successful.');
            $user  = auth()->user();
            if ($user->role->type != 'admin' && $user->role->type != 'superadmin') {
                return redirect()->route('seller.profile.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }
    public function bankAccountUpdate(SellerBankAccountRequest $request, $id)
    {

        try {
            $this->seller->bankAccountUpdate($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Bank account update successful.');
            $user  = auth()->user();
            if ($user->role->type != 'admin' && $user->role->type != 'superadmin') {
                return redirect()->route('seller.profile.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function businessImgDelete(Request $request)
    {
        $del = $this->seller->businessImgDelete($request->id);
        LogActivity::successLog('Business img delete successful.');
        return $del;
    }

    public function bankImgDelete(Request $request)
    {
        $del = $this->seller->bankImgDelete($request->id);
        LogActivity::successLog('Bank img delete successful.');
        return $del;
    }

    public function warehouseAddressUpdate(SellerWarehouseAddressRequest $request, $id)
    {

        try {
            $this->seller->warehouseAddressUpdate($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Warehouse address update successful.');
            $user  = auth()->user();
            if ($user->role->type != 'admin' && $user->role->type != 'superadmin') {
                return redirect()->route('seller.profile.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }
    public function returnAddressUpdate(SellerReturnAddressRequest $request, $id)
    {

        try {
            $this->seller->returnAddressUpdate($request->except('_token'), $id);
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Return address update successful.');
            $user  = auth()->user();
            if ($user->role->type != 'admin' && $user->role->type != 'superadmin') {
                return redirect()->route('seller.profile.index');
            } else {
                return back();
            }
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 503);
        }
    }

    public function returnAddresChange(Request $request)
    {

        $update = $this->seller->returnAddressChange($request->except('_token'));
        LogActivity::successLog('Return addres change successful.');
        return $update;
    }


    public function tabSelect($id)
    {
        Session::put('profile_tab', $id);
        return 'done';
    }
}
