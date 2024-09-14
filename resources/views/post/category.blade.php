@extends('includes.baseform')
@section('title')
{{ $postCategory->name }} - De Buena Mano
@endsection

@section('content')
    <section class="container-fluid first-sec-blog">
        <div class="container mx-auto d-flex align-items-center">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <h1>Exploremos juntos el maravilloso viaje de la crianza</h1>
                    <p>Tómate tu tiempo, relájate y sumérgete en nuestro mundo de historias, consejos prácticos, ideas inspiradoras y perspectivas honestas sobre la crianza.</p>
                </div>
            </div>
        </div>        
    </section>
    <section class="container-fluid breadcrumb-sec">
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('post.blog') }}">Blog</a></li>
                <li class="breadcrumb-item active">{{ $postCategory->name }}</li>
            </ol>
        </nav>
        </div>
    </section>
    <section>
        <div id="app">
            <categories-loop :post-category-slug="'{{ $postCategorySlug }}'" />
        </div>
    </section>
@endsection