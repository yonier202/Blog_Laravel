
@component('mail::message')
# Hola {{$autor->name}}
{{$question->user->name}} te ha enviado un mensaje desde la web Laravel.

@component('mail::panel')
{{$question->body}}
@endcomponent

Correo de contacto {{$question->user->email}}

@endcomponent