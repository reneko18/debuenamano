@extends('includes.baseform')
@section('title')
{{ $product->meta_title }} - De Buena Mano
@endsection

@section('content')
    <section class="container p-pages pb-5">
        <div class="row">
            <div class="col-lg-6">
				@if(($product->galleries->get(0)) == null)
					<img class="first-img-proj img-fluid" src="{{ asset('img/image-dummy-products.png') }}" alt="">  
				@else
					<img class="first-img-proj img-fluid" src="{{ asset($product->galleries->get(0)->url)}}" alt=""> 
				@endif                 
            </div>
            <div class="col-lg-6">
                <div class="encabezado-producto bg-blanco-verdoso mb-5">
                    <span class="sku"><b>SKU</b> {{ $product->sku }}</span>
                    <h1>{{$product->name}}</h1>
                    <div class="d-flex align-items-center mb-4 vendedor">
                        <img class="img-fluid mr-10" src="{{ asset('img/test-user-sp.png') }}" alt="test-user">
                        <span><b>Publicado por {{ $product->user->name }} {{ $product->user->lastname }}</b> - hace dos semanas</span>
                    </div>
                    <div class="descripcion">					
					    <p> {{ $product->description }} </p>
                    </div>
                </div>

                <div class="valores-producto d-md-flex d-sm-inline-flex align-items-md-center mb-5 flex-md-row flex-sm-column">
                    <div class="mr-3 pb-3">
                        <span class="precio">$ {{ number_format($product->price,0,',', '.') }}</span>
                    </div>
                    <div class="mr-3 pb-3">
                        <span class="porcentaje">-29,7%</span>
                    </div>
                    <div class="d-flex precio-referencia flex-column pb-3">
                        <b>$120.000</b>
                        <span>Precio referencial del producto nuevo</span>
                    </div>
                </div>

                <div class="valores-producto d-flex align-items-center mb-5">
                    <form method="POST" action="{{ route('cart.add', ['product' => $product->slug]) }}">
                        @csrf
                        <button type="submit" class="btn boton-principal">añadir al carro</button>
                    </form>
                        
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif                     
                    <button class="btn boton-favoritos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                            <path d="M15.6215 1.57252C13.7867 0.0089339 11.058 0.290179 9.37385 2.02787L8.71426 2.70755L8.05468 2.02787C6.3739 0.290179 3.64181 0.0089339 1.80702 1.57252C-0.295619 3.36713 -0.406108 6.58806 1.47555 8.53333L7.95423 15.2229C8.37275 15.6549 9.05243 15.6549 9.47094 15.2229L15.9496 8.53333C17.8346 6.58806 17.7241 3.36713 15.6215 1.57252Z"/>
                        </svg>
                    </button>
                </div>
           

                <div class="mb-60">
                    <div class="tabs-product">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">CARACTERISTICAS</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DETALLES</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Categoría</span>
                                            <span class="txt-in-tab">{{ $product->category->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Marca</span>
                                            <span class="txt-in-tab">{{ $product->brand}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Modelo</span>
                                            <span class="txt-in-tab">7888-207</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Género</span>
                                            <span class="txt-in-tab">Unisex</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Edad</span>
                                            <span class="txt-in-tab">Recién nacido a 2 años</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Tiempo de uso</span>
                                            <span class="txt-in-tab">{{ $product->used_time}} {{ $product->used_time_unit}}</span>                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="pb-3">
                                            <span class="title-in-tab">Estado</span>
                                            <span class="txt-in-tab">{{ $product->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col">
                                    <span class="title-in-tab pb-3">Dimensiones y peso</span>
                                    <div class="d-md-flex justify-content-md-between">
                                        <div class="pb-3">
                                            <span class="txt-in-tab"><b>largo:</b> {{$product->deliveryInformation->length}} cm</span>
                                        </div>
                                        <div class="pb-3">
                                            <span class="txt-in-tab"><b>ancho:</b> {{$product->deliveryInformation->width}} cm</span>
                                        </div>
                                        <div class="pb-3">
                                            <span class="txt-in-tab"><b>altura:</b> {{$product->deliveryInformation->height}} cm</span>
                                        </div>
                                        <div class="pb-3">
                                            <span class="txt-in-tab"><b>peso:</b> {{$product->deliveryInformation->weight}} kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pb-3">
                                    <span class="title-in-tab">Observación</span>
                                    <p class="txt-in-tab">{{$product->remark}}</p>
                                </div>
                                <div class="col pb-3">
                                    <span class="title-in-tab">Recomendación</span>
                                    <p class="txt-in-tab">{{$product->advice}}</p>
                                </div>
                            </div>
                        </div> <!-- tab-content -->                        
                    </div> <!-- tabs-product -->
                </div> <!-- mb-60 -->
            </div> <!-- col-lg-6 -->
        </div> <!-- row -->
    </section>
    <section class="container">
        <h2>Artículos Sugeridos</h2>		
    </section>
@endsection
