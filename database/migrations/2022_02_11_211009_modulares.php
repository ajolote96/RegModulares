<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modulares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('modulares', function (Blueprint $table) {
            $table->id();
            $table->string('Titulo',100);
            $table->string('Area_participacion',255);

            $table->string('id_usuario',10);

            $table->string('Codigo_1',9)->nullable();
            $table->string('Nombre_1',255)->nullable();
            $table->string('Correo_1',200)->nullable();
            $table->string('Carrera_1',200)->nullable();

            $table->string('Codigo_2',9)->nullable();
            $table->string('Nombre_2',255)->nullable();
            $table->string('Correo_2',200)->nullable();
            $table->string('Carrera_2',200)->nullable();

            $table->string('asesor_codigo_1',9)->nullable();
            $table->string('asesor_nombre_1',255)->nullable();
            $table->string('asesor_departamento_1',255)->nullable();
            $table->string('asesor_correo_1',200)->nullable();

            $table->string('asesor_codigo_2',9)->nullable();
            $table->string('asesor_nombre_2',255)->nullable();
            $table->string('asesor_departamento_2',255)->nullable();
            $table->string('asesor_correo_2',200)->nullable();

            $table->string('resumen');
            $table->string('justificacion_m1');
            $table->string('justificacion_m2');
            $table->string('justificacion_m3');

            $table->string('status',20)->nullable();

            $table->string('actividad_integrantes');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
