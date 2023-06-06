<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;


    public function horarios()
    {
        return $this->hasMany(Horarios::class,'id_area');
    }
}
