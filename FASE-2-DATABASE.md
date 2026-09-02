# FASE 2 — DATABASE SETUP (Minggu 2)

Status: IN PROGRESS
Target: Setup MariaDB + jalankan schema SQL

---

## LANGKAH 2.1: Setup MariaDB

```bash
# Jika belum terinstall:
sudo apt install mariadb-server  # Linux
# atau
brew install mariadb             # Mac
# atau
# Download MariaDB 10.11 dari mariadb.org (Windows)

# Start service:
sudo service mariadb start
# atau
brew services start mariadb

# Login sebagai root:
mysql -u root -p

# Buat database (perintah SQL):
CREATE DATABASE IF NOT EXISTS rt_rw_net CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Verifikasi:
USE rt_rw_net;
SHOW TABLES;  # Harus kosong (baru dibuat)

# Buat user aplikasi (opsional tapi disarankan):
CREATE USER IF NOT EXISTS 'rt_rw_app'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON rt_rw_net.* TO 'rt_rw_app'@'localhost';
FLUSH PRIVILEGES;
```

---

## LANGKAH 2.2: Jalankan Schema SQL

```bash
# Dari folder workspace:
mysql -u root -p rt_rw_net < docs/data/SCHEMA-v1.0.md

# Atau jika menggunakan mysql client interaktif:
# 1. Buka mysql -u root -p rt_rw_net
# 2. Copy-paste isi file SCHEMA-v1.0.md ke terminal
# 3. Tunggu "Query OK" untuk setiap tabel

# Verifikasi berhasil:
USE rt_rw_net;
SHOW TABLES;
# Harus muncul 20 tabel: customers, services, packages, invoices, payments, pops, olts, routers, onts, tickets, incidents, work_orders, technicians, products, warehouses, stock, suppliers, purchase_orders, assets, bank_accounts, cash_transactions, chart_of_accounts, journal_entries, journal_line_items, employees, audit_logs
```

---

## LANGKAH 2.3: Verifikasi Data Integrity

```sql
-- Cek jumlah tabel
SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'rt_rw_net';
-- Harus: ~20

-- Cek foreign keys
SELECT TABLE_NAME, CONSTRAINT_NAME FROM information_schema.table_constraints WHERE constraint_type = 'FOREIGN KEY' AND table_schema = 'rt_rw_net';

-- Cek index
SELECT TABLE_NAME, INDEX_NAME FROM information_schema.statistics WHERE table_schema = 'rt_rw_net';
```

---

## LANGKAH 2.4: Dokumentasi Status

Update `PROGRESS-STATUS.md`:

```
Week: 2
Phase: 2 (Database Setup)
Status: 🟢 ON TRACK
Completed: MariaDB installed, rt_rw_net database created, 20 tables created
In Progress: Schema verification
Blocked: None
Next: Phase 3 — Laravel Setup
```

---

## KESELARASAN DENGAN BLUEPRINT

Schema ini berdasarkan:
- `docs/data/SCHEMA-v1.0.md` — SQL lengkap
- `docs/domains/DOMAIN-MODEL.md` — entity relationships
- `docs/data/SYSTEM-OF-RECORD.md` — data ownership rules
- `docs/01-BUSINESS-BLUEPRINT.md` — business structure
- `docs/security/SECURITY-ARCHITECTURE.md` — audit table design

---

## CATATAN

Jika MariaDB belum terinstall atau bermasalah, alternatif sementara:
- Gunakan Docker: `docker run -d -p 3306:3306 --name mariadb -e MYSQL_ROOT_PASSWORD=secret mariadb:10.11`
- Atau gunakan SQLite untuk development awal (tapi mariadb wajib untuk produksi)

---

## LANGKAH BERIKUTNYA (Setelah DB Selesai)

**Fase 3: Setup Laravel** — lihat `SETUP-LARAVEL.md`
Perintah utama: `composer create-project laravel/laravel api 11.*`
