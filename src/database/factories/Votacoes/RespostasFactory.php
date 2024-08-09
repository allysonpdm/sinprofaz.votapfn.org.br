<?php

namespace Database\Factories\Votacoes;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Votacoes\Respostas;
use App\Models\Votacoes\Questoes;

class RespostasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Respostas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'questaoId' => Questoes::all()->random(1)->first()->id,
            'label' => $this->faker->realTextBetween(30, 180),
        ];
    }
}
