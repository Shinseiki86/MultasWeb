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
		<tbody>
			@foreach($multas as $multa)
			<tr>
				<td>{{ $multa -> PROP_CEDULA }}</td>
				<td>{{ $multa -> PROP_NOMBRE }}</td>
				<td>{{ $multa -> PROP_APELLIDO }}</td>

				<td>{{ $multa -> VEHI_PLACA }}</td>
				<td>{{ $multa -> VEHI_MODELO }}</td>
				<td>{{ $multa -> VEHI_ANNO }}</td>
				<td>{{ $multa -> MULT_FECHA }}</td>
				<td>{{ $multa -> MULT_ESTADO }}</td>
				<td>{{ $multa -> MULT_VALOR }}</td>
				<td>{{ $multa -> MULT_DESCRIPCION }}</td>
				<td>
					<!-- Botón Editar (edit) -->
					<a class="btn btn-small btn-info btn-xs" href="{{ route('core.multas.edit', [ 'MULT_ID' => $multa->MULT_ID ] ) }}" data-tooltip="tooltip" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</a>

					<!-- carga botón de borrar -->
					{{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
						'class'=>'btn btn-xs btn-danger btn-delete',
						'data-toggle'=>'modal',
						'data-id'=> $multa->MULT_ID,
						'data-modelo'=> str_upperspace(class_basename($multa)),
						'data-descripcion'=> $multa->PROP_CEDULA.' '.$multa->VEHI_PLACA,
						'data-action'=>'multas/'. $multa->MULT_ID,
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
