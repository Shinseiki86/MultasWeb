<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use LaravelFCM\Message\Topics;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use App\Models\Multa;
use App\Models\Vehiculo;

class MultaController extends Controller
{
	protected $route = 'core.multas';
	protected $class = Multa::class;

	public function __construct()
	{
		//parent::__construct($false);
		$this->middleware('auth')->except(['getMultasJson']);

	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$multas = Multa::join('VEHICULOS', 'VEHICULOS.VEHI_ID', '=', 'MULTAS.VEHI_ID')
						->join('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'MULTAS.PROP_ID')
						->select([
							'MULT_ID',
							'PROP_CEDULA',
							'PROP_NOMBRE',
							'PROP_APELLIDO',
							'VEHI_PLACA',
							'VEHI_MODELO',
							'VEHI_ANNO',
							'MULT_FECHA',
							'MULT_ESTADO',
							'MULT_VALOR',
							'MULT_DESCRIPCION',
						])->get();
		return view($this->route.'.index', compact('multas'));
	}

	/**
	 * Retorna json para Datatable.
	 *
	 * @return json
	 */
	public function getMultasJson($cedula)
	{
		return Multa::join('VEHICULOS', 'VEHICULOS.VEHI_ID', '=', 'MULTAS.VEHI_ID')
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
						->where('PROP_CEDULA', '=', $cedula)
						->get()->toJson();
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
	 * @param  int  $MULT_ID
	 * @return Response
	 */
	public function edit($MULT_ID)
	{
		$multa = Multa::findOrFail($MULT_ID);
		return view($this->route.'.edit', $this->getArraysSelect()+compact('multa'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $MULT_ID
	 * @return Response
	 */
	public function update($MULT_ID)
	{
		parent::updateModel($MULT_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $MULT_ID
	 * @return Response
	 */
	public function destroy($MULT_ID)
	{
		parent::destroyModel($MULT_ID);
	}

	private function getArraysSelect()
	{
		//Se crea un array con los vehiculos disponibles
		$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_PLACA');

		$PROP_NOMBRECOMPLETO = expression_concat([
			'PROP_CEDULA',
			'PROP_NOMBRE',
			'PROP_APELLIDO',
		], 'PROP_NOMBRECOMPLETO');
		$arrPropietario = model_to_array(Propietario::class, $PROP_NOMBRECOMPLETO);

		return compact('arrVehiculos', 'arrPropietario');
	}

}

/*
		$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);

		$notificationBuilder = new PayloadNotificationBuilder('Nueva multa ACB123');
		$notificationBuilder->setBody('La placa ABC123 tiene una nueva multa por $xxxx')
						    ->setSound('default');

		$dataBuilder = new PayloadDataBuilder();
		$dataBuilder->addData(['a_data' => 'my_data']);

		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();
		$data = $dataBuilder->build();

		//$token = "AAAAwFWAWRg:APA91bFWj__Miw_gnjlDD2FW6d31uNRJnvZVqrtlsCJyHF6NWkCeAk7Bi1BRF8VT6DKYqIb8Fld3-FM6ES0TIMkVaOvc5zRnnhTXS-RPE8Pvcp6MMPMKuCW1rM2-M_IpM8gSJAf2Q77B";
		$token = "AAAAwFWAWRg:APA91bGB0VTcd1wQZixvz7mIVROFny1CH5yg7udxWI9tlq0j5grzb_-Ve0wV35oIH3vy38_Ehfi57M1c_ouBtxyHTBDCl0M7o9IizfWPf-XEUf-BjZUblXgi45Jyohop7ayY33pUGN8I";

		$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
		dump($downstreamResponse);

		$topic = new Topics();
		$topic->topic('multas');
		$topicResponse = FCM::sendToTopic($topic, null, $notification, null);
		dd($topicResponse);
*/
