<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\FornecedorRequest;
use App\Services\FornecedorService;

class FornecedorController extends Controller
{

    use ApiResponse;

    protected $service;

    public function __construct(FornecedorService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Pega o filtro do query string
        $nome = $request->query('nome');

        // Monta query
        $query = Fornecedor::query();

        if ($nome) {
            $query->where('nome', 'like', "%{$nome}%");
        }

        // ordena por created_at ascendente
        $query->orderBy('created_at', 'desc');

        // Pega todos os resultados (pode paginar depois)
        $fornecedores = $query->get();
        return  $this->successResponse($fornecedores, 'Lista de fornecedores com sucesso.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FornecedorRequest $request)
    {
        $fornecedor = $this->service->create($request->only(['nome', 'cnpj', 'email']));
        return $this->successResponse($fornecedor, 'Fornecedor criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $fornecedor = Fornecedor::findOrFail($id);

        if (!$fornecedor) {
            return $this->errorResponse('Fornecedor não encontrado.', 404);
        }

        return $this->successResponse($fornecedor, 'Fornecedor encontrado.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FornecedorRequest $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        if (!$fornecedor) {
            return $this->errorResponse('Fornecedor não encontrado', 404);
        }

        $fornecedor = $this->service->update($fornecedor, $request->only(['nome', 'cnpj', 'email']));
        return $this->successResponse($fornecedor, 'Fornecedor atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::destroy($id);
        return $this->successResponse('Fornecedor excluída com sucesso.');
    }
}
