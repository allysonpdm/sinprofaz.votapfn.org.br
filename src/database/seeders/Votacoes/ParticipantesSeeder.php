<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Sufragios;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;
use DateTime;
use Illuminate\Database\Seeder;

class ParticipantesSeeder extends BaseSeeder
{
    protected $table = 'participantes';
    protected $data = [];
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
