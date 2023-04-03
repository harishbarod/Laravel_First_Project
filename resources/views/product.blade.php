<!DOCTYPE html>
<html>
  <head>
    <title>Buy Product</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <div class="product">
        <img
          src="https://cdn.pixabay.com/photo/2017/07/02/19/24/dumbbells-2465478_960_720.jpg"
          alt="The Shoes" width="300px"
        />
        <div class="description">
          <h3>Sports Shoes</h3>
          <h5>$30.00</h5>
        </div>
      </div>
      <form action="/" method="POST">
        @csrf
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
    </section>
  </body>
</html>