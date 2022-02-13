<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cactividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_actividad', function (Blueprint $table) {
            $table->id('id_actividad');
            $table->string('nombre_act', 50);
            $table->string('tipo_act', 50)->default('otro');
            $table->integer('id_prestador',0,0)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('objetivo')->nulllable();
            $table->string('fecha', 50);
            $table->string('status', 50)->default('en proceso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_actividad');
    }
}
