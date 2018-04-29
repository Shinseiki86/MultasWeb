<?php

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculosTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Vehiculo::create([
            'VEHI_PLACA'    => 'ABC123',
            'PROP_ID'    	=> 1,
            'VEHI_MODELO'   => 'FORD FIESTA',
            'VEHI_ANNO'     => 2000,
        ]);

		Vehiculo::create([
            'VEHI_PLACA'    => 'ABC456',
            'PROP_ID'    	=> 1,
            'VEHI_MODELO'   => 'AUDI',
            'VEHI_ANNO'     => 2001,
        ]);

		Vehiculo::create([
            'VEHI_PLACA'    => 'ZXY999',
            'PROP_ID'    	=> 2,
            'VEHI_MODELO'   => 'RENAULT 4',
            'VEHI_ANNO'     => 1986,
        ]);

	}
}
