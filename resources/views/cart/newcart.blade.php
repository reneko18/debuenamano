@extends('includes.baseform')
@section('title')
  Carrito - De Buena Mano
@endsection

@section('content')
    <section class="container-fluid p-pages">
        <div class="container mb-5">
            <h1>Proceso de compra</h1>
            {{ $totalPrice }}
        </div>
        <div id="app">
            <new-cart :cart-items="{{ json_encode($cartItems) }}" :total-price="'{{ $totalPrice }}'"/>
        </div>        
    </section>
@endsection