<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
      use HasFactory;

    protected $fillable = [
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'otros_nombres',
        'pais_empleo',
        'tipo_identificacion',
        'numero_identificacion',
        'correo',
        'fecha_ingreso',
        'area',
        'estado',
    ];
}
