<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Questoes;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;

class EstadosSeeder extends BaseSeeder
{
    protected $table = 'estados';
    protected $data = [
        ['uf' => 'AC', 'nome' => 'Acre'],
        ['uf' => 'AL', 'nome' => 'Alagoas'],
        ['uf' => 'AP', 'nome' => 'Amapá'],
        ['uf' => 'AM', 'nome' => 'Amazonas'],
        ['uf' => 'BA', 'nome' => 'Bahia'],
        ['uf' => 'CE', 'nome' => 'Ceará'],
        ['uf' => 'DF', 'nome' => 'Distrito Federal'],
        ['uf' => 'ES', 'nome' => 'Espírito Santo'],
        ['uf' => 'GO', 'nome' => 'Goiás'],
        ['uf' => 'MA', 'nome' => 'Maranhão'],
        ['uf' => 'MT', 'nome' => 'Mato Grosso'],
        ['uf' => 'MS', 'nome' => 'Mato Grosso do Sul'],
        ['uf' => 'MG', 'nome' => 'Minas Gerais'],
        ['uf' => 'PA', 'nome' => 'Pará'],
        ['uf' => 'PB', 'nome' => 'Paraíba'],
        ['uf' => 'PR', 'nome' => 'Paraná'],
        ['uf' => 'PE', 'nome' => 'Pernambuco'],
        ['uf' => 'PI', 'nome' => 'Piauí'],
        ['uf' => 'RJ', 'nome' => 'Rio de Janeiro'],
        ['uf' => 'RN', 'nome' => 'Rio Grande do Norte'],
        ['uf' => 'RS', 'nome' => 'Rio Grande do Sul'],
        ['uf' => 'RO', 'nome' => 'Rondônia'],
        ['uf' => 'RR', 'nome' => 'Roraima'],
        ['uf' => 'SC', 'nome' => 'Santa Catarina'],
        ['uf' => 'SP', 'nome' => 'São Paulo'],
        ['uf' => 'SE', 'nome' => 'Sergipe'],
        ['uf' => 'TO', 'nome' => 'Tocantins'],
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
