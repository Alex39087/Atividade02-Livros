# Atividade 02 - Consumo e criação de API com Laravel

Projeto em Laravel que contém:

1. **Consumo de API externa**: PokéAPI (https://pokeapi.co), gratuita e sem chave, via `Http` do Laravel (`PokemonController`).
2. **API RESTful de livros**: `apiResource`, `LivroResource` (formatação da resposta), `LivroRequest` (validação), migration e model.
3. **Testes com Postman**: collection em `../postman/`.
4. **Desafio**: cliente em Flask (Python) que consome a API, em `../cliente-flask/`.

## Como executar

Requisitos: PHP 8.3+, Composer.

**Jeito rápido** (instala tudo, cria o banco e popula com 5 livros):

```bash
bash setup.sh        # no Windows: setup.bat
php artisan serve
```

**Jeito manual:**

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
php artisan migrate --seed
php artisan serve
```

Testes automáticos (CRUD, validação e consumo da PokéAPI simulado):

```bash
php artisan test
```

## Rotas (prefixo `/api`)

| Verbo | URI | Descrição |
|---|---|---|
| GET | /pokemon | Lista 10 pokémons (PokéAPI) |
| GET | /pokemon/{nome} | Detalhes de um pokémon (PokéAPI) |
| GET | /livros | Lista livros (paginado) |
| POST | /livros | Cria livro |
| GET | /livros/{id} | Mostra livro |
| PUT/PATCH | /livros/{id} | Atualiza livro |
| DELETE | /livros/{id} | Remove livro (204) |

Use sempre o header `Accept: application/json`.

## Postman
Importe `../postman/Atividade02.postman_collection.json`.

## Cliente Flask (desafio)
Com a API rodando na porta 8000:

```bash
cd ../cliente-flask
python -m venv venv && source venv/bin/activate   # Windows: venv\Scripts\activate
pip install -r requirements.txt
python app.py
```
Acesse http://localhost:5000
