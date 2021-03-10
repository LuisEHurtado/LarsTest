@component('mail::message')
# BIENVENIDO

<p>Hola, {{ $maildata['name'] }}</p>
<p>Se ha generado un orden a su nombre</p>



Gracias,<br>
{{ config('app.name') }}
@endcomponent
