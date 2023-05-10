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


    // Relaciones inversas
    public function curso()
    {   
        
        return $this->belongsTo(Cursos::class,'id_curso');   
    }

    public function area()
    {
        return $this->belongsTo(Areas::class,'id_area');   
    }
}
