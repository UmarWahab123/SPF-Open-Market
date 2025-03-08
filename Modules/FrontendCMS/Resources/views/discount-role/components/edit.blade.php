<div class="main-title">
    <h3 class="mb-30">{{ __('frontendCms.edit_discount_role') }}
    </h3>
</div>
@include('frontendcms::discount-role.components.form',['form_id' => 'discount_role_edit_form', 'discount_role' => 'edit','btn_id' => 'edit_btn', 'button_name' => __('common.update'),'pricingPlan' => $pricingPlan ])

