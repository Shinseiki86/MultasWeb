<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Vehiculo;

class VehiculoController extends Controller
{
	protected $route = 'core.vehiculos';
	protected $class = Vehiculo::class;

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$PROP_NOMBRECOMPLETO = expression_concat([
			'PROP_NOMBRE',
			'PROP_APELLIDO',
		], 'PROP_NOMBRECOMPLETO');

		$vehiculos = Vehiculo::join('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'VEHICULOS.PROP_ID')
						->select([
							'VEHI_ID',
							'VEHI_PLACA',
							'VEHI_MODELO',
							'VEHI_ANNO',
							'PROP_CEDULA',
							$PROP_NOMBRECOMPLETO,
						])->get();
		return view($this->route.'.index', compact('vehiculos'));
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create', $this->getArraysSelect());
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		parent::storeModel();
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $VEHI_ID
	 * @return Response
	 */
	public function edit($VEHI_ID)
	{
		$vehiculo = Vehiculo::findOrFail($VEHI_ID);
		return view($this->route.'.edit', $this->getArraysSelect()+compact('vehiculo'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $VEHI_ID
	 * @return Response
	 */
	public function update($VEHI_ID)
	{
		parent::updateModel($VEHI_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $VEHI_ID
	 * @return Response
	 */
	public function destroy($VEHI_ID)
	{
		parent::destroyModel($VEHI_ID);
	}

	private function getArraysSelect()
	{

		$PROP_NOMBRECOMPLETO = expression_concat([
			'PROP_CEDULA',
			'PROP_NOMBRE',
			'PROP_APELLIDO',
		], 'PROP_NOMBRECOMPLETO');
		$arrPropietarios = model_to_array(Propietario::class, $PROP_NOMBRECOMPLETO);

		return compact('arrPropietarios');
	}


}

