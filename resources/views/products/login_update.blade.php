@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="text-center">Product form</h3>

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


<form  action="{{ route('products.store') }}" method="POST">

    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Product Name</label>
      <input type="text" class="form-control" id="name"  name="name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Product price</label>
      <input type="number" class="form-control" id="price" name="price">
    </div>

    <button type="submit" class="btn btn-primary">Add product</button>
  </form>
</div>

