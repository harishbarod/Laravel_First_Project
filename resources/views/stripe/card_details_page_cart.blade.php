@extends('layouts.app')
@section('content')
 <style>
 .submit-button {
 margin-top: 10px;
}
 </style>
 </head>
 <body>
 
<div class="container">
<div class='row'>
<div class='col-md-4'></div>
<div class='col-md-4'>
<form class="form-horizontal" method="POST" id="payment-form" role="form" action="{{ route('new_customer_payment_cart') }}" >
{{ csrf_field() }}
<div class='form-row'>
<div class='col-xs-12 form-group card required'>
<label class='control-label'>Card Number</label>
<input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_no">
<small class="text-danger">{{ $errors->first('number')  }}</small>
</div>
</div>
<div class='form-row'>
<div class='col-xs-4 form-group cvc required'>
<label class='control-label'>CVV</label>
<input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name="cvv">
<small class="text-danger">{{ $errors->first('cvc')  }}</small>
</div>
<div class='col-xs-4 form-group expiration required'>
<label class='control-label'>Expiration</label>
<input class='form-control card-expiry-month' placeholder='MM' size='4' type='text' name="ExpiryMonth">
<small class="text-danger">{{ $errors->first('exp_month')  }}</small>
</div>
<div class='col-xs-4 form-group expiration required'>
<label class='control-label'> </label>
<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="ExpiryYear">
<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' name="amount" name="ExpiryYear" value="300">
<small class="text-danger">{{ $errors->first('exp_year')  }}</small>
</div>
</div>
<div class='form-row'>
<div class='col-md-12' style="margin-left:-10px;">

    <input type="hidden" name="total" value="{{ $total }}">
</div>
</div>
<div class='form-row'>
<div class='col-md-12 form-group'>
<button class='form-control btn btn-success submit-button' type='submit'>Pay »</button>
</div>
</div>
<div class='form-row'>
<div class='col-md-12 error form-group hide'>

</div>
</div>
</form>
</div>
<div class='col-md-4'></div>
</div>
</div>

@endsection