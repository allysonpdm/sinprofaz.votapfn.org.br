<?php

namespace Database\Seeders\Votacoes;

use App\Models\Votacoes\Sufragios;
use ArchCrudLaravel\Database\Seeders\BaseSeeder;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends BaseSeeder
{
    protected $table = 'users';
    protected $data = [];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data = [
            ['name' => 'Allyson','email' => 'allyson@livreiniciativa.com','email_verified_at' => NULL,'password' => '$2y$10$Gx2iQANrEJARAWqH/oxwiucp52zN95VX3sy8OIiUNDorYI/pcuUxW']
        ];
        parent::run();
        //Sufragios::factory()
        //    ->count(5)
        //    ->create();
    }
}
