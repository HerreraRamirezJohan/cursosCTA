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
            'departamento'             => $this->faker->randomElement([
                                        'DEPTO. DE DERECHO PUBLICO',
                                        'LICENCIATURA EN SOCIOLOGÍA',
                                        'LICENCIATURA EN ESTUDIOS INTERNACIONALES',
                                        'DEPTO. DE DESARROLLO SOCIAL',
                                        'DEPTO. DE LENGUAS MODERNAS',
                                        'DEPTO. DE FILOSOFIA',
                                        'DEPTO. DE DERECHO PRIVADO',
                                        'DEPTO. DE HISTORIA',
                                        'DEPTO. DE LETRAS',
                                        'DEPTO. DE ESTUDIOS DE LENGUAS INDIGENAS',
                                        'DEPTO. DE ESTUDIOS POLITICOS',
                                        'DEPTO. DE ESTUDIOS DEL PACIFICO',
                                        'DEPTO. DE ESTUDIOS INTERNACIONALE',
                                        'DEPTO. DE TRABAJO SOCIAL',
                                        'LICENCIATURA EN ESCRITURA CREATIVA',
                                        'DEPTO. DE ESTUDIOS LITERARIOS',
                                        'DEPTO. DE ESTUDIOS DE LA COMUNICACION SOCIAL',
                                        'DEPTO. DE ESTUDIOS SOCIO URBANOS ',
                                        'DEPTO. DE SOCIOLOGIA',
                                        'DEPTO. DE ESTUDIOS INTERDISCIPLINARES EN CIENCIAS',
                                        'DEPTO. DE ESTUDIOS EN EDUCACION'
                                    ]),
            'alumnos_registrados'      => $this->faker->numberBetween(0, 40),
            'nivel'                    => $this->faker->randomElement(['licenciatura', 'maestria', 'doctorado']),
            'profesor'                 => $this->faker->name(),
            'codigo'                   => $this->faker->randomNumber(5),
            'ciclo'                    => $this->faker->randomElement(['2020A', '2020B', '2021A', '2021B', '2022A', '2022B', '2023A', '2023B']),
        ];
    }
}
