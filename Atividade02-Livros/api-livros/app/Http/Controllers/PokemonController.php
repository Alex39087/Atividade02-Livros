<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

/**
 * Consumo da PokéAPI (https://pokeapi.co), gratuita e sem chave.
 */
class PokemonController extends Controller
{
    private const BASE_URL = 'https://pokeapi.co/api/v2';

    public function index(): JsonResponse
    {
        $resposta = Http::acceptJson()->timeout(10)->get(self::BASE_URL . '/pokemon', ['limit' => 10]);

        if ($resposta->failed()) {
            return response()->json(['erro' => 'Falha ao buscar dados externos'], 502);
        }

        return response()->json([
            'status' => 'sucesso',
            'total'  => $resposta->json('count'),
            'dados'  => collect($resposta->json('results'))->pluck('name'),
        ]);
    }

    public function show(string $nome): JsonResponse
    {
        $resposta = Http::acceptJson()->timeout(10)->get(self::BASE_URL . '/pokemon/' . strtolower($nome));

        if ($resposta->status() === 404) {
            return response()->json(['erro' => 'Pokémon não encontrado'], 404);
        }

        if ($resposta->failed()) {
            return response()->json(['erro' => 'Falha ao buscar dados externos'], 502);
        }

        $d = $resposta->json();

        return response()->json([
            'nome'   => $d['name'],
            'altura' => $d['height'],
            'peso'   => $d['weight'],
            'tipos'  => collect($d['types'])->pluck('type.name'),
            'imagem' => $d['sprites']['front_default'],
        ]);
    }
}
