<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prestadorespendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW prestadorespendientes AS 
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
        `cda`.`users`.`updated_at` AS `updated_at`
        FROM
            `cda`.`users`
        WHERE
            (`cda`.`users`.`tipo` = 'prestadorP')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadoraspendientes');
    }
}
