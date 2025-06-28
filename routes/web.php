<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompraController;

Route::get('/', [CompraController::class, 'dashboard']);
Route::get('/compras/nova', [CompraController::class, 'create']);
Route::post('/compras', [CompraController::class, 'store']);
