
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

        

    @if(!empty($subscriptions))
    <table class="table table-bsubscriptioned mt-5" >
        <tr>
            <th>No</th>       
            <th>Price</th>
            <th>Purchase Date</th>
            <th>Expiry Date</th>
            <th>Payment Method</th>
            <th>Actions</th>
            <th>invoice
        </tr>
        
     <?php   $i =0 ;  ?>
       @foreach ($subscriptions as $subscription)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $subscription['price'] }}</td>
            <td>{{substr($subscription['created_at'],0,10)  }}</td>
            <td>@if($subscription['expire_date']){{ $subscription['expire_date'] }} @endif
                @if(empty($subscription['expire_date'])) till subscription end @endif
            
            </td>
            <td>@if($subscription['payment_method']==1) PayPal @endif
                @if($subscription['payment_method']==2) Stripe @endif         
            </td> 

            <td>
                @if(!empty($subscription['subscription_id'] ))
                
                <form 
                @if($subscription['subscription_status']=='unsubscribe')
                action="{{ route('unsubscribed_subscription') }}"@endif
                @if($subscription['subscription_status']=='re-activate')
                action="{{ route('reactivate_subscription') }}"@endif
                
                
                method="POST">
                    @csrf
                    <input type="hidden" name="subscription_id" value="{{$subscription['subscription_id'] }}">
                <button class="btn  
                @if($subscription['subscription_status']=='unsubscribe')
                btn-danger @endif 
                @if($subscription['subscription_status']=='re-activate')
                btn-success @endif "
                 type="submit"> {{ $subscription['subscription_status'] }}</button>
            
            </form>
            @endif

            </td>
            <td> <a class="btn" href="{{ asset('storage/pdf/chat/'.$subscription['pdf_invoice']) }}"><i style="font-size:24px;"  class="fa-sharp fa-solid fa-download"></i></a></td>
    
        </tr>
        @endforeach
    </table>
        @endif

   

    @if(empty($subscriptions))
       <h2 class="text-center mt-5">No Chat subscription has been activated yet</h2>    
      @endif

      
@endsection