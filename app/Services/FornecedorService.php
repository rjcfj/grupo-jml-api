<?php

namespace App\Services;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorService
{
    /**
     * Cria um fornecedor com sanitização do CNPJ
     */
    public function create(array $data): Fornecedor
    {
        // sanitiza CNPJ (remove pontos, traços, barras)
        $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);

        return DB::transaction(function () use ($data) {
            return Fornecedor::create($data);
        });
    }

    /**
     * Atualiza um fornecedor
     */
    public function update(Fornecedor $fornecedor, array $data): Fornecedor
    {
        if (isset($data['cnpj'])) {
            $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);
        }

        return DB::transaction(function () use ($fornecedor, $data) {
            $fornecedor->update($data);
            return $fornecedor;
        });
    }
}
