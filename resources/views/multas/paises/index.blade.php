@extends('layouts.menu')
@section('title', '/ Propietarios')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Propietarios
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('cnfg-geograficos.propietarios.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">Código</th>
				<th class="col-md-5">Nombre</th>
				<th class="col-md-1">Vehiculos</th>
				<th class="hidden-xs col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getPropietarios', 'columns'=>[
		'PROP_CODIGO',
		'PROP_NOMBRE',
		'VEHICULOS_COUNT',
		'PROP_CREADOPOR',
	]])	
@endsection