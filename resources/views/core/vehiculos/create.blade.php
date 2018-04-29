@extends('layouts.menu')

@section('page_heading', 'Nuevo Vehiculo')

@section('section')
{{ Form::open(['route' => 'core.vehiculos.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
