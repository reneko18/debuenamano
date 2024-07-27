@extends('includes.baseform')
@section('title')
  Blog - De Buena Mano
@endsection
@push('post-seo')
    <meta name="description" content="">    
@endpush

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
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
        </nav>
        </div>
    </section>
    <section>
        <div id="app">
            <posts-loop></posts-loop>
        </div>
    </section>
@endsection