# Status — 2026-09-02 06:00

## CONTAINERS (docker-compose up -d berhasil)
- ✅ rt-rw-redis
- ✅ blueprint-mariadb-1 (BARU, port 3306)
- ✅ rt-rw-api (Laravel image)

## PENTING — DATA TABLES
Container lama `6f03f5ac8e66` (dengan 28 tabel) sudah dihapus!
**Container baru `blueprint-mariadb-1` masih KOSONG** (perlu re-import schema).

## LANGKAH VERIFIKASI DAN RE-IMPORT

```powershell
# 1. Verifikasi container baru
docker exec blueprint-mariadb-1 mysql -u root -psecret -e "SHOW DATABASES;"

# 2. Jika database rt_rw_net belum ada, copy & import schema
docker cp docs/data/SCHEMA-v1.0.md blueprint-mariadb-1:/tmp/schema.sql
docker exec -i blueprint-mariadb-1 mysql -u root -psecret rt_rw_net < docs/data/SCHEMA-v1.0.md

# 3. Verifikasi 28 tabel
docker exec blueprint-mariadb-1 mysql -u root -psecret rt_rw_net -e "SHOW TABLES;"
```

## JALANKAN LARAVEL
```powershell
# Cek container status
docker ps

# Masuk ke container Laravel dan install dependencies
docker exec -it rt-rw-api sh
cd /var/www/html
composer install --ignore-platform-reqs
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8000
```

## TEST API
```powershell
curl http://localhost:8000/api/v1/health
```
