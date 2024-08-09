<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Questoes;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;

class QuestoesSeeder extends BaseSeeder
{
    protected $table = 'questoes';
    protected $data = [
        [
            'id' => 1,
            'sufragioId' => 1,
            'label' => 'Eleições SINPROFAZ – Diretoria triênio 2023/2025',
            'complemento' => null,
            'limiteEscolhas' => 1
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
        //Questoes::factory()
        //    ->count(5)
        //    ->create();
    }
}
