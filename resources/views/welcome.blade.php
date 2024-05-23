@extends('layouts.guest')
@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title text-center">
            {{ config('app.name') }}
        </h1>
    </div>
    <div class="card-body">
        <h3 class="text-dark text-center">Sistema web para alarma mediante Smart Button, Model WS101-915M</h3>
    </div>
    <div class="card-footer text-muted text-center">PERSON TECHNOLOGY
        <br>
        <p>Copyrigth, {{ date('Y') }}. Todos los derechos reservados.!</p>
    </div>
</div>
    
@endsection