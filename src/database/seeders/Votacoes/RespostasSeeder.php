<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Respostas;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;
use Illuminate\Database\Seeder;

class RespostasSeeder extends BaseSeeder
{
    protected $table = 'respostas';
    protected $data = [
        [
            'id' => 1,
            'questaoId' => 1,
            'label' => 'Chapa 1: Nome da Chapa',
        ],
        [
            'id' => 2,
            'questaoId' => 1,
            'label' => 'Chapa 2: Nome da Chapa',
        ],
        [
            'id' => 3,
            'questaoId' => 1,
            'label' => 'Branco',
        ],
        [
            'id' => 4,
            'questaoId' => 1,
            'label' => 'Nulo',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
        //Respostas::factory()
        //    ->count(5)
        //    ->create();
    }
}
