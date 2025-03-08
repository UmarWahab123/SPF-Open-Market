<style type="text/css">
  #card-element{
  height: 50px;
  padding-top: 16px;
  }
</style>
<div class="modal-body">
  <div class="container mb-5">
      <div class="row">
          <div class="col-md-8">
              <label class='control-label'> {{ __("common.name") }}</label>
              <input type="input" class="form-control" name="name" placeholder="{{__("common.enter_name")}}">
              <input type='hidden' name='stripeToken' id='stripe-token-id'>
              <br>
              <div id="card-element" class="form-control"></div>
          </div>
      </div>
  </div>
</div>

@push("scripts")
<script type="text/javascript">
  var stripe, cardElement;

  $(document).ready(function(){
      stripe = Stripe('{{ config('services.stripe.key') }}');
      var elements = stripe.elements();
      cardElement = elements.create('card',{
        hidePostalCode: true  
      });
      cardElement.mount('#card-element');
  });

  $('#pay-now-btn').on('click', function(e){
      e.preventDefault();
      if($('input[name="method"]:checked').val() === 'Stripe'){
          createStripeToken();
      } else {
          // Submit the form for non-Stripe payments
          $('#main-checkout-form').submit();
      }
  });

  function createStripeToken() {
  document.getElementById("pay-now-btn").disabled = true;
  stripe.createToken(cardElement).then(function(result) {
    if (result.error) {
      document.getElementById("pay-now-btn").disabled = false;
      alert(result.error.message);
    } else {
      document.getElementById("stripe-token-id").value = result.token.id;
      // Submit form to create a subscription instead of a charge
      $('#main-checkout-form').submit();
    }
  });
}

</script>
@endpush
