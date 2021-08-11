@extends('layouts.frontend-master')
@push('head-script')

    <style>
        .example.example4 {
  background-color: #f6f9fc;
}

.example.example4 * {
  font-family: Inter, Open Sans, Segoe UI, sans-serif;
  font-size: 16px;
  font-weight: 500;
}

.example.example4 form {
  max-width: 496px !important;
  padding: 0 15px;
}

.example.example4 form > * + * {
  margin-top: 20px;
}

.example.example4 .container {
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
  border-radius: 4px;
  padding: 3px;
}

.example.example4 fieldset {
  border-style: none;
  padding: 5px;
  margin-left: -5px;
  margin-right: -5px;
  background: rgba(18, 91, 152, 0.05);
  border-radius: 8px;
}

.example.example4 fieldset legend {
  float: left;
  width: 100%;
  text-align: center;
  font-size: 13px;
  color: #8898aa;
  padding: 3px 10px 7px;
}

.example.example4 .card-only {
  display: block;
}
.example.example4 .payment-request-available {
  display: none;
}

.example.example4 fieldset legend + * {
  clear: both;
}

.example.example4 input, .example.example4 button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: none;
  border-style: none;
  color: #fff;
}

.example.example4 input:-webkit-autofill {
  transition: background-color 100000000s;
  -webkit-animation: 1ms void-animation-out;
}

.example.example4 #example4-card {
  padding: 10px;
  margin-bottom: 2px;
}

.example.example4 input {
  -webkit-animation: 1ms void-animation-out;
}

.example.example4 input::-webkit-input-placeholder {
  color: #9bacc8;
}

.example.example4 input::-moz-placeholder {
  color: #9bacc8;
}

.example.example4 input:-ms-input-placeholder {
  color: #9bacc8;
}

.example.example4 button {
  display: block;
  width: 100%;
  height: 37px;
  background-color: #d782d9;
  border-radius: 2px;
  color: #fff;
  cursor: pointer;
}

.example.example4 button:active {
  background-color: #b76ac4;
}

.example.example4 .error svg .base {
  fill: #e25950;
}

.example.example4 .error svg .glyph {
  fill: #f6f9fc;
}

.example.example4 .error .message {
  color: #e25950;
}

.example.example4 .success .icon .border {
  stroke: #ffc7ee;
}

.example.example4 .success .icon .checkmark {
  stroke: #d782d9;
}

.example.example4 .success .title {
  color: #32325d;
}

.example.example4 .success .message {
  color: #8898aa;
}

.example.example4 .success .reset path {
  fill: #d782d9;
}
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row checkout-box ">
            <div class="col-lg-6">
                <div class="panel panel-default checkout-step-01 ">
                    <div class="panel-body">
                        <h4 class="checkout-subtitle">Shipping Adress</h4>
                        @if (session()->get('coupon'))
                            <strong>Sub Total</strong> : ${{$total}} <br>
                            <strong>Coupon Name</strong> : {{session()->get('coupon')['coupon_name']}} <br>
                            <strong>Coupon Discound</strong> : {{session()->get('coupon')['coupon_descount']}}% <br>
                            <strong>Coupon Amount</strong> : ${{session()->get('coupon')['coupon_amount']}} <br>
                            <strong>Grand Total</strong> : ${{session()->get('coupon')['coupon_total']}} <br>
                        @else
                            <strong>Sub Total</strong> : ${{$total}} <br>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Mathod</h4>
                                </div>
                                <div class="cell example example4" id="example-4">
                                  <form action="{{ route('user.stripe.payment') }}" method="post" id="payment-form">
                                    @csrf
                                  <div class="form-row">
                                      <label for="card-element">
                                      Credit or debit card
                                      </label>
                                      <input type="hidden" name="name" value="{{ $data['name'] }}">
                                      <input type="hidden" name="email" value="{{ $data['email'] }}">
                                      <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                      <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                      <input type="hidden" name="select_division" value="{{ $data['select_division'] }}">
                                      <input type="hidden" name="select_district" value="{{ $data['select_district'] }}">
                                      <input type="hidden" name="select_state" value="{{ $data['select_state'] }}">
                                      <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                      <div id="card-element">
                                      <!-- A Stripe Element will be inserted here. -->
                                      </div>
                                      <!-- Used to display form errors. -->
                                      <div id="card-errors" role="alert"></div>
                                  </div>
                                <br>
                                <button class="btn btn-primary">Submit Payment</button>
                                </form>
                                  </div>
                                <div class="row text-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">Stripe<span>*</span></label>
                                            <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="Stripe">
                                        </div>  
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">Card<span>*</span></label>
                                            <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="Card">
                                        </div>  
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="info-title" for="exampleInputEmail1">HandCash<span>*</span></label>
                                            <input type="radio" name="payment_nathod" class="form-control unicase-form-control text-input" value="HandCash">
                                        </div>  
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

<script type="text/javascript">
    // Create a Stripe client.
  var stripe = Stripe('pk_test_51JJKG3A5O262omJdneRCtuHmScGfAOnqqtSg62nrS0quBJUR4KSbw0v78vY6Y45yfABbL15Q73qWuKNd7njOX11y00w1uMhYAb');
  // Create an instance of Elements.
  var elements = stripe.elements();
  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
  };
  // Create an instance of the card Element.
  var card = elements.create('card', {style: style});
  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');
  // Handle real-time validation errors from the card Element.
  card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
  });
  // Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
  });
  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
  }
</script>
@endpush