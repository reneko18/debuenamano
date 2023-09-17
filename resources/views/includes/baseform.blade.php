<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/fff2c97c92.js" crossorigin="anonymous"></script>
    @vite('resources/sass/app.scss')
    <title>@yield('title')</title>
</head>
<body>    
    @include('includes.headerform')
    @yield('content')
    @include('includes.footerform')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Get the height of the left column
            var catHeight = $('.cat-select').outerHeight() + 24,
                genreHeight = $('.cont-genre').outerHeight(),
                leftHeight = catHeight + genreHeight;
            // Set the height of the textarea to match the left column height
            $('#desc-pro').css('height', leftHeight);
        });
    </script>   
</body>
</html>