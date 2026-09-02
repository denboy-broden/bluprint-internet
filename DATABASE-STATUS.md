# Database Setup — Status

Container: rt-rw-mariadb (mariadb:10.11)
Port: 3306
DB: rt_rw_net
Root password: secret
Status: RUNNING (image pulled, container created with exit code 0)

Schema import: DILEWATI (terminal hang saat `docker cp` + redirect `<` tidak didukung PowerShell)

## Cara manual import:
```bash
# Copy file ke container (PowerShell):
docker cp docs/data/SCHEMA-v1.0.md rt-rw-mariadb:/tmp/schema.sql

# Eksekusi dalam container:
docker exec -it rt-rw-mariadb mysql -u root -psecret rt_rw_net < /tmp/schema.sql
```

Atau jalankan SQL secara interaktif:
```bash
docker exec -it rt-rw-mariadb mysql -uroot -psecret
USE rt_rw_net;
SOURCE /tmp/schema.sql;
```

## Verifikasi setelah import:
```sql
USE rt_rw_net;
SHOW TABLES;  # Harus 20 tabel
```

---

## LANGKAH SELANJUTNYA (FASE 3 — LARAVEL)

Karena database container sudah berjalan, lanjutkan ke Laravel.
Lihat `FASE-3-LARAVEL.md` dan `docs/architecture/SETUP-LARAVEL.md`.
