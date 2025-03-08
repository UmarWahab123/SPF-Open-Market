<!doctype html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<html @if(isRtl()) dir="rtl" class="rtl no-js" @else class="no-js" @endif lang="zxx">
    @php
    $adminColor = Modules\Appearance\Entities\AdminColor::where('is_active',1)->first();
    $popupContent = \Modules\FrontendCMS\Entities\SubscribeContent::find(2);
    $promotionbar = \Modules\FrontendCMS\Entities\SubscribeContent::find(3);
    $langs = app('langs');
    $currencies = app('currencies');
    $locale = app('general_setting')->language_code;
    $ship = app('general_setting')->country_name;
    if(\Session::has('locale')){
        $locale = \Session::get('locale');
    }

    if(auth()->check()){
        $locale = auth()->user()->lang_code;
    }
    $currency_code = getCurrencyCode();

    $carts = collect();
    $compares = 0;
    $wishlists = 0;
    if(auth()->check()){
        $carts = \App\Models\Cart::with('product.product.product','giftCard','product.product_variations.attribute', 'product.product_variations.attribute_value.color')->where('user_id',auth()->user()->id)->where('product_type', 'product')->whereHas('product',function($query){
            return $query->where('status', 1)->whereHas('product', function($q){
                return $q->activeSeller();
            });
        })->orWhere('product_type', 'gift_card')->where('user_id',auth()->user()->id)->whereHas('giftCard', function($query){
            return $query->where('status', 1);
        })->get();
        $compares = count(\App\Models\Compare::with('sellerProductSKU.product')->where('customer_id', auth()->user()->id)->whereHas('sellerProductSKU', function($query){
            return $query->where('status',1)->whereHas('product', function($q){
                return $q->activeSeller();
            });
        })->pluck('id'));
        $wishlists = count(\App\Models\Wishlist::where('user_id', auth()->user()->id)->pluck('id'));
    }else {
        $carts = \App\Models\Cart::with('product.product.product','giftCard','product.product_variations.attribute', 'product.product_variations.attribute_value.color')->where('session_id',session()->getId())->where('product_type', 'product')->whereHas('product',function($query){
            return $query->where('status', 1)->whereHas('product', function($q){
                return $q->activeSeller();
            });
        })->orWhere('product_type', 'gift_card')->where('session_id', session()->getId())->whereHas('giftCard', function($query){
            return $query->where('status', 1);
        })->get();

        if(\Session::has('compare')){
            $dataList = Session::get('compare');
            $collcets =  collect($dataList);

            $collcets =  $collcets->sortByDesc('product_type');
            $products = [];
            foreach($collcets as $collcet){
                $product_com = \Modules\Seller\Entities\SellerProductSKU::with('product')->where('id',$collcet['product_sku_id'])->whereHas('product', function($query){
                    return $query->activeSeller();
                })->pluck('id');
                if($product_com){
                    $products[] = $product_com;
                }
            }
            $compares = count($products);
        }

    }
    $items = 0;
    foreach($carts as $cart){
        $items += $cart->qty;
    }

    $regular_menus = Modules\Menu\Entities\Menu::with('elements.page','elements.childs','elements.childs.page')->where('menu_type', 'normal_menu')->where('menu_position','top_navbar')->whereIn('id',[1,2])->orderBy('id')->where('status', 1)->get();
    $topnavbar_left_menu = null;
    $topnavbar_right_menu = null;
    foreach ($regular_menus as $menu) {
        if($menu->slug == 'top-navbar-left-menu'){
            $topnavbar_left_menu = $menu;
        }
        elseif ($menu->slug == 'top-navbar-right-menu') {
            $topnavbar_right_menu = $menu;
        }
    }

    $top_bar = Modules\FrontendCMS\Entities\HomePageSection::where('section_name','top_bar')->first();
@endphp

@include('frontend.amazy.partials._head',['promotionbar' => $promotionbar])

<body>
    <!-- preloader  -->
    <!--
        <div class="preloader" >
             <h3 data-text="Amazy..">Amazy..</h3>
         </div>
    -->
    <div class="preloader_setup" id="pre-loader">
        @include('backEnd.partials.preloader')
    </div>
    <!-- preloader:end  -->
    <!-- promotion_bar_wrapper::start  -->
    <!-- position-fixed>> add this class to use this  -->
    @php
        $promotionshow = true;
        if(Session::get('close_promotion')){
            $promotionshow = false;
        }
    @endphp
    @if($promotionshow && @$promotionbar->status)
    <div class="promotion_bar position-relative top-0 start-0 w-100 d-lg-block">
        <a href="{{@$promotionbar->description}}" target="_blank" class="promotion_bar_wrapper d-flex align-items-center position-relative">
            <span class="close_promobar gj-cursor-pointer d-inline-flex align-items-center justify-content-center" id="promotion_close">
                <i class="ti-close"></i>
            </span>
        </a>
    </div>
    @endif
    <!-- promotion_bar_wrapper::end  -->

    <!-- HEADER::START -->
    @include('frontend.amazy.partials._header',[$popupContent,$compares])
    <!--/ HEADER::END -->

    @section('content')
     @show
    @include('frontend.amazy.partials._footer')
