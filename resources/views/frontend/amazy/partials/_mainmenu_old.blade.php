<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
<style>
    @media (max-width: 991px){
        .mobile_menu {
            top: 54px;
        }
    }
    @media (max-width: 767.98px){
        header.amazcartui_header .header_area .header_top_area .header__wrapper .header__left {
              justify-content: flex-start;
              margin-left: 0;
        }
        .mobile_menu {
            top: 46px;
        }
    }


    .search-container {
  display: flex;
  align-items: center;
  background-color: #0b2e1f;
  border-radius: 5px;
  padding-right: 5px;
  width: 100%;
  border: 1px solid white;
}
.search-container .search-input::placeholder {
  color: white;
}
.search-input {
  border: none;
  background-color: #072b20;
  color: #fff;
  outline: none;
  flex-grow: 1;
  font-size: 16px;
}
.search-input:focus {
  border: none; /* Maintain no border on focus */
  background-color: #072b20; /* Keep the background color on focus */
  color: #fff; /* Keep the text color on focus */
  outline: none; /* Prevent outline on focus */
  box-shadow: none;
}

.login{
    color: #ffffff; 
    font-size:12px;  
    text-decoration: none; 
    margin-bottom: -5px;"
}
.register{
    color: #ffffff; 
    font-size:12px;  
    text-decoration: none; 
    font-weight: 700;
    margin-top: 10px;
}

.category_box_input{
    border: none; 
    outline: none; 
    flex: 1; 
    background-color: transparent; 
    color: #ffffff;
    font-size: 18px;
}

.header_search_field{
    background-color: transparent; 
    border: 1px solid rgb(255, 255, 255); 
    border-radius: 5px; 
    display: flex; 
    align-items: center;
    color: #fff;
    height: 36px;
}


.search_icon{
 color: #072b20;
}
#search_button{
    background-color: white; 
    border: none; 
    padding: 5px 12px;
    margin:0 5px;
    height: 28px;
}
    /* start new style */


</style>











