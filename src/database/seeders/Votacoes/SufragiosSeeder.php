<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Sufragios;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;
use DateTime;
use Illuminate\Database\Seeder;

class SufragiosSeeder extends BaseSeeder
{
    protected $table = 'sufragios';
    protected $data = [
        [
            'id' => 1,
            'nome' => 'Eleições SINPROFAZ',
            'subtitulo' => 'Diretoria biênio 2023/2025',
            'descricao' => 'Votação exclusivamente por meio desta plataforma digital, até às 18h de hoje (30/06/2023). Para saber mais sobre as regras desta eleição e as chapas concorrentes acesse o Edital',
            'inicio' => '2023-01-15 04:20:00',
            'fim' => '2023-01-16 04:20:00'
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
        //Sufragios::factory()
        //    ->count(5)
        //    ->create();
    }
}
