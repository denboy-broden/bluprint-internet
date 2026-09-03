# RT/RW NET — BUSINESS & ORGANIZATION BLUEPRINT (FINAL)
> **Dokumen dasar untuk merancang struktur organisasi, fungsi bisnis,
> proses kerja, SOP, KPI, sistem informasi, automation, dan AI Agent
> untuk usaha RT/RW Net.**

> **Ver.:** 1.0 • **Updated:** 2026-09-04 • **Author:** Project Lead

---

## 1. Tujuan Dokumen

Dokumen ini menjadi blueprint dasar bagaimana usaha RT/RW Net dijalankan.

### Tujuan Utama:
1. Menentukan struktur organisasi.
2. Menentukan fungsi setiap bagian.
3. Menentukan siapa bertanggung jawab terhadap pekerjaan tertentu.
4. Menentukan alur kerja antar bagian.
5. Memisahkan fungsi operasional, keuangan, kontrol, dan manajemen.
6. Menentukan KPI setiap fungsi.
7. Menjadi dasar pembuatan SOP.
8. Menjadi dasar pembuatan sistem ERP / ISP Management.
9. Menjadi dasar automation.
10. Menjadi dasar pengembangan AI Agent.

### Prinsip Utama:
> **ORGANIZATION → FUNCTION → RESPONSIBILITY → AUTHORITY → PROCESS → SOP → KPI → SYSTEM → AUTOMATION → AI**

> **Jangan membangun sistem terlebih dahulu sebelum proses bisnisnya jelas.**

---

## 2. Prinsip Dasar Struktur Perusahaan

Struktur RT/RW Net tidak boleh hanya berdasarkan jabatan.

```
ORGANIZATION
     ↓
DEPARTMENT / FUNCTION
     ↓
ROLE
     ↓
RESPONSIBILITY
     ↓
AUTHORITY
     ↓
BUSINESS PROCESS
     ↓
WORKFLOW
     ↓
SOP
     ↓
KPI
     ↓
SYSTEM
     ↓
AUTOMATION
     ↓
AI AGENT
```

### Contoh:
```
Operations
    ↓
NOC
    ↓
NOC Engineer
    ↓
Monitoring Network
    ↓
Memiliki akses monitoring
    ↓
Network Incident Process
    ↓
Alarm → Ticket → Diagnosis → Escalation
    ↓
SOP Incident Management
    ↓
Uptime / MTTA / MTTR
    ↓
NOC Dashboard
    ↓
Automatic Alert
    ↓
AI NOC Agent
```

---

## 3. Struktur Organisasi Tingkat Atas

### Struktur Utama:
```
                              OWNER
                                │
                                ▼
                       GENERAL MANAGER
                         / MANAGEMENT
                                │
       ┌────────────┬───────────┼───────────┬───────────┐
       ▼            ▼           ▼           ▼           ▼
     SALES       MARKETING   CUSTOMER    OPERATIONS   FINANCE
                               SERVICE
       │            │           │           │           │
       │            ▼           │           │       ┌───┴────┐
       │           ADS           │           │       │        │
       │                        TICKET       NOC    BILLING ACCOUNTING
       │                            │
       │                            │
       │                       TECHNICAL
       │                            │
       │                    ┌───────┴───────┐
       │                    ▼               ▼
       │                FIELD TECH      INSTALLATION
       │
       ▼
CUSTOMER ACQUISITION
```

### Support Functions:
- HR / Administration
- Procurement
- Warehouse / Inventory
- Asset Management
- IT / Internal Systems
- Legal / Compliance

### Control Functions:
- QA / Internal Audit
- Risk Management
- Planning / Analytics

---

## 4. Owner

### Tujuan:
Owner adalah pemilik dan pengambil keputusan strategis tertinggi.

### Tanggung Jawab:
- Arah perusahaan
- Visi dan misi
- Investasi
- Ekspansi
- Target pelanggan
- Target revenue
- Target profit
- Keputusan strategis
- Keputusan investasi besar
- Keputusan pembukaan area baru
- Keputusan perubahan harga strategis
- Keputusan vendor strategis
- Pengawasan management
- Pengawasan risiko perusahaan

### Owner sebaiknya tidak menangani:
Contoh:
```
"Pelanggan Budi internet mati."
"Teknisi belum datang."
"Stok kabel tinggal 100 meter."
"Pelanggan belum membayar."
```

**Owner cukup menerima informasi:**
```
Customer:
5,231

Revenue:
Rp XXX

Profit:
Rp XXX

New Customer:
+127

Churn:
32

Outstanding:
Rp XX

Network Uptime:
99.xx%

Open Ticket:
87

Average Resolution:
42 menit
```

---

## 5. Governance / Internal Control

Governance bukan harus menjadi departemen.

**Governance adalah aturan bagaimana perusahaan dikendalikan.**

### Komponen:
```
GOVERNANCE
│
├── Authority
├── Approval
├── Segregation of Duties
├── Policy
├── SOP
├── Audit Trail
├── Compliance
└── Internal Control
```

