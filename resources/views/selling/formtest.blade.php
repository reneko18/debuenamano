@extends('includes.baseform')
@section('title')
  Formulario de publicacion de producto - De Buena Mano
@endsection
@section('content')
    <section id="app" class="p-pages pb-5">
        <selling-form-product-two :user-id="'{{ auth()->user()->id }}'" :user-bank="'{{ $user->bankDetail }}'" />
    </section>
@endsection
