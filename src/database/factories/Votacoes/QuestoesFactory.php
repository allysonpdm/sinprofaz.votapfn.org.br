<?php

namespace Database\Factories\Votacoes;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Votacoes\Questoes;
use App\Models\Votacoes\Sufragios;

class QuestoesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questoes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sufragioId' => Sufragios::all()->random()->id,
            'label' => $this->faker->realTextBetween(3, 255),
            'complemento' => $this->faker->realTextBetween(30, 255),
        ];
    }
}
