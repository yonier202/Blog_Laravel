{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Correo de Contacto</h1>

    <p>Nombre: {{$data['name']}}</p>
    <p>Correo Electrónico: {{$data['email']}}</p>
    <p>Asunto: {{$data['message']}}</p>

</body>
</html> --}}

@component('mail::message')
# Hola Jhonier Rojas
{{$data['name']}} te ha enviado un mensaje desde la web Laravel.

@component('mail::panel')
{{$data['message']}}
@endcomponent

Correo de contacto {{$data['email']}}

@endcomponent