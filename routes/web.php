<?php

use App\Http\Controllers\SysinfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SysinfoController::class, 'index']);
