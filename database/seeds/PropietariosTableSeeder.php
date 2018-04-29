<?php

use Illuminate\Database\Seeder;
use App\Models\Propietario;

class PropietariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Propietario::create([
            'PROP_CEDULA'    => 123456789,
            'PROP_NOMBRE'    => 'PEPE',
            'PROP_APELLIDO'  => 'PEREZ',
        ]);
        Propietario::create([
            'PROP_CEDULA'    => 987654321,
            'PROP_NOMBRE'    => 'MONICA',
            'PROP_APELLIDO'  => 'GALINDO',
        ]);
    }
}