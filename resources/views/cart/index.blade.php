@extends('includes.baseform')
@section('title')
Carrito - De Buena Mano
@endsection

@push('lezada-css')
	<!-- FontAwesome CSS -->
	<link href="{{ url('lezada/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- Ionicons CSS -->
	<link href="{{ url('lezada/css/ionicons.min.css')}}" rel="stylesheet">

	<!-- Themify CSS -->
	<link href="{{ url('lezada/css/themify-icons.css')}}" rel="stylesheet">

	<!-- Plugins CSS -->
	<link href="{{ url('lezada/css/plugins.css')}}" rel="stylesheet">

	<!-- Helper CSS -->
	<link href="{{ url('lezada/css/helper.css')}}" rel="stylesheet">

	<!-- Main CSS -->
	<link href="{{ url('lezada/css/main.css')}}" rel="stylesheet">

	<!-- Modernizer JS -->
	<script src="{{ url('lezada/js/vendor/modernizr-2.8.3.min.js')}}"></script>
@endpush

@section('content')
<div id="app">
    <cart-page/>
</div>
<div class="shopping-cart-area mb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <!--=======  cart table  =======-->

                <div class="cart-table-container">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th class="product-name" colspan="2">Producto</th>
                                <th class="product-price">Precio</th>                                
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="shop-product-basic.html">
                                        <img src="assets/images/products/bag-1-1-600x800.jpg" class="img-fluid" alt="">
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="shop-product-basic.html">Black Fabric Watch</a>
                                    <span class="product-variation">Color: Black</span>
                                </td>

                                <td class="product-price"><span class="price">$100.00</span></td>


                                <td class="total-price"><span class="price">$100.00</span></td>

                                <td class="product-remove">
                                    <a href="#">
                                        <i class="ion-android-close"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!--=======  End of cart table  =======-->
            </div>
            <div class="col-lg-12 mb-80">
                <!--=======  coupon area  =======-->

                <div class="cart-coupon-area pb-30">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-md-30 mb-sm-30">

                        </div>

                        <div class="col-lg-6 text-start text-lg-end">
                            <!--=======  update cart button  =======-->

                            <button class="lezada-button lezada-button--medium">update cart</button>

                            <!--=======  End of update cart button  =======-->
                        </div>
                    </div>
                </div>

                <!--=======  End of coupon area  =======-->
            </div>

            <div class="col-xl-4 offset-xl-8 col-lg-5 offset-lg-7">
                <div class="cart-calculation-area">
                    <h2 class="mb-40">Cart totals</h2>

                    <table class="cart-calculation-table mb-30">
                        <tr>
                            <th>SUBTOTAL</th>
                            <td class="subtotal">$100.00</td>
                        </tr>
                        <tr>
                            <th>TOTAL</th>
                            <td class="total">$100.00</td>
                        </tr>
                    </table>

                    <div class="cart-calculation-button text-center">
                        <button class="lezada-button lezada-button--medium">proceed to checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection