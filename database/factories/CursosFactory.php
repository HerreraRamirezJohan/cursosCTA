<?php

namespace Database\Factories;

use App\Models\Cursos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;


class CursosFactory extends Factory
{
    protected $model = Cursos::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nrc'                       => $this->faker->randomNumber(5),
            'curso_nombre'             => $this->faker->company(),
            'observaciones'            => $this->faker->paragraph(),
            'departamento'             => $this->faker->company(),
            'alumnos_registrados'      => $this->faker->numberBetween(0,40),
            'nivel'                    => $this->faker->randomElement(['licenciatura', 'maestria', 'doctorado']),
            'profesor'                 => $this->faker->name(),
            'codigo'                   => $this->faker->randomNumber(5),
            'ciclo'                    => $this->faker->randomElement(['2020', '2021' ,'2022', '2023']),
        ];
    }
}