### Contoh:
Teknisi membutuhkan pembelian:
```
Technician
    ↓
Purchase Request
    ↓
Manager Approval
    ↓
Procurement
    ↓
Supplier
    ↓
Warehouse
```

**Teknisi tidak boleh:**
```
Request
 ↓
Approve sendiri
 ↓
Membeli sendiri
 ↓
Menerima sendiri
 ↓
Mencatat sendiri
```

**Tujuan:** Mengurangi kesalahan, pemborosan, fraud, konflik kepentingan, manipulasi data.

---

## 6. General Manager / Management

Management merupakan penghubung antara Owner dan seluruh operasional.

### Tanggung Jawab:
- Menjalankan strategi Owner
- Membuat target
- Mengatur divisi
- Membuat SOP
- Mengawasi karyawan
- Melakukan evaluasi
- Menyelesaikan masalah antar divisi
- Mengatur prioritas
- Melakukan planning
- Membuat laporan kepada Owner

---

## 7. Sales

### Tujuan:
Mendapatkan pelanggan baru.

### Fungsi:
```
SALES
│
├── Lead Management
├── Prospect
├── Qualification
├── Follow Up
├── Quotation
├── Registration
├── Closing
└── Customer Conversion
```

### Workflow:
```
Lead
 ↓
Contact
 ↓
Qualification
 ↓
Coverage Check
 ↓
Offer
 ↓
Follow Up
 ↓
Closing
 ↓
Registration
 ↓
Installation Order
```

### KPI:
- Jumlah leads
- Qualified leads
- Conversion rate
- New customers
- Sales target
- Sales cycle
- Follow-up response time

---

## 8. Marketing

### Tujuan:
Menciptakan demand dan menghasilkan leads.

### Fungsi:
```
MARKETING
│
├── Branding
├── Campaign
├── Content
├── Promotion
├── Social Media
├── Organic Marketing
├── Paid Marketing
└── Market Analysis
```

### Marketing dan Sales harus terhubung:
```
Marketing
    ↓
Lead
    ↓
Sales
    ↓
Customer
    ↓
Revenue
```

**Marketing lebih penting:**
```
Marketing Cost
       ↓
Leads
       ↓
Qualified Leads
       ↓
Customers
       ↓
Revenue
```

---

## 9. Ads

Ads merupakan fungsi paid marketing di bawah Marketing.

### Fungsi:
```
ADS
│
├── Campaign
├── Audience
├── Budget
├── Creative
├── A/B Testing
├── Conversion Tracking
├── Optimization
└── Attribution
```

### Workflow:
```
Objective
 ↓
Audience
 ↓
Budget
 ↓
Creative
 ↓
Launch
 ↓
Monitor
 ↓
Optimize
 ↓
Lead
 ↓
Sales
 ↓
Customer
 ↓
CAC / ROAS
```

### KPI:
- CPL
- CAC
- CTR
- Conversion Rate
- ROAS
- Qualified leads
- Customer acquisition cost

---

## 10. Customer Service (CS)

CS adalah pintu masuk komunikasi pelanggan.

### Fungsi:
```
CUSTOMER SERVICE
│
├── Registration Assistance
├── Inquiry
├── Complaint
├── Payment Information
├── Upgrade
├── Downgrade
├── Suspension
├── Reactivation
├── Termination
└── Retention
```

### Prinsip:
CS tidak harus menangani semua aspek teknis (network, billing, installation). CS fokus pada komunikasi pelanggan dan mengarahkan tiket ke bagian teknis yang sesuai.

**Contoh:**
- Pelanggan menelepon CS tentang tagihan
- CS mencatat tiket dan mengarahkan ke bagian Billing
- Teknisi mengecek jaringan, kemudian melanjutkan ke Technical Support

---

## 11. Operations

### Tujuan:
Mengelola jaringan fisik dan instalasi pelanggan.

### Sub-Fungsi:
- **NOC**: Monitoring jaringan, pemeliharaan, instalasi
- **Technical Support**: Support teknis, troubleshooting
- **Field Technician**: Kunjungan lapangan, instalasi, perbaikan
- **Installation**: Pemasangan baru
- **Network Development**: Ekspansi jaringan

---

## 12. Finance

### Tujuan:
Mengelola keuangan perusahaan.

### Sub-Fungsi:
- **Billing**: Membuat tagihan pelanggan
- **Accounting**: Pencatatan keuangan
- **Treasury**: Manajemen kas dan bank
- **Audit**: Audit internal dan kepatuhan

---

## 13. AI Platform

### Tujuan:
Menerapkan AI untuk membantu manusia.

### Prinsip:
- AI tidak boleh mengacaukan governance.
- AI harus mengikuti permission.
- Untuk tindakan sensitif: AI merekomendasikan, manusia menyetujui.

### Contoh Aplikasi:
- **AI NOC**: Monitoring, analisis, rekomendasi, escalasi
- **AI CS**: Klasifikasi, identifikasi masalah, respons
- **AI Finance**: Rekonsiliasi otomatis, detection exception

