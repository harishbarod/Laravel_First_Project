@extends('layouts.app')

@section('content')

<div class="container" style="width: 50vw">
    <h3 class="text-center"> Add Books to Store</h3>

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



<form  action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
      <label for="name" class="form-label"> Name</label>
      <input type="text" class="form-control" id="name"  name="name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label"> Image</label>
        <input type="file" class="form-control" id="image"  name="image" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label"> Price</label>
        <input type="number" class="form-control" id="price"  name="price" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label"> Quantity</label>
        <input type="number" class="form-control" id="quantity"  name="quantity" aria-describedby="emailHelp">
      </div>

    <button type="submit" class="btn btn-primary">Add Books</button>
  </form>
</div>





{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

