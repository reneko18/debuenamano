@extends('includes.baseform')
@section('title')
  Carrito - De Buena Mano
@endsection

@section('content')
    @if ($cartItems)
        <section class="container-fluid p-pages pb-100">
            <div class="container mb-5">
                <h1>Proceso de compra</h1>          
            </div>
            <div id="app">
                <new-cart :cart-items="{{ json_encode($cartItems) }}" :total-price="'{{ $totalPrice }}'"/>    
            </div>   
            <form id="paymentForm" action="{{ route('create.webpay') }}" method="post">
                @csrf
                <input type="hidden" name="buy_order" value="18">
                <input type="hidden" name="session_id" value="{{ Session::getId() }}">
                <input id="totalAmount" type="hidden" name="amount" value="{{ $total }}">
                <input type="hidden" name="return_url" value="{{ url('/') }}/order-end">
            </form>     
        </section>       
    @else
        <section class="container-fluid p-pages pb-100">
            <div class="container mb-5 py-5 text-center">
                <img class="mb-5" src="{{asset('/img/carrito-vacio.svg')}}" alt="icono carro de compra vacío">
                <h3 class="mb-5">No hay productos en tu carro</h3>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn boton-principal">Ir a la tienda</a>
                </div>                
            </div>
        </section>   
    @endif

@endsection

@push('ajax-cart')
<script>
    // Function to update the value of the hidden input field
    const updateTotalAmount = (newValue) => {
        document.getElementById('totalAmount').value = newValue;
    };

    // Listen for AJAX response and update the total amount
    window.addEventListener('ajaxUpdateTotal', (event) => {
        const newValue = event.detail.total;
        updateTotalAmount(newValue);
    });
</script>
@endpush