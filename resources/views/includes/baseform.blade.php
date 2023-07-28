<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/sass/app.scss')
    <title>@yield('title')</title>
</head>
<body>    
    @include('includes.headerform')
    @yield('content')
    @include('includes.footerform')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    
</body>
</html>