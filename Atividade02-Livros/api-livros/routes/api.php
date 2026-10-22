<?php

use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\PokemonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Consumo de API externa (PokéAPI)
Route::get('/pokemon', [PokemonController::class, 'index']);
Route::get('/pokemon/{nome}', [PokemonController::class, 'show']);

// API RESTful de livros
Route::apiResource('livros', LivroController::class);
