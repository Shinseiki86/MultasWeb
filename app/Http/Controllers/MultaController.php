<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Multa;
use App\Models\Vehiculo;

class MultaController extends Controller
{
	protected $route = 'multas.multas';
	protected $class = Multa::class;

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
		return view($this->route.'.index');
	}

	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getMultasJson($prop_cedula)
	{
		$model = Multa::join('VEHICULOS', 'VEHICULOS.VEHI_ID', '=', 'MULTAS.VEHI_ID')
						->join('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'MULTAS.PROP_ID')
						->select([
							//'MULTAS.PROP_ID',
							'PROP_CEDULA as Cedula',
							'PROP_NOMBRE as Nombre',
							'PROP_APELLIDO as Apellido',
							//'MULTAS.VEHI_ID',
							'VEHI_PLACA as Placa',
							'VEHI_MODELO as Modelo',
							'VEHI_ANNO as Ano',
							'MULT_FECHA as Fecha',
							'MULT_ESTADO as Estado',
							'MULT_VALOR as Valor',
							'MULT_DESCRIPCION as Descripcion',
						])
                        ->where('PROP_CEDULA', '=', $prop_cedula)
                        ->get();
		return $model->toJson();
		/*return Datatables::collection($model)
			->addColumn('action', function($model){
				return parent::buttonEdit($model).
					parent::buttonDelete($model, 'MULT_ID');
			})->make(true);*/
	}

	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getData()
	{
		$model = Multa::join('VEHICULOS', 'VEHICULOS.VEHI_ID', '=', 'MULTAS.VEHI_ID')
						->join('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'MULTAS.PROP_ID')
						->select([
							'PROP_CEDULA as Cédula',
							'PROP_NOMBRE as Nombre',
							'PROP_APELLIDO as Apellido',
							'VEHI_PLACA as Placa',
							'VEHI_MODELO as Modelo',
							'VEHI_ANNO as Año',
							'MULT_FECHA as Fecha',
							'MULT_ESTADO as Estado',
							'MULT_VALOR as Valor',
							'MULT_DESCRIPCION as Descripción',
						])->get();

		return Datatables::collection($model)
			->addColumn('action', function($model){
				return parent::buttonEdit($model).
					parent::buttonDelete($model, 'MULT_ID');
			})->make(true);
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con los vehiculos disponibles
		$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_PLACA');

		return view($this->route.'.create', compact('arrVehiculos'));
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
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function edit($CIUD_ID)
	{
		// Se obtiene el registro
		$multa = Multa::findOrFail($CIUD_ID);

		//Se crea un array con los vehiculos disponibles
		$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_NOMBRE');

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('multa', 'arrVehiculos'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function update($CIUD_ID)
	{
		parent::updateModel($CIUD_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $CIUD_ID
	 * @return Response
	 */
	public function destroy($CIUD_ID)
	{
		parent::destroyModel($CIUD_ID);
	}

}
