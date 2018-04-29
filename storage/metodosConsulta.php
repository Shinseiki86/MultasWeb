<?php 

public function buscaContrato(Request $request)
	{ 
		$data = Prospecto::join('CONTRATOS', 'CONTRATOS.PROS_ID', '=', 'PROSPECTOS.PROS_ID')
						->where([
						    ['PROSPECTOS.PROS_ID', '=', $request->PROSPECTO],
						    ['CONTRATOS.ESCO_ID', '=', '1'],
						])
						->select(['PROSPECTOS.PROS_ID as PROSP',
							'CONT_FECHAINGRESO',
							'ESCO_ID',
						])->get();
	    return response()->json($data);
	}

 ?>

 <span ng-bind="ausentismo[0].AUSE_OBSERVACIONES"></span>