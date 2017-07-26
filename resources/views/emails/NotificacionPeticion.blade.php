@component('mail::message')
# {{$title}}

{{$message}}

### Datos:
**Tipo de peticion:** {{$peticion->tipo->nombre}}<br>
**Usuario:** {{$peticion->idUsuario}}<br>
**Tabla:** {{$peticion->campos->first()->tabla}}<br>
**Campo:** {{$peticion->campos->first()->campo}}<br>
**Valor nuevo:** {{$peticion->campos->first()->valorNuevo}}<br>

Saludos,<br>
{{ config('app.name') }}
@endcomponent
