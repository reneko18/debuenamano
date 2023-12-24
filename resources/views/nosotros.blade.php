@extends('includes.baseform')
@section('content')

<div class="bg-gris ptb-60">
    <div class="d-flex align-items-center">
        <div class="col-md-3 offset-md-2">
            <h1>Tu comunidad de reutilización y crianza</h1>
            <p class="mb-40">Hemos creado una plataforma digital nacional donde podrás comprar y vender productos nuevos y de segunda mano con poco uso en muy buenas condiciones para bebés, niñas y niños de hasta 5 años.</p>
        </div>
                
        <div class="col-md-6 ms-auto text-right">
            <img class="img-fluid" src="img/madre_e_hijos.jpg" alt="dbm">
        </div>
    </div>
</div>

<section class="mt-130">
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-4">
                <img class="img-fluid text-center" src="img/ana-y-carlos.svg" alt="Ana y Carlos, creadores de De Buena Mano">
            </div>  
            <div class="col-md-7 col-md-offset-1">
                <h2 class="pb-3">Detrás de DBM nos encontramos Ana y Carlos, dos amigos que desde nuestros roles de madre y tío respectivamente nos embarcamos en esta aventura motivados por nuestra pasión por la crianza responsable y la sostenibilidad.</h2>
                <p>Comprendemos lo importante que es para las familias reducir los gastos asociados a la crianza. Sabemos que los artículos destinados a los más pequeños suelen ser costosos debido a la prioridad que damos a la calidad. Sin embargo, a veces estos productos se utilizan durante un tiempo limitado y, en muchas ocasiones, se mantienen en excelentes condiciones para su reutilización.</p>

                <p>Nuestra visión es simple pero poderosa: ayudar a construir un futuro más sostenible y responsable para las generaciones venideras.</p>

                <p>Desde esa convicción y porque creemos firmemente que la crianza es una experiencia colectiva le hemos dado vida a debuenamano.cl, un espacio comunitario digital entre madres, padres y cuidadores donde pueden compartir sus historias, consejos y productos que ya no utilizan.</p> 

                <p>¡Bienvenidas y bienvenidos sean a De Buena Mano, nos emociona tenerte aquí y de ser parte de tu viaje en la crianza.</p>
            </div>           
        </div>
    </div>
</section>

<section class="mt-130">
    <div class="d-flex align-items-stretch justify-content-between mx-5">
            <div class=" d-flex col-md-4 bg-negro-verdoso py-5 px-5 align-items-center">
               <h2 class="titular-frase align-middle">“Nuestra inspiración surge de la constante búsqueda de una solución para dar un nuevo propósito a los artículos apenas utilizados que adquirimos para nuestros hijos e hijas”</h2> 
            </div>  
            <div class="col-md-8">
                <img class="img-fluid" src="img/inspiracion.png" alt="nuestra inspiración">
            </div>           
        </div>
    </div>
</section>

<div class="container-fluid">
    <slider-home/>
</div>


@endsection