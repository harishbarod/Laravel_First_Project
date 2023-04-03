
@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Product List </h2>
            </div>
            <a class="btn btn-danger" class="float-right" style="float: right !important" href="{{ route('Trash') }}"> Trash  </a>
            <div class="pull-right mb-4">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Add Book </a>
              
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
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                 
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-edit"></i></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Trash</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection