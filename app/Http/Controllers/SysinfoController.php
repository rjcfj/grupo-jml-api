<?php

namespace App\Http\Controllers;

class SysinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtendo os metadados
        return response()->json([
            'company' => 'Grupo JML',
            'project' => 'Gerenciamento de Fornecedor - Backend',
            'version' => '1.0.0',
            'license' => 'MIT',
            'author' => [
                'name' => 'Ricardo Junior',
                'email' => 'ricardojcfj@gmail.com'
            ]
        ]);
    }
}
