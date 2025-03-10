@extends('backEnd.master')
@section('styles')

<link rel="stylesheet" href="{{asset(asset_path('modules/ordermanage/css/my_sale_details.css'))}}" />

@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{getNumberTranslate($order->order_number)}}</h3>
                            @if (permissionCheck('order_manage.print_order_details'))
                                <ul class="d-flex float-right">
                                    <li><a href="{{ route('my_order_manage.print_order_details', $order->id) }}" target="_blank"
                                       class="primary-btn fix-gr-bg radius_30px mr-10">{{__('order.print')}}</a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 student-details">
                    <div class="white_box_50px box_shadow_white" id="printableArea">
                        <div class="row pb-30 border-bottom">
                            <div class="col-md-6 col-lg-6">
                                <div class="logo_div">
                                    <img src="{{showImage(app('general_setting')->logo)}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 text-right">
                                <h4>{{getNumberTranslate($order->order_number)}}</h4>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{__('defaultTheme.billing_info')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.name')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->billing_name : $order->guest_info->billing_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.email')}}</td>
                                        <td><a class="link_color" href="mailto:{{($order->customer_id) ? @$order->address->billing_email : $order->guest_info->billing_email}}">: {{($order->customer_id) ? @$order->address->billing_email : $order->guest_info->billing_email}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.phone')}}</td>
                                        <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->billing_phone : @$order->guest_info->billing_phone)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.address')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->billing_address : @$order->guest_info->billing_address}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.city')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getBillingCity->name : @$order->guest_info->getBillingCity->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.state')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getBillingState->name : @$order->guest_info->getBillingState->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.country')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getBillingCity->name : @$order->guest_info->getBillingCountry->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.postcode')}}</td>
                                        <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->billing_postcode : @$order->guest_info->billing_post_code)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{__('defaultTheme.seller_info')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.name')}}</td>
                                        <td>:  {{app('general_setting')->company_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.phone')}}</td>
                                        <td>:  <a class="link_color" href="tel:{{getNumberTranslate(app('general_setting')->phone)}}">{{getNumberTranslate(app('general_setting')->phone)}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.email')}}</td>
                                        <td>:  <a class="link_color" href="mailto:{{app('general_setting')->email}}">{{app('general_setting')->email}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('order.website')}}</td>
                                        <td>
                                            @if (getParentSeller()->slug)
                                                <a href="#">:  {{route('frontend.seller',getParentSeller()->slug)}}</a>
                                            @elseif(!is_null(app('general_setting')->website_url))
                                                <a href="#">:  {{ app('general_setting')->website_url }}</a>
                                            @else
                                                <a href="#">:  {{route('frontend.seller',base64_encode(getParentSellerId()))}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{__('defaultTheme.shipping_info')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.name')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->shipping_name : @$order->guest_info->shipping_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.email')}}</td>
                                        <td><a class="link_color" href="mailto:{{($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email}}">: {{($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.phone')}}</td>
                                        <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->shipping_phone : @$order->guest_info->shipping_phone)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.address')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->shipping_address : @$order->guest_info->shipping_address}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.city')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getShippingCity->name : @$order->guest_info->getShippingCity->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.state')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getShippingState->name : @$order->guest_info->getShippingState->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.country')}}</td>
                                        <td>: {{($order->customer_id) ? @$order->address->getShippingCountry->name : @$order->guest_info->getShippingCountry->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.postcode')}}</td>
                                        <td>: {{getNumberTranslate(($order->customer_id) ? @$order->address->shipping_postcode : @$order->guest_info->shipping_post_code)}}</td>
                                    </tr>
                                </table>
                            </div>
                            @php
                                $seller_id = getParentSellerId();
                                $order_packages = $order->packages->where('seller_id', $seller_id)->where('package_code', $package->package_code)->first();
                                $total_gst = 0;
                            @endphp
                            @if (file_exists(base_path().'/Modules/GST/') && (app('gst_config')['enable_gst'] == "gst" || app('gst_config')['enable_gst'] == "flat_tax"))
                                @foreach ($order_packages->gst_taxes as $key => $gst_tax)
                                    @php
                                        $total_gst += $gst_tax->amount;
                                    @endphp
                                @endforeach
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{__('defaultTheme.payment_info')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.payment_method')}}</td>
                                        <td>: {{$order->GatewayName}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.amount')}}</td>
                                        <td>: {{ single_price(@$order->order_payment->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('order.txn_id')}}</td>
                                        <td>: {{@$order->order_payment->txn_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.date')}}</td>
                                        <td>: {{dateConvert(@$order->order_payment->created_at)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('defaultTheme.payment_status')}}</td>
                                        <td>:
                                            @if ($order->is_paid == 1)
                                                <span>{{__('common.paid')}}</span>
                                            @else
                                                <span>{{__('common.pending')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>

                                @if(isModuleActive('Affiliate'))
                                    @if($order->affiliateUser)
                                        <table class="table-borderless clone_line_table">
                                            <tr>
                                                <td><strong>{{__('affiliate.affiliate_user')}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>{{__('common.name')}}</td>
                                                <td>: <a class="link_color" href="">{{ @$order->affiliateUser->user->first_name }}</a></td>
                                            </tr>
                                            <tr>
                                                <td>{{__('common.email')}}</td>
                                                <td>: {{ @$order->affiliateUser->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{__('common.phone')}}</td>
                                                <td>: {{getNumberTranslate(@$order->affiliateUser->user->phone)}}</td>
                                            </tr>
                                        </table>
                                    @endif
                                @endif
                            </div>

                        </div>

                        <div class="row mt-30">
                            <div class="col-12 mt-30">
                                @if ($order_packages->is_cancelled == 1)
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label red" for="">
                                            {{__('defaultTheme.order_cancelled')}} - ({{ getNumberTranslate($order_packages->package_code) }})
                                        </label>
                                    </div>

                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label sub-title" for="">
                                            {{ @$order_packages->cancel_reason->name }}
                                        </label>
                                    </div>
                                @endif
                                <div class="box_header common_table_header">
                                    <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('common.package')}}: {{ getNumberTranslate($order_packages->package_code) }}</h3>
                                    <ul class="d-flex float-right">
                                        <li> <strong>{{__('shipping.shipping_method')}} : {{ $order_packages->shipping->method_name }}</strong></li>
                                    </ul>
                                </div>

                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <!-- table-responsive -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{__('common.sl')}}</th>
                                                        <th scope="col">{{__('common.image')}}</th>
                                                        <th scope="col">{{__('common.name')}}</th>
                                                        <th scope="col">{{__('common.qty')}}</th>
                                                        <th scope="col">{{__('common.price')}}</th>
                                                        <th scope="col">{{__('Commission')}}</th>
                                                        <th scope="col">{{__('common.tax')}}</th>
                                                        <th scope="col">{{__('common.total')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_packages->products as $key => $package_product)
                                                        <tr>
                                                            <td>{{ getNumberTranslate($key + 1) }}</td>
                                                            <td>
                                                                <div class="product_img_div">
                                                                    @if ($package_product->type == "gift_card")
                                                                        <img src="{{showImage(@$package_product->giftCard->thumbnail_image)}}"
                                                                             alt="#">
                                                                    @else
                                                                        @if (@$package_product->seller_product_sku->sku->product->product_type == 1)
                                                                            <img src="{{showImage(@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->sku->product->thumbnail_image_source)}}"
                                                                                 alt="#">
                                                                        @else
                                                                            <img src="{{showImage(@$package_product->seller_product_sku->sku->variant_image?@$package_product->seller_product_sku->sku->variant_image:@$package_product->seller_product_sku->product->thum_img??@$package_product->seller_product_sku->product->product->thumbnail_image_source)}}"
                                                                                 alt="#">
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="text-nowrap">
                                                                @if ($package_product->type == "gift_card")
                                                                    {{ @$package_product->giftCard->name }} <br>
                                                                    <a class="green gift_card_div pointer" data-gift-card-id='{{ $package_product->giftCard->id }}' data-qty='{{ $package_product->qty }}' data-customer-mail='{{($order->customer_id) ? $order->shipping_address->customer_email : $order->guest_info->shipping_email}}' data-order-id='{{ $order->id }}'><i class="ti-email mr-1 green"></i>
                                                                        {{($order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first() != null && $order->gift_card_uses->where('gift_card_id', $package_product->giftCard->id)->first()->is_mail_sent) ? "__('order.sent_already')" : "__('order.send_code_now')"}}
                                                                    </a>
                                                                @else
                                                                    {{ @$package_product->seller_product_sku->sku->product->product_name }}

                                                                    @if (@$package_product->seller_product_sku->product->product->is_physical == 0 && @$package_product->seller_product_sku->sku->digital_file)
                                                                        <br><a class="green is_digital_div pointer" data-customer-id='{{ $order->customer_id }}' data-product-sku-id='{{ @$package_product->seller_product_sku->product_sku_id }}' data-seller-sku-id='{{ @$package_product->seller_product_sku->id }}' data-seller-id='{{ $order_packages->seller_id }}' data-package-id='{{ $order_packages->id }}' data-qty='{{ $package_product->qty }}' data-customer-mail='{{($order->customer_id) ? @$order->address->shipping_email : @$order->guest_info->shipping_email}}' data-order-id='{{ $order->id }}'><i class="ti-email mr-1 green"></i>
                                                                           {{__('common.send_link_mail')}}
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @if ($package_product->type == "gift_card")
                                                                <td>{{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}</td>
                                                            @else
                                                                @if (@$package_product->seller_product_sku->sku->product->product_type == 2)
                                                                    <td class="text-nowrap">
                                                                        {{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}
                                                                        <br>
                                                                        @php
                                                                            $countCombinatiion = count(@$package_product->seller_product_sku->product_variations);
                                                                        @endphp
                                                                        @foreach (@$package_product->seller_product_sku->product_variations as $key => $combination)
                                                                            @if ($combination->attribute->id == 1)
                                                                                <div class="box_grid ">
                                                                                    <span>{{ $combination->attribute->name }}:</span><span class='box variant_color' style="background-color:{{ $combination->attribute_value->value }}"></span>
                                                                                </div>
                                                                            @else
                                                                                {{ $combination->attribute->name }}:
                                                                                {{ $combination->attribute_value->value }}
                                                                            @endif
                                                                            @if ($countCombinatiion > $key + 1)
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                @else
                                                                    <td>{{__('common.qty')}}: {{ getNumberTranslate($package_product->qty) }}</td>
                                                                @endif
                                                            @endif
                                                            @php 
                                                            $sellerCommissionRate = \Modules\MultiVendor\Entities\SellerCommssionType::where([
                                                                ['name', '=', 'Commission'],
                                                                ['status', '=', 1],
                                                            ])->value('rate');
                                                            // dd($sellerCommissionRate);
                                                            $commissionAmount = ($package_product->price * $package_product->qty * $sellerCommissionRate) / 100;
                                                            @endphp
                                                            <td class="text-nowrap">{{ single_price($package_product->price) }}</td>
                                                            @if($package_product->seller_product_sku->user_id != 1)
                                                                <td class="text-nowrap">{{ single_price($commissionAmount) }}</td>
                                                            @else
                                                            <td class="text-nowrap">{{ single_price(0) }}</td>
                                                            @endif 
                                                            <td class="text-nowrap">{{ single_price($package_product->tax_amount) }}</td>
                                                            <td class="text-nowrap">{{ single_price($package_product->price * $package_product->qty + $package_product->tax_amount - $commissionAmount) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col-md-6">
                                <table class="table-borderless clone_line_table">
                                    <tr>
                                        <td><strong>{{__('order.order_info')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="info_tbl">{{__('order.is_paid')}}</td>
                                        <td>: {{ $order->is_paid == 1 ? __('common.yes') : __('common.no') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info_tbl">{{__('order.is_cancelled')}}</td>
                                        <td>: {{ $order->is_cancelled == 1 ? __('common.yes') : __('common.no') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table-borderless clone_line_table ml-md-auto mt-md-0 mt-2">
                                    <tr>
                                        <td><strong>{{__('common.order_summary')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="info_tbl">{{__('order.subtotal')}}</td>
                                        <td>: {{ single_price($order->sub_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Subscription Discount')}}</td>
                                        <td class="pl-25 text-nowrap">: - {{ single_price($order->discount_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('common.shipping_charge')}}</td>
                                        <td class="pl-25 text-nowrap">:+ {{ single_price($order->shipping_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info_tbl">{{__('common.tax')}}/{{__('gst.gst')}}</td>
                                        <td>: {{single_price($order_packages->tax_amount)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="info_tbl">{{__('order.grand_total')}}</td>
                                        <td>: {{ single_price(@$order->order_payment->amount) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 student-details">
                    @if ($order->is_cancelled != 1 && $order_packages->is_cancelled != 1)
                        @if (permissionCheck('order_manage.update_delivery_status'))
                            <form action="{{ route('order_manage.update_delivery_status', $order_packages->id) }}" method="post">
                                @csrf
                                <div class="row white_box p-25 box_shadow_white mr-0 ml-0">
                                    @if($order_packages->order->is_confirmed == 0)
                                    <div class="col-lg-12">
                                        <div class="primary_input">
                                            <label class="primary_selectlabel alert alert-warning">
                                                {{__('order.status_is_changable_after_confirmed_the_order')}}
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-12 p-0">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for=""> <strong>{{ __('order.delivery_status') }}</strong></label>
                                            <select class="primary_select mb-25" name="delivery_status" id="delivery_status" >
                                                @foreach ($processes as $key => $process)
                                                    <option value="{{ $process->id }}" @if ($order_packages->delivery_status == $process->id) selected @endif>{{ $process->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for=""> <strong>{{ __('order.note') }}</strong> </label>
                                            <textarea class="primary_textarea height_112 address" placeholder="{{ __('order.note') }}" name="note" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-0 text-center">
                                        <button class="primary_btn_2"><i class="ti-check"></i>{{ __('common.update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="row mt-2 mr-0 ml-0 white_box p-25 box_shadow_white">
                            <div class="col-lg-12 p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th scope="col">{{ __('common.state') }}</th>
                                            <th scope="col">{{ __('common.date') }}</th>
                                            <th scope="col">{{ __('common.note') }}</th>
                                            <th scope="col">{{ __('common.updated_by') }}</th>
                                        </tr>
                                        @foreach ($order_packages->delivery_states as $key => $delivery_state)
                                            <tr>
                                                <td>{{ dateConvert(@$delivery_state->delivery_process->created_at) }}</td>
                                                <td>{{$delivery_state->created_at}}</td>
                                                <td>{{ @$delivery_state->note }}</td>
                                                <td>{{ @$delivery_state->creator->first_name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                    @endif

                    @if($order->note != null)
                        <div class="row white_box p-25 ml-0 mr-0 box_shadow_white mt-20">
                            <div class="description_box">
                                <h4 class="f_s_14 f_w_500 mb_10">{{__('common.order')}} {{__('common.note')}}:</h4>
                                <p class="f_w_400">
                                    {{$order->note}}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript">

        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click', '.is_digital_div', function(){
                    var customer_id = $(this).attr("data-customer-id");
                    var seller_id = $(this).attr("data-seller-id");
                    var order_id = $(this).attr("data-order-id");
                    var package_id = $(this).attr("data-package-id");
                    var seller_product_sku_id = $(this).attr("data-seller-sku-id");
                    var product_sku_id = $(this).attr("data-product-sku-id");
                    var mail = $(this).attr("data-customer-mail");
                    var qty = $(this).attr("data-qty");
                    $(this).text('Sending.....');
                    var _this = this;
                    $.post('{{ route('send_digital_file_access_to_customer') }}', {_token:'{{ csrf_token() }}', customer_id:customer_id, seller_id:seller_id, order_id:order_id, package_id:package_id, seller_product_sku_id:seller_product_sku_id, product_sku_id:product_sku_id, mail:mail, qty:qty}, function(data){
                        if (data == "true" || data == 1) {
                            toastr.success("{{__('common.mail_has_been_sent_successful')}}","{{__('common.success')}}")
                            $(_this).text('Sent')
                        }else {
                            toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");

                            $(_this).text("{{__('order.send_code_now')}}")
                        }
                    });
                });
                $(document).on('click','.gift_card_div', function(){
                    var gift_card_id = $(this).attr("data-gift-card-id");
                    var order_id = $(this).attr("data-order-id");
                    var mail = $(this).attr("data-customer-mail");
                    var qty = $(this).attr("data-qty");
                    $(this).text('Sending.....');
                    var _this = this;
                    $.post('{{ route('send_gift_card_code_to_customer') }}', {_token:'{{ csrf_token() }}', order_id:order_id, mail:mail, gift_card_id:gift_card_id, qty:qty}, function(data){

                        if (data == "true" || data == 1) {

                            toastr.success("{{__('common.mail_has_been_sent_successful')}}","{{__('common.success')}}")
                            $(_this).text('Sent')
                        }else {
                            toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                            $(_this).text("{{__('order.send_code_now')}}")
                        }

                    }).fail(function(response) {
                        if(response.responseJSON.msg){
                            toastr.error(response.responseJSON.msg ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            $(_this).text('Already Used')
                            return false;
                        }
                    });
                });

                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    setTimeout(function () {
                        window.location.reload();
                    }, 15000);
                }
            });
        })(jQuery);


    </script>
@endpush
