@extends('includes.baseform')
@section('title')
Tienda - De Buena Mano
@endsection
@section('content')
<section class="container-fluid">
    <div class="container my-5 py-5">
        <div class="row">
            @foreach ($products as $p)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <p class="card-text">{{ $p->description }}</p>
                            <a href="#" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endsection