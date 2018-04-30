<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Propietario extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'PROPIETARIOS';
    protected $primaryKey = 'PROP_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PROP_FECHACREADO';
	const UPDATED_AT = 'PROP_FECHAMODIFICADO';
	const DELETED_AT = 'PROP_FECHAELIMINADO';
	protected $dates = ['PROP_FECHACREADO', 'PROP_FECHAMODIFICADO', 'PROP_FECHAELIMINADO'];

	protected $fillable = [
		'PROP_CEDULA',
		'PROP_NOMBRE',
		'PROP_APELLIDO',
	];

	public static function rules($id = 0){
		$rules = [
			'PROP_CEDULA' => ['required','numeric',static::unique($id,'PROP_CEDULA')],
			'PROP_NOMBRE' => ['required','max:300'],
			'PROP_APELLIDO' => ['required','max:300'],
		];
		return $rules;
	}
	
	public function multas()
	{
		$foreingKey = 'MULT_ID';
		return $this->hasMany(Multa::class, $foreingKey);
	}
	public function vehiculos()
	{
		$foreingKey = 'VEHI_ID';
		return $this->hasMany(Vehiculo::class, $foreingKey);
	}

}
