<style>
@charset "utf-8";
/* CSS Document */
@font-face {
  font-family: Lora-VariableFont;
  src: url('{{ asset('frontend/amazy/fonts/Lora-VariableFont_wght.ttf') }}');
}

@font-face {
  font-family: Roboto-Regular;
  src: url('{{ asset('frontend/amazy/fonts/Roboto-Regular.ttf') }}');
}

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



    /* Style for the dropdown button and text */
.user-dropdown-btn, .user-login-btn {
    display: flex;
    align-items: center;
    background-color: transparent;
    border: none;
    padding: 5px;
    font-size: 16px;
    color: #333; 
}

.user-icon-img {
    width: 30px;
    height: 30px;
    margin-right: 10px;
}

.account-label {
    font-size: 16px;
    font-weight: normal;
    color: #333;
}
.user-name {
    font-weight: bold;
    color :white;
}

.dropdown-item {
    color: #333 !important;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
    color: #000;
}


#userDropdownMenu {
    display: none; /* Initially hide dropdown */
    position: absolute;
    z-index: 1000;
    /* Add custom styling as needed */
}
.user-toggle-btn.active + #userDropdownMenu {
    display: block; /* Show dropdown when the button is active */
}
.header .dropdown li a {
    padding: 5px 10px !important;
    font-size: 17px;
}
</style>

{{-- <div class="header_top_area" style="display:none;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__wrapper d-flex justify-content-between">
                    <!-- header__left__start  -->
                    <div class="header__left d-flex align-items-center">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ showImage(app('general_setting')->logo) }}" alt="{{ app('general_setting')->company_name }}" title="{{ app('general_setting')->company_name }}">
                            </a>
                        </div>
                    </div>
                    <!-- header__left__end  -->

                    

                    



                    <div class="header_middle ">
                        <form method="GET" id="search_form">
                            <div class="input-group header_search_field ">
                                <div class="input-group-prepend">
                                    <button class="btn input-group-append" id="search_button"> <i class="ti-search"></i> </button>
                                </div>
                                <input type="text" class="form-control category_box_input lh-base" id="inlineFormInputGroup" placeholder="{{ __('defaultTheme.search_your_item') }}">

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

                    </div>
                    <!-- header__right_start  -->
                    <div class="header_top_area_right" >
                        <div class="wish_cart">
                            <div class="single_wishcart_lists" >
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


                      
                </div>
            </div>
        </div>
    </div>
</div> --}}




<div class="logo_navbar" style="  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">
    <div class="header">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="logo mt-4">
                <a href="{{ url('/') }}">
                    <img src="{{ showImage(app('general_setting')->logo) }}" alt="{{ app('general_setting')->company_name }}" title="{{ app('general_setting')->company_name }}">
                </a>
                {{-- <div class="col-md-2"> <a href="index.html" class="logo"><img src="{{asset('public/frontend/amazy/img/home/logo.png')}}"></a> </div> --}}
            </div>
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                <div class="dropdown">
                  <button class="btn btn-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><span class="flag-icon flag-icon-us me-1"></span> <span class="">EN</span></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li> <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-us me-1"></span> <span class="language_cointry">EN</span></a> </li>
                    <li> <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es me-1"></span> <span class="language_cointry">SP</span></a> </li>
                  </ul>
                </div>
              </div>
              
              
              <div class="col-md-4 col-lg-4 col-sm-8 col-8" >
                <div class="search-container">
                  <form method="GET" id="search_form" style="margin: 0px;">
                            <div class="input-group header_search_field" >
                                
                                <input type="text" class="form-control category_box_input lh-base search-input" id="inlineFormInputGroup"
                                         placeholder="{{ __('defaultTheme.search_your_item') }}" >
                                <div class="input-group-prepend">
                                    {{-- <button class="btn input-group-append" id="search_button"> <i class="ti-search"></i> </button> --}}
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

                  
                   
                 
                    
                    {{-- <div class="header_middle "> --}}
                        

                    {{-- </div> --}}
                </div>
              </div>
              {{-- <div class="col-md-2 col-lg-2 col-sm-4 col-4">
               
                <div class="user_icons">
                  <div class="dropdown">



                    @if(isset(auth()->user()->role))

                     @if(auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff')
                    <a href="{{url('/admin-dashboard')}}" ><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/user.png')}}"> Logout<br>
                    <b>Dashboard</b> </button></a>

                    @elseif (auth()->user()->role->type == 'customer')
                     <a href="{{url('/profile/dashboard')}}" ><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/user.png')}}"> Logout<br>
                    <b>My Account</b> </button></a>
                    @else
                     <a href="{{url('/login')}}" ><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/user.png')}}"> Login<br>
                    <b>My Account</b> </button></a>
                    @endif


                     @else
                     <a href="{{url('/login')}}" ><button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/user.png')}}"> Login<br>
                    <b>My Account</b> </button></a>
                    @endif





                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                  </div>
                </div>
              </div> --}}

          <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                <div class="user_icons">
                    <div class="dropdown">
                        @if(auth()->check()) <!-- Check if the user is logged in -->
                            <button class="btn btn-lg dropdown-toggle user-dropdown-btn" type="button" id="dropdownMenuButtonUser">
                                <img src="{{asset('public/frontend/amazy/img/home/user.png')}}" class="user-icon-img">
                                <div class="user-account-details">
                                    <span class="user-name">Hello, {{ auth()->user()->name }}</span><br> <!-- Display user name -->
                                    <span class="account-label text-white mt">My Account</span> <!-- Main dropdown label -->
                                </div>
                            </button>
                            {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonUser">
                                @if(auth()->user()->role->type == 'customer')
                                    <li><a class="dropdown-item" href="{{ url('/profile/dashboard') }}" style="font-size: medium !important;">Dashboard</a></li> <!-- Customer Dashboard Link -->
                                @elseif(auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff')
                                    <li><a class="dropdown-item" href="{{ url('/admin-dashboard') }}" style="font-size: medium !important;">Admin Dashboard</a></li> <!-- Admin Dashboard Link -->
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ url('/logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: medium !important;">
                                       Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul> --}}
                            <ul class="user-dropdown-menu " id="userDropdownMenu" aria-labelledby="dropdownMenuButtonUser" style="background: rgb(13 45 32);  box-shadow: 0px 0px 11px 0px rgb(255 255 255 / 75%); border-radius: 10px; margin-top: 10px;">
                                @if(auth()->user()->role->type == 'customer')
                                    <li><a class="dropdown-item" href="{{ url('/profile/dashboard') }}">Dashboard</a></li>
                                @elseif(auth()->user()->role->type == 'superadmin' || auth()->user()->role->type == 'admin' || auth()->user()->role->type == 'staff')
                                    <li><a class="dropdown-item" href="{{ url('/admin-dashboard') }}">Admin Dashboard</a></li>
                                @elseif(auth()->user()->role->type == 'seller')
                                    <li><a class="dropdown-item" href="{{ url('/seller/dashboard') }}">Seller Dashboard</a></li>
                                @endif
                    
                                <li>
                                    <a class="dropdown-item" href="{{ url('/logout') }}" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        @else
                            <a href="{{ url('/login') }}">
                                <button class="btn btn-lg user-login-btn" type="button">
                                    <img src="{{asset('public/frontend/amazy/img/home/user.png')}}" class="user-icon-img">
                                    <span class="user-name">Login</span><br> <!-- Login Button for Guests -->
                                    <span class="account-label text-white mt">My Account</span>
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>


            
            
    
              <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                <div class="user_icons">
                  <div class="dropdown">
                    <button class="btn toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/return.png')}}"> Returns<br>
                    <b>& Orders</b> </button>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-lg-2 col-sm-4 col-4">
                <div class="user_icons">
                  <div class="dropdown">
                    <a href="{{ url('/cart') }}"><button class="btn toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="{{asset('public/frontend/amazy/img/home/cart.png')}}"> View<br>
                    <b>Cart(<span class="cart_count_bottom">{{getNumberTranslate($items)}}</span>)</b> </button></a>
                  </div>

                    
                </div>
              </div>
            </div>
            <input class="menu-btn" type="checkbox" id="menu-btn">
            <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
            <ul class="menu">
              <li><a href="{{url('/')}}" class="active">Home</a></li>
              <li><a href="{{url('/all-products')}}">Products</a></li>
              <li><a href="#">Membership</a></li>
              <li><a href="#">Training</a></li>
              @if(@auth()->user()->role->type == 'seller')                  
              <li><a href="{{url('/seller/dashboard')}}">Become a seller</a></li>
              @else
               <li><a href="{{url('/become-a-seller')}}">Become a seller</a></li>
              @endif
              <li><a href="{{ route('frontend.contact-us') }}">Contact us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('dropdownMenuButtonUser');
    const dropdownMenu = document.getElementById('userDropdownMenu');

    // Toggle the dropdown menu on button click
    dropdownButton.addEventListener('click', function (event) {
        event.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown if clicking outside of it
    document.addEventListener('click', function (event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});


  </script>


  