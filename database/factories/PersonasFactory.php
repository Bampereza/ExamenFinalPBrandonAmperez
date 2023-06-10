<?php

namespace Database\Factories;
use App\Models\personas;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonasFactory extends Factory
{
    protected $personas=Personas::class;

    public function definition()
    {
        return [
            'nombre'=>$this->faker->text(5),
            'paterno'=>$this->faker->text(5),
            'materno'=>$this->faker->text(5),
            'fecha_nacimiento'=>$this->faker->date('Y-m-d'),

        ];
    }
}
