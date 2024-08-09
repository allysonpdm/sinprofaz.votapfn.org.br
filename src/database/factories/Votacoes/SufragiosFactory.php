<?php

namespace Database\Factories\Votacoes;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Votacoes\Sufragios;

class SufragiosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sufragios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'inicio' => $this->faker->date('Y-m-d') . " " . $this->faker->time('H:i:s'),
            'fim' => $this->faker->date('Y-m-d') . " " . $this->faker->time('H:i:s')
        ];
    }
}
