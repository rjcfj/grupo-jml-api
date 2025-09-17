<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fornecedor;

class FornecedorFactory extends Factory
{
    protected $model = Fornecedor::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'cnpj' => $this->faker->unique()->numerify('##############'), // 14 dígitos
            'email' => $this->faker->companyEmail,
        ];
    }
}
