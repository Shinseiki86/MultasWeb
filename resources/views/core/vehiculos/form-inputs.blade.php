@include('chosen')
<div class='col-md-8 col-md-offset-2'>

	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'VEHI_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'VEHI_NOMBRE', 'label'=>'Descripción', 'options'=>['maxlength' => '300'] ])

	@include('widgets.forms.input', ['type'=>'select', 'name'=>'PROP_ID', 'label'=>'Propietario', 'data'=>$arrPropietarios])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-geograficos/vehiculos'])
	
</div>