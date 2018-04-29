@extends('layouts.menu')
@section('title', '/ Vehiculos')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Vehículos
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			<a class='btn btn-primary' role='button' href="{{ route('core.vehiculos.create') }}" data-tooltip="tooltip" title="Crear Nuevo" name="create">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
	</div>
@endsection

@section('section')

	<table class="table table-striped" id="tabla">
		<thead>
			<tr>
				<th class="col-md-1">PLACA</th>
				<th class="col-md-1">MODELO</th>
				<th class="col-md-1">AÑO</th>
				<th class="col-md-1">CÉDULA</th>
				<th class="col-md-1">PROPIETARIO</th>
				
				<th class="col-md-1 all notFilter"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($vehiculos as $vehiculo)
			<tr>
				<td>{{ $vehiculo -> VEHI_PLACA }}</td>
				<td>{{ $vehiculo -> VEHI_MODELO }}</td>
				<td>{{ $vehiculo -> VEHI_ANNO }}</td>
				<td>{{ $vehiculo -> PROP_CEDULA }}</td>
				<td>{{ $vehiculo -> PROP_NOMBRECOMPLETO }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.vehiculos.edit', [ 'VEHI_ID' => $vehiculo->VEHI_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $vehiculo->VEHI_ID,
						'data-modelo'=> str_upperspace(class_basename($vehiculo)),
						'data-descripcion'=> $vehiculo->VEHI_PLACA,
						'data-action'=>'vehiculos/'. $vehiculo->VEHI_ID,
						'data-target'=>'#pregModalDelete',
						'data-tooltip'=>'tooltip',
						'title'=>'Borrar',
					])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@include('widgets/modal-delete')
	@include('widgets.datatable.datatable-export')	
@endsection