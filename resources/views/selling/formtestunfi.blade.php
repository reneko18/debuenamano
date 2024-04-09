@extends('includes.baseform')
@section('title')
  Formulario de publicacion de producto - De Buena Mano
@endsection
@section('content')
    <section id="app" class="p-pages pb-5">
        <selling-form-product-two 
          :user-id="'{{ auth()->user()->id }}'" 
          :product-id="'{{ $product->id ?? '' }}'" 
          :main-step="{{ json_encode($mainStepArray ?? []) }}"
          :active-title-pro="'{{ $product->active_title ?? '' }}'"
          :received-constant-pro="'{{ $product->received_constant ?? '' }}'"
          :current-step-pro="'{{ $product->current_step ?? '' }}'"
          :product-slug="'{{ $product->slug ?? '' }}'"
        />
    </section>
@endsection
