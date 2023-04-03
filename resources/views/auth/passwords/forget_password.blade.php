@extends('layouts.app')
@section('content')

<div class="container">
    <h3 >Forget password  </h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  


<form  action="{{ url('otp_send_email') }}" method="POST" >

    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Email</label>
      <input type="email" style="width: 50vw" class="form-control" id="email"  name="email" aria-describedby="emailHelp">
    </div>
    <button class="btn btn-primary ">Send Mail</button>
</form>
@endsection;

