@extends('includes.baseform')
@section('content')

<div class="bg-blanco-verdoso d-none d-md-block">
    <div class="container-fluid bg-hero-landing">
        <div class="row">
            <div class="d-flex align-items-center justify-content-around">
                <div class="col-lg-4 col-md-5 offset-lg-1 offset-md-0 hero px-5">
                    <h2>Prepárate para descubrir una nueva forma de comprar y vender productos para bebés, niños y niñas.</h2>
                    <p class="mb-40">Suscríbete para recibir noticias sobre nuestro lanzamiento y los productos en tienda:</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control input-landing" placeholder="Ingresa tu correo electrónico" aria-label="Ingresa tu correo electrónico" aria-describedby="button-addon2">
                        <button class="boton-landing" type="button">Quiero estar al tanto</button>
                    </div>
                </div>      
                <div class="col-lg-7 col-md-7 pt-60 ms-auto text-right">
                    <div id="parallax-landing"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('dbm-parallax')

<script>
    document.addEventListener("DOMContentLoaded", function() {
    (function() {
    // Add event listener
    document.addEventListener("mousemove", parallax);
    const elem = document.querySelector("#parallax-landing");
    // Magic happens here
    function parallax(e) {
        let _w = window.innerWidth/2;
        let _h = window.innerHeight/2;
        let _mouseX = e.clientX;
        let _mouseY = e.clientY;
        let _depth1 = `${50 - (_mouseX - _w) * 0.001}% ${50 - (_mouseY - _h) * 0.001}%`;
        let _depth2 = `${50 - (_mouseX - _w) * 0.002}% ${50 - (_mouseY - _h) * 0.002}%`;
        let _depth3 = `${50 - (_mouseX - _w) * 0.006}% ${50 - (_mouseY - _h) * 0.006}%`;
        let x = `${_depth3}, ${_depth2}, ${_depth1}`;
        elem.style.backgroundPosition = x;
    }

})();
});
</script>
@endpush