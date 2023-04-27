<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    // public function scopeCicloYNombre($query, $nombre, $ciclo)
    // {   
    //     if($nombre){
    //         return $query->where('curso_nombre', 'LIKE' , "%$nombre%");
    //     }
    // }
    
}
