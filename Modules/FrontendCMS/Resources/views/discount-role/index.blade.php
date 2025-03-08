@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                @include('frontendcms::discount-role.components.show')
                @include('backEnd.partials._deleteModalForAjax',['item_name' => __('frontendCms.Discount Role')])
                @if (permissionCheck('frontendcms.discount.role.store'))
                    <div class="col-lg-3">
                        <div class="row">
                            <div id="formHtml" class="col-lg-12">
                                @include('frontendcms::discount-role.components.create',compact('pricingPlan'))
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-9">
                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">
                                        <h3 class="mb-30">{{__('frontendCms.Discount Role List')}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="QA_section QA_section_heading_custom check_box_table">
                                <div class="QA_table">
                                    <div class="" id="item_table">
                                        @include('frontendcms::discount-role.components.list')
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
@include('frontendcms::discount-role.components.scripts')
