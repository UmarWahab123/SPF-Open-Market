<div class="main-title">
    <h3 class="mb-30">{{__('frontendCms.add_discount_role')}} </h3>
</div>
@include('frontendcms::discount-role.components.form',['form_id' => 'add_discount_role_form','discount_role' => 'create','btn_id' => 'create_btn', 'button_name' => __('common.save'),'pricingPlan' => $pricingPlan ])




