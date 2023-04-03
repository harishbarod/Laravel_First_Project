@extends('layouts.app')
@section('content')

<div class="container">
    <h3 class="text-center">Add User </h3>


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
  
<a href="{{ url('add_login') }}" class="btn btn-primary">User Profile</a>

<form  action="{{ url('add_profile') }}" method="POST">

    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Email</label>
      <input type="text" class="form-control" id="email"  name="email" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobile"  name="mobile" aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Age</label>
        <input type="text" class="form-control" id="age"  name="age" aria-describedby="emailHelp">
      </div>
    

    <button type="submit" class="btn btn-primary">Add user</button>
  </form>
</div>






@endsection

