<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Areas;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */ 
    public function run()
    {

        // \App\Models\Cursos::factory(500)->create();
        // \App\Models\Horarios::factory(500)->create();
        // \App\Models\User::create([
        //     'name' => 'Administrador',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('50p0rt3')
        // ]);

        $areaIds = Areas::select('id')->where(function ($query) {
            $query->where('tipo_espacio', 'Laboratorio')
                  ->orWhere('tipo_espacio', 'Aula');
        })->where('sede', 'Belenes')->where('activo', 1)->get();
                // dd($areaIds);
        foreach ($areaIds as $areaId) {
            foreach (['lunes','martes','miercoles','jueves','viernes','sabado'] as $key => $day) {
                for($i=7; $i<=21; $i++){
                    \App\Models\HorariosNew::create([
                        'id_area' => $areaId->id,
                        'dia' => $day,
                        'hora' => $i
                    ]);
                }
            }
        }
    }
}
