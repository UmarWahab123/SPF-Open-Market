<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Traits\GoogleAnalytics4;
use Illuminate\Support\Facades\App;
use Modules\Customer\Entities\CustomerAddress;
use Modules\Visitor\Entities\VisitorHistory;
use Modules\Marketing\Entities\ReferralCode;
use Modules\MultiVendor\Entities\SellerAccount;
use Modules\Seller\Entities\SellerProduct;
use Modules\Review\Entities\ProductReview;
use Modules\Refund\Entities\RefundRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Account\Entities\Transaction;
use Modules\Marketing\Entities\CouponUse;
use Modules\Marketing\Entities\Coupon;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Setup\Entities\Country;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\SearchTerm;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Modules\FormBuilder\Repositories\FormBuilderRepositories;
use App\Models\Cart;
use Illuminate\Support\Facades\Schema;
use App\Models\OrderPackageDetail;
use App\Models\OrderProductDetail;
use Carbon\Carbon;
use Nwidart\Modules\Facades\Module;
use Illuminate\Http\Request;
use Exception;
use Modules\FrontendCMS\Entities\LoginPage;
use Illuminate\Support\Facades\DB;
use Modules\Setup\Repositories\CityRepository;
use Modules\Setup\Repositories\StateRepository;
use Modules\UserActivityLog\Traits\LogActivity;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;


class ProfileController extends Controller
{
    use GoogleAnalytics4;

    public function __construct()
    {
        $this->middleware(['maintenance_mode','auth','customer']);
    }

