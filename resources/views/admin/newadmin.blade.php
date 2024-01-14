<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/sass/app.scss')
    <title>Admin DBM</title>
</head>
<body>
<section class="container-fluid">
    <div class="container">
        <div id="app">
            <admin-view />
        </div>
    </div>
</section>
@vite('resources/js/app.js')
</body>
</html>