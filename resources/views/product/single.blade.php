@extends('includes.baseform')
@section('title')
  Plantilla producto simple - De Buena Mano
@endsection
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('img/test-img-single.png') }}" alt="test-img-single">
            </div>
            <div class="col-md-6">
                <div class="encabezado-producto bg-blanco-verdoso">
                    <span class="sku"><b>SKU</b> DEPOR-XYZ-BLN-41</span>
                    <h1>Cuna Simmons Kids</h1>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid mr-10" src="{{ asset('img/test-user-sp.png') }}" alt="test-user">
                        <span><b>Publicado por Pilar</b> - hace dos semanas</span>
                    </div>
                    <p class="descripcion">
                        Como nueva, perfecto estado. Para niños de hasta 5 años. Doy colchón que le compré aparte y que encaja perfectamente con la cuna. Es muy cómoda y sencilla. Mi bebé la uso por 7 meses.
                    </p>
                </div>

                <div class="row d-flex align-items-center mb-60">
                    <div class="col-4">
                        <span class="precio">$85.000</span>
                    </div>
                    <div class="col-8 d-flex justify-content-end">
                        <button class="btn boton-principal">añadir a tu carro</button>
                        <button class="btn boton-favoritos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <path d="M15.6215 1.57252C13.7867 0.0089339 11.058 0.290179 9.37385 2.02787L8.71426 2.70755L8.05468 2.02787C6.3739 0.290179 3.64181 0.0089339 1.80702 1.57252C-0.295619 3.36713 -0.406108 6.58806 1.47555 8.53333L7.95423 15.2229C8.37275 15.6549 9.05243 15.6549 9.47094 15.2229L15.9496 8.53333C17.8346 6.58806 17.7241 3.36713 15.6215 1.57252Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="detalle-producto mb-60">
                    <div class="row mb-30">
                        <div class="col d-flex flex-column">
                            <h3>Marca</h3>
                            <span>Simmons</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <h3>Tiempo de uso</h3>
                            <span>2 meses</span>
                        </div>
                        <div class="col d-flex flex-column">
                            <h3>Estado</h3>
                            <span>Como nuevo</span>
                        </div>
                    </div>
                    
                    <h3>Dimensiones y peso</h3>
                   
                    <div class="row mb-30">
                        <div class="d-flex">
                            <div class="col">
                                <span><b>largo:</b></span>
                                <span>139,5 cm</span>
                            </div>
                            <div class="col">
                                <span><b>ancho:</b></span>
                                <span>79,5 cm</span>
                            </div>
                            <div class="col">
                                <span><b>altura:</b></span>
                                <span>116,5 cm</span>
                            </div>
                            <div class="col">
                                <span><b>peso:</b></span>
                                <span>40 kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-30">
                        <h2>Observación</h2>
                        <p>En la parte trasera del respaldo se ven unas marcas producto del roce con la pared.</p>
                    </div>
                    <div>
                        <h2>Recomendación</h2>
                        <p>Puede sonar obvio, pero de todas formas sugiero limpiar la madera con un paño seco para quitar el polvo y luego usar lustramuebles. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="container">
        <h2>Artículos Sugeridos</h2>
    </section>
    <section class="container">
        <h2>Artículos Complementarios</h2>
    </section>
@endsection