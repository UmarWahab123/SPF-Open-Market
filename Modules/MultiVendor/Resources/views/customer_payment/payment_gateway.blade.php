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

@php
    $discount = 0;
    $dis_percent = !empty($subscription_plan) ? $subscription_plan->discount:0;
    if(!empty($subscription_plan) && $subscription_plan->discount_type == 1){
         $discount = ($subscription_plan->plan_price * $subscription_plan->discount) / 100;
    }else{
         $discount = $subscription_plan->discount;
    }
    $sub_total = $subscription_plan->plan_price - $discount;


    if(session()->has('coupon_discount')){
         $final_discounted_price = $sub_total - session()->get('coupon_discount');
    }else{
        $final_discounted_price = $sub_total;
    }
    $tax = !empty($subscription_plan) && !empty($subscription_plan->gst_tax_id) ? $subscription_plan->gst_tax_id:0;
    $vat = ($final_discounted_price * $tax) / 100;

    $total_pay = $final_discounted_price + $vat;
@endphp


@section('content')
<div class="product_details_wrapper">
    <div class="container">
        <div class="row mb-5">
            <div class="col-xl-6">
                @if(count($gateway_activations->where('method','!=','Cash on Delivery')) > 0)
                <form action="{{route('customer.subscription_payment')}}" method="post" class="checkout-form" enctype="multipart/form-data" id="main-checkout-form">
                    @csrf
                    <input type="hidden" name="pricing_plan_id" value="{{$subscription_plan->id}}">
                    <div class="row">
                        <div class="col-12 mb_10">
                            <h3 class="check_v3_title2">{{__('common.payment')}}</h3>
                            <h6 class="shekout_subTitle_text">{{__('defaultTheme.all_transactions_are_secure_and_encrypted')}}.</h6>
                        </div>
                        <div class="col-12">
                            <div class="accordion checkout_acc_style mb_30" id="accordionExample">
                                @foreach($gateway_activations->where('method','!=','Cash On Delivery') as $key => $payment)
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="headingOne">
                                            <span class="accordion-button shadow-none">
                                                <span class="w-100">
                                                    <label class="primary_checkbox d-inline-flex style4 gap_10 w-100">
                                                        <input type="radio" name="method" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-controls="collapse{{$key}}" class="payment_method" data-name="{{$payment->method}}" value="{{$payment->method}}" {{$key == 0 ? 'checked' : ''}}>
                                                        <span class="checkmark mr_10"></span>
                                                        <span class="label_name f_w_500">
                                                            @php
                                                                switch ($payment->method) {
                                                                    case 'Stripe':
                                                                        echo __("payment_gatways.stripe");
                                                                        break;
                                                                    case 'Bank Payment':
                                                                        echo __("payment_gatways.bank_payment");
                                                                        break;
                                                                }
                                                            @endphp
                                                        </span>
                                                    </label>
                                                </span>
                                            </span>
                                        </div>
                                        <div id="collapse{{$key}}" class="accordion-collapse collapse {{$key == 0 ? 'show' : ''}}" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body" id="acc_{{$payment->id}}">
                                                <div class="row">
                                                    @if($payment->method == 'Stripe')
                                                        @include('multivendor::customer_payment.components._stripe_payment_modal')
                                                    @elseif($payment->method == 'Bank Payment')
                                                        @php
                                                            $bank = $payment->where('method','Bank Payment')->first();
                                                        @endphp
                                                        @include('multivendor::customer_payment.components._bank_payment_modal', compact('bank','total_pay'))
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb_25">
                            <label class="primary_checkbox d-flex">
                                <input value="1" id="term_check" checked="" type="checkbox" required>
                                <span class="checkmark mr_15"></span>
                                <span class="label_name f_w_400">{{ __("common.i_agree_terms") }}</span>
                                <span id="error_term_check" class="text-danger"></span>
                            </label>
                        </div>
                        <div class="col-12">
                            <button type="button" id="pay-now-btn" class="amaz_primary_btn style2 min_200 text-center text-uppercase">
                                {{ __("common.pay_now") }}
                            </button>
                        </div>
                    </div>
                </form>
             @else
                <div class="alert alert-danger">
                    {{ __('payment_gatways.gateway_not_active') }}
                </div>
             @endif            
            </div>
            <div class="col-lg-6">
                    <div class="order_sumery_box flex-fill">
                        <h3 class="check_v3_title mb_25">{{ __("common.payment_summery") }}</h3>
                        <div class="subtotal_lists">
                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("marketing.Plan Price") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text">{{ single_price($subscription_plan->plan_price) }}</span>
                                    </div>
                                </div>



                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.discount") }}  {{$subscription_plan->discount_type == 1 ?  "(".$seller_subscription->discount.'%'.")" :''}}</span>
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
                                        <span class="total_text"  > {{ single_price($final_discounted_price) }} </span>
                                    </div>
                                </div>

                                <div class="single_total_list d-flex align-items-center">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text"> {{__('common.vat/tax/gst')}}  ({{$tax}} %) </span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($vat) }} </span>
                                    </div>
                                </div>



                                <div class="total_amount d-flex align-items-center flex-wrap pb_25">
                                    <div class="single_total_left flex-fill">
                                        <span class="total_text">{{ __("common.total") }}</span>
                                    </div>
                                    <div class="single_total_right">
                                        <span class="total_text"  > {{ single_price($vat + $final_discounted_price) }} </span>
                                    </div>
                                </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

    @if ($errors->any())
        @foreach($errors->all() as $error)
        <script>
            toastr.error("{{$error}}",'Error');
        </script>
        @endforeach
    @endif

      
@endpush
