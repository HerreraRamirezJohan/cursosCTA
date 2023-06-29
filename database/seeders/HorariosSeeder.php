<?php

namespace Database\Seeders;
use App\Models\Areas;
use App\Models\Cursos;
use Illuminate\Database\Seeder;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $areaIds = Areas::select('id')->where(function ($query) {
            $query->where('tipo_espacio', 'Laboratorio')
                  ->orWhere('tipo_espacio', 'Aula');
        })->where('sede', 'Belenes')->where('activo', 1)->get();
                // dd($areaIds);    
        foreach ($areaIds as $areaId) {
            foreach (['lunes','martes','miercoles','jueves','viernes','sabado'] as $key => $day) {
                for($i=7; $i<=21; $i++){
                    \App\Models\HorariosNew::create([
                        'id_curso'  => Cursos::all()->random()->id,
                        'id_area' => $areaId->id,
                        'dia' => $day,
                        'hora' => $i
                    ]);
                }
            }
        }
    }
}
