# Atividade 02: resumo rápido

Pastas:
- `api-livros/`: API em Laravel (consumo da PokéAPI + CRUD de livros)
- `postman/`: collection para importar no Postman
- `cliente-flask/`: projeto separado em Flask que consome a API (desafio)

## Rodar tudo (3 terminais)
1. API: `cd api-livros && bash setup.sh && php artisan serve`   (Windows: `setup.bat`)
2. Postman: Import > `postman/Atividade02.postman_collection.json` > Run collection
3. Flask: `cd cliente-flask && python -m venv venv && source venv/bin/activate && pip install -r requirements.txt && python app.py`
   (Windows: `venv\Scripts\activate`) e acesse http://localhost:5000

## Checklist para a apresentação
- [ ] http://localhost:8000/api/pokemon/pikachu retorna JSON (consumo de API)
- [ ] `php artisan route:list --path=api` mostra as rotas RESTful de livros
- [ ] Postman: POST 201, POST vazio 422, GET 200, PUT 200, DELETE 204
- [ ] http://localhost:5000 lista, cria e exclui livros (desafio)
