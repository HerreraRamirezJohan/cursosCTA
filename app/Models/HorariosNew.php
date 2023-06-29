<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosNew extends Model
{
    use HasFactory;

    protected $fillable = ['id_curso', 'id_area','dia', 'hora', 'status'];


    
    public function curso()
    {   
        
        return $this->belongsTo(Cursos::class,'id_curso');   
    }

    public function area()
    {
        return $this->belongsTo(Areas::class,'id_area');   
    }

}
