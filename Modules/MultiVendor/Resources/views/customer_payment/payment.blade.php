@extends('frontend.amazy.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{asset(asset_path('frontend/amazy/css/page_css/product_details.css'))}}" />
    <link rel="stylesheet" href="{{asset(asset_path('frontend/default/css/lightbox.css'))}}" />
    @if(isRtl())
        <style>
            .zoomWindowContainer div {
                left: 0!important;
                right: 510px;
            }
            .product_details_part .cs_color_btn .radio input[type="radio"] + .radio-label:before {
                left: -1px !important;
            }
            @media (max-width: 970px) {
                .zoomWindowContainer div {
                    right: inherit!important;
                }
            }
        </style>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('content')
<div class="product_details_wrapper">
    <div class="container">
        <div class="row mb-5">
            <div class="col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb_10">
                            <h3 class="check_v3_title2">{{ __("common.plan_details") }}</h3>
                            <h6 class="shekout_subTitle_text">{{__('defaultTheme.all_transactions_are_secure_and_encrypted')}}.</h6>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 20%">{{ __("common.plan_name") }}:</td>
                                    <td>{{ $subscription_plan->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __('common.category_limit') }}:</td>
                                    <td>{{ $subscription_plan->best_for }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">{{ __("common.expire_in") }}:</td>
                                    <td>{{ $subscription_plan->expire_in }} {{ __("common.days") }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('frontend.subscription_payment_details',$subscription_plan->id) }}" class="amaz_primary_btn style2  min_200 text-center text-uppercase">
                                {{ __("common.continue_payment") }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                    <div class="order_sumery_box flex-fill">
                        <h3 class="check_v3_title mb_25">{{ __('common.payment_summery') }}</h3>
                        <div class="subtotal_lists">
                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.plan_price") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text">{{ single_price($subscription_plan->plan_price) }}</span>
                                    </div>
                                </div>

                                @php
                                    $discount = 0;
                                    $dis_percent = !empty($subscription_plan) ? $subscription_plan->discount:0;
                                    if(!empty($subscription_plan) && $subscription_plan->discount_type == 1){
                                       $discount = ($subscription_plan->plan_price * $subscription_plan->discount) / 100;
                                    }else{
                                       $discount = $subscription_plan->discount;
                                    }

                                    $sub_total = $subscription_plan->plan_price - $discount;
                                @endphp

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.discount") }} {{$subscription_plan->discount_type == 1 ?  "(".$subscription_plan->discount.'%'.")" :''}} </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($discount) }} </span>
                                    </div>
                                </div>

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.subtotal") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($sub_total) }} </span>
                                    </div>
                                </div>



                                @php
                                    $tax = !empty($subscription_plan->gst_tax_id) && !empty($subscription_plan->gst_tax_id) ? $subscription_plan->gst_tax_id:0;
                                    $vat = ($sub_total * $tax) / 100
                                @endphp

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text"> {{__('common.vat/tax/gst')}} ({{$tax}} %) </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($vat) }} </span>
                                    </div>
                                </div>



                                <div class="total_amount d-flex align-items-center flex-wrap pb_25">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.total") }} </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($vat + $sub_total) }} </span>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
