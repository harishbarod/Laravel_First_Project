@extends('layouts.app')
@section('content')
<style>
        * {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #484c4b;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

.column1{
  display: flex;
  justify-content: center;
  
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>

<h2 class="text-center mt-5 mb-4">Purchase Chat Subscription Now</h2>
    <div class="center" style="display: flex; justify-content:center;">
     @foreach ($plans['subscription_plans'] as $plan)
     <form action="{{url('stripe_chat')}}" method="post">
        <input type="hidden" name="total" value="{{ $plan->price }}">
        @csrf
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="plan_type" value="{{ $plan->plan_type }}">
        <input type="hidden" name="chat" value="chat">
        <input type="hidden" name="price_id" value="{{ $plan->price_id }}">
        <input type="hidden" name="total" id="total" value="{{ $plan->price  }}">
        <input type="hidden" name="subscription" id="subscription" value="subscription">


     <div class="columns" style="width:30vw;">
        <ul class="price">
          <li class="header" style="background-color:#484c4b">Chat Plan</li>
          <li class="grey">${{ $plan->price  }}/ {{ $plan->plan_type }}</li>
          {{-- <li>Unlimited Messages</li> --}}
            

       

          <li class="grey"><button  class="button">Purchase Now</button ></li>
        </ul>
      </div>
    </form>
     @endforeach
    </div>
           
</div>





<h3 class="text-center mt-5 mb-4">Purchase  Plan for first month</h3>
<div class="center" style="display: flex; justify-content:center;">
  @foreach ($plans['one_time_plans'] as $plan)
  <form action="{{url('processpaypal_chat')}}" method="post">
     <input type="hidden" name="total" value="{{ $plan->price }}">
     @csrf
     <input type="hidden" name="type" value="1">
    

  <div class="columns" >
     <ul class="price"  style="width:50vw;">
       <li class="header" style="background-color:#484c4b">Chat Plan</li>
       <li class="grey">${{ $plan->price  }}/ {{ $plan->duration }}</li>
       {{-- <li>Unlimited Messages</li> --}}
         
       <li class="grey"><button  class="button">Purchase Now</button ></li>
     </ul>
   </div>
 </form>
  @endforeach
 </div>
        
</div>
@endsection