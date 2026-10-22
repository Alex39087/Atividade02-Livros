@echo off
call composer install
if not exist .env copy .env.example .env
php artisan key:generate
if not exist database\database.sqlite type nul > database\database.sqlite
php artisan migrate --seed --force
echo.
echo Tudo pronto! Para iniciar: php artisan serve
