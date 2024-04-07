@extends('includes.baseform')
@section('content')

<div class="bg-gris ptb-60">
    <div class="d-flex align-items-center">
        <div class="col-md-3 offset-md-2 hero">
            <h1>EXPLORA, VENDE Y COMPRA DE FORMA SEGURA</h1>
            <p class="mb-40">DBM es tu marketplace dedicado a la compra y venta de productos de segunda mano para bebes, niñas y niños de hasta 5 años.</p>
            <a href="#" class="boton-secundario">Ver todos los artículos en venta</a>
        </div>
                
        <div class="col-md-7 ms-auto text-right">
        <div id="parallax"></div>
        </div>
    </div>
</div>

<div class="banner-dbm">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h3>Compra con seguridad</h3>
                <p>Tu dinero está 100% protegido</p>
            </div>
            <div class="col-md-4">
                <h3>Sencillo y cómodo</h3>
                <p>Te guíamos en todo el proceso</p>
            </div>
            <div class="col-md-4">
                <h3>Productos seleccionados</h3>
                <p>A buenos precios y bien cuidados</p>
            </div>
        </div>
    </div>
</div>

<section class="mt-130">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <div><h2 class='titular'>Últimas publicaciones</h2></div>
                <div><a href="#" class="enlace">ver todos los productos</a></div>
            </div>             
        </div>
    </div>
</section>

<section class="mt-130 bg-blanco-verdoso">
    <div class="container ptb-130">
        <div class="row text-center mb-60">
            <div><h2 class='titular'>Proceso de venta/compra</h2></div> 
        </div>
        <div class="row">
            <div class="d-flex justify-content-between align-items-center text-center proceso">
                <div>
                    <img src="icons/cuenta.svg" alt="icono Creas tu cuenta de usuario en DBM">
                    <h3>Crea tu cuenta de usuario en DBM</h3>
                </div>
                <div>
                    <img src="icons/form.svg" alt="icono Completas el formulario de publicación">
                    <h3>Completa el formulario de publicación</h3>
                </div>
                <div>
                    <img src="icons/verificacion.svg" alt="icono Verificamos y publicamos tu producto">
                    <h3>Verificamos y publicamos tu producto</h3>
                </div>
                <div>
                    <img src="icons/venta.svg" alt="icono Te avisamos que fue vendido">
                    <h3>Te avisamos que fue vendido</h3>
                </div>
                <div>
                    <img src="icons/despacho.svg" alt="icono Te asistimos al enviar el producto">
                    <h3>Te asistimos al enviar el producto</h3>
                </div>
                <div>
                    <img src="icons/recepcion.svg" alt="icono Confirmamos el recibo del producto">
                    <h3>Confirmamos el recibo del producto</h3>
                </div>
                <div>
                    <img src="icons/pago.svg" alt="icono Transferimos el pago a tu cuenta">
                    <h3>Transferimos el pago a tu cuenta</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-130">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <div><h2 class='titular'>Nuestro Blog</h2></div>
                <div><a href="#" class="enlace">visita el blog</a></div>
            </div>             
        </div>
    </div>
</section>

<!-- GRADIENTE LINEAL PARA TENER BLANCO EN TOP AND BOTTOM -->
<section class="mt-130 bg-negro-verdoso">
    <div class="container ptb-130">
        <div class="row relative">
            <div class="col-md-5">
                <h2 class="pb-2">Tu comunidad de reutilización y crianza</h2>
                <p class="pb-5">Hemos creado una <b>plataforma digital chilena</b> donde podrás comprar y vender productos nuevos y de segunda mano con poco uso en muy buenas condiciones para bebés, niñas y niños de hasta 5 años.</p>
                <a href="#" class="boton-principal">visita el blog</a>
            </div>
            <div class="col-md-5-grid">
                <img class="img-fluid" src="img/dbm_comunidad.png" alt="Tu comunidad de reutilización y crianza">
            </div>    
        </div>
    </div>
</section>




@endsection

@push('dbm-parallax')

<script>
    document.addEventListener("DOMContentLoaded", function() {
    (function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector("#parallax");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/2;
        let _h = window.innerHeight/2;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
        let _depth1 = `${50 - (_mouseX - _w) * 0.01}% ${50 - (_mouseY - _h) * 0.01}%`;
        let _depth2 = `${50 - (_mouseX - _w) * 0.02}% ${50 - (_mouseY - _h) * 0.02}%`;
        let _depth3 = `${50 - (_mouseX - _w) * 0.06}% ${50 - (_mouseY - _h) * 0.06}%`;
        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
        console.log(x);
        elem.style.backgroundPosition = x;
    }

})();
});
</script>
@endpush