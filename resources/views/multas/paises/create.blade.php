@extends('layouts.menu')

@section('page_heading', 'Nuevo Propietario')

@section('section')
{{ Form::open(['route' => 'cnfg-geograficos.propietarios.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
