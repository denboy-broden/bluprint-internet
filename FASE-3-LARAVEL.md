# FASE 3 — SETUP LARAVEL PROJECT

Status: IN PROGRESS
Durasi: 3-5 hari
Referensi: docs/architecture/SETUP-LARAVEL.md, docs/data/SCHEMA-v1.0.md
Milestone: M4 — Backend API Ready

---

## LANGKAH 3.1 — INISIALISASI LARAVEL

```bash
# Buat project
mkdir -p /workspace/rt-rw-net-api
cd /workspace/rt-rw-net-api
composer create-project laravel/laravel . 11.* --prefer-dist --no-interaction

# Verifikasi
php artisan --version  # Harus 11.x
php -v                 # Harus 8.3+
```

---

## LANGKAH 3.2 — INSTALL DEPENDENCY

```bash
composer require laravel/sanctum spatie/laravel-permission

# Untuk database
composer require doctrine/dbal  # Untuk migration
```

---

## LANGKAH 3.3 — KONFIGURASI .ENV

Salin dari `.env.example` dan edit:

```
APP_NAME="RT/RW Net API"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rt_rw_net
DB_USERNAME=root
DB_PASSWORD=secret

REDIS_HOST=localhost
REDIS_PORT=6379

SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:8000
```

---

## LANGKAH 3.4 — SETUP SANCTUM & RBAC

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

---

## LANGKAH 3.5 — SETUP DATABASE (Jika belum)

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rt_rw_net;"
php artisan migrate
```

---

## LANGKAH 3.6 — BUAT FOLDER STRUCTURE

```bash
mkdir -p app/Services
mkdir -p app/Repositories
mkdir -p app/Actions
mkdir -p app/Http/Controllers/Api/V1
mkdir -p app/Http/Middleware
mkdir -p app/Http/Requests
mkdir -p app/Http/Resources
```

---

## LANGKAH 3.7 — TEST KONEKSI

```bash
# Jalankan server
php artisan serve

# Di terminal lain, test:
curl http://localhost:8000/api/test
```

---

## STATUS UPDATE (PROGRESS-STATUS.md)

```
Week: 3
Phase: 3 (Laravel Setup)
Status: 🟢 IN PROGRESS
Completed: Laravel installed, Sanctum + Spatie installed, .env configured
In Progress: Folder structure, database connection
Blocked: None
Next: Customer Module (Migration + Model + Controller)
```

---

## REFERENSI

- docs/architecture/SETUP-LARAVEL.md
- ROADMAP.md (Phase 4: Business API)
- TASK-TRACKING.md (T05, T06, T07, T08)
- MASTER-BLUEPRINT.md
