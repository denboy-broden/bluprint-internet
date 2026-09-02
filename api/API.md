# RT/RW Net AI-Powered Business Operating System

## Sistem Backend API

### Arsitektur

| Komponen | Teknologi | Port |
|----------|-----------|------|
| Backend API | Laravel 11 + PHP 8.3 | 8001 |
| Database | MariaDB 10.11 | 3306 |
| Cache/Queue | Redis 7-alpine | 6379 |

### Endpoint API

#### Base URL
```
http://localhost:8001/api
```

---

## Endpoints

### 1. Health Check
```bash
GET /api/health
```
**Response (200):**
```json
{"status":"ok","service":"rt-rw-net-api"}
```

---

### 2. Customers (Pelanggan)

#### List Semua Customer
```bash
GET /api/customers
```

#### Lihat Customer Spesifik
```bash
GET /api/customers/{id}
```

#### Tambah Customer Baru
```bash
POST /api/customers
Content-Type: application/json

{
  "name": "Budi Santoso",
  "email": "budi@rt01.net",
  "phone": "081234567890",
  "address": "Jl. Merdeka No.1, RT01 RW05",
  "identity_number": "1234567890123456",
  "identity_type": "KTP",
  "status": "active",
  "package_id": 1
}
```

#### Update Customer
```bash
PUT /api/customers/{id}
Content-Type: application/json

{
  "name": "Budi Santoso Updated",
  "status": "inactive"
}
```

#### Hapus Customer
```bash
DELETE /api/customers/{id}
```

---

### 3. Services (Layanan)

#### List Semua Service
```bash
GET /api/services
```

#### Lihat Service Spesifik
```bash
GET /api/services/{id}
```

#### Tambah Service Baru
```bash
POST /api/services
Content-Type: application/json

{
  "name": "Internet 50Mbps",
  "description": "Paketan internet rumah 50Mbps unlimited",
  "price": 150000,
  "duration_days": 30,
  "speed_mbps": 50,
  "category": "internet",
  "is_active": true
}
```

#### Update Service
```bash
PUT /api/services/{id}
Content-Type: application/json

{
  "price": 175000
}
```

#### Hapus Service
```bash
DELETE /api/services/{id}
```

---

### 4. Tickets (Tiket Support)

#### List Semua Ticket
```bash
GET /api/tickets
```

#### Lihat Ticket Spesifik
```bash
GET /api/tickets/{id}
```

#### Tambah Ticket Baru
```bash
POST /api/tickets
Content-Type: application/json

{
  "customer_id": 1,
  "subject": "Internet lambat",
  "description": "Koneksi internet sering terputus sejak pagi",
  "category": "internet",
  "priority": "high",
  "status": "open"
}
```

#### Update Ticket
```bash
PUT /api/tickets/{id}
Content-Type: application/json

{
  "status": "in_progress",
  "technician_id": 1
}
```

#### Hapus Ticket
```bash
DELETE /api/tickets/{id}
```

---

## Database Schema

### Tables
- `customers` - Data pelanggan
- `services` - Paket layanan (internet, TV, dll)
- `tickets` - Tiket support/pengaduan
- `packages` - Paket langganan
- `payments` - Pembayaran
- `invoices` - Invoice tagihan
- `employees` - Data karyawan/teknisi
- `technicians` - Data teknisi
- `products` - Produk/barang
- `suppliers` - Supplier
- `purchase_orders` - Purchase order
- `stock` - Stok barang
- `warehouses` - Gudang
- `olts` - OLT devices
- `onts` - ONT devices
- `routers` - Router devices
- `pops` - POP/AP locations
- `incidents` - Incident reports
- `work_orders` - Work orders
- `audit_logs` - Audit log
- `bank_accounts` - Rekening bank
- `chart_of_accounts` - Chart of accounts
- `cash_transactions` - Transaksi kas
- `journal_entries` - Jurnal umum
- `journal_line_items` - Line item jurnal
- `campaigns` - Marketing campaigns
- `leads` - Sales leads
- `assets` - Asset/peralatan

---

## Cara Menjalankan

### 1. Build & Run
```bash
docker-compose up -d --build
```

### 2. Jalankan Server Laravel
```bash
docker exec rt-rw-api php artisan serve --host=0.0.0.0 --port=8001
```

### 3. Seeding Data Sample
```bash
docker exec rt-rw-api php artisan db:seed --class=RTNETSeeder
```

### 4. Verifikasi
```bash
curl http://localhost:8001/api/health
```

---

## Environment Variables (.env)

```env
APP_NAME="RT/RW Net API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8001

DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=rt_rw_net
DB_USERNAME=root
DB_PASSWORD=secret

SESSION_DRIVER=file
CACHE_STORE=file

REDIS_HOST=redis
REDIS_PORT=6379
```

---

## Error Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 204 | No Content (Deleted) |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Internal Server Error |

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 11 + PHP 8.3 |
| Database | MariaDB 10.11 |
| Cache | Redis 7-alpine |
| Container | Docker |
| API Format | JSON REST |

---

**Last Updated**: 2026-09-02
**Version**: 0.1.0
