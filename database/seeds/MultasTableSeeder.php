<?php

use Illuminate\Database\Seeder;
use App\Models\Multa;

class MultasTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		Multa::create([
			'MULT_FECHA' => '2000-01-20',
			'PROP_ID' => 1,
			'VEHI_ID' => 3,
			'MULT_ESTADO' => 'PENDIENTE',
			'MULT_VALOR' => 1000000,
			'MULT_DESCRIPCION' => 'PRUEBA 1',
			'MULT_CREADOPOR' => 'PRUEBA',
		]);

		Multa::create([
			'MULT_FECHA' => '2010-01-20',
			'PROP_ID' => 1,
			'VEHI_ID' => 3,
			'MULT_ESTADO' => 'PAGADA',
			'MULT_VALOR' => 600000,
			'MULT_DESCRIPCION' => 'PRUEBA 2',
			'MULT_CREADOPOR' => 'PRUEBA',
		]);

		Multa::create([
			'MULT_FECHA' => '2000-01-20',
			'PROP_ID' => 1,
			'VEHI_ID' => 1,
			'MULT_ESTADO' => 'PENDIENTE',
			'MULT_VALOR' => 400000,
			'MULT_DESCRIPCION' => 'PRUEBA 3',
			'MULT_CREADOPOR' => 'PRUEBA',
		]);

		Multa::create([
			'MULT_FECHA' => '2000-01-20',
			'PROP_ID' => 2,
			'VEHI_ID' => 1,
			'MULT_ESTADO' => 'PAGADA',
			'MULT_VALOR' => 150000,
			'MULT_DESCRIPCION' => 'PRUEBA 4',
			'MULT_CREADOPOR' => 'PRUEBA',
		]);

	}
}