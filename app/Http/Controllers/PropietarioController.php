<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Propietario;

class PropietarioController extends Controller
{
	protected $route = 'core.propietarios';
	protected $class = Propietario::class;

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
		//$model = Propietario::with('vehiculos')->get();
		$model = Propietario::select(['PROP_ID','PROP_CODIGO','PROP_NOMBRE','PROP_CREADOPOR'])
						->get();

		return Datatables::collection($model)
			->addColumn('VEHICULOS_COUNT', function($model){
				return $model->vehiculos->count();
			})
			->addColumn('action', function($model){
				return parent::buttonEdit($model).
					parent::buttonDelete($model, 'PROP_NOMBRE');
			})->make(true);
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create');
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
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function edit($PROP_ID)
	{
		// Se obtiene el registro
		$propietario = Propietario::findOrFail($PROP_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view($this->route.'.edit', compact('propietario'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function update($PROP_ID)
	{
		parent::updateModel($PROP_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function destroy($PROP_ID)
	{
		parent::destroyModel($PROP_ID);
	}


}

