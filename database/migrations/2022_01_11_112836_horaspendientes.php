<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horaspendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW horaspendientes AS
        SELECT
        `cda`.`horasprestadores`.`id` AS `id`,
        `cda`.`horasprestadores`.`codigo` AS `codigo`,
        `cda`.`horasprestadores`.`nombre` AS `nombre`,
        `cda`.`horasprestadores`.`apellido` AS `apellido`,
        `cda`.`horasprestadores`.`fecha` AS `fecha`,
        `cda`.`horasprestadores`.`hora_entrada` AS `hora_entrada`,
        `cda`.`horasprestadores`.`hora_salida` AS `hora_salida`,
        `cda`.`horasprestadores`.`tiempo` AS `tiempo`,
        `cda`.`horasprestadores`.`estado` AS `estado`,
        `cda`.`horasprestadores`.`horas` AS `horas`,
        `cda`.`horasprestadores`.`nota` AS `nota`,
        `cda`.`horasprestadores`.`fecha_actual` AS `fecha_actual`,
        `cda`.`horasprestadores`.`idusuario` AS `idusuario`,
        `cda`.`horasprestadores`.`origen` AS `origen`,
        `cda`.`horasprestadores`.`responsable` AS `responsable`
    FROM
        `cda`.`horasprestadores`
    WHERE
        (
            `cda`.`horasprestadores`.`estado` = 'pendiente'
        )
        ");
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
