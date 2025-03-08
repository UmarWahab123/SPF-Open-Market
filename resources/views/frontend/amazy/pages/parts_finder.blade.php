@extends('frontend.amazy.layouts.app')

<style>
.parts-finder-link {
   color:#323232;
}
</style>

@section('title')
SPF Open Market
@endsection
@section('breadcrumb')

@endsection

@section('content')
<div class="collection_ page single_product_page">
<div class="top_main_lines_bg">
  <div class="second_section_new_navbar" style="padding:0px; margin: 0px">
    <div class="top" style="  background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%); height: 10px; "></div>
    <div class="container" >
      <div class="row">
        <div class="col-md-12">
          <div class="navbar">
          <a href="{{url('/parts-finder')}}">Parts Finder</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="page">
    <h1 class="page-heading mt-5 mb-5" style="margin-left: 143px; color:#323232;">Parts Finder</h1>
    <div data-content-region="page_builder_content"></div>
    <div class="page-content page-content--centered mb-5">
      <div class ="container">
        <div class="row">
            <!-- Product 1 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-air-purge-ap-gun-parts']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/graco-fusion-ap-140x140.jpeg" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-air-purge-ap-gun-parts']) }}">Graco Fusion Air Purge (AP) Gun Parts</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-clearshot-cs-gun-parts']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/graco-fusion-cs-140x140.jpeg" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-clearshot-cs-gun-parts']) }}">Graco Fusion ClearShot (CS) Gun Parts</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-mechanical-purge-mp-gun-parts']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/graco-fusion-mp-140x140.jpeg" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-mechanical-purge-mp-gun-parts']) }}">Graco Fusion Mechanical Purge (MP) Gun Parts</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-proconnect-pc-gun-parts']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/graco-fusion-proconnect-140x140.jpg" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-proconnect-pc-gun-parts']) }}">Graco Fusion ProConnect (PC) Gun Parts</a>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-probler-p2-air-purge-gun-parts']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/graco-probler-p2-140x140.jpg" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-probler-p2-air-purge-gun-parts']) }}">Graco Probler P2 Air Purge Gun Parts</a>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="quality_gun_product" style="border: 1px solid #eee; border-radius: 4px; overflow: hidden; text-align: center;">
                    <div class="image" style="padding: 15px;">
                        <a class="parts-finder-link" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-fx-poster']) }}">
                            <img src="https://store-s6knf1ps94.mybigcommerce.com/product_images/import/Fusion-Fx-Poster-b.png" alt="" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <a class="parts-finder-link" style="display: block; padding: 8px; background: #F9F9F9; border-top: solid 1px #F3F3F3;" href="{{ route('frontend.part.finder', ['slug' => 'graco-fusion-fx-poster']) }}">Graco Fusion Fx Poster</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>

@endsection

@push('scripts')

@endpush
