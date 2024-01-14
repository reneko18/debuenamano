@extends('includes.baseform')
@section('content')
<h1 class="text-center">Inicio</h1>
<div class="container-fluid bg-parallax">
    <div id="parallax"><h1 class="parallax-txt">Parallax</h1></div>
</div>
<div class="container-fluid">
    <slider-home/>
</div>
@endsection
@push('parallax')
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
        elem.style.backgroundPosition = x;
    }

})();
});
    </script>
@endpush
