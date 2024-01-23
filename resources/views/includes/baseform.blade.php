<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('post-seo')
    <script src="https://kit.fontawesome.com/0a363a0ee9.js" crossorigin="anonymous"></script>
    @stack('material-icons')
    @stack('lezada-css')
    @vite('resources/sass/app.scss')
    <title>@yield('title')</title>
</head>
<body id="app">    
    @include('includes.headerform')
    @yield('content')
    @include('includes.footerform')
    @vite('resources/js/app.js')
    @stack('script-copy-link')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @stack('lezada-js')
    @stack('dbm-parallax')
    @stack('img-profil')
</body>
</html>