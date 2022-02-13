<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class modulare extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'Titulo',
        'Codigo_1',
        'Nombre_1',
        'Correo_1',
        'Carrera_1',
        'Codigo_2',
        'Nombre_2',
        'Correo_2',
        'Carrera_2',
        'asesor_codigo_1',
        'asesor_nombre_1',
        'asesor_departamento_1',
        'asesor_correo_1',
        'asesor_codigo_2',
        'asesor_nombre_2',
        'asesor_departamento_2',
        'asesor_correo_2',
        'Area_de_participacion',
        'resumen',
        'justificacion_m1',
        'justificacion_m2',
        'justificacion_m3',
        'id_usuario',
        'actividad_integrantes',
        'Area_participacion',
        'status',
      ];
}