    public function index(){
        try{
            $data['user_info'] = User::find(auth()->user()->id);
            $data['addressList'] = CustomerAddress::where('customer_id',auth()->user()->id)->where('is_updated',0)->get();
            $data['countries'] = Country::where('status', 1)->orderBy('name')->get();
            $data['states'] = (new StateRepository())->getByCountryId(app('general_setting')->default_country)->where('status', 1);
            $data['cities'] = (new CityRepository())->getByStateId(app('general_setting')->default_state)->where('status', 1);
            if (auth()->user()->role->type != 'customer') {
                return view('backEnd.pages.customer_data.profile',$data);
            }
            else {
                // dd(User::find(auth()->user()->id));
                return view(theme('pages.profile.profile'),$data);
            }
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }
    public function dashboard()
    {
        try{
            if (auth()->user()->role->type == "superadmin" || auth()->user()->role->type == "admin" || auth()->user()->role->type == "staff") {
                if (app('business_settings')->where('type', 'google_analytics')->first()->status == 1 &&  env('ANATYTIC_RESULT_DASHBOARD') == 1){
                    $analytic = Analytics::fetchVisitorsAndPageViews(Period::days(1));
                    $a = Analytics::fetchVisitorsAndPageViews(Period::days(1));
                    $data['total_page_visitor'] = $a->sum('visitors');
                    $data['total_page_views'] = $a->sum('pageViews');
                    $userType = Analytics::fetchUserTypes(Period::days(3));
                    $data['total_new_visitor'] = $userType->where('type', 'New Visitor')->sum('sessions');
                    $data['total_old_views'] = $userType->where('type', 'Returning Visitor')->sum('sessions');
                    $data['total_in_session'] = $data['total_new_visitor'] + $data['total_old_views'];
                }
                $data['totalProducts'] = Product::where('is_approved',1)->count();
                $data['totalSellers'] = isModuleActive('MultiVendor')?SellerAccount::all()->count():0;
                $data['totalCustomers'] = User::where('role_id',4)->get()->count();
                $data['totalvisitors'] = VisitorHistory::VisitorCount('today');
                $data['total_sale'] = Order::TotalSaleCount('today');
                $data['total_review'] = ProductReview::TotalReviewCount('today');
                $data['categories'] = Category::whereHas('products')->limit(10)->take(10)->get();
                $data['topSaleCategories'] = Category::orderBy('total_sale','desc')->limit(10)->take(10)->get();
                $data['categoriesTotal'] = Category::where('status', 1)->count();
                $data['top_ten_products'] = SellerProduct::with('product','product.categories','product.brand')->orderBy('total_sale','desc')->limit(10)->take(10)->get();
                $data['top_ten_sellers'] = isModuleActive('MultiVendor')?SellerAccount::with('user')->orderBy('total_sale_qty','desc')->limit(10)->take(10)->get():[];
                $data['coupon_wise_sales'] = Coupon::with('coupon_uses')->whereHas('coupon_uses')->limit(10)->take(10)->latest()->get();
                $data['total_coupon'] = Coupon::with('coupon_uses')->get();
                $data['total_order'] = Order::OrderInfo('today', 'all');
                $data['total_pending_order'] = Order::OrderInfo('today', 0);
                $data['total_completed_order'] = Order::OrderInfo('today', 1);
                $data['income'] = Transaction::GetIncome('today');
                $data['expense'] = Transaction::GetExpense('today');
                $data['total_revenue'] = $data['income'] - $data['expense'];
                $data['new_customers'] = User::where('role_id', 4)->latest()->limit(10)->take(10)->get();
                $data['total_active_customers'] = User::where('role_id', 4)->where('is_active', 1)->get()->count();
                $data['total_subscriber'] = Subscription::count();
                $data['latest_search_keywords'] = SearchTerm::latest()->limit(10)->take(10)->get();
                $data['recently_added_products'] = SellerProduct::with('product','product.categories','product.brand')->latest()->take(10)->get();
                $data['top_refferers'] = ReferralCode::with('user')->orderBy('total_used','desc')->take(10)->get();
                $data['latest_orders'] = Order::with('packages', 'customer')->latest()->take(10)->get();
                $data['graph_total_product'] = SellerProduct::where('status',1)->select('id')->count();
                $data['graph_admin_product'] = SellerProduct::whereHas('seller', function($q){
                                                    $q->where('role_id', 1);
                                                })->where('status',1)->count();
                $data['graph_seller_product'] = SellerProduct::whereHas('seller', function($q){
                                                    $q->where('role_id', 5);
                                                })->where('status',1)->count();

                $data['graph_total_sales'] = Order::count();
                $data['graph_cancelled_sales'] = count(Order::where('is_cancelled', 1)->get());
                $data['graph_completed_sales'] = count(Order::where('is_completed', 1)->get());
                $data['graph_sales_today'] = count(Order::where('is_confirmed', 0)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());
                $data['graph_pending_sales_today'] = count(Order::where('is_confirmed', 0)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());
                $data['graph_processing_sales_today'] = count(Order::where('is_confirmed', 1)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());
                $data['graph_completed_sales_today'] = count(Order::where('is_completed', 1)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());
                $data['graph_total_sellers'] = isModuleActive('MultiVendor')?count(SellerAccount::all()):0;
                $data['graph_normal_sellers'] = isModuleActive('MultiVendor')?count(SellerAccount::where('is_trusted', 0)->get()):0;
                $data['graph_trusted_sellers'] = isModuleActive('MultiVendor')?count(SellerAccount::where('is_trusted', 1)->get()):0;

                $data['top_disputed_customer'] = DB::table('refund_requests')
                                                    ->select(DB::raw('customer_id as customer_id'), DB::raw('sum(total_return_amount) as total'))
                                                    ->groupBy(DB::raw('customer_id'))
                                                    ->orderBy('total','desc')
                                                    ->take(10)
                                                    ->get();
                $data['top_disputed_sellers'] = DB::table('refund_request_details')
                                                    ->select(DB::raw('seller_id as seller_id'), DB::raw('count(seller_id) as total'))
                                                    ->groupBy(DB::raw('seller_id'))
                                                    ->orderBy('total','desc')
                                                    ->take(10)
                                                    ->get(['seller_id']);
                $data['graph_total_authorized_order'] = count(Order::where('customer_id', '!=', null)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());;
                $data['graph_total_guest_order'] = count(Order::where('customer_id', null)->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get());;
                $data['total_product_in_cart'] = Cart::TotalCart('today');
                return view('backEnd.dashboard', $data);
            }else {
                // dd("ss");
                $data['total_order_count'] = Order::where('customer_id', auth()->user()->id)->count();
                $data['total_confirmed_order_count'] = Order::where('customer_id', auth()->user()->id)->where('is_confirmed',1)->count();
                $data['total_completed_order_count'] = Order::where('customer_id', auth()->user()->id)->where('is_completed',1)->count();
                $data['total_processing_order_count'] = Order::where('customer_id', auth()->user()->id)->where('is_confirmed',1)->where('is_completed',0)->count();
                $wishlist_query = Wishlist::query()->where('user_id', auth()->user()->id)->whereHas('product', function($q){
                    $q->activeSeller();
                });
                $data['wishlists'] = $wishlist_query->with(['product.product','product.skus'])->latest()->take(4)->get();
                $data['total_wishlist_count'] = $wishlist_query->count();
                $data['total_item_in_carts'] = Cart::where('user_id', auth()->user()->id)->count();
                $data['total_success_refund'] = RefundRequest::where('customer_id', auth()->user()->id)->where('is_completed', 1)->count();
                $data['total_coupon_used'] = CouponUse::where('user_id', auth()->user()->id)->count();
                $data['purchase_histories'] = OrderPackageDetail::with(['order','products'])->whereHas('order', function($query){
                    $query->where('customer_id', auth()->id());
                })->latest()->paginate(5);

                $data['carts'] = \App\Models\Cart::with('product.product.product','giftCard','product.product_variations.attribute', 'product.product_variations.attribute_value.color')->where('user_id',auth()->user()->id)->where('product_type', 'product')->whereHas('product',function($query){
                        return $query->where('status', 1)->whereHas('product', function($q){
                            return $q->activeSeller();
                        });
                    })->orWhere('product_type', 'gift_card')->where('user_id',auth()->user()->id)->whereHas('giftCard', function($query){
                        return $query->where('status', 1);
                    })->latest()->take(4)->get();
                $data['recent_order_products'] = OrderProductDetail::with(['seller_product_sku.product.product','giftCard'])->select('order_product_details.*')->join('order_package_details', function($query){
                    $query->on('order_package_details.id','=','order_product_details.package_id')->join('orders', function($query1){
                        $query1->on('orders.id','=','order_package_details.order_id')->where('orders.customer_id',auth()->id());
                    });
                })->distinct('order_product_details.id')->orderByDesc('order_product_details.id')->take(4)->get();
                return view(theme('pages.profile.dashboard'), $data);
            }
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }
   
    public function dashboardCards($type)
    {
        $total_visitors = VisitorHistory::VisitorCount($type);
        $total_sale = Order::TotalSaleCount($type);
        $total_order = Order::OrderInfo($type, 'all');
        $total_pending_order = Order::OrderInfo($type, 0);
        $total_completed_order = Order::OrderInfo($type, 1);
        $total_review = ProductReview::TotalReviewCount('today');
        $income = Transaction::GetIncome($type);
        $expense = Transaction::GetExpense($type);
        $total_revenue = $income - $expense;
        return [
            'total_visitors' => $total_visitors,
            'total_sale' => single_price($total_sale),
            'total_order' => $total_order,
            'total_pending_order' => $total_pending_order,
            'total_completed_order' => $total_completed_order,
            'total_review' => $total_review,
            'total_revenue' => single_price($total_revenue),
        ];
    }

    public function order(){

        try{

            return view(theme('pages.profile.order'));
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function refund(){
        try{

            return view(theme('pages.profile.refund'));
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }
    public function buyerQuiz(){
        // dd("ok");
        $user = Auth::user();
        // dd($user);
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
      return view(theme('pages.profile.quiz'),compact('row','form_data','loginPageInfo' ,'currentStep','user'));
    }
   public function buyerQuizStore(Request $request)
    {
        // Validate the request data
        $this->validator($request->all())->validate();
    
        // Update the authenticated user's information
        $user = $this->updateUser($request);
        // dd($user);
        // Display a success message
        Toastr::success(__('Buyer Quiz Successfully Submited!'), __('common.success'));
    
        // Redirect to the thank you page
       return redirect()->route('frontend.buyer.quiz');
    }
    
    protected function validator(array $data)
    {
        // Determine the validation rules for the email or phone field
        $contactField = $data['email'];
        if (filter_var($contactField, FILTER_VALIDATE_EMAIL)) {
            $contactValidation = ['required', 'string', 'max:255', 'email', 'unique:users,email,' . Auth::id()];
        } elseif (preg_match("/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/", $contactField)) {
            $contactValidation = ['required', 'string', 'min:7', 'max:16', 'unique:users,phone,' . Auth::id()];
        } else {
            $contactValidation = ['required', 'string', 'max:255', 'email'];
        }
    
        // Define the validation rules
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => $contactValidation,
            'Company_name' => 'required|string',
            'Phone_number' => ['required', 'string', 'unique:users,phone,' . Auth::id()],
            'Billing_address' => 'required|string',
            'Shipping_address' => 'required|string',
            'commercial_or_residential' => 'required|string',
            'loading_dock' => 'required|string',
            'forklift' => 'required|string',
            'pallet_jack' => 'required|string',
            'hours' => 'nullable|string',
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
            'referral_code' => ['sometimes', 'nullable', Rule::exists('referral_codes', 'referral_code')->where('status', 1)],
        ], [
            'Phone_number.unique' => 'The phone number you entered is already in use.',
        ]);
    }
    
    protected function updateUser(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        // Prepare the data for updating
        $updateData = $request->only([
            'first_name', 'last_name', 'Company_name', 'Phone_number', 'Billing_address',
            'Shipping_address', 'commercial_or_residential', 'loading_dock', 'forklift',
            'pallet_jack', 'hours', 'call_ahead', 'special_instructions',
            'accounts_payable_contact_name', 'accounts_payable_number', 'accounts_payable_email',
            'general_liability', 'preferred_language', 'years_in_business', 'number_of_locations',
            'primary_business_function', 'number_of_rigs', 'monthly_volume', 'open_cell_volume',
            'closed_cell_volume', 'total_volume_previous_year', 'preferred_foam_brand',
            'preferred_rig_type', 'power_source', 'proportioner_brand', 'proportioner_model',
            'preferred_spray_gun' ,'quiz_approved'
        ]);
    
        // // Handle password update if provided
        // if ($request->filled('password')) {
        //     $updateData['password'] = Hash::make($request->password);
        // }
    


        // $updateData['quiz_approved'] = "pepnding";

        // Handle custom fields if present
        if ($request->has('custom_field')) {
            $customFields = [];
            foreach (json_decode($request->custom_field) as $key => $field) {
                if ($request->hasFile($field)) {
                    $file = ImageStore::saveImage($request[$field], 250, 250);
                    $customFields[$field] = $file;
                } else {
                    $customFields[$field] = $request[$field];
                }
            }
            $updateData['others'] = $this->othersFieldValue($customFields);
        }
    // Update the user's information
        $user->update($updateData);
        // dd($user);
        return $user;
    }
}
