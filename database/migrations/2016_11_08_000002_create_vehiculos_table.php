<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    
    private $nomTabla = 'VEHICULOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = $this->nomTabla.': ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->increments('VEHI_ID');
            $table->string('VEHI_PLACA', 6)->unique();
            $table->unsignedInteger('PROP_ID')->comment('Llave foranea con PROPIETARIOS');
            $table->string('VEHI_MODELO', 30);
            $table->unsignedSmallInteger('VEHI_ANNO');

            //Traza
            $table->string('VEHI_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('VEHI_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('VEHI_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('VEHI_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('VEHI_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('VEHI_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla VEHICULOS
            $table->foreign('PROP_ID')
                ->references('PROP_ID')
                ->on('PROPIETARIOS')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Borrando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::dropIfExists($this->nomTabla);
    }

}
