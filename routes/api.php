<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\SysinfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [SysinfoController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('fornecedores', FornecedorController::class);
