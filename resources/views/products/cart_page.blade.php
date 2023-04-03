@extends('layouts.app')
@section('content')
<script src="{{ asset('js/cart.js') }}" defer></script>
<style>
        @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
</style>
{{-- background-color: #d2c9ff; --}}
<section class="h-100 h-custom" style=" height:50vh">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                     <h6 class="mb-0 text-muted"><?php echo sizeof($products);?> items</h6> 
                    </div>
                    <hr class="my-4 ajax_cart_data">
                     <?php  $total=0; ?>
                    @foreach ($products as $product)
                    <div class="row mb-4 d-flex justify-content-between align-items-center product_main" id ={{ $product['product_id'] }}>
                      <div class="col-md-3 col-lg-2 col-xl-2">
                        <img
                        src="{{ $product['image'] ?asset('images/books/'.$product['image']) : asset('images/question/'.$img) }}"                          class="img-fluid rounded-3" alt="Cotton T-shirt">
                      </div>

                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-black mb-0">{{ $product['name'] }}</h6>
                      </div>
                      

                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex ">

                        <button class="btn btn-link px-2 price_down"
                          onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          
                        </button>
  
                        <input id="form1" min="1" name="quantity" value="{{$product['cart_quantity']}}" product_id= "{{ $product['product_id'] }}" type="number"
                          class="quantity_change form-control form-control-sm" />
  
                        <button class="btn btn-link px-2 price_up"
                          onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        
                        </button>

                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">           
                        <h6 class="mb-0 product_price"> ${{ $product['price'] }}</h6>
                      </div>

                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class="text-muted"></a>
                        <button class="delete_btn btn " style="color:#c71111;" id="button_id" class="text-muted" value="{{ $product['product_id']}} "><i class="fas fa-times"></i></button>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                       
                      </div>

                    </div>
                        <hr id="hr{{ $product['product_id'] }}" class="my-4">
                          
                        <?php  $total += $product['price'] * $product['cart_quantity'] ?>
                        
                  @endforeach
              
                    @if($total==0)
                      
                    <h3>Please add item to Cart</h3>
                    @endif

                    @if($total!=0)
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5>$ {{ $total }}</h5>
                    </div>
                     <form action="{{url('payment_option')}}" method="post">
                      @csrf       
                      <input type="hidden" name="total" value="{{ $total }}">   
                                   
                     <button type="submit" class="btn btn-dark btn-block btn-lg"
                      data-mdb-ripple-color="dark">Place Order</button>
                     </form>
                   
                     @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection