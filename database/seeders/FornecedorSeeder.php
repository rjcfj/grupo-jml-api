<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Faker\Factory as Faker;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        foreach (range(1, 10) as $i) {
            Fornecedor::create([
                'nome' => $faker->company,
                'cnpj' => preg_replace('/\D/', '', $faker->cnpj(false)),
                'email' => $faker->companyEmail,
            ]);
        }
    }
}
