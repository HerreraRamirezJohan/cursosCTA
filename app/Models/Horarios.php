<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_final',
        'id_curso',
        'id_area'
    ];

    public function cursos()
    {
        return $this->belongsTo(Cursos::class);   
    }

    public function areas()
    {
        return $this->belongsTo(Areas::class);   
    }
}
