<div class="main-title">
    <h3 class="mb-30">{{__('frontendCms.add_subscription_plan')}} </h3>
</div>
@include('frontendcms::pricing-plan.components.form',['form_id' => 'add_pricing_form','pricing_plane' => 'create','btn_id' => 'create_btn', 'button_name' => __('common.save'),'gst_taxes' => $gst_taxes ])




