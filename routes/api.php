<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;

Route::post('/login', [AutenticacionController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductosController::class);
    Route::apiResource('users', UsuariosController::class);
});