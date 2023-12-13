@extends('includes.baseform')
@section('title')
Checkout - De Buena Mano
@endsection

@push('post-seo')   
    <meta name="description" content="Checkout de marketplace De Buena Mano">    
@endpush

@section('content')
  <section class="container-fluid py-5">
    <div class="container mx-auto">
      <h1>Checkout De Buena Mano</h1>
      <form  action="{{ route('create.webpay')}}" method="POST">
          @csrf
          <label for="buy_order" class="form-label mb-5">
              Orden de compra: 123456
          </label>
          <input type="hidden" id="buy_order" name="buy_order" value="123456"/>
  
          <label for="session_id" class="form-label mb-5">
              Id de sesión: session123456
          </label>
          <input id="session_id" type="hidden" name="session_id" value="session123456" />
  
          <label for="amount" class="form-label mb-5">
              Monto: {{ $product->price }}
          </label>
          <input id="amount" type="hidden" name="amount" value="{{ $product->price }}"/>  
  
          <label for="return_url" class="form-label mb-5">
              URL de retorno: {{ url('/') }}/checkout/returnUrl
          </label>
          <input id="return_url" type="hidden" name="return_url" value="{{ url('/') }}/checkout/returnUrl"/>
  
          <button type="submit" class="btn boton-principal">Finalizar compra</button>
      </form>
    </div>

  </section>
@endsection

