<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Vehiculo extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'VEHICULOS';
    protected $primaryKey = 'VEHI_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'VEHI_FECHACREADO';
	const UPDATED_AT = 'VEHI_FECHAMODIFICADO';
	const DELETED_AT = 'VEHI_FECHAELIMINADO';
	protected $dates = ['VEHI_FECHACREADO', 'VEHI_FECHAMODIFICADO', 'VEHI_FECHAELIMINADO'];

	protected $fillable = [
		'VEHI_PLACA',
		'VEHI_MODELO',
		'VEHI_ANNO',
		'PROP_ID',
	];

	public static function rules($id = 0){
		$rules = [
			'VEHI_PLACA' => ['required','max:6',static::unique($id,'VEHI_PLACA')],
			'VEHI_MODELO' => ['required','max:300'],
			'VEHI_ANNO' => ['required','numeric'],
			//'PROP_ID'     => ['required','numeric']//, 'exists:PROPIETARIOS'],
		];
		return $rules;
	}

	public function multas()
	{
		$foreingKey = 'VEHI_ID';
		return $this->hasMany(Multa::class, $foreingKey);
	}

	public function propietario()
	{
		$foreingKey = 'PROP_ID';
		return $this->belongsTo(Propietario::class, $foreingKey);
	}

}
