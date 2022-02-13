<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModularesRegistrados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW `modulares_registrados` AS SELECT
        `modulares`.`Titulo` AS `Titulo`,
        `modulares`.`Area_participacion` AS `Area_participacion`,
        `modulares`.`id` AS `id_modular`,
        `modulares`.`Codigo_1` AS `Codigo_1`,
        `modulares`.`Nombre_1` AS `Nombre_1`,
        `modulares`.`Correo_1` AS `Correo_1`,
        `modulares`.`Carrera_1` AS `Carrera_1`,
        `modulares`.`Codigo_2` AS `Codigo_2`,
        `modulares`.`Nombre_2` AS `Nombre_2`,
        `modulares`.`Correo_2` AS `Correo_2`,
        `modulares`.`Carrera_2` AS `Carrera_2`,
        `modulares`.`asesor_codigo_1` AS `asesor_codigo_1`,
        `modulares`.`asesor_nombre_1` AS `asesor_nombre_1`,
        `modulares`.`asesor_departamento_1` AS `asesor_departamento_1`,
        `modulares`.`asesor_correo_1` AS `asesor_correo_1`,
        `modulares`.`asesor_codigo_2` AS `asesor_codigo_2`,
        `modulares`.`asesor_nombre_2` AS `asesor_nombre_2`,
        `modulares`.`asesor_departamento_2` AS `asesor_departamento_2`,
        `modulares`.`asesor_correo_2` AS `asesor_correo_2`,
        `modulares`.`resumen` AS `resumen`,
        `modulares`.`justificacion_m1` AS `justificacion_m1`,
        `modulares`.`justificacion_m2` AS `justificacion_m2`,
        `modulares`.`justificacion_m3` AS `justificacion_m3`,
        `modulares`.`actividad_integrantes` AS `actividad_integrantes`,
        `modulares`.`status` AS `status_modulares`,
        `users`.`id` AS `id_alumno`,
        `users`.`name` AS `nombre_alumno`,
        `users`.`apellido` AS `apellido`,
        `users`.`correo` AS `correo`,
        `users`.`codigo` AS `codigo`,
        `users`.`tipo` AS `tipo`,
        `users`.`status` AS `status_usuario`,
        `users`.`carrera` AS `carrera`
    FROM
        (
            `modulares`
        JOIN `users` ON
            (
                `modulares`.`id_usuario` = `users`.`id`
            )
        )
    WHERE
        (`users`.`status` = 'registrado')"
    );
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
