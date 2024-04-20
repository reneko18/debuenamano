<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('post-seo')
    <script src="https://kit.fontawesome.com/fff2c97c92.js" crossorigin="anonymous"></script>
    @stack('material-icons')
    @vite('resources/sass/app.scss')
    <title>@yield('title')</title>
</head>
<body id="app">
    @vite('resources/js/app.js')    
    @include('includes.headerform')
    @yield('content')
    @include('includes.footerform')
    @stack('script-copy-link')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script> 
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script> --}}
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
    @stack('dbm-parallax')
    {{-- @stack('img-profil') --}}
    @stack('password-eye')
    @stack('confetti')
    @stack('ajax-cart')
</body>
</html>