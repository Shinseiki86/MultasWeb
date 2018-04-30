@include('chosen')
@include('datepicker')
<div class='col-md-8 col-md-offset-2'>

	<div class="row">
		@include('widgets.forms.input', ['type'=>'date', 'column'=>5, 'name'=>'MULT_FECHA', 'label'=>'Fecha de la multa', 'options'=>['required'] ])
		@include('widgets.forms.input', ['type'=>'select', 'column'=>4,'name'=>'MULT_ESTADO', 'label'=>'Estado', 'data'=>['PENDIENTE'=>'PENDIENTE', 'PAGADA'=>'PAGADA'], 'options'=>['required'] ])
		@include('widgets.forms.input', ['type'=>'number', 'column'=>3, 'name'=>'MULT_VALOR', 'label'=>'Valor', 'options'=>['required'] ])
	</div>

	<div class="row">
		@include('widgets.forms.input', ['type'=>'select', 'column'=>8, 'name'=>'PROP_ID', 'label'=>'Propietario', 'data'=>$arrPropietario ])
		@include('widgets.forms.input', ['type'=>'select', 'column'=>4, 'name'=>'VEHI_ID', 'label'=>'Vehículo', 'data'=>$arrVehiculos ])
	</div>

	<div class="row">
		@include('widgets.forms.input', [ 'type'=>'textarea', 'name'=>'MULT_DESCRIPCION', 'label'=>'Descripción', 'options'=>['maxlength' => '300'] ])
	</div>

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'core/multas'])

</div>