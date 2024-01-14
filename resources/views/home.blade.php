@extends('includes.baseform')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">{{ __('Panel de administración') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas logeado!') }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <a href="/new-formulario-venta" class="btn btn-lg btn-primary">Agregar un producto</a>
        </div>
    </div>
</div>
@endsection


