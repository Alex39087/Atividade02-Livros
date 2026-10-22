<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LivroApiTest extends TestCase
{
    use RefreshDatabase;

    private function criarLivro(array $dados = []): Livro
    {
        return Livro::create(array_merge([
            'titulo' => 'Dom Casmurro',
            'autor' => 'Machado de Assis',
            'ano_publicacao' => 1899,
        ], $dados));
    }

    public function test_lista_livros(): void
    {
        $this->criarLivro();

        $this->getJson('/api/livros')
            ->assertOk()
            ->assertJsonPath('data.0.titulo', 'Dom Casmurro');
    }

    public function test_cria_livro(): void
    {
        $this->postJson('/api/livros', [
            'titulo' => 'Vidas Secas',
            'autor' => 'Graciliano Ramos',
            'ano_publicacao' => 1938,
        ])->assertCreated()->assertJsonPath('data.autor', 'Graciliano Ramos');

        $this->assertDatabaseHas('livros', ['titulo' => 'Vidas Secas']);
    }

    public function test_validacao_ao_criar_livro(): void
    {
        $this->postJson('/api/livros', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['titulo', 'autor']);
    }

    public function test_mostra_livro(): void
    {
        $livro = $this->criarLivro();

        $this->getJson("/api/livros/{$livro->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $livro->id);
    }

    public function test_livro_inexistente_retorna_404(): void
    {
        $this->getJson('/api/livros/999')->assertNotFound();
    }

    public function test_atualiza_livro(): void
    {
        $livro = $this->criarLivro();

        $this->putJson("/api/livros/{$livro->id}", ['titulo' => 'Novo título'])
            ->assertOk()
            ->assertJsonPath('data.titulo', 'Novo título');
    }

    public function test_exclui_livro(): void
    {
        $livro = $this->criarLivro();

        $this->deleteJson("/api/livros/{$livro->id}")->assertNoContent();

        $this->assertDatabaseMissing('livros', ['id' => $livro->id]);
    }

    public function test_consome_pokeapi(): void
    {
        Http::fake([
            'pokeapi.co/*' => Http::response([
                'name' => 'pikachu',
                'height' => 4,
                'weight' => 60,
                'types' => [['type' => ['name' => 'electric']]],
                'sprites' => ['front_default' => 'https://exemplo.com/pikachu.png'],
            ]),
        ]);

        $this->getJson('/api/pokemon/pikachu')
            ->assertOk()
            ->assertJsonPath('nome', 'pikachu')
            ->assertJsonPath('tipos.0', 'electric');
    }

    public function test_pokemon_inexistente_retorna_404(): void
    {
        Http::fake(['pokeapi.co/*' => Http::response('Not Found', 404)]);

        $this->getJson('/api/pokemon/naoexiste')->assertNotFound();
    }
}
