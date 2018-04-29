@extends('layouts.menu')
@section('title', '/ Vehiculos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Vehículos
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('cnfg-geograficos.vehiculos.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
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
				<th class="col-md-3">Nombre</th>
				<th class="col-md-3">Propietario</th>
				<th class="col-md-1">Multas</th>
				<th class="hidden-xs col-md-1">Creado</th>
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'getVehiculos', 'columns'=>[
		'VEHI_CODIGO',
		'VEHI_NOMBRE',
		'PROP_NOMBRE',
		'MULTAS_COUNT',
		'VEHI_CREADOPOR',
	]])	
@endsection