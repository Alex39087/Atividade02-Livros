<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    public function run(): void
    {
        $livros = [
            ['titulo' => 'Dom Casmurro',          'autor' => 'Machado de Assis',  'ano_publicacao' => 1899],
            ['titulo' => 'Memórias Póstumas de Brás Cubas', 'autor' => 'Machado de Assis', 'ano_publicacao' => 1881],
            ['titulo' => 'Grande Sertão: Veredas', 'autor' => 'Guimarães Rosa',    'ano_publicacao' => 1956],
            ['titulo' => 'Vidas Secas',           'autor' => 'Graciliano Ramos',  'ano_publicacao' => 1938],
            ['titulo' => 'O Cortiço',             'autor' => 'Aluísio Azevedo',   'ano_publicacao' => 1890],
        ];

        foreach ($livros as $livro) {
            Livro::firstOrCreate(['titulo' => $livro['titulo']], $livro);
        }
    }
}
