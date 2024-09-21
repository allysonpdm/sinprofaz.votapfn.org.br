<?php

namespace Database\Seeders;

use Database\Seeders\Votacoes\{
    EstadosSeeder,
    ParticipantesSeeder,
    QuestoesSeeder,
    RespostasSeeder,
    SufragiosSeeder,
    UsersSeeder
};
use Illuminate\Database\Seeder;

class VotacaoSinprofazOrgBrFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SufragiosSeeder::class,
            QuestoesSeeder::class,
            RespostasSeeder::class,
            ParticipantesSeeder::class,
            UsersSeeder::class,
            EstadosSeeder::class
        ]);
    }
}
