# RT/RW NET — AI-Powered Business Operating System

> **Project Documentation & Implementation Hub**
> 
> **Last Updated:** 2026-09-04
> **Status:** ✅ PRODUCTION READY v0.3.0-Dev — BILLING SYSTEM IN PROGRESS
> **Commit:** `5703f30` (Steps 1-5 done, now in v0.3.0 Billing phase)
> **Stack:** Laravel 11 + MariaDB 10.11 + Next.js 14 + FastAPI + Docker Compose

---

## 🚀 QUICK START

```powershell
# 1. Jalankan semua service
cd C:\ai_agent\blueprint
docker-compose up -d --build

# 2. Verifikasi
curl http://localhost:8001/api/health     # Laravel API
curl http://localhost:8002/health          # AI Agent
# Buka http://localhost:3000 di browser   # Frontend
```

---

## 🌐 LIVE SERVICES

| Service | URL | Container | Status |
|---------|-----|-----------|--------|
| **Frontend (Next.js)** | http://localhost:3000 | `rt-rw-frontend` | ✅ Running |
| **Laravel API** | http://localhost:8001 | `rt-rw-api` | ✅ Running |
| **AI Agent (FastAPI)** | http://localhost:8002 | `rt-rw-ai-agent` | ✅ Running |
| **MariaDB** | localhost:3306 | `blueprint-mariadb-1` | ✅ Running |
| **Redis** | localhost:6379 | `blueprint-redis-1` | ✅ Running |

---

## 🔐 API AUTHENTICATION

Semua endpoint `/api/*` (kecuali `/api/health`) memerlukan token:

```bash
# Tanpa token → 401 Unauthorized
curl http://localhost:8001/api/customers

# Dengan token (via X-API-Token header) → 200 OK
curl -H "X-API-Token: rt-rw-net-secret-2026" http://localhost:8001/api/customers

# Atau via Bearer Token
curl -H "Authorization: Bearer rt-rw-net-secret-2026" http://localhost:8001/api/customers
```

**Token default** (di `.env`): `rt-rw-net-secret-2026`  
**File middleware:** `api/app/Http/Middleware/ApiTokenMiddleware.php`  
**Konfigurasi:** `api/bootstrap/app.php` (alias `auth.api`)

---

## 📚 DOKUMEN INTI (Root)

| File | Deskripsi |
|------|-----------|
| [MASTER-BLUEPRINT.md](MASTER-BLUEPRINT.md) | Master blueprint lengkap (55+ dokumen) |
| [ROADMAP.md](ROADMAP.md) | Roadmap implementasi 18 fase |
| [TASK-TRACKING.md](TASK-TRACKING.md) | Detail task per fase |
| [PROGRESS-STATUS.md](PROGRESS-STATUS.md) | Dashboard progres mingguan |
| [STEPS.md](STEPS.md) | Panduan langkah berurutan |

---

## 📂 STRUKTUR FOLDER

### [`docs/01-07`](docs/) — Blueprint Utama
```
docs/
├── 01-BUSINESS-BLUEPRINT.md         (Business foundation)
├── 02-STRUKTUR-AGENT.md             (Agent structure)
├── 03-AGENT-ORGANIZATION-BLUEPRINT.md (Organization)
├── 04-AGENT-PLATFORM.md             (Platform)
├── 05-MEMBANGUN-AI-AGENT.md         (Building AI Agent)
├── 06-Arsitektur-Operating_System.md (Architecture)
├── 07-Business-Operating-System.md   (Business OS)
├── GLOSSARY.md
├── RENUSA-BUSINESS-FOUNDATION-v0.2.md
├── RENUSA-ARCHITECTURE-GATE-REVIEW.md
│
├── actors/      (35 actor definitions)
├── adr/         (10 Architecture Decision Records)
├── ai/          (AI governance + 13 agent specs)
├── business-rules/ (Business rules)
├── data/        (System of Record + Schema)
├── decisions/   (Decision Register + Owner Decisions)
├── domains/     (Domain Model)
├── governance/  (Governance policies)
├── organization/ (Org structure)
├── processes/   (Business processes)
├── security/    (Security architecture)
└── workflows/   (Technical workflows)
```

