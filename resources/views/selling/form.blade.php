@extends('includes.baseform')
@section('title')
  Formulario de publicacion de producto - De Buena Mano
@endsection
@section('content')
    <section id="app" class="p-pages pb-5">
        <new-selling-form-product :user-id="'{{ auth()->user()->id }}'" />
    </section>
@endsection
