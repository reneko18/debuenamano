@extends('includes.baseform')
@section('title')
  Categorias Blog - De Buena Mano
@endsection
@push('post-seo')
    <meta name="description" content="">    
@endpush

@section('content')
    <section class="container-fluid first-sec-blog">
        <div class="container mx-auto d-flex align-items-center">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <h1>Categorias</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>        
    </section>
    <section class="container-fluid breadcrumb-sec">
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
        </nav>
        </div>
    </section>
    <section class="container">
        <div class="row" id="postcategories-archive">
            @foreach($categories as $category)
                <div class="card" style="width: 18rem;">
                    {{-- <img src="" class="card-img-top" alt="imagen autor"> --}}
                    <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection