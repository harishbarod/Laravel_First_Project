@extends('layouts.app')
@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
 
   
    <div class="row ">
    @foreach ($products as $product)
        <div class="col-md-4" :1remstyle="margin;">
        <div class="card" style="width: 18rem;">
            <img style="display: flex; justify-content:center ;align-item:center; height:130px ;" class="card-img-top center" src="{{ $product->image ?asset('images/books/'.$product->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">
            <div class="card-body">
              <h5 class="card-text">  <b> {{ $product->name }}</b>
                
                <h3  style="color: red"> ${{ $product->price }}  
                    <form action="{{route('add_to_cart') }}" method="post" >
                        @csrf
                     <input type="hidden" name="product_id" value="{{ $product->id }}">
                     <button class="btn btn-primary" type="submit">Add to Cart</button>
                    </form>
                    </h3>  
            </h5>
            </div>
        </div>
          </div>

    @endforeach
</div>
@endsection 