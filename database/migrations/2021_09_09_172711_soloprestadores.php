<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Soloprestadores extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW soloprestadores AS
        SELECT
        `cda`.`users`.`id` AS `id`,
        `cda`.`users`.`name` AS `name`,
        `cda`.`users`.`correo` AS `correo`,
        `cda`.`users`.`codigo` AS `codigo`,
        `cda`.`users`.`tipo` AS `tipo`,
        `cda`.`users`.`email_verified_at` AS `email_verified_at`,
        `cda`.`users`.`password` AS `password`,
        `cda`.`users`.`remember_token` AS `remember_token`,
        `cda`.`users`.`created_at` AS `created_at`,
        `cda`.`users`.`carrera` AS `carrera`,
        `cda`.`users`.`updated_at` AS `updated_at`,
        `cda`.`users`.`horas` AS `horas`,
        `cuentahoras`.`horas_servicio` AS `horas_cumplidas`,
        `cuentahoras`.`horas_restantes` AS `horas_restantes`
        FROM
            (
                `cda`.`users`
            LEFT JOIN `cda`.`cuentahoras` ON
                (
                    (
                        `cda`.`users`.`codigo` = `cuentahoras`.`codigo`
                    )
                )
            )
        WHERE
            (`cda`.`users`.`tipo` = 'prestador')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soloprestadores');
    }
}
