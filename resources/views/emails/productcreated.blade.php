<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet" type="text/css">
    </head>
    <body style="font-family: 'Roboto', sans-serif;">
        <div style="width:100%;max-width:600px;margin:0 auto;">
            <div style="position:relative; background-color:#C0C6B9; height:55px;">
                <img src="{{ asset('images/mails/logo.png') }}" alt="Logo" style="width:80px;max-width: 80px;height: auto;position: absolute;top: 100%;left: 50%;transform: translate(-50%, -50%);">
            </div>
            <div style="padding: 10% 5%">
                <p style="font-size: 13px; color: #151A0F; line-height:21px;">Hola {{ $user->name }} {{ $user->lastname }}!</p>
                <p style="font-size: 13px; color: #151A0F; line-height:21px;">Has creado un nuevo producto {{ $product->title }} el cual lo revisaremos para validar a la brevedad</p> 
                <p style="font-size: 13px; color: #151A0F; line-height:21px;">
                    ¡Saludos!<br>
                    El equipo de De Buena Mano 🌟
                </p>
            </div>
        </div>
    </body>
</html>