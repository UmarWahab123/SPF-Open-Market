<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Traits\GoogleAnalytics4;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\FrontendCMS\Entities\PricingPlan;
use Modules\FrontendCMS\Entities\DiscountRole;
use Illuminate\Support\Facades\DB;
use Modules\Seller\Entities\SellerProduct;
use Modules\FrontendCMS\Entities\HomePageSection;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\ProductReport;
use Modules\Product\Services\ReportReasonService;
use Modules\CheckPincode\Entities\PinCodeConfigurations;
use Modules\UserActivityLog\Traits\LogActivity;
class ProductController extends Controller
{
    use GoogleAnalytics4;

    protected $productService, $reason;
    public function __construct(ProductService $productService, ReportReasonService $reportReasonService)
    {
        $this->productService = $productService;
        $this->reason = $reportReasonService;
        $this->middleware('maintenance_mode');
    }
    public function index(){
        $widgets = HomePageSection::all();
        $categories = Category::get();
        $products = SellerProduct::with('seller', 'reviews', 'skus', 'wishList', 'product.shippingMethods')
        ->activeSeller()
        ->where('products.status', 1) // Get only active products
        ->select('seller_products.*')
        ->join('products', function($q){
            return $q->on('seller_products.product_id', '=', 'products.id');
        });
        $products = $products->distinct('seller_products.id')->get();
        return view(theme('pages.products'),compact('widgets','categories','products'));
    }
    public function allProducts(Request $request){
        $widgets = HomePageSection::all();
        $categories = Category::get();
        
        // Base query for products
        $productsQuery = SellerProduct::with('seller', 'reviews', 'skus', 'wishList', 'product.shippingMethods')
            ->activeSeller()
            ->where('products.status', 1)
            ->select('seller_products.*')
            ->join('products', function($q){
                return $q->on('seller_products.product_id', '=', 'products.id');
            });
        // dd($productsQuery);
        // Apply category filter if present
        if ($request->has('category_id') && $request->category_id != null) {
            $productsQuery->whereHas('product.categories', function($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        if ($request->has('rating') && $request->rating != null) {
            if ($request->rating !== null) {
                if ($request->rating == 5) {
                    $productsQuery = $productsQuery->where('seller_products.avg_rating', 5);
                } elseif ($request->rating == 4) {
                    $productsQuery = $productsQuery->whereBetween('seller_products.avg_rating', [4.0, 4.9]);
                } elseif ($request->rating == 3) {
                    $productsQuery = $productsQuery->whereBetween('seller_products.avg_rating', [3.0, 3.9]);
                }
            }
        }
    
       // Handle price filtering with your existing logic
        if ($request->has('min_price') && $request->has('max_price')) {
            $min_price = $request->min_price;
            $max_price = $request->max_price;
            $productsQuery = $productsQuery->join('seller_product_s_k_us', function ($q) use ($min_price, $max_price) {
                $q->on('seller_products.id', '=', 'seller_product_s_k_us.product_id')
                    ->whereBetween('seller_product_s_k_us.selling_price', [$min_price, $max_price]);
            });
        }
    
        if ($request->has('features')) {
            // Apply feature filters
        }
    
        // Paginate filtered results (3 products per page)
        $products = $productsQuery->distinct('seller_products.id')->paginate(12);
    
        // Handle AJAX request for filtered pagination
        if ($request->ajax()) {
            $view = view('frontend.amazy.pages.product_list', compact('products'))->render();
            
            return response()->json([
                'html' => $view,
                'nextPageUrl' => $products->appends($request->except('page'))->nextPageUrl() // Preserve filters in pagination
            ]);
        }
    
        // Default view (non-AJAX)
        return view(theme('pages.all_products'), compact('widgets', 'categories', 'products'));
    }
    public function form() {
        return view(theme('pages.form'));
    }
    
    public function submitForm(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
             'Name' => 'required|string',
            'Company_name' => 'required|string',
            'email' => 'required|email',
            'Phone_number' => 'required|string',
            'Billing_address' => 'required|string',
            'Shipping_address' => 'required|string',
            'commercial_or_residential' => 'required|string',
            'loading_dock' => 'required|string',
            'forklift' => 'required|string',
            'pallet_jack' => 'required|string',
            'hours' => 'required|string',
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
            'preferred_rig_type' => 'nullable|string',
            'power_source' => 'nullable|string',
            'proportioner_brand' => 'nullable|string',
            'proportioner_model' => 'nullable|string',
            'preferred_spray_gun' => 'nullable|string',
        ]);
    
        // Save the data to your database
        DB::table('hubspotform')->insert([
            
            'Name' => $validated['Name'],
            'Company_name' => $validated['Company_name'],
            'email' => $validated['email'],
            'Phone_number' => $validated['Phone_number'],
            'Billing_address' => $validated['Billing_address'],
            'Shipping_address' => $validated['Shipping_address'],
            'commercial_or_residential' => $validated['commercial_or_residential'],
            'loading_dock' => $validated['loading_dock'],
            'forklift' => $validated['forklift'],
            'pallet_jack' => $validated['pallet_jack'],
            'hours' => $validated['hours'],
            'call_ahead' => $validated['call_ahead'],
            'special_instructions' => $validated['special_instructions'],
            'accounts_payable_contact_name' => $validated['accounts_payable_contact_name'],
            'accounts_payable_number' => $validated['accounts_payable_number'],
            'accounts_payable_email' => $validated['accounts_payable_email'],
            'general_liability' => $validated['general_liability'],
            'preferred_language' => $validated['preferred_language'],
            'years_in_business' => $validated['years_in_business'],
            'number_of_locations' => $validated['number_of_locations'],
            'primary_business_function' => $validated['primary_business_function'],
            'number_of_rigs' => $validated['number_of_rigs'],
            'monthly_volume' => $validated['monthly_volume'],
            'open_cell_volume' => $validated['open_cell_volume'],
            'closed_cell_volume' => $validated['closed_cell_volume'],
            'total_volume_previous_year' => $validated['total_volume_previous_year'],
            'preferred_foam_brand' => $validated['preferred_foam_brand'],
            'preferred_rig_type' => $validated['preferred_rig_type'],
            'power_source' => $validated['power_source'],
            'proportioner_brand' => $validated['proportioner_brand'],
            'proportioner_model' => $validated['proportioner_model'],
            'preferred_spray_gun' => $validated['preferred_spray_gun'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Prepare the data for HubSpot submission
        $hubspotData = [
            'firstname' => $validated['Name'],
            'company' => $validated['Company_name'],
            'email' => $validated['email'],
            'tel' => $validated['Phone_number'],
            'Billing_address' => $validated['Billing_address'],
            'Shipping_address' => $validated['Shipping_address'],
            'commercial_or_residential' => $validated['commercial_or_residential'],
            'loading_dock' => $validated['loading_dock'],
            'forklift' => $validated['forklift'],
            'pallet_jack' => $validated['pallet_jack'],
            'hours' => $validated['hours'],
            'call_ahead' => $validated['call_ahead'],
            'special_instructions' => $validated['special_instructions'],
            'accounts_payable_contact_name' => $validated['accounts_payable_contact_name'],
            'accounts_payable_number' => $validated['accounts_payable_number'],
            'accounts_payable_email' => $validated['accounts_payable_email'],
            'general_liability' => $validated['general_liability'],
            'preferred_language' => $validated['preferred_language'],
            'years_in_business' => $validated['years_in_business'],
            'number_of_locations' => $validated['number_of_locations'],
            'primary_business_function' => $validated['primary_business_function'],
            'number_of_rigs' => $validated['number_of_rigs'],
            'monthly_volume' => $validated['monthly_volume'],
            'open_cell_volume' => $validated['open_cell_volume'],
            'closed_cell_volume' => $validated['closed_cell_volume'],
            'total_volume_previous_year' => $validated['total_volume_previous_year'],
            'preferred_foam_brand' => $validated['preferred_foam_brand'],
            'preferred_rig_type' => $validated['preferred_rig_type'],
            'power_source' => $validated['power_source'],
            'proportioner_brand' => $validated['proportioner_brand'],
            'proportioner_model' => $validated['proportioner_model'],
            'preferred_spray_gun' => $validated['preferred_spray_gun'],
        ];
    
        // Call the function to submit to HubSpot
        $hubspotSubmitted = $this->submit_to_hubspot($hubspotData);
    
        if ($hubspotSubmitted) {
            return redirect()->back()->with('success', 'Form submitted successfully to HubSpot and saved to database!');
        } else {
            return redirect()->back()->with('error', 'Form submitted to database, but failed to submit to HubSpot.');
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
                ['name' => 'hours', 'value' => $hubdata['hours']],
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
    




    public function show($seller,$slug = null)
    {
        $widgets = HomePageSection::all();
        session()->forget('item_details');
        if($slug){
            $product =  $this->productService->getActiveSellerProductBySlug($slug, $seller);
        }else{
            $product =  $this->productService->getActiveSellerProductBySlug($seller);
        }
        if($product->status == 0 || $product->product->status == 0){
            return abort(404);
        }
        if (auth()->check()) {
            $this->productService->recentViewStore($product->id);
        } else {
            $recentViwedData = [];
            $recentViwedData['product_id'] = $product->id;
            if(session()->has('recent_viewed_products')){
                $recent_viewed_products = collect();
                foreach (session()->get('recent_viewed_products') as $key => $recentViwedItem){
                    $recent_viewed_products->push($recentViwedItem);
                }
                $recent_viewed_products->push($recentViwedData);
                session()->put('recent_viewed_products', $recent_viewed_products);
            }
            else{
                $recent_viewed_products = collect([$recentViwedData]);
                session()->put('recent_viewed_products', $recent_viewed_products);
            }
        }
        $this->productService->recentViewIncrease($product->id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2 && $product->variant_details != '') {
            $item_detail = [];
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }
            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            }else {
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status',1)->pluck('rating');
        if(count($reviews)>0){
            $value = 0;
            $rating = 0;
            foreach($reviews as $review){
                $value += $review;
            }
            $rating = $value/count($reviews);
            $total_review = count($reviews);
        }else{
            $rating = 0;
            $total_review = 0;
        }
        //ga4
        if(app('business_settings')->where('type', 'google_analytics')->first()->status == 1){
            $eData = [
                'name' => 'view_item',
                'params' => [
                    "currency" => currencyCode(),
                    "value"=> 1,
                    "items" => [
                        [
                            "item_id"=> $product->product->skus[0]->sku,
                            "item_name"=> $product->product_name,
                            "currency"=> currencyCode(),
                            "price"=> $product->product->skus[0]->selling_price
                        ]
                    ],
                ],
            ];
            $this->postEvent($eData);
        }
        //end ga4
        $recent_viewed_products = $this->productService->recentViewedLast3Product($product->id);
        $reasons = $this->reason->get();
        if(isModuleActive('CheckPincode')){
            $pincodeConfig = PinCodeConfigurations::first();
            return view(theme('pages.product_details'),compact('product','rating','total_review','recent_viewed_products','pincodeConfig','reasons','widgets'));
        }
        return view(theme('pages.product_details'),compact('product','rating','total_review','recent_viewed_products','reasons','widgets'));

    }


    public function newShow($seller,$slug = null)
    {
        $widgets = HomePageSection::all();
        session()->forget('item_details');
        if($slug){
            $product =  $this->productService->getActiveSellerProductBySlug($slug, $seller);
        }else{
            $product =  $this->productService->getActiveSellerProductBySlug($seller);
        }
        if($product->status == 0 || $product->product->status == 0){
            return abort(404);
        }
        if (auth()->check()) {
            $this->productService->recentViewStore($product->id);
        } else {
            $recentViwedData = [];
            $recentViwedData['product_id'] = $product->id;
            if(session()->has('recent_viewed_products')){
                $recent_viewed_products = collect();
                foreach (session()->get('recent_viewed_products') as $key => $recentViwedItem){
                    $recent_viewed_products->push($recentViwedItem);
                }
                $recent_viewed_products->push($recentViwedData);
                session()->put('recent_viewed_products', $recent_viewed_products);
            }
            else{
                $recent_viewed_products = collect([$recentViwedData]);
                session()->put('recent_viewed_products', $recent_viewed_products);
            }
        }
        $this->productService->recentViewIncrease($product->id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2 && $product->variant_details != '') {
            $item_detail = [];
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }
            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            }else {
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status',1)->pluck('rating');
        
        if(count($reviews)>0){
            $value = 0;
            $rating = 0;
            foreach($reviews as $review){
                $value += $review;
            }
            $rating = $value/count($reviews);
            $total_review = count($reviews);
        }else{
            $rating = 0;
            $total_review = 0;
        }
        //ga4
        if(app('business_settings')->where('type', 'google_analytics')->first()->status == 1){
            $eData = [
                'name' => 'view_item',
                'params' => [
                    "currency" => currencyCode(),
                    "value"=> 1,
                    "items" => [
                        [
                            "item_id"=> $product->product->skus[0]->sku,
                            "item_name"=> $product->product_name,
                            "currency"=> currencyCode(),
                            "price"=> $product->product->skus[0]->selling_price
                        ]
                    ],
                ],
            ];
            $this->postEvent($eData);
        }
        //end ga4
        $recent_viewed_products = $this->productService->recentViewedLast3Product($product->id);
        $reasons = $this->reason->get();
        if(isModuleActive('CheckPincode')){
            $pincodeConfig = PinCodeConfigurations::first();
            return view(theme('pages.newproduct_details'),compact('product','rating','total_review','recent_viewed_products','pincodeConfig','reasons','widgets'));
        }
        return view(theme('pages.newproduct_details'),compact('product','rating','total_review','recent_viewed_products','reasons','widgets'));

    }

    public function show_in_modal(Request $request)
    {
        // dd($request->all());
        session()->forget('item_details');
        $product =  $this->productService->getProductByID($request->product_id);
        $this->productService->recentViewIncrease($request->product_id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2) {
            $item_detail = [];
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }

            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            } else{
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status',1)->pluck('rating');
        if(count($reviews)>0){
            $value = 0;
            $rating = 0;
            foreach($reviews as $review){
                $value += $review;
            }
            $rating = $value/count($reviews);
            $total_review = count($reviews);
        }else{
            $rating = 0;
            $total_review = 0;
        }
        return (string) view(theme('partials.product_add_to_cart_modal'),compact('product','rating','total_review'));
    }
    public function admin_show_in_modal(Request $request)
    {
        session()->forget('item_details');
        $product =  $this->productService->getProductByID($request->product_id);
        $this->productService->recentViewIncrease($request->product_id);
        $item_details = session()->get('item_details');
        $options = array();
        $data = array();
        if ($product->product->product_type == 2) {
            foreach ($product->variant_details as $key => $v) {
                $item_detail[$key] = [
                    'name' => $v->name,
                    'attr_id' => $v->attr_id,
                    'code' => $v->code,
                    'value' => $v->value,
                    'id' => $v->attr_val_id,
                ];
                array_push($data, $v->value);
            }

            if (!empty($item_details)) {
                session()->put('item_details', $item_details + $item_detail);
            } else{
                session()->put('item_details', $item_detail);
            }
        }
        $reviews = $product->reviews->where('status',1)->pluck('rating');
        if(count($reviews)>0){
            $value = 0;
            $rating = 0;
            foreach($reviews as $review){
                $value += $review;
            }
            $rating = $value/count($reviews);
            $total_review = count($reviews);
        }else{
            $rating = 0;
            $total_review = 0;
        }
        return view('backEnd.pages.customer_data.product_add_to_cart_modal',compact('product','rating','total_review'));
    }

    public function getReviewByPage(Request $request){
        $reviews = $this->productService->getReviewByPage($request->only('page', 'product_id'));
        $product = $this->productService->getProductByID($request->product_id);
        if($product){
            $all_reviews = $product->reviews;
        }else{
            $all_reviews = collect();
        }
        return view(theme('partials._product_review_with_paginate'),compact('reviews','all_reviews'));
    }

    public function getPickupByCity(Request $request){
        $get_pickup_location_by_city = $this->productService->getPickupByCity($request->except('_token'));
        return $get_pickup_location_by_city;
    }

    public function getPickupInfo(Request $request){
        $pickup = $this->productService->getPickupById($request->except('_token'));
        $shipping_method = $this->productService->getLowestShippingFromSeller($request->except('_token'));
        return response()->json([
            'pickup_location' => $pickup,
            'shipping' => $shipping_method
        ]);
    }

    public function submitReport(Request $request)
    {
        $data = $request->validate([
            "reason_id" => "nullable",
            "email" => "required",
            "comment" => "required",
            "product_id" => "required"
        ]);
       try{
            $create =  ProductReport::create($data);
            if($create){
                Toastr::success('product_reported','Success');
            }else{
                Toastr::error('Something went wrong','Error');
            }
            return back();
       }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return response()->json([
            "status" => 0,
        ]);
       }

    }
    public function partFinder($slug = null ){
        if($slug){
            return view(theme('pages.parts_finder_details'),compact('slug'));
        }else{
           return view(theme('pages.parts_finder'));
        }
      
    }
    public function compareProductPrice($price)
    {  
        // Fetch and calculate TIER 1 prices
        $subscriptionPlanTier1 = PricingPlan::where('name', 'TIER 1')->first();
        $finalPriceAfterDiscountTier1 = $this->calculateDiscountedPrice($subscriptionPlanTier1, $price);
    
        // Fetch and calculate TIER 2 prices
        $subscriptionPlanTier2 = PricingPlan::where('name', 'TIER 2')->first();
        $finalPriceAfterDiscountTier2 = $this->calculateDiscountedPrice($subscriptionPlanTier2, $price);
    
        // Fetch and calculate TIER 3 prices
        $subscriptionPlanTier3 = PricingPlan::where('name', 'TIER 3')->first();
        $finalPriceAfterDiscountTier3 = $this->calculateDiscountedPrice($subscriptionPlanTier3, $price);
        // Return response as JSON
        return response()->json([
            'success' => true,
            'data' => [
                'tier1' => number_format($finalPriceAfterDiscountTier1, 2),
                'tier2' => number_format($finalPriceAfterDiscountTier2, 2),
                'tier3' => number_format($finalPriceAfterDiscountTier3, 2),
            ],
        ]);
    }
    
    private function calculateDiscountedPrice($subscriptionPlan, $price)
    {
        $discountRoles = [];
        if ($subscriptionPlan) {
            $pricingPlanId = $subscriptionPlan->id;
            $discountRoles = DiscountRole::where('pricing_plan_id', $pricingPlanId)->get();
        }
    
        $finalPriceAfterDiscount = $price;
        $subscriptionDiscount = 0;
    
        // Apply discount logic
        if (collect($discountRoles)->isNotEmpty()) {
            foreach ($discountRoles as $role) {
                if ($price >= $role->start_price && $price <= $role->end_price) {
                    $subscriptionDiscountPercentage = $role->discount;
                    $subscriptionDiscount = ($price * $subscriptionDiscountPercentage) / 100;
                    $finalPriceAfterDiscount = $price - $subscriptionDiscount;
                    break;
                }
            }
        }
    
        return $finalPriceAfterDiscount;
    }
    
}
