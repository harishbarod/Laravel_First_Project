
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">    

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Orders </h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <form class="d-flex mt-2" action="{{ url('order_history') }}" method="GET">
        <input class="form-control me-2" style="width: 20vw" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    @if(!empty($orders[0]->name))
    <table  class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Username</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Image</th>
            <th> Invoice </th>
        </tr>
        
     <?php   $i =1 ; 
     if(isset($_GET['page'])){
        
        $page_no= $_GET['page'];
      }
      else{
       $page_no=1;
      }
    //  echo '<pre>';
    //   print_r($orders);die;
    //   ?>
          
       @foreach ($orders as $order)
        <tr>
            <td>{{  5*$page_no-5 + $i++ }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->username }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->ordered_quantities }}</td> 
            <td>{{substr($order->order_date,0,10 )  }}</td> 
            <td>@if($order->payment_method==1) PayPal @endif
                @if($order->payment_method==2) Stripe @endif         
            </td> 
            <td>{{ $order->payment==1 ?'Done':'Pending' }}</td> 
            <td> <div> 
                <img style="width: 50px; height:50px" src="{{ $order['image'] ?asset('images/books/'.$order['image']) : asset('images/question/1660900136.jpg') }}" alt="" class="img-fluid">
               </div>
            </td>
            <td> <a class="text-dark btn" href="{{ asset('storage/pdf/cart/'.$order->pdf) }}"><i style="font-size:24px;"  class="fa-sharp fa-solid fa-download"></i></a></td>
           
        </tr>      
        @endforeach
    </table>

    {!! $orders->links() !!}
    
        @endif

    @if(empty($orders[0]->name))
       <h2 class="text-center mt-5">No Orders has been placed yet</h2>
      
      @endif


      
@endsection