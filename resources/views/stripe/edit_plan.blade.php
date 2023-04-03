@extends('layouts.app')
@section('content')
<h2 class="text-center"> Update Plan</h2>



<div class="container" style="width:40vw">  

    <form action="{{ url('update_plan') }}" method="POST">
  <div class="mb-3">
     @csrf
    <label for="name" class="form-label"> Name</label>
    <input type="text" name="name" value="{{ $data[0]->name }}" class="form-control"  >
    <small>@error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div>

  <div class="mb-3">
    <label for="price" class="form-label"> Price</label>
    <input type="number" name="price"  value="{{ $data[0]->price }}" class="form-control"  >
    <input type="hidden" name="plan_id" value="{{$data[0]->plan_id}}">
    <small>@error('price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div> 

 <div class="mb-3">
    <label for="price" class="form-label"> Plan type</label>
    <select name="duration" class="form-select"  id="duration">
        <option  @if($data[0]->plan_type=="month") selected @endif   value="month">1 Month</option>
        <option  @if($data[0]->plan_type=="year") selected @endif value="year">1 year</option>
       
    </select>
    <small>@error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror</small>
  </div>
 
  
  <div class="mb-3">
   <button class="btn btn-primary">Update Plan</button>
  </div>

</form>
</div>
@endsection
