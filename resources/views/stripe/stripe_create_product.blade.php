@extends('layouts.app')
@section('content')
<h2 class="text-center"> Create Plan</h2>
<div class="container" style="width:40vw">

    <form action="{{ url('add_plan') }}" method="POST">
  <div class="mb-3">
     @csrf
    <label for="name" class="form-label"> Name</label>
    <input type="text" name="name" class="form-control"  >
    <small>@error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label"> Price</label>
    <input type="number" name="price" class="form-control"  >
    <small>@error('price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div> 
 <div class="mb-3">
    <label for="price" class="form-label"> Plan type</label>
    <select name="duration" class="form-select"  id="duration">
        <option value="month">1 Month</option>
        <option value="year">1 year</option>
       
    </select>
    <small>@error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div>
  
  <div class="mb-3">
   <button class="btn btn-primary">Add Plan</button>
  </div>

</form>
</div>
@endsection
