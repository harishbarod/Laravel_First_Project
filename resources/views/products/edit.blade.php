@extends('layouts.app')
 
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Edit Books</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
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
  
    <form action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data"  method="POST">
        @csrf
        @method('PUT')
   
        <div class="mb-3">
            <label for="name" class="form-label"> Name</label>
            <input type="text" class="form-control" id="name"  name="name"  aria-describedby="emailHelp" value="{{ $product->name }}">
          </div>

          @php $img ="1660900136.jpg"; @endphp
          <div> 
            <img style="width: 50px; height:50px" src="{{ $product->image ?asset('images/books/'.$product->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">
           </div>
          <div class="mb-3">
              <label for="name" class="form-label"> Image</label>
               
              <input type="hidden" name="old_image" value="{{ $product->image }}">
              <input type="file" class="form-control" id="image"  name="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label"> Price</label>
              <input type="number" class="form-control" id="price"  name="price" value="{{ $product->price }}" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="name" class="form-label"> Quantity</label>
              <input type="number" class="form-control" id="quantity"  name="quantity" value="{{ $product->quantity }}" aria-describedby="emailHelp">
            </div>
      
          <button type="submit" class="btn btn-primary">Add Books</button>
    </form>
@endsection
