<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultasTable extends Migration
{
    
    private $nomTabla = 'MULTAS';

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

            $table->increments('MULT_ID');
            $table->date('MULT_FECHA');
            $table->unsignedInteger('VEHI_ID')->comment('Llave foranea con VEHICULOS');
            $table->unsignedInteger('PROP_ID')->comment('Llave foranea con PROPIETARIOS');

            $table->boolean('MULT_ESTADO');
            $table->unsignedBigInteger('MULT_VALOR');
            $table->string('MULT_DESCRIPCION', 300);
            
            //Traza
            $table->string('MULT_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('MULT_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('MULT_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('MULT_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('MULT_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('MULT_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relación con tabla VEHICULOS
            $table->foreign('VEHI_ID')
                ->references('VEHI_ID')
                ->on('VEHICULOS')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Relación con tabla PROPIETARIOS
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
