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
        'cupo',
        'activo',
        'nivel',
        'profesor',
        'codigo',
    ];

    public function horarios()
    {
        return $this->hasMany(Horarios::class,'id_curso');
    }

    public function horariosNew()
    {
        return $this->hasMany(horariosNew::class,'id_curso');
    }
    
    
}
