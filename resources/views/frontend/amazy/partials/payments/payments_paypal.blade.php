
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>

<div id="paypal-button-container"></div>
{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    let totalAmount = document.getElementById('total_amount').getAttribute('data-amount');
    console.log("totalAmount",totalAmount);
    
    paypal.Buttons({
        fundingSource: paypal.FUNDING.CARD,
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalAmount // Dynamic total amount from your cart
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                let paymentData = {
                    payment_id: details.id,
                    payer_id: details.payer.payer_id,
                    amount: details.purchase_units[0].amount.value,
                    status: details.status,
                    type:"order"
                };
                $('#pre-loader').show();
                // Send an AJAX request to backend
                fetch('{{ route("paypal.success") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(paymentData)
                }).then(response => response.json())
                  .then(data => {
                    // Redirect or show success message based on backend response
                    if(data.success) {
                    // Redirect based on the payment type
                        if (data.type === 'order') {
                            // Create a data object similar to how it's done in your backend
                            let redirectData = {
                                payment_id: data.payment_id,
                                gateway_id: data.gateway_id,
                                step: 'complete_order'
                            };

                            // Build the URL with the object properties
                            let queryString = Object.keys(redirectData).map(key => key + '=' + encodeURIComponent(redirectData[key])).join('&');

                            // Redirect using the dynamically built query string
                            window.location.href = '{{ route("frontend.checkout") }}?' + queryString;
                            $('#pre-loader').hide();
                            //  toastr.success("Order payment successful","{{__('common.success')}}")
                        } else if (data.type === 'subscription') {
                            window.location.href = '{{ route("seller.dashboard") }}';
                              $('#pre-loader').hide();
                        } else {
                            window.location.href = '{{ route("frontend.checkout") }}'; 
                              $('#pre-loader').hide();
                            // Fallback for unknown type
                        }
                    } else {
                        // Show error message
                        alert('Payment failed: ' + data.message);
                          $('#pre-loader').hide();
                    }
                });
            });
        }
    }).render('#paypal-button-container'); // Renders PayPal button in the container
   }); 

// }); 
</script> --}}

