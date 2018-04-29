<div class='col-md-8 col-md-offset-2'>
	
	@include('widgets.forms.input', ['type'=>'text', 'column'=>4, 'name'=>'PROP_CODIGO', 'label'=>'Código', 'options'=>['maxlength' => '25'] ])

	@include('widgets.forms.input', ['type'=>'text', 'column'=>8, 'name'=>'PROP_NOMBRE', 'label'=>'Descripción', 'options'=>['maxlength' => '300'] ])

	<!-- Botones -->
	@include('widgets.forms.buttons', ['url' => 'cnfg-geograficos/propietarios'])

</div>