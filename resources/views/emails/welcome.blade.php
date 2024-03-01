<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido a De Buena Mano {{ $user->name }} {{ $user->lastname }}!</h1>
    <p>Has creado tu cuenta exitosamente</p>
    <p>Email : {{ $user->email }}</p>
    <p>Teléfono : {{ $user->phone }}</p>
    <p>Tu contraseña: {{ $password }}</p>
</body>
</html>
