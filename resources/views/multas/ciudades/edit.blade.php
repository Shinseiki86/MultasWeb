@extends('layouts.menu')

@section('page_heading', 'Actualizar Multa')

@section('section')
{{ Form::model($multa, ['action' => ['CnfgGeograficos\MultaController@update', $multa->CIUD_ID ], 'method' => 'PUT', 'class' => 'form-horizontal' ]) }}

	<!-- Elementos del formulario -->
	@rinclude('form-inputs')

{{ Form::close() }}
@endsection