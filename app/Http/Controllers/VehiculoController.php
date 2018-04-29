<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Vehiculo;

class VehiculoController extends Controller
{
	protected $route = 'multas.vehiculos';
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
		return view($this->route.'.index');
	}


	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getData()
	{
		//$model = Vehiculo::with('propietario','multas')->get();
		$model = Vehiculo::join('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'VEHICULOS.PROP_ID')
						->select(['VEHI_ID','VEHI_CODIGO','VEHI_NOMBRE','PROP_NOMBRE','VEHI_CREADOPOR'])
						->get();

		return Datatables::collection($model)
			->addColumn('MULTAS_COUNT', function($model){
				return $model->multas->count();
			})
			->addColumn('action', function($model){
				return parent::buttonEdit($model).
					parent::buttonDelete($model, 'VEHI_NOMBRE');
			})->make(true);
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con los países disponibles
		$arrPropietarios = model_to_array(Propietario::class, 'PROP_NOMBRE');

		return view($this->route.'.create', compact('arrPropietarios'));
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
		// Se obtiene el registro
		$vehiculo = Vehiculo::findOrFail($VEHI_ID);

		//Se crea un array con los países disponibles
		$arrPropietarios = model_to_array(Propietario::class, 'PROP_NOMBRE');

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('vehiculo', 'arrPropietarios'));
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


}

