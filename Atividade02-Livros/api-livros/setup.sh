#!/usr/bin/env bash
# Prepara o projeto: dependências, .env, chave, banco SQLite, migrations e dados de exemplo.
set -e
composer install
[ -f .env ] || cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed --force
echo ""
echo "Tudo pronto! Para iniciar: php artisan serve"
