<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Soloclientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW soloclientes AS 
        SELECT
        `cda`.`users`.`id` AS `id`,
        `cda`.`users`.`name` AS `name`,
        `cda`.`users`.`correo` AS `correo`,
        `cda`.`users`.`codigo` AS `codigo`,
        `cda`.`users`.`created_at` AS `created_at`,
        `cda`.`clientes`.`curso1` AS `curso1`,
        `cda`.`clientes`.`curso2` AS `curso2`,
        `cda`.`clientes`.`curso3` AS `curso3`,
        `cda`.`users`.`tipo_cliente` AS `tipo_cliente`
        FROM
            (
                `cda`.`users`
            JOIN `cda`.`clientes` ON
                (
                    (`cda`.`users`.`id` = `cda`.`clientes`.`id`)
                )
            )
        WHERE
            (`cda`.`users`.`tipo` = 'clientes')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soloclientes');
    }
}
