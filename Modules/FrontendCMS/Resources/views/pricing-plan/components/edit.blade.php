<div class="main-title">
    <h3 class="mb-30">{{ __('frontendCms.edit_Subscription_plan') }}
    </h3>
</div>
@include('frontendcms::pricing-plan.components.form',['form_id' => 'pricing_edit_form', 'pricing_plane' => 'edit','btn_id' => 'edit_btn', 'button_name' => __('common.update'),'gst_taxes' => $gst_taxes ])

