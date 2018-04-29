<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Multa extends ModelWithSoftDeletes
{
	
	//Nombre de la tabla en la base de datos
	protected $table = 'MULTAS';
	protected $primaryKey = 'MULT_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'MULT_FECHACREADO';
	const UPDATED_AT = 'MULT_FECHAMODIFICADO';
	const DELETED_AT = 'MULT_FECHAELIMINADO';
	protected $dates = ['MULT_FECHACREADO', 'MULT_FECHAMODIFICADO', 'MULT_FECHAELIMINADO'];

	protected $fillable = [
		'MULT_FECHA',
		'PROP_ID',
		'VEHI_ID',
		'MULT_ESTADO',
		'MULT_VALOR',
		'MULT_DESCRIPCION',
	];

	public static function rules($id = 0){
		$rules = [
			'MULT_FECHA'  => ['required','date'],
			'PROP_ID'     => ['required','numeric'],
			'VEHI_ID'     => ['required','numeric'],
			'MULT_ESTADO' => ['required','boolean'],
			'MULT_VALOR'  => ['required','numeric'],
			'MULT_DESCRIPCION'=> ['required','max:300'],
		];
		return $rules;
	}

	public function vehiculo()
	{
		$foreingKey = 'VEHI_ID';
		return $this->belongsTo(Vehiculo::class, $foreingKey);
	}
}
