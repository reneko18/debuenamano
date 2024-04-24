@extends('includes.baseform')
@section('content')

<div class="bg-gris pt-seccion-inicial pb-60">
    <div class="container px-5">
        <div class="row">
            <div class="d-lg-flex align-items-center">
                <div class="col-lg-4 col-sm-12 ">
                    <h1>Tu comunidad de reutilización y crianza</h1>
                    <p class="mb-40">Hemos creado una plataforma digital nacional donde podrás comprar y vender productos nuevos y de segunda mano con poco uso en muy buenas condiciones para bebés, niñas y niños de hasta 5 años.</p>
                </div>
                        
                <div class="col-lg-7 col-sm-12 ms-auto text-right">
                    <img class="img-fluid" src="img/madre_e_hijos.jpg" alt="dbm">
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pt-130">
    <div class="container-fluid px-5">
        <div class="card mb-5">
            <div class="row gx-0 d-flex">
                <div class="col-lg-5">
                    <div class="card-body bg-negro-verdoso d-flex align-items-center justify-content-center h-100 flex-column">
                        <p class="card-text px-sm-5 py-sm-5">“Nuestra inspiración surge de la constante búsqueda de una solución para dar un nuevo propósito a los artículos apenas utilizados que adquirimos para nuestros hijos e hijas”</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <img src="img/inspiracion.png" alt="..." class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-130">
    <div class="container px-5">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-lg-4">
                <img class="img-fluid text-center mb-5" src="img/ana-y-carlos.svg" alt="Ana y Carlos, creadores de De Buena Mano">
            </div>  
            <div class="col-lg-7 col-md-offset-1">
                <h2 class="pb-3">Detrás de DBM nos encontramos Ana y Carlos, dos amigos que desde nuestros roles de madre y tío respectivamente nos embarcamos en esta aventura motivados por nuestra pasión por la crianza responsable y la sostenibilidad.</h2>
                <p>Comprendemos lo importante que es para las familias reducir los gastos asociados a la crianza. Sabemos que los artículos destinados a los más pequeños suelen ser costosos debido a la prioridad que damos a la calidad. Sin embargo, a veces estos productos se utilizan durante un tiempo limitado y, en muchas ocasiones, se mantienen en excelentes condiciones para su reutilización.</p>

                <p>Nuestra visión es simple pero poderosa: ayudar a construir un futuro más sostenible y responsable para las generaciones venideras.</p>

                <p>Desde esa convicción y porque creemos firmemente que la crianza es una experiencia colectiva le hemos dado vida a debuenamano.cl, un espacio comunitario digital entre madres, padres y cuidadores donde pueden compartir sus historias, consejos y productos que ya no utilizan.</p> 

                <p>¡Bienvenidas y bienvenidos sean a De Buena Mano, nos emociona tenerte aquí y de ser parte de tu viaje en la crianza.</p>
            </div>           
        </div>
    </div>
</section>

<section class="bg-gris mt-130 ptb-130">
    <div class="container px-5">
        <div class="row d-flex align-items-stretch">
            <div class="col-lg-2 bg-verde mb-5">
                <h2 class="px-sm-5 py-sm-5">Nuestro propósito</h2>
            </div>
            <div class="col-lg-10">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-4 text-lg-center">
                        <img class="mb-2" src="icons/reutilizacion.svg" alt="">
                        <h3>Promover la </br> Reutilización</h3>
                    </div>
                    <div class="col-lg-8">
                        <p>En una época en la que la sostenibilidad es esencial, nuestra plataforma es tu aliada para reutilizar productos de calidad. ¿Por qué comprar algo nuevo cuando puedes darle una segunda vida a artículos en excelente estado? <b>La reutilización inteligente</b> no solo ahorra dinero, sino que también <b>reduce el impacto ambiental al disminuir la necesidad de fabricar nuevos productos.</b></p>
                    </div>
                </div>
                <div class="row d-flex align-items-center pt-5">
                    <div class="col-lg-4 text-lg-center">
                        <img class="mb-2" src="icons/crianza.svg" alt="">
                        <h3>Crianza </br> Consciente</h3>
                    </div>
                    <div class="col-lg-8">
                        <p>En el viaje de la crianza, sabemos que cada peso y cada decisión cuentan. Queremos facilitar esa elección al ofrecer una solución que te permite acceder a productos de alta calidad a precios convenientes. Al comprar en nuestra plataforma, puedes confiar en que estás haciendo una elección consciente para tu familia y el planeta. Cada artículo cuenta una historia y tiene un propósito.</p>
                    </div>             
                </div>
            </div>        
        </div>
    </div>
</section>

<div class="container mt-130">
    <div class="row">
        <h2 class="mb-60">Características De Buena Mano</h2>
        <!-- <slider-home/> -->
    </div>
</div>


@endsection