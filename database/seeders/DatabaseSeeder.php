<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Fornecedor::count() == 0) {
            $this->call([FornecedorSeeder::class]);
        }
    }
}
