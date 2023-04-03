@extends('layouts.app')

@section('content')

<h2 class="text-center mt-5" style="margin-bottom:rem !important;">Welcome  to Knowledge Test Site</h2>
{{-- <a href="{{ url('question-page') }}" class="btn btn-primary mt-4 mb-3">Take Test</a> --}}

   {{-- <h2 class="text-center mb-4">Buy Now to Get 30% OFF  </h2> --}}
 
   @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="row ">
    @foreach ($products as $product)
 
        <div class="col-md-4" >
        <div class="card" style="width: 18rem;">
            <img style="display: flex; justify-content:center ;align-item:center; height:130px ;" class="card-img-top center" src="{{ $product->image ?asset('images/books/'.$product->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">
            <div class="card-body">
              <h5 class="card-text">  <b> {{ $product->name }}</b>
                <h3  style="color: red"> ${{ $product->price }}  

                    @if(Auth::check())
                    <form action="{{route('add_to_cart') }}" method="post" >
                        @csrf
                     <input type="hidden" name="product_id" value="{{ $product->id }}">
                     <button class="btn btn-primary" type="submit">Add to Cart</button>
                    </form>
                    @endif

                    @if(empty(Auth::check()))
                      <br>
                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">Add to Cart</button>
                   
                    @endif
                    </h3>   
                    
            </h5>
            </div>
        </div>
          </div>
          

    @endforeach
    <a href="{{ route('see-all-products') }}" class="text-center mb-4"><h4>See all products</h4> </a>
</div>

<!-- Modal for adding image -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Please login to add item to cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
      </div>
    </div>
  </div>
@endsection 