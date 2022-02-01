@component('mail::message')
# Hola Administrador
<br>
<p>
    Has recibido un msaje del formulario de contacto
</p>

**Nombre:** {{$datosMensaje['nombre']}}

**Email:**  {{$datosMensaje['email']}}


**Informacion**


{{$datosMensaje['contenido']}}
@endcomponent
