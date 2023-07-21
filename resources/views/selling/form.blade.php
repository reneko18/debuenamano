<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/sass/app.scss')
    <title>Formulario de Venta</title>
</head>
<body>
    <section class="container">
        <h1 class="text-center my-5">Test Form</h1>
    </section>
    <section id="app">
        <new-selling-form-product></new-selling-form-product>
    </section>
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
</body>
</html>