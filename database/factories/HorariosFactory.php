<?php

namespace Database\Factories;

use App\Models\Areas;
use App\Models\Cursos;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dia'       =>  $this->faker->randomElement(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']),
            'horario'   =>  $this->faker->randomElement(['0700-0800', '0800-9000', '0900-1000','1000-1100','1100-1200',
                                                        '1200-1300','1300-1400','1400-1500','1500-1600','1600-1700',
                                                        '1700-1800','1800-1900','1900-2000', '2000-2100']),
            'id_curso'  =>  Cursos::all()->random()->id,
            'id_area'  =>  Areas::all()->random()->id,

        ];
    }
}
