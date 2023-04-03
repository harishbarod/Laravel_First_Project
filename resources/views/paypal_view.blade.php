@extends('layouts.app')
@section('content')

<body>
    <!-- Set up a container element for the button -->
    <a class="btn btn-primary" href="{{ route('processpaypal') }}">PAY 100$</a>

    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif

    
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif

<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency=USD"></script>
</body>
@endsection;