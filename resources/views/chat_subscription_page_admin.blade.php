
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">



    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Chat Paid Service Users </h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <form class="d-flex mt-2" action="{{ url('chat_subscription') }}" method="GET">
        <input class="form-control me-2" style="width: 20vw" type="search" name="search" value="{{ old('search') }}"  placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>


    @if(!empty($subscriptions))
    <table class="table table-bsubscriptioned mt-5">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Price</th>
            <th>Purchase Date</th>  
            <th>Expiry Date</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Invoice</th>
        </tr>
        
     <?php   $i =0;
     ?>
    
       @foreach ($subscriptions as $subscription)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $subscription['name'] }}</td>
            <td>{{ $subscription['price'] }}</td>
            <td>{{substr($subscription['created_at'],0,10)  }}</td> 
            <td>{{ $subscription['expire_date'] }}</td>
            <td>@if($subscription['payment_method']==1) PayPal @endif
                @if($subscription['payment_method']==2) Stripe @endif         
            </td> 
            <td>{{ $subscription['payment_status']==1 ?'Done':'Pending' }}</td>
            <td> <a class="btn" href="{{ asset('storage/pdf/chat/'.$subscription['pdf_invoice']) }}"><i style="font-size:24px;"  class="fa-sharp fa-solid fa-download"></i></a></td>
                
        </tr>
        @endforeach
    </table>
        @endif

   

    @if(empty($subscriptions))
       <h2 class="text-center mt-5">No Chat subscription has been activated yet</h2>    
      @endif

      
@endsection