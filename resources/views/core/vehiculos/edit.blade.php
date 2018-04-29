@extends('layouts.menu')

@section('page_heading', 'Actualizar Vehiculo')

@section('section')
{{ Form::model($vehiculo, ['action' => ['VehiculoController@update', $vehiculo->VEHI_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection