@extends('layouts.menu')
@section('title', '/ Multas')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-xs-6 col-lg-6">
			Multas
		</div>
		<div id="btns-top" class="col-xs-4 col-xs-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.multas.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-xs-1 all">CÉDULA</th>
				<th class="col-xs-2">NOMBRE</th>
				<th class="col-xs-2">APELLIDO</th>
				<th class="col-xs-1 all">PLACA</th>
				<th class="col-xs-1">MODELO</th>
				<th class="col-xs-1">AÑO</th>
				<th class="col-xs-1">FECHA</th>
				<th class="col-xs-1 all">ESTADO</th>
				<th class="col-xs-1 all">VALOR</th>
				<th class="col-xs-2">DESCRIPCIÓN</th>

				<th class="col-xs-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-ajax', ['urlAjax'=>'multas/getTable', 'columns'=>[
		'PROP_CEDULA',
		'PROP_NOMBRE',
		'PROP_APELLIDO',
		'VEHI_PLACA',
		'VEHI_MODELO',
		'VEHI_ANNO',
		'MULT_FECHA',
		'MULT_ESTADO',
		'MULT_VALOR',
		'MULT_DESCRIPCION',
	]])	
@endsection
