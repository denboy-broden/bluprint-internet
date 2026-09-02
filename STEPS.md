# LANGKAH IMPLEMENTASI BERURUTAN — RT/RW Net

> Dokumen ini adalah panduan langkah demi langkah dari nol sampai produksi.
> Setiap langkah harus selesai sebelum lanjut ke langkah berikutnya.
> Update file `PROGRESS-STATUS.md` setiap minggu.

---

## FASE 1 — PERSIAPAN (Minggu 1)

### Langkah 1.1: Baca Blueprint
- [ ] Baca `MASTER-BLUEPRINT.md` (ringkasan)
- [ ] Baca `01-BUSINESS-BLUEPRINT.md` (struktur bisnis)
- [ ] Baca `02-STRUKTUR-AGENT.md` (13 agent)
- [ ] Konfirmasi dengan Owner: struktur organisasi, 5 divisi utama

### Langkah 1.2: Formasi Tim
- [ ] Tentukan: Backend Lead, AI Lead, DevOps, Business Analyst
- [ ] Buat group chat (WhatsApp/Telegram/Slack)
- [ ] Jadwalkan meeting harian 9 AM (standup)

### Langkah 1.3: Keputusan Owner (PENTING!)
- [ ] DEC-001: Payment Gateway (Midtrans / Duniebl / lain)
- [ ] DEC-002: AI Network Authority (L2 recommend / L4 execute with approval)
- [ ] DEC-003: Accounting Standard (PSAK / GAAP)
- [ ] DEC-005: Warehouse Strategy (Central / Distributed / Hybrid)

---

## FASE 2 — DATABASE (Minggu 2)

### Langkah 2.1: Setup MariaDB
- [ ] Install MariaDB 10.11 (Docker atau server)
- [ ] Buat database `rt_rw_net`
- [ ] Import schema dari `docs/data/SCHEMA-v1.0.md`
- [ ] Verifikasi semua 20 tabel + index + foreign keys

### Langkah 2.2: ERD Review
- [ ] Buat diagram ERD (draw.io / Lucidchart)
- [ ] Verifikasi relasi: customers → services → invoices → payments
- [ ] Verifikasi: customers → tickets → work_orders → technicians
- [ ] Konfirmasi data ownership (dari `SYSTEM-OF-RECORD.md`)

---

## FASE 3 — BACKEND API (Minggu 3-4)

### Langkah 3.1: Setup Laravel
- [ ] `composer create-project laravel/laravel api`
- [ ] `composer require laravel/sanctum spatie/laravel-permission`
- [ ] Konfigurasi `.env` (DB: rt_rw_net)
- [ ] `php artisan migrate`
- [ ] Setup `routes/api.php`

### Langkah 3.2: Modul Customer (VERTICAL SLICE)
- [ ] Buat model: `Customer`, `Service`, `Package`
- [ ] Buat migration untuk 3 tabel
- [ ] Buat controller: `CustomerController`
- [ ] Buat service: `CustomerService`
- [ ] Buat API endpoint:
  - `GET /api/v1/customers`
  - `POST /api/v1/customers`
  - `GET /api/v1/customers/{id}`
- [ ] Test dengan Postman / curl

### Langkah 3.3: Auth & RBAC
- [ ] Setup Sanctum login
- [ ] Buat roles: Owner, GM, Admin, CS, Tech, Finance
- [ ] Buat middleware `role:Admin`
- [ ] Test akses dengan token berbeda

---

## FASE 4 — WEB APP (Minggu 5-6)

### Langkah 4.1: Setup Next.js
- [ ] `npx create-next-app@latest web --typescript`
- [ ] Setup Tailwind, Zustand, React Query
- [ ] Buat halaman Login
- [ ] Konfigurasi API base URL

### Langkah 4.2: Dashboard Dasar
- [ ] Halaman Dashboard (data dari backend)
- [ ] Menu Customer (daftar, detail)
- [ ] Menu Billing (invoice, pembayaran)
- [ ] Menu Ticket (status, prioritas)

---

## FASE 5 — INTEGRASI JARINGAN (Minggu 7-8)

### Langkah 5.1: MikroTik
- [ ] Setup API RouterOS
- [ ] Test: get active PPPoE
- [ ] Test: disable/enable user
- [ ] Integrasi dengan modul Service (auto-suspend saat bill overdue)

### Langkah 5.2: Monitoring
- [ ] Setup Prometheus (monitor router, OLT)
- [ ] Setup Grafana dashboard
- [ ] Setup alert rules (packet loss > 5%, uptime < 99%)

---

## FASE 6 — AI AGENT PERTAMA (Minggu 9-10)

### Langkah 6.1: Setup Python
- [ ] `python -m venv venv`
- [ ] `pip install openai-agents fastapi`
- [ ] Setup file agen pertama: `agents/cs_agent.py`
- [ ] Definisikan PURPOSE, RESPONSIBILITIES, TOOLS, PERMISSION

### Langkah 6.2: Test Agent
- [ ] Test prompt: "Internet saya mati, CUST-001"
- [ ] Agent harus bisa:baca data dari backend → jawab → buat ticket → notifikasi
- [ ] Namun: **Agent belum perlu backend real dulu** — bisa pakai mock data
- [ ] Setelah berhasil → hubungkan ke real API

---

## FASE 7 — PRODUKSI (Minggu 11-12)

### Langkah 7.1: Soft Launch
- [ ] Deploy ke server produksi (Docker)
- [ ] Uji 1 area kecil (50 pelanggan)
- [ ] Monitor 24 jam pertama
- [ ] Perbaiki bug

### Langkah 7.2: Full Launch
- [ ] Roll out semua area
- [ ] On-call rotation aktif
- [ ] Dokumentasi final (SOP, user manual)

---

## STATUS UPDATE FORMAT (Setiap Minggu)

Simpan ke `PROGRESS-STATUS.md`:

```
Week: 3
Phase: 3 (Backend)
Status: 🟢 ON TRACK
Completed: Customer Module, Auth
In Progress: Service Module
Blocked: None
Next: Service Module + DB Migration
```

---

*Dokumen ini adalah panduan praktis. Setiap langkah harus selesai sebelum lanjut. Update STATUS setiap minggu.*
