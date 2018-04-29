@extends('layouts.menu')
@section('title', '/ Dashboard')

@section('page_heading')
	<div class="row">
		<div id="titulo" class="col-xs-8 col-md-6 col-lg-6">
			Dashboard
		</div>
		<div id="btns-top" class="col-xs-4 col-md-6 col-lg-6 text-right">
			
		</div>
	</div>
@endsection

@section('section')

	@include('widgets.charts.panelchart', ['idCanvas' => 'chart1', 'title' => 'Contratos x Empleador' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart2', 'title' => 'Tickets x Estado' ])
	@include('widgets.charts.panelchart', ['idCanvas' => 'chart3', 'title' => 'Tickets abiertos x Empresa' ])

@endsection

@push('scripts')
	{!! Html::script('assets/scripts/chart.js/Chart.min.js') !!}
	{!! Html::script('assets/scripts/momentjs/moment-with-locales.min.js') !!}
	{!! Html::script('assets/scripts/chart.js/dashboard.js') !!}
	<script type="text/javascript">
		$(function () {
			newChart(
				'gestion-humana/getContratosEmpleador',
				'Personal Activo Por Empresa',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart1',
				'bar'
			);
			newChart(
				'cnfg-tickets/getTicketsPorEstado',
				'Tickets por estado',
				'ESTI_DESCRIPCION',
				'count',
				'chart2',
				'bar'
			);
			newChart(
				'cnfg-tickets/getTicketsAbiertosPorEmpresa',
				'Tickets Abiertos Por Empresa',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart3',
				'bar'
			);
			newChart(
				'gestion-humana/getContratosParticipacion',
				'Participación',
				'EMPL_NOMBRECOMERCIAL',
				'count',
				'chart1',
				'bar'
			);
			$('.typeChart').removeClass('disabled');
		});
	</script>
@endpush