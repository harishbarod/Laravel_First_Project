
{{-- @extends('products.layout') --}}


@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-left">
                <a style="float: right" href="{{ route('products.index') }}" class="mt-4 mb-5 btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                <h2 class="text-center">Trashed Product List </h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td> <div> 
                <img style="width: 50px; height:50px" src="{{ $product->image ?asset('images/books/'.$product->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">
               </div>
            </td>
            <td>
                <form action="{{ route('permanent_delete') }}" method="POST">
                     <input type="hidden" name="id" value="{{ $product->id }}">
                    <a class="btn btn-primary" href="{{ route('restore',$product->id) }}"><i class="fa fa-undo" aria-hidden="true"></i></a>
                    @csrf                  
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection