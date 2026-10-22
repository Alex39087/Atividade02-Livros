<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivroRequest;
use App\Http\Resources\LivroResource;
use App\Models\Livro;

class LivroController extends Controller
{
    public function index()
    {
        return LivroResource::collection(Livro::latest()->paginate(10));
    }

    public function store(LivroRequest $request)
    {
        $livro = Livro::create($request->validated());

        return new LivroResource($livro);
    }

    public function show(Livro $livro)
    {
        return new LivroResource($livro);
    }

    public function update(LivroRequest $request, Livro $livro)
    {
        $livro->update($request->validated());

        return new LivroResource($livro);
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();

        return response()->noContent();
    }
}
