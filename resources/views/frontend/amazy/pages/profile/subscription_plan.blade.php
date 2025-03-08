@extends('frontend.amazy.layouts.app')
@section('content')
    <div class="amazy_dashboard_area dashboard_bg section_spacing6">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    @include('frontend.amazy.pages.profile.partials._menu')
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="dashboard_white_box_header d-flex align-items-center gap_20  mb_20">
                        <h3 class="font_20 f_w_700 mb-0 ">{{__('amazy.Subscription Plans')}}</h3>
                    </div>
                    <div class="dashboard_white_box bg-white mb_25 pt-0">
                        <div class="dashboard_white_box_body">
                          <div class="row justify-content-center">
                          @if($data['subscription_plans']->count() > 1)
                            @foreach($data['subscription_plans'] as $plan)
                                <div class="col-md-4 col-sm-6 mt-5 mb-5">
                                    <div class="card plan-card h-100 shadow-lg position-relative">
                                        {{-- <div class="ribbon d-none"><span>Popular</span></div> --}}
                                        <div class="card-header text-center text-white py-4" style=" background: linear-gradient(90deg, rgba(6, 30, 33, 1) 0%, rgba(34, 56, 29, 1) 100%);">
                                            <h4 class="mb-0 text-white">{{ $plan->name }}</h4>
                                        </div>
                                        <div class="card-body text-center p-4">
                                            <h5 class="display-6">${{ number_format($plan->plan_price) }}</h5>
                                            <p><strong>{{ $plan->expire_in }}</strong> {{ __('common.days_access') }}</p>
                                            <hr>
                                            <p><strong class="bg-info text-white">{{ $plan->best_for }}</strong></p><br>
                                            
                                            
                                            @if ($plan->discountRole->isNotEmpty())
                                                <p><strong>{{ __('frontendCms.discount') }}</strong> : {{ __('common.up_to') }} <strong> {{ $plan->discountRole->max('discount') }} % </strong></p>
                                            @else 
                                            <p>{{ __('frontendCms.discount') }} : {{ __('common.up_to') }} <strong> 0 %</strong></p>
                                            @endif

                                            @php
                                                // Check if there's a subscription payment with status "Pending" or "Active"
                                                $subscription = $plan->subscriptionPayments->first();
                                            @endphp
                                           
                                            @if($subscription && $subscription->status == "Pending")
                                            <div class="mt-4">
                                                {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg plan_cancel_btn btn-outline-secondary mr_5">{{__('common.cancel')}}</a> --}}
                                                
                                                <button class="btn btn-lg btn-outline-dark buy-now-btn text-white" style="padding: 10px 20px; background-color: red;" disabled>
                                                    {{ __('common.pending_plan') }}
                                                </button>
                                                
                                            </div>

                                            @elseif($subscription && $subscription->status == "Active")
                                            {{-- <a href="{{ url('/cancel-subscription-plan'.'/' . $subscription->id) }}" style="max-height: 47px;" class="btn btn-lg mt-4 plan_cancel_btn btn-block btn-outline-secondary">{{__('common.cancel')}}</a> --}}

                                                <button class="btn btn-lg btn-outline-info btn-block mt-4 buy-now-btn" style="background-color : cornsilk;" disabled>
                                                    {{ __('common.active_plan') }}
                                                </button>
                                            @elseif($subscription && $subscription->status == "Expired")
                                                <button class="btn btn-lg btn-outline-info btn-block buy-now-btn mt-4" style="background-color : rgb(192 206 56); color :red;" disabled>
                                                    {{ __('common.expired') }}
                                                </button>

                                                <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="btn btn-lg btn-outline-success btn-block mt-4 buy-now-btn paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                                                    {{ __('common.buy_now') }}
                                                </a>

                                            @else
                                                <a href="{{ route('frontend.subscription_payment_select', encrypt($plan->id)) }}" class="btn btn-lg btn-outline-success btn-block mt-4 buy-now-btn paypal-payment-btn" data-plan-id="{{$plan->id}}" data-plan-price="{{ $plan->plan_price }}">
                                                    {{ __('common.buy_now') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          @else
                            <h3> {{ __('common.no_subscription_plan_was_found') }} </h3>
                          @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="paypalModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complete Your Subscription Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paypalButtons = document.querySelectorAll('.paypal-payment-btn');

    paypalButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // Set dynamic amount from the clicked plan
            const planPrice = event.target.getAttribute('data-plan-price');
            var pricing_plan_id = event.target.getAttribute('data-plan-id');
            // Show the modal
            $('#paypalModal').modal('show');

            // Remove previous PayPal button instance if it exists
            document.getElementById('paypal-button-container').innerHTML = '';

            // Render the PayPal button in the modal and trigger it automatically
            paypal.Buttons({
                fundingSource: paypal.FUNDING.CARD,
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: planPrice // Dynamic total amount
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Handle the payment success
                        const paymentData = {
                            payment_id: details.id,
                            pricing_plan_id:pricing_plan_id,
                            payer_id: details.payer.payer_id,
                            amount: details.purchase_units[0].amount.value,
                            status: details.status,
                            type:'customer_subscription_payment'
                        };
                        $('#pre-loader').show();

                        fetch('{{ route("paypal.success") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(paymentData)
                        }).then(response => response.json())
                        .then(data => {
                          $('#pre-loader').hide();
                          $('#paypalModal').modal('hide')
                            if (data.success) {
                                toastr.success("Subscription payment successful", "{{__('common.success')}}");
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.error('Payment failed: ' + data.message, "{{__('common.error')}}");
                            }
                        }).catch(error => {
                            $('#pre-loader').hide();
                            $('#paypalModal').modal('hide')
                            toastr.error('An error occurred: ' + error.message, "{{__('common.error')}}");
                        });
                    });
                }
            }).render('#paypal-button-container'); // Renders PayPal button inside modal
        });
    });
});
$(".close").click(function(){
  $('#paypalModal').modal('hide');
});
</script>
@endpush

