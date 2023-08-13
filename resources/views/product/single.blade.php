@extends('includes.baseform')
@section('title')
  Plantilla producto simple - De Buena Mano
@endsection
@section('content')
    <section class="container">
        <div class="row">
            <div class="col">
                <img class="img-fluid" src="{{ asset('img/test-img-single.png') }}" alt="test-img-single">
            </div>
            <div class="col">
                <span>SKU DEPOR-XYZ-BLN-41</span>
                <h1>Cuna Simmons Kids</h1>
                <div class="d-flex">
                    <img class="img-fluid" src="{{ asset('img/test-user-sp.png') }}" alt="test-user">
                    <span>Publicado por Pilar - hace dos semanas</span>
                </div>
                <p>
                    Como nueva, perfecto estado. Para niños de hasta 5 años. Doy colchón que le compré aparte y que encaja perfectamente con la cuna. Es muy cómoda y sencilla. Mi bebé la uso por 7 meses.
                </p>
                <div class="row">
                    <div class="col d-flex flex-column">
                        <span>Marca</span>
                        <span>Simmons</span>
                    </div>
                    <div class="col d-flex flex-column">
                        <span>Tiempo de uso</span>
                        <span>2 meses</span>
                    </div>
                    <div class="col d-flex flex-column">
                        <span>Estado</span>
                        <span>Como nuevo</span>
                    </div>
                </div>
                <div class="row">
                    <span>Dimensiones y peso</span>
                    <div class="col">
                        <span>largo:</span>
                        <span>139,5 cm</span>
                    </div>
                    <div class="col">
                        <span>ancho:</span>
                        <span>79,5 cm</span>
                    </div>
                    <div class="col">
                        <span>altura:</span>
                        <span>116,5 cm</span>
                    </div>
                    <div class="col">
                        <span>peso:</span>
                        <span>40 kg</span>
                    </div>
                </div>
                <div>
                    <h2>Observación</h2>
                    <p>En la parte trasera del respaldo se ven unas marcas producto del roce con la pared.</p>
                </div>
                <div>
                    <h2>Recomendación</h2>
                    <p>Puede sonar obvio, pero de todas formas sugiero limpiar la madera con un paño seco para quitar el polvo y luego usar lustramuebles. </p>
                </div>
                <div class="row">
                    <div class="col-5">
                        <span>$85.000</span>
                    </div>
                    <div class="col-5">
                        <button class="btn btn-primary">añadido a tu carro</button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary">
                            <svg version="1.1" id="heart-wish" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 18 16" xml:space="preserve">
                            <style type="text/css">
                                #heart-wish{width: 100%;max-width: 17px;}
                                #heart-wish .st0{fill:#C0C6B9;}
                            </style>
                            <path class="st0" d="M15.6,1.6C13.8,0,11.1,0.3,9.4,2L8.7,2.7L8.1,2C6.4,0.3,3.6,0,1.8,1.6c-2.1,1.8-2.2,5-0.3,7L8,15.2
                                c0.4,0.4,1.1,0.4,1.5,0l6.5-6.7C17.8,6.6,17.7,3.4,15.6,1.6z"/>
                            </svg>
                        </button>
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