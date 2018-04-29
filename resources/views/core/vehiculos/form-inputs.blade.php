@include('chosen')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'VEHI_PLACA', 'label'=>'Placa', 'options'=>['maxlength' => '6', 'required'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'VEHI_MODELO', 'label'=>'Modelo', 'options'=>['maxlength' => '30', 'required'] ])

	@include('widgets.forms.input', ['type'=>'number', 'column'=>4, 'name'=>'VEHI_ANNO', 'label'=>'Año', 'options'=>['min' => '1900', 'max' => '2050', 'required'] ])

	@include('widgets.forms.input', ['type'=>'select', 'column'=>8, 'name'=>'PROP_ID', 'label'=>'Propietario', 'data'=>$arrPropietarios, 'options'=>['required'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-geograficos/vehiculos'])
	
</div>