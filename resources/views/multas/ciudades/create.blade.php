@extends('layouts.menu')

@section('page_heading', 'Nueva Multa')

@section('section')
{{ Form::open(['route' => 'cnfg-geograficos.multas.store', 'class' => 'form-horizontal']) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection
