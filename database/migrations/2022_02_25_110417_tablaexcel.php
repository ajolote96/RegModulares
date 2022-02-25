<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tablaexcel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW `tabla_excel` AS SELECT
    `users`.`created_at` AS `Fecha`,
    `modulares`.`status` AS `Status`,
    `modulares`.`id` AS `Id_proyecto`,
    `modulares`.`Titulo` AS `Nombre_del_Proyecto`,
    `users`.`codigo` AS `Codigo_Representante`,
    CONCAT( `users`.`name`, ' ', `users`.`apellido`) AS `Nombre_Representante`,
    `users`.`carrera` AS `Carrera_Representante`,
    `users`.`correo` AS `Correo`,
    `modulares`.`Codigo_1` AS `Codigo_2doParticipante`,
    `modulares`.`Nombre_1` AS `Nombre_2doParticipante`,
    `modulares`.`Carrera_1` AS `Carrera_2doParticipante`,
    `modulares`.`Codigo_2` AS `Codigo_3erParticipante`,
    `modulares`.`Nombre_2` AS `Nombre_3erParticipante`,
    `modulares`.`Carrera_2` AS `Carrera_3erParticipante`,
    `modulares`.`asesor_codigo_1` AS `Codigo_Asesor`,
    `modulares`.`asesor_nombre_1` AS `Nombre_Asesor`,
    `modulares`.`asesor_correo_1` AS `Correo_Asesor`,
    `modulares`.`asesor_departamento_1` AS `Dpepartamento_Asesor`,
    `modulares`.`resumen` AS `Resumen_ Proyecto`,
    `modulares`.`justificacion_m1` AS `Justificacion_Modulo1`,
    `modulares`.`justificacion_m2` AS `Justificacion_Modulo2`,
    `modulares`.`justificacion_m3` AS `Justificacion_Modulo3`
	FROM
    (
        `modulares`
    JOIN `users` ON(
            `modulares`.`id_usuario` = `users`.`id`
        )
    );"
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