<div class="header_top_area" style="  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__wrapper d-flex justify-content-between">
                    <!-- header__left__start  -->
                    <div class="header__left d-flex align-items-center">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                            <img src="{{ showImage(app('general_setting')->logo) }}" alt="{{ app('general_setting')->company_name }}" title="{{ app('general_setting')->company_name }}" style="padding:10px; width:170px;">

                            </a>
                        </div>
                    </div>
                    <!-- header__left__end  -->

                    

                    

                
                    <!-- header__right_start  -->
                    <div class="header_top_area_right" style="display: none;">    
                        <div class="wish_cart">
                            <div class="single_wishcart_lists" style="grid-gap:0;">
                                <div class="icon d-inline-block lh-1 dynamic_svg">

                                    <svg  width="16.5" height="16.5" viewBox="0 0 16.5 16.5">
                                        <g id="user" transform="translate(0.25 0.25)">
                                          <g id="Group_1602" data-name="Group 1602" transform="translate(0)">
                                            <path id="Path_1911" data-name="Path 1911" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                            <path id="Path_1912" data-name="Path 1912" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                          </g>
                                        </g>
                                      </svg>
                                </div>
                                @guest
                                    <span class="d-inline-block lh-1 ">
                                        <a href="{{url('/login')}}">{{ __('defaultTheme.login') }}</a>
                                        <a href="{{url('/register')}}">/ {{ __('defaultTheme.register') }}</a>
                                    </span>
                                @else
                                    <span class="d-inline-block lh-1 ">
                                        @if (auth()->check() && auth()->user()->role->type == "superadmin" || auth()->check() && auth()->user()->role->type == "admin" || auth()->check() && auth()->user()->role->type == "staff")
                                            <a href="{{ route('admin.dashboard') }}">{{ __('common.dashboard') }}</a>
                                        @elseif (auth()->check() && auth()->user()->role->type == "seller" && isModuleActive('MultiVendor'))
                                            <a href="{{ route('seller.dashboard') }}">{{ __('common.dashboard') }}</a>
                                        @elseif (auth()->check() && auth()->user()->role->type == "affiliate")
                                            <a href="{{ route('affiliate.my_affiliate.index') }}">{{ __('common.dashboard') }}</a>
                                        @else
                                            <a href="{{ route('frontend.dashboard') }}">{{ __('common.dashboard') }}</a>
                                        @endif

                                        <a href="{{ route('logout') }}" class="log_out">/ {{ __('defaultTheme.log_out') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </span>
                                @endguest
                            </div>
                        </div>
                         <div class="single_top_lists position-relative me-3 d-flex align-items-center shoping_language d-lg-none d-inline-flex">
                            <div class="">
                                <div class="language_toggle_btn gj-cursor-pointer d-flex align-items-center gap_10 ">
                                    <span>{{strtoupper($locale)}}</span>
                                    <span class="vertical_line style2 d-none d-md-block"></span>
                                    <span>{{strtoupper($currency_code)}}</span>
                                    <i class="ti-angle-down"></i>
                                </div>
                                <div class="language_toggle_box position-absolute top-100 end-0 bg-white">
                                    <form action="{{route('frontend.locale')}}" method="POST">
                                        @csrf
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.language') }}</span>
                                            <select class="amaz_select6 wide mb_20" name="lang">
                                                @foreach($langs as $key => $lang)
                                                <option {{ $locale==$lang->code?'selected':'' }} value="{{$lang->code}}">
                                                    {{$lang->native}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="lag_select">
                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.currency') }}</span>
                                            <select class="amaz_select6 wide" name="currency">
                                                @foreach($currencies as $key => $item)
                                                <option {{$currency_code==$item->code?'selected':'' }}
                                                    value="{{$item->id}}">
                                                    ({{$item->symbol}}) {{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="amaz_primary_btn style3 save_btn">{{ __('defaultTheme.save_change') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="wish_cart_mobile">
                            <div class="home6_search_toggle ">
                                <i class="ti-search"></i>
                            </div>
                        </div>
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    <!-- header__right_end  -->


                      <!-- New_code_start  -->
                    <header class="header" >
                        <div class="container" >
                            <div class="row" style="justify-content: space-around;  margin-left: 30px;"> 
                                {{-- margin-left: 30px;  12 --}}
                            <div class="col-md-11">
                                <div class="row" >
                                <div class="col-md-2 col-lg-2 col-sm-4 col-3">
                                    <div class="dropdown">
                                    <button class="btn btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><span class="flag-icon flag-icon-us me-1"></span> <span class="">EN</span></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-us me-1"></span> <span class="language_cointry">EN</span></a> </li>
                                        <li> <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es me-1"></span> <span class="language_cointry">SP</span></a> </li>
                                    </ul>
                                    </div>
                                </div>

                                

                                {{-- <div class="col-md-3 col-lg-3 col-sm-6 col-6">     --}}
                                <div class="col-md-4 col-lg-4 col-sm-8 col-9">    
                                <form method="GET" id="search_form">
                                    <div class="input-group header_search_field">
                            
                                        <input type="text" class="form-control category_box_input lh-base text-white white-placeholder" style="height: 36px;" id="inlineFormInputGroup" placeholder="{{ __('defaultTheme.search_your_item') }}" >
                            
                                        <div class="input-group-prepend" >
                                            <button class="btn input-group-append" id="search_button" >
                                                <i class="search_icon ti-search"></i>
                                            </button>
                                        </div>
                            
                                        <div class="live-search">
                                            <ul class="p-0" id="search_items">
                                                <li class="search_item" id="search_empty_list"></li>
                                                <li class="search_item" id="search_history"></li>
                                                <li class="search_item" id="tag_search"></li>
                                                <li class="search_item" id="category_search"></li>
                                                <li class="search_item" id="product_search"></li>
                                                <li class="search_item" id="seller_search"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                  



                                    {{--
                                    <form method="GET" id="search_form">
                                        <div class="search-container">
                                            
                                            <input type="text" class="form-control   search-input" id="inlineFormInputGroup" placeholder="{{ __('defaultTheme.search_your_item') }}">
                                            <div class="input-group-prepend">
                                                <button class="search-button" id="search_button"> <i class="fa fa-search"></i> </button>
                                            </div>

                                            <div class="live-search">
                                                <ul class="p-0" id="search_items">
                                                    <li class="search_item" id="search_empty_list">

                                                    </li>
                                                    <li class="search_item" id="search_history">

                                                    </li>
                                                    <li class="search_item" id="tag_search">

                                                    </li>
                                                    <li class="search_item" id="category_search">

                                                    </li>
                                                    <li class="search_item" id="product_search">

                                                    </li>
                                                    <li class="search_item" id="seller_search">

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                    --}}
                                <!-- </div> -->
                                    
                                </div>

                                <!-- <div class="col-md-4 col-lg-4 col-sm-8 col-8">
                                    <div class="search-container">
                                    <input type="text" placeholder="Search Product...         |" class="search-input">
                                    <button class="search-button"> <i class="fa fa-search"></i> </button>
                                    </div>
                                </div> -->

                                <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                                    <!-- header__right_start -->
                                    <div class="header_top_area_right " style="margin-left: 15px;" >    
                                        
                                            <div class="wish_cart">
                                            <div class="single_wishcart_lists" style="grid-gap: 5px; align-items: flex-start;">
                                                <a href="{{url('/login')}}" class="d-flex" >
                                                <div >
                                                <img src="{{asset('public/frontend/amazy/img/home/user.png')}}" style="width: 25px; height: auto; margin-top:5px;">
                                                    <!-- <div class="icon d-inline-block lh-1 dynamic_svg">
                                                    <svg width="16.5" height="16.5" viewBox="0 0 16.5 16.5">
                                                        <g id="user" transform="translate(0.25 0.25)">
                                                            <g id="Group_1602" data-name="Group 1602" transform="translate(0)">
                                                                <path id="Path_1911" data-name="Path 1911" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                                                <path id="Path_1912" data-name="Path 1912" d="M13.657,10.343a7.969,7.969,0,0,0-3.04-1.907,4.625,4.625,0,1,0-5.234,0A8.013,8.013,0,0,0,0,16H1.25a6.75,6.75,0,0,1,13.5,0H16A7.948,7.948,0,0,0,13.657,10.343ZM8,8a3.375,3.375,0,1,1,3.375-3.375A3.379,3.379,0,0,1,8,8Z" transform="translate(0)" fill="#fd4949" stroke-width="0.5"/>
                                                            </g>
                                                        </g>
                                                    </svg> -->
                                                </div>
                                                <div style="margin:3px 0 0 10px ">
                                                    @guest
                                                    <span class="d-inline-block lh-1">
                                                        {{-- <a href="{{url('/login')}}" class="login">{{ __('defaultTheme.login') }}<br></a>
                                                        <a href="{{url('/register')}}" class="register">{{ __('defaultTheme.register') }}</a> --}}
                                                        <div class="login">{{ __('defaultTheme.login') }}<br></div>
                                                        <div class="register">{{ __('defaultTheme.register') }}</div>
                                                    </span>
                                                    @else
                                                    <span class="d-inline-block lh-1">
                                                        @if (auth()->check() && auth()->user()->role->type == "superadmin" || auth()->check() && auth()->user()->role->type == "admin" || auth()->check() && auth()->user()->role->type == "staff")
                                                        <a href="{{ route('admin.dashboard') }}">{{ __('common.dashboard') }}</a>
                                                        @elseif (auth()->check() && auth()->user()->role->type == "seller" && isModuleActive('MultiVendor'))
                                                        <a href="{{ route('seller.dashboard') }}">{{ __('common.dashboard') }}</a>
                                                        @elseif (auth()->check() && auth()->user()->role->type == "affiliate")
                                                        <a href="{{ route('affiliate.my_affiliate.index') }}">{{ __('common.dashboard') }}</a>
                                                        @else
                                                        <a href="{{ route('frontend.dashboard') }}">{{ __('common.dashboard') }}</a>
                                                        @endif
                                                        <a href="{{ route('logout') }}" class="log_out">/ {{ __('defaultTheme.log_out') }}</a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </span>
                                                    @endguest
                                                </div>
                                                </a>
                                            </div>
                                        <div class="single_top_lists position-relative me-3 d-flex align-items-center shoping_language d-lg-none d-inline-flex">
                                            <div class="">
                                                <div class="language_toggle_btn gj-cursor-pointer d-flex align-items-center gap_10 ">
                                                    <span>{{strtoupper($locale)}}</span>
                                                    <span class="vertical_line style2 d-none d-md-block"></span>
                                                    <span>{{strtoupper($currency_code)}}</span>
                                                    <i class="ti-angle-down"></i>
                                                </div>
                                                <div class="language_toggle_box position-absolute top-100 end-0 bg-white">
                                                    <form action="{{route('frontend.locale')}}" method="POST">
                                                        @csrf
                                                        <div class="lag_select">
                                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.language') }}</span>
                                                            <select class="amaz_select6 wide mb_20" name="lang">
                                                                @foreach($langs as $key => $lang)
                                                                <option {{ $locale==$lang->code?'selected':'' }} value="{{$lang->code}}">
                                                                    {{$lang->native}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="lag_select">
                                                            <span class="font_12 f_w_500 text-uppercase mb_10 d-block">{{ __('defaultTheme.currency') }}</span>
                                                            <select class="amaz_select6 wide" name="currency">
                                                                @foreach($currencies as $key => $item)
                                                                <option {{$currency_code==$item->code?'selected':'' }}
                                                                    value="{{$item->id}}">
                                                                    ({{$item->symbol}}) {{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="amaz_primary_btn style3 save_btn">{{ __('defaultTheme.save_change') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                        {{-- </a> --}}
                                        <div class="wish_cart_mobile">
                                            <div class="home6_search_toggle ">
                                                <i class="ti-search"></i>
                                            </div>
                                        </div>
                                        <div class="mobile_menu d-block d-lg-none"></div>
                                    </div>
                            </div>
                                    {{-- <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                                    <div class="user_icons">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/user.png')}}" > Login<br>
                                        <b>My Account</b> </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                                    </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                                    <div class="user_icons">
                                    <div class="dropdown">
                                        <button class="btn toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/return.png')}}" > Returns<br>
                                        <b>& Orders</b> </button>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                                    <div class="user_icons">
                                    <div class="dropdown">
                                        {{-- <a href="{{ url('/cart') }}"  class="single_top_lists d-flex align-items-center d-none d-md-inline-flex text-decoration-none">
                                            <button class="btn toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <img src="{{asset('public/frontend/amazy/img/home/cart.png')}}" >
                                                  View<br>
                                                  <div><b><span>{{ __('common.cart') }} (<span class="cart_count_bottom">{{getNumberTranslate($items)}}</span>)</span> </b><div>
                                            </button>
                                        </a> --}}
                                        <a href="{{ url('/cart') }}" class="single_top_lists d-flex align-items-center d-none d-md-inline-flex text-decoration-none">
                                            <button class="btn toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{asset('public/frontend/amazy/img/home/cart.png')}}" alt="Cart Icon">
                                                <!-- Style to make 'View' appear above 'Cart' -->
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <span>View</span>
                                                    <!-- Cart and number in the same line -->
                                                    <span><b>{{ __('common.cart') }} (<span class="cart_count_bottom">{{getNumberTranslate($items)}}</span>)</b></span>
                                                </div>
                                            </button>
                                        </a>

                                    </div>
                                    </div>
                                </div>
                                </div>
                                <input class="menu-btn" type="checkbox" id="menu-btn">
                                <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
                                <ul class="menu">
                                <li><a href="{{route('frontend.welcome')}}">Home</a></li>
                                <li><a href="product.html">Products</a></li>
                                <li><a href="#">Membership</a></li>
                                <li><a href="#">Training</a></li>
                                <li><a href="#">Resources</a></li>
                                <li><a href="{{route('frontend.contact-us')}}">Contact us</a></li>
                                
                                </ul>
                            </div>
                            </div>
                        </div>
                        </header>

                        
                     <!-- New_code_end  -->
                </div>
            </div>
        </div>
    </div>
</div>

