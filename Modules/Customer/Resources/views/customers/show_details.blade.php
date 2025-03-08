@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/customer/css/show_details.css'))}}" />
<style>
    .white-color{
        color: #FFF !important;
    }
</style>
@endsection
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">{{ __('common.customer_profile')}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="img_div">
                                    <img class="student-meta-img mb-3" src="{{ (@$customer->avatar != null) ? showImage($customer->avatar) : showImage('frontend/default/img/avatar.jpg') }}"  alt="">
                                </div>
                                <h3>{{$customer->first_name}} {{$customer->last_name}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr>
                                        <td>{{ __('common.name') }}</td>
                                        <td>: <span class="ml-1"></span>{{$customer->first_name}} {{$customer->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.email') }}</td>
                                        <td>: <span class="ml-1"></span>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.phone') }}</td>
                                        <td>: <span class="ml-1"></span>{{ (getNumberTranslate($customer->Phone_number)) ?? $customer->username }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.registered_date') }}</td>
                                        <td>: <span class="ml-1"></span>{{ dateConvert($customer->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('common.active_status') }}</td>
                                        <td>: <span class="ml-1"></span>
                                            @if ($customer->is_active == 1)
                                                <span class="badge_1">{{__('common.active')}}</span>
                                            @elseif($customer->is_active == 0)
                                                <span class="badge_4">{{__('common.disabled')}}</span>
                                            @else
                                                <span class="badge_4">{{__('common.in-active')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3 col-sm-12">
                               <div class="mb-3 mb-md-0 customer_profile">
                                <h3>{{__('common.order_summary')}}</h3>
                                <table class="table table-borderless customer_view">
                                    <tr><td>{{__('common.total_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders))}}</td></tr>
                                    <tr><td>{{__('common.confirmed_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_confirmed', 1)->where('is_completed', 0)))}}</td></tr>
                                    <tr><td>{{__('common.pending_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_confirmed', 0)))}}</td></tr>
                                    <tr><td>{{__('common.completed_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_completed', 1)))}}</td></tr>
                                    <tr><td>{{__('common.cancelled_orders')}}</td>
                                    <td>: <span class="ml-1"></span>{{getNumberTranslate(count($customer->orders->where('is_cancelled', 1)))}}</td></tr>
                                </table>
                               </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="customer_subscriptions_payments">
                                    <h3>{{__('common.subsription_payments_summary')}}</h3>
                                    @if($customer_subscription_payment)
                                    <table class="table table-borderless customer_view">
                                        <tr><td>{{__('common.plan_name')}}</td>
                                        <td>: <span class="ml-1"></span>{{$customer_subscription_payment->pricingPlans->name}}</td></tr>
                                        <tr><td>{{__('common.transaction_title')}}</td>
                                        <td>: <span class="ml-1"></span>{{$customer_subscription_payment->transaction->title}}</td></tr>
                                        <tr><td>{{__('common.payment_method')}}</td>
                                            <td>: <span class="ml-1"></span>{{$customer_subscription_payment->transaction->payment_method}} </td></tr>
                                        <tr><td>{{__('common.amount')}}</td>
                                        <td>: <span class="ml-1"></span>{{$customer_subscription_payment->transaction->amount}} $</td></tr>
                                        <tr><td>{{__('common.transaction_date')}}</td>
                                        <td>: <span class="ml-1"></span>{{$customer_subscription_payment->transaction->transaction_date}} </td></tr>
                                        <tr><td>{{__('common.status')}}</td>
                                            <td>: <span class="ml-1"></span>{{$customer_subscription_payment->status}} </td></tr>
                                        <tr><td>{{__('common.is_approved')}}</td>
                                            <td>: <span class="ml-1"></span><label class="switch_toggle" for="active_checkbox{{ $customer_subscription_payment->id }}">
                                                <input type="checkbox" id="active_checkbox{{ $customer_subscription_payment->id }}" @if ($customer_subscription_payment->is_approved == 1) checked @endif value="{{ $customer_subscription_payment->id }}" class="update_approved_status" data-customer-id="{{ $customer_subscription_payment->customer_id }}" data-id="{{ $customer_subscription_payment->id }}">
                                                <div class="slider round"></div>
                                            </label></td></tr>
                                    </table>
                                    @else
                                        <p>{{ __('No subscription found.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($customer->description)
                            <hr>
                                <div class="row">
                                    <div class="col">
                                        <label class="primary_input_label" for="">
                                            @php
                                                echo $customer->description;
                                            @endphp
                                        </label>
                                    </div>
                                </div>
                            <hr>
                        @endif
                    </div>
                </div>
            </div>
            <div class="white_box_50px box_shadow_white">
             <div class="row">
              <div class="col-md-6 col-sm-12">
                    <div class="basic-business-info">
                        <h3>Basic Business Info</h3>
                        @if($customer->quiz_approved)
                        <table class="table table-borderless customer_view">
                            <tr><td>{{__('Company Name')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->company_name}}</td></tr>
                            <tr><td>{{__('Phone Number')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->Phone_number}}</td></tr>
                            <tr><td>{{__('Billing Address')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->billing_address}}</td></tr>
                            <tr><td>{{__('Shipping Address')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->shipping_address}}</td></tr>
                            <tr><td>{{__('Commercial or Residential?')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->commercial_or_residential}}</td></tr>
                            <tr><td>{{__('Loading Dock?')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->loading_dock}}</td></tr>
                            <tr><td>{{__('Forklift?')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->forklift}}</td></tr>
                            <tr><td>{{__('Pallet Jack?')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->pallet_jack}}</td></tr>
                             <tr><td>{{__('Call Ahead?')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->call_ahead}}</td></tr>
                            <tr><td>{{__('Special Instructions for Deliveries?')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->special_instructions}}</td></tr>
                            <tr><td>{{__('Payable Contact Name')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->accounts_payable_contact_name}}</td></tr>
                            <tr><td>{{__('Payable Number')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->accounts_payable_number}}</td></tr>
                             <tr><td>{{__('Payable Email')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->accounts_payable_email}}</td></tr>
                            <tr><td>{{__('Liability Insurance Provider')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->general_liability}}</td></tr>
                             <tr><td>{{__('Preferred Language')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->preferred_language}}</td></tr>
                        </table>
                        @else
                            <p>{{ __('No Quiz found.') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="basic-business-info">
                        <h3>Detailed Business Info</h3>
                        @if($customer->quiz_approved)
                        <table class="table table-borderless customer_view">
                            <tr><td>{{__('Years in Business')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->years_in_business}}</td></tr>
                            
                            <tr><td>{{__('Number of Locations')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->number_of_locations}}</td></tr>
                            <tr><td>{{__('Primary Business Function')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->primary_business_function}}</td></tr>
                            <tr><td>{{__('Number of Rigs')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->number_of_rigs}}</td></tr>
                            <tr><td>{{__('Monthly Volume')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->monthly_volume}}</td></tr>
                            <tr><td>{{__('Open Cell Volume')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->open_cell_volume}}</td></tr>
                            <tr><td>{{__('Closed Cell Volume')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->closed_cell_volume}}</td></tr>
                            <tr><td>{{__('Total Volume Previous Year')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->total_volume_previous_year}}</td></tr>
                             <tr><td>{{__('Preferred Foam Brand')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->preferred_foam_brand}}</td></tr>
                        </table>
                        @else
                            <p>{{ __('No Quiz found.') }}</p>
                        @endif
                    </div>
                </div>
               {{-- <div class="row mt-2"> --}}
                <div class="col-md-12 col-sm-12">
                    <div class="basic-business-info">
                        <h3>Equipment Info</h3>
                        @if($customer->quiz_approved)
                        <table class="table table-borderless customer_view">
                            <tr><td>{{__('Preferred Rig Type')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->preferred_rig_type}}</td></tr>
                            
                            <tr><td>{{__('Shore Power or Diesel Generator')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->power_source}}</td></tr>
                            <tr><td>{{__('What Brand Proportioners')}}</td>
                                <td>: <span class="ml-1"></span>{{$customer->proportioner_brand}}</td></tr>
                            <tr><td>{{__('What Model Proportions')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->proportioner_model}}</td></tr>
                            <tr><td>{{__('Preferred Spray Gun Brand and Modele')}}</td>
                            <td>: <span class="ml-1"></span>{{$customer->preferred_spray_gun}}</td></tr>
                            <tr><td>{{__('common.is_approved')}}</td>
                                <td>: <span class="ml-1"></span><label class="switch_toggle" for="active_checkbox{{ $customer->id }}">
                                    <input type="checkbox" id="active_checkbox{{ $customer->id }}" @if ($customer->quiz_approved == "approved") checked @endif value="{{ $customer->id }}" class="update_approved_quiz">
                                    <div class="slider round"></div>
                                </label></td></tr>
                        </table>
                        @else
                            <p>{{ __('No Quiz found.') }}</p>
                        @endif
                    </div>
                </div>
            {{-- </div>  --}}
            </div>
             </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="col-lg-12 student-details">
                            <ul class="nav nav-tabs tab_column mb-50" role="tablist">
                                <li class="nav-item">
                                   <a class="nav-link active" href="#Order" role="tab" data-toggle="tab">{{ __('common.orders') }}</a>
                                </li>
                                {{--
                                <li class="nav-item">
                                    <a class="nav-link" href="#Wallet" role="tab" data-toggle="tab">{{ __('common.wallet_histories') }}</a>
                                </li>
                                --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="#Address" role="tab" data-toggle="tab">{{ __('common.addresses') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#login_ip" role="tab" data-toggle="tab">{{ __('common.login_ip') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-30">

                                <div role="tabpanel" class="tab-pane fade show active" id="Order">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table" id="orderTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('common.sl')}}</th>
                                                                    <th width="10%">{{__('common.date')}}</th>
                                                                    <th>{{__('common.order_id')}}</th>
                                                                    <th>{{__('order.total_product_qty')}}</th>
                                                                    <th>{{__('common.total_amount')}}</th>
                                                                    <th>{{__('order.order_status')}}</th>
                                                                    <th>{{__('order.is_paid')}}</th>
                                                                    <th>{{__('common.action')}}</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div role="tabpanel" class="tab-pane fade" id="Wallet">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">

                                                    <div class="">
                                                        <table class="table Crm_table_active3" id="walletTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{__('common.sl')}}</th>
                                                                    <th>{{__('common.date')}}</th>
                                                                    <th>{{__('common.user')}}</th>
                                                                    <th>{{__('order.txn_id')}}</th>
                                                                    <th>{{__('common.amount')}}</th>
                                                                    <th>{{__('common.type')}}</th>
                                                                    <th>{{__('common.payment_method')}}</th>
                                                                    <th>{{__('common.approval')}}</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                --}}
                                <div role="tabpanel" class="tab-pane fade" id="Address">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table Crm_table_active3">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('common.sl') }}</th>
                                                                    <th>{{ __('common.full_name') }}</th>
                                                                    <th>{{ __('common.address') }}</th>
                                                                    <th>{{ __('common.region') }}</th>
                                                                    <th>{{ __('common.email') }}</th>
                                                                    <th>{{ __('common.phone_number') }}</th>
                                                                    <th>{{ __('common.postcode') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($customer->customerAddresses as $key => $address)
                                                                    <tr class="{{ $address->is_updated == 0 ? 'bg-success':'' }}">
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($key+1) }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->name }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->address }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($address->city.'-'.$address->state.'-'.$address->country) }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ $address->email }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($address->phone) }}</td>
                                                                        <td class="{{ $address->is_updated == 0 ? 'white-color':'' }}" >{{ getNumberTranslate($address->postal_code) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="login_ip">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="QA_section QA_section_heading_custom check_box_table">
                                                <div class="QA_table ">
                                                    <div class="">
                                                        <table class="table Crm_table_active3">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('common.sl') }}</th>
                                                                    <th>{{ __('common.IP') }}</th>
                                                                    <th>{{ __('common.agent') }}</th>
                                                                    <th>{{ __('common.login_time') }}</th>
                                                                    <th>{{ __('common.logout_time') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($logins as $key => $login)
                                                                    <tr>
                                                                       <td>{{ $key + 1 }}</td>
                                                                       <td>{{ $login->ip }}</td>
                                                                       <td>{{ $login->agent }}</td>
                                                                       <td>{{ showDate($login->login_time).' '.date("h:i a",strtotime($login->login_time)) }}</td>
                                                                       <td>{{ showDate($login->logout_time).' '.date("h:i a",strtotime($login->logout_time)) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script type="text/javascript">
        $(document).ready(function(){
            let baseUrl = $('#url').val();
            let urlForOrders = baseUrl + '/customer/profile/details/' + "{{$customer->id}}" + '/get-orders';
            $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: urlForOrders
                }),
                "initComplete":function(json){
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id',render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'date', name: 'date' },
                    { data: 'order_number', name: 'order_number' },
                    { data: 'number_of_product', name: 'number_of_product' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'order_status', name: 'order_status' },
                    { data: 'is_paid', name: 'is_paid' },
                    { data: 'action', name: 'action' }
                ],
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });

            let urlForWallet = baseUrl + '/customer/profile/details/' + "{{$customer->id}}" + '/get-wallet-history';
            $('#walletTable').DataTable({
                processing: true,
                serverSide: true,
                "stateSave": true,
                "ajax": ( {
                    url: urlForWallet
                }),
                "initComplete":function(json){

                },
                columns: [
                    { data: 'DT_RowIndex', name: 'id' ,render:function(data){
                        return numbertrans(data)
                    }},
                    { data: 'date', name: 'date' },
                    { data: 'user', name: 'user' },
                    { data: 'txn_id', name: 'txn_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'type', name: 'type' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'approval', name: 'approval' }
                ],

                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: trans('common.quick_search'),
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'Copy',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        title: $("#header_title").text(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#header_title").text(),
                        titleAttr: 'PDF',
                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        title: $("#header_title").text(),
                        exportOptions: {
                            columns: ':not(:last-child)',
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ['colvisRestore']
                    }
                ],
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
            });
        });
        $(document).on('change', '.update_approved_status', function(event){
            let id = $(this).data('id');
            let customer_id = $(this).data('customer-id');
            let is_approved = 0;

            if($(this).prop('checked')){
                is_approved = 1;
            }
            else{
                is_approved = 0;
            }
            $("#pre-loader").removeClass('d-none');

            $.post('{{ route('customer.update_approved_status') }}', {_token:'{{ csrf_token() }}', id:id, is_approved:is_approved, customer_id:customer_id}, function(data){
                if(data == 1){
                    toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                }else if(data == 0){
                  toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                }
                else{
                    toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                }
                $("#pre-loader").addClass('d-none');
            })

            .fail(function(response) {
            if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                    $('#pre-loader').addClass('d-none');
                    return false;
                }

            });
        });
        $(document).on('change', '.update_approved_quiz', function(event){ 
            let id = $(this).val();
            let quiz_approved = "pending"; // Default to pending
        
            if ($(this).prop('checked')) {
                quiz_approved = "approved";
            }
        
            $("#pre-loader").removeClass('d-none');
        
            $.post('{{ route('customer.update_approved_quiz') }}', {
                _token: '{{ csrf_token() }}', 
                id: id, 
                quiz_approved: quiz_approved
            }, function(data){
                if (data == 1) {
                    toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                } else {
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                }
                $("#pre-loader").addClass('d-none');
            }).fail(function(response) {
                if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error, "{{__('common.error')}}");
                    $('#pre-loader').addClass('d-none');
                }
            });
        });

    </script>
@endpush
