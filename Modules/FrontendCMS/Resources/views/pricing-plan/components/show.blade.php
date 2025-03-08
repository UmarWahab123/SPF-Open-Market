<div id="show_item_modal">
    <div class="modal fade" id="item_show">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('frontendCms.show Subscription Plan') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"> <i class="ti-close "></i></button>
                </div>
                <div class="modal-body item_edit_form">
                    <h5>{{__('common.name')}}: <p class="d-inline" id="show_name"></p></h5>
                    <h5>{{__('frontendCms.plan_price')}}: <p class="d-inline" id="show_plan_price"></p></h5>
                    <h5>{{__('frontendCms.expire_in')}}: <p class="d-inline" id="show_expire_in"></p></h5>
                </div>
            </div>
        </div>
    </div>
</div>