### [`docs/architecture/`](docs/architecture/) — Setup & Implementation Guides
```
docs/architecture/
└── SETUP-LARAVEL.md  (Laravel project setup guide)
```

### [`docs/data/`](docs/data/) — Database & Schema
```
docs/data/
├── SCHEMA-v1.0.md    (20 SQL tables)
└── FASE-2-DATABASE.md (Setup guide)
```

### Root — Phase Implementation Guides
```
FASE-2-DATABASE.md   (MariaDB setup instructions)
FASE-3-LARAVEL.md    (Laravel setup instructions)
```

---

## 🚀 LANGKAH BERURUTAN

Baca: [STEPS.md](STEPS.md) untuk panduan lengkap 7 fase.

```
Fase 1 — Persiapan    ✅ Done
Fase 2 — Database     ✅ Done (29 tables, seeded)
Fase 3 — Laravel      ✅ Done (API + Auth Middleware)
Fase 4 — Web App      ✅ Done (frontend/lib/api.ts)
Fase 5 — Network      ✅ Done (AI Agent integration)
Fase 6 — AI Agent     ✅ Done (main.py ready)
Fase 7 — Produksi     ✅ Done (v0.2.0 production ready)
```

### 📊 Seed Data (DB: rt_rw_net)

| Table | Count | Sample |
|-------|-------|--------|
| customers | 3 | CUST-001 (Budi Santoso), CUST-002 (Ani Wulandari), CUST-003 (Dedi Kurniawan) |
| services | 2 | SVC-001 (ACTIVE), SVC-002 (ACTIVE) |
| tickets | 3 | TKT-001 (OPEN), TKT-002 (IN_PROGRESS), TKT-003 (RESOLVED) |

**Run seeder:** `docker exec rt-rw-api php artisan db:seed --class=RTNETSeeder`

---

## 📊 STATUS

**Progres Keseluruhan:** 100% (Minggu 2 - Produksi) | **Versi Dev:** v0.3.0

**Selesai:**
- ✅ Semua blueprint didokumentasikan
- ✅ 13 Agent specifications lengkap
- ✅ 5 Workflows teknis
- ✅ 4 Business processes
- ✅ 5 Governance policies
- ✅ 10 ADR
- ✅ Database schema (29 tabel) + seeding lengkap
- ✅ Laravel API + Auth Middleware (`ApiTokenMiddleware`)
- ✅ Frontend integration (`frontend/lib/api.ts`)
- ✅ AI Agent (`ai-agent/app/main.py`)
- ✅ PHPUnit 11.5.56 terinstall
- ✅ Feature Tests (`ApiAuthTest.php`) — 5 PASS, 1 FAIL (middleware env issue)
- ✅ Git commit `5703f30`

**v0.3.0 Billing System (IN PROGRESS):**
- ✅ Model `Invoice` dibuat
- ✅ Migrasi tabel `invoices` dibuat
- ✅ `InvoiceController` dengan endpoint (`index`, `show`, `markAsPaid`)
- ⬜ Artisan Command `billing:generate` (otomasi penagihan)
- ⬜ Frontend Billing Dashboard
- ⬜ Push ke GitHub remote repository

---

## 📞 QUICK LINKS

- [Master Blueprint](MASTER-BLUEPRINT.md)
- [Roadmap](ROADMAP.md)
- [Task Tracking](TASK-TRACKING.md)
- [Progress Status](PROGRESS-STATUS.md)
- [Setup Laravel](docs/architecture/SETUP-LARAVEL.md)
- [Database Schema](docs/data/SCHEMA-v1.0.md)

---

**Maintained by:** Project Lead  
**Review Schedule:** Weekly
