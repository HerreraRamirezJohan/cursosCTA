<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrc',
        'curso_nombre',
        'ciclo',
        'observaciones',
        'departamento',
        'alumnos_registrados',
        'activo',
        'nivel',
        'profesor',
        'codigo',
    ];
    
}
