<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="https://kit.fontawesome.com/0a363a0ee9.js" crossorigin="anonymous"></script>
      @vite('resources/sass/app.scss')
      <title>Admin DBM</title>
  </head>
  <body>          
    <section id="app" class="container-fluid">
          <admin-product-edit :product-slug="'{{ $producto->slug }}'"/>
    </section>                        
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script> 
  </body>
</html>