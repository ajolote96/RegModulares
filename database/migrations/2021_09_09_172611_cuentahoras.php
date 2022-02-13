<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuentahoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW cuentahoras AS 
        SELECT
        `cda`.`horasprestadores`.`codigo` AS `codigo`,
        SUM(`cda`.`horasprestadores`.`horas`) AS `horas_servicio`,
        (
            `cda`.`users`.`horas` - SUM(`cda`.`horasprestadores`.`horas`)
        ) AS `horas_restantes`
        FROM
            (
                `cda`.`users`
            JOIN `cda`.`horasprestadores` ON
                (
                    (
                        `cda`.`users`.`id` = `cda`.`horasprestadores`.`idusuario`
                    )
                )
            )
        WHERE
            (
                `cda`.`horasprestadores`.`estado` = 'autorizado'
            )
        GROUP BY
            `cda`.`horasprestadores`.`codigo`,
            `cda`.`users`.`horas`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentahoras');
    }
}