### Kewenangan AI:
```
ROLE
PERMISSION
SCOPE
APPROVAL
AUDIT LOG
```

**AI tidak boleh:**
- Mengubah laporan keuangan
- Mengubah konfigurasi MikroTik
- Mengeluarkan uang tanpa approval

---

## 14. Roadmap Implementasi

### Urutan Implementasi yang Disarankan:
```
PHASE 1
ORGANIZATION
        ↓
PHASE 2
ROLE & RESPONSIBILITY
        ↓
PHASE 3
AUTHORITY & PERMISSION
        ↓
PHASE 4
BUSINESS PROCESS
        ↓
PHASE 5
SOP
        ↓
PHASE 6
KPI
        ↓
PHASE 7
DATA MODEL
        ↓
PHASE 8
SYSTEM ARCHITECTURE
        ↓
PHASE 9
ERP / ISP SYSTEM
        ↓
PHASE 10
AUTOMATION
        ↓
PHASE 11
AI AGENT
```

### Prioritas Implementasi Sistem:
Untuk tahap awal, modul yang paling penting:
1. Customer
2. Service
3. Billing
4. Payment
5. Ticket
6. Technician
7. Network
8. Inventory
9. Finance
10. Reporting

### Tahapan selanjutnya:
11. Sales
12. CRM
13. Marketing
14. Ads
15. Procurement
16. Asset
17. Accounting
18. HR
19. Audit
20. Risk

---

## 15. Prinsip Utama Sistem

Sistem harus dibangun berdasarkan prinsip:
```
ONE CUSTOMER
        ↓
ONE CUSTOMER RECORD
        ↓
ALL CUSTOMER ACTIVITIES
```

### Contohnya:
```
Customer
 │
 ├── Contact
 ├── Contract
 ├── Service
 ├── Device
 ├── Invoice
 ├── Payment
 ├── Ticket
 ├── Work Order
 ├── Installation
 ├── Complaint
 ├── Upgrade
 └── Termination
```

**Semua terhubung.**

---

## 16. Prinsip Audit Trail

Semua tindakan penting harus memiliki history.

### Contohnya:
```
USER:
admin01

ACTION:
Suspend Customer

CUSTOMER:
CUST-000123

TIME:
2026-08-31 20:31

REASON:
Overdue Payment

OLD STATUS:
ACTIVE

NEW STATUS:
SUSPENDED
```

**Untuk tindakan penting:**
```
WHO
WHAT
WHEN
WHERE
WHY
BEFORE
AFTER
```

**harus dapat diketahui.**

---

## 17. Kesimpulan

Struktur usaha RT/RW Net tidak boleh hanya:
```
Owner
Admin
Teknisi
```

Jika bisnis ingin berkembang, harus dipandang sebagai perusahaan dengan fungsi:

**Organisasi berfungsi dengan roles yang jelas, kewenangan yang dipisahkan, proses yang terstandardisasi, KPI yang terukur, sistem yang terintegrasi, automation yang diterapkan, dan AI yang mendukung.**

**Dengan pendekatan ini, sistem RT/RW Net nantinya bukan hanya menjadi:**

> "Aplikasi billing pelanggan."

**Tetapi dapat berkembang menjadi:**

> **Integrated ISP / RT/RW Net Business Operating System**

**yang menghubungkan:**
Customer, Sales, Marketing, Ads, CS, Network, NOC, Technician, Ticket, Installation, Billing, Payment, Finance, Accounting, Inventory, Asset, Procurement, HR, Management, Reporting, Audit, Risk, Automation, AI.

**dan seluruh bagian tersebut bekerja menggunakan satu struktur data dan satu alur bisnis yang terintegrasi.**

---

## 18. Prinsip Akhir

**Blueprint ini menggunakan prinsip:**
> **Bangun perusahaan terlebih dahulu secara konseptual, kemudian bangun sistem yang mengikuti perusahaan tersebut.**

**Urutan akhirnya:**
```
BUSINESS
   ↓
ORGANIZATION
   ↓
FUNCTION
   ↓
ROLE
   ↓
RESPONSIBILITY
   ↓
AUTHORITY
   ↓
PROCESS
   ↓
SOP
   ↓
KPI
   ↓
DATA
   ↓
ERP
   ↓
AUTOMATION
   ↓
AI
```

**Dengan pendekatan ini, sistem RT/RW Net nantinya bukan hanya menjadi:**
> "Aplikasi billing pelanggan."
**Tetapi dapat berkembang menjadi:**
> **Integrated ISP / RT/RW Net Business Operating System**
**yang menghubungkan:** (list lengkap)
**dan seluruh bagian tersebut bekerja menggunakan satu struktur data dan satu alur bisnis yang terintegrasi.**

---

**Dokumentasi Bisnis Blueprint lengkap dan siap digunakan untuk pengembangan RT/RW Net AI Operating System.**