
<style>
    .background {
  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);
}
.footer_section_left{
    color: white;
    padding-top: 30px;
}
.footer_section_left ul{
    list-style-type: none;
}
.footer_section_left ul li {
    font-size: 20px;
    line-height: 35px;
}
.tweleve_section{
    padding: 20px 0px;
    background-color: white;
    color: black;
}
.tweleve_section p {
    margin: 0px;
    text-align: center;
}



.top_of_page {
  text-align: center;
  color: white;
  text-decoration: none;
  font-size: 25px;
  padding: 20px 0px;
  display: inline-block;
}
.eleven_section {
  padding: 20px 0px;
}
.eleven_section .footer_section {
  padding-top: 30px;
  background-image: url(images/last_bg.png);
  background-repeat: no-repeat;
  background-size: 100% 100%;
  background-position: center;
  text-align: center;
  width: 60%;
  margin: 0 auto;
}
.eleven_section .footer_section img {
  width: 45%;
}
.eleven_section .footer_section a {
  background-color: #34ff4c;
  padding: 10px 100px;
  border: none;
  border-radius: 10px;
  display: inline-block;
  margin-top: 30px;
  font-size: 25px;
  font-family: 'Roboto-Regular';
  letter-spacing: 2px;
  color: #0e2423;
  text-decoration: none;
}
.footer_section_last {
  width: 100%;
  display: inline-block;
  text-align: center;
}
.footer_section_last h5 {
  color: white;
  font-size: 25px;
  margin: 10px 0px;
}
.tweleve_section{
    padding: 20px 0px;
    background-color: white;
    color: black;
}
.tweleve_section p {
    margin: 0px;
    text-align: center;
}
</style>

@php
    $footer_content = \Modules\FooterSetting\Entities\FooterContent::first();
    $subscribeContent = \Modules\FrontendCMS\Entities\SubscribeContent::find(1);
    $about_section = Modules\FrontendCMS\Entities\HomePageSection::where('section_name','about_section')->first();
@endphp
@if(url()->current() == url('/'))
<div id="about_section" class="amaz_section section_spacing4 {{ ($about_section)? ($about_section->status == 0?'d-none':'') : ''}}" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__title d-flex align-items-center gap-3 mb_20">
                    <h3 class="m-0 flex-fill">{{ app('general_setting')->footer_about_title }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="amaz_mazing_text">
                    @php echo app('general_setting')->footer_about_description; @endphp
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- FOOTER::START  -->














    <footer class="home_three_footer">
        <div class="main_footer_wrap">
            <div class="container">
                 <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget" >
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','1') as $page)
                                    @if($page->pageData)
                                    @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                        @continue
                                    @endif
                                    <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 footer_links_50 ">
                        <div class="footer_widget">
                            <ul class="footer_links">
                                @foreach($sectionWidgets->where('section','2') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                        <li><a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="footer_widget" >

                            <div class="apps_boxs">
                                @if($footer_content->show_play_store)
                                <a href="{{$footer_content->play_store}}" class="google_play_box d-flex align-items-center mb_10">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/google_play.svg" alt="{{__('amazy.Google Play')}}" title="{{__('amazy.Google Play')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Google Play')}}</h4>
                                    </div>
                                </a>
                                @endif
                                @if($footer_content->show_app_store)
                                <a href="{{$footer_content->app_store}}" class="google_play_box d-flex align-items-center">
                                    <div class="icon">
                                        <img src="{{url('/')}}/public/frontend/amazy/img/amaz_icon/apple_icon.svg" alt="{{__('amazy.Apple Store')}}"  title="{{__('amazy.Apple Store')}}">
                                    </div>
                                    <div class="google_play_text">
                                        <span>{{__('amazy.Get it on')}}</span>
                                        <h4 class="text-nowrap">{{__('amazy.Apple Store')}}</h4>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <x-subscribe-component :subscribeContent="$subscribeContent"/>
                </div>
            </div>
        </div>
        <div class="copyright_area p-0">
            <div class="container">
                <div class="footer_border m-0"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copy_right_text d-flex align-items-center gap_20 flex-wrap justify-content-between">
                            @php echo app('general_setting')->footer_copy_right; @endphp
                            {{-- <div class="footer_list_links">
                                @foreach($sectionWidgets->where('section','3') as $page)
                                    @if($page->pageData)
                                        @if(!isModuleActive('Lead') && $page->pageData->module == 'Lead')
                                            @continue
                                        @endif
                                            <a href="{{ url($page->pageData->slug) }}">{{$page->name}}</a> 
                                    @endif
                                @endforeach
                            </div>--}}
                        </div>
                    </div>
                </div>
                @if($footer_content->show_payment_image != 0 && $footer_content->payment_image)
                    <div class="footer_border m-0"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="payment_imgs text-center ">
                                <img class="img-fluid" src="{{showImage($footer_content->payment_image)}}" alt="{{__('common.payment_method')}}" title="{{__('common.payment_method')}}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </footer>
    
    <!-- FOOTER::END  -->
@include('frontend.amazy.auth.partials._login_modal')
<div id="cart_data_show_div">
    @include('frontend.amazy.partials._cart_details_submenu')
</div>
<div id="cart_success_modal_div">
    @include('frontend.amazy.partials._cart_success_modal')
</div>
<input type="hidden" id="login_check" value="@if(auth()->check()) 1 @else 0 @endif">
<div class="add-product-to-cart-using-modal">

</div>

@include('frontend.amazy.partials._modals')

<div id="back-top" style="display: none;">
    <a title="{{__('common.go_to_top')}}" href="#"><i class="fas fa-chevron-up"></i></a>
</div>

@php
    $messanger_data = \Modules\GeneralSetting\Entities\FacebookMessage::first();
@endphp
@if($messanger_data->status == 1)
    @php echo $messanger_data->code; @endphp
@endif


@include('frontend.amazy.partials._script')
@stack('scripts')
@stack('wallet_scripts')



</body>

</html>
