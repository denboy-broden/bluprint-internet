# Setup Laravel — Phase 1 Implementation Guide

Tutorial lengkap untuk memulai backend Laravel + MariaDB.

## Commands

```bash
composer create-project laravel/laravel api 11.*
cd api
composer require laravel/sanctum spatie/laravel-permission
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
cp .env.example .env
```

## Key Settings (.env)

DB_DATABASE=rt_rw_net
DB_USERNAME=root
DB_PASSWORD=secret
DB_HOST=localhost

## First Migration

php artisan migrate

## First API Endpoint (Customer)

Route::get('/customers', [CustomerController::class, 'index']);

## References
- docs/data/SCHEMA-v1.0.md
- docs/domains/DOMAIN-MODEL.md
- docs/security/SECURITY-ARCHITECTURE.md
- ROADMAP.md
- MASTER-BLUEPRINT.md
