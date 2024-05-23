@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection



@section('content')
<div class="content d-flex justify-content-center align-items-center">
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
</div>
@endsection

@push('scriptsHeader')
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/demo/pages/datatables_basic.js') }}"></script>
@endpush
@push('scriptsFooter')

@endpush