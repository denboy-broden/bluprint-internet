Betul. **Ini justru langkah yang paling tepat sekarang.** Kita jangan masuk coding dulu.

Kita akan membuat **Master System Blueprint** yang menjadi "konstitusi" untuk seluruh aplikasi RT/RW Net + AI Agent + Telegram.

Di bawah ini saya susun versi **Blueprint v1.0** yang bisa langsung Anda simpan sebagai `RT-RW-NET-AI-BUSINESS-OPERATING-SYSTEM.md`.

# RT/RW NET AI BUSINESS OPERATING SYSTEM

## Master System Blueprint v1.0

### 1. Visi Sistem

Sistem yang dibangun bukan sekadar aplikasi billing RT/RW Net.

Sistem ini merupakan:

> **AI-Powered RT/RW Net Business Operating System**

yang mengintegrasikan:

* manajemen perusahaan
* pelanggan
* sales
* marketing
* billing
* finance
* accounting
* network operations
* ticketing
* teknisi lapangan
* inventory
* procurement
* reporting
* business intelligence
* AI agents
* automation
* Telegram
* web application

Tujuan akhirnya:

```text
DATA
  ↓
BUSINESS PROCESS
  ↓
AUTOMATION
  ↓
AI ANALYSIS
  ↓
DECISION
  ↓
ACTION
  ↓
VERIFICATION
  ↓
REPORTING
  ↓
LEARNING
```

---

# 2. Prinsip Arsitektur

Sistem harus mengikuti prinsip berikut.

### 2.1 Business First

AI mengikuti proses bisnis.

Bukan proses bisnis mengikuti AI.

```text
Business Rules
      ↓
Business System
      ↓
AI
```

bukan:

```text
AI
 ↓
mengarang business rules
```

### 2.2 Database adalah Source of Truth

AI tidak menjadi sumber data utama.

```text
AI
 ↓
Business Service
 ↓
Database
```

### 2.3 Agent tidak boleh mempunyai akses database bebas

Agent menggunakan:

```text
Tool
 ↓
Service
 ↓
Database
```

bukan:

```text
Agent
 ↓
Raw SQL
 ↓
Database
```

### 2.4 Semua tindakan penting harus dapat diaudit

```text
WHO
WHAT
WHEN
WHY
FROM WHERE
TO WHAT
RESULT
```

harus tercatat.

---

# 3. High-Level Architecture

```text
                         OWNER / USER
                              │
               ┌──────────────┴──────────────┐
               │                             │
               ▼                             ▼
        WEB APPLICATION                  TELEGRAM
               │                             │
               └──────────────┬──────────────┘
                              ▼
                       API / AI GATEWAY
                              │
             ┌────────────────┼────────────────┐
             ▼                ▼                ▼
       BUSINESS SYSTEM    AI PLATFORM      AUTOMATION
             │                │                │
             │                │                │
             ▼                ▼                ▼
           CRM             Agents           Workflow
           ERP             Router            Events
           NMS             Tools             Queue
           Billing         Memory            Scheduler
           Finance         Knowledge
           Inventory       Evaluation
             │                │
             └────────────────┘
                      │
                      ▼
                 DATA PLATFORM
                      │
        ┌─────────────┼─────────────┐
        ▼             ▼             ▼
     MariaDB        Redis       Object Storage
        │
        ▼
   BUSINESS DATA
```

---

# 4. Lapisan Sistem

Sistem dibagi menjadi **7 layer**.

```text
LAYER 7 — EXPERIENCE
Web / Telegram / API

LAYER 6 — AI ORGANIZATION
13 Agents / Orchestrator

LAYER 5 — AUTOMATION
Workflow / Event / Queue / Scheduler

LAYER 4 — BUSINESS APPLICATION
CRM / Billing / Finance / NMS / Inventory

LAYER 3 — BUSINESS SERVICES
Business Rules / Services / Policies

LAYER 2 — DATA
MariaDB / Redis / Object Storage

LAYER 1 — INFRASTRUCTURE
Server / Docker / Network / Monitoring
```

---

# 5. Organization Structure

```text
OWNER
 │
 └── MANAGEMENT
      │
      ├── SALES
      │
      ├── MARKETING
      │    └── ADS
      │
      ├── CUSTOMER SERVICE
      │
      ├── OPERATIONS
      │    ├── NOC
      │    ├── Installation
      │    ├── Maintenance
      │    └── Field Technician
      │
      ├── FINANCE
      │
      ├── ACCOUNTING
      │
      ├── WAREHOUSE
      │
      ├── PROCUREMENT
      │
      └── HR / ADMIN
```

---

# 6. Business Domain

Kita membagi sistem menjadi domain.

### Customer Domain

```text
Customer
Contact
Address
Service
Package
Installation
Customer Status
Customer History
```

### Sales Domain

```text
Lead
Prospect
Opportunity
Follow Up
Registration
Conversion
```

### Marketing Domain

```text
Campaign
Advertisement
Channel
Content
Audience
Lead Source
Marketing Cost
ROI
```

### Billing Domain

```text
Invoice
Billing Cycle
Payment
Receivable
Late Payment
Discount
Penalty
Suspension
Reactivation
```

### Finance Domain

```text
Cash
Bank
Income
Expense
Transfer
Cashflow
Budget
```

### Accounting Domain

```text
Chart of Accounts
Journal
Ledger
Trial Balance
Profit & Loss
Balance Sheet
```

### Network Domain

```text
POP
Router
OLT
Switch
ONU
ONT
VLAN
IP
PPPoE
RADIUS
Bandwidth
Link
Monitoring
```

### Operations Domain

```text
Ticket
Incident
Work Order
Installation
Maintenance
Technician
SLA
Diagnosis
Action
Resolution
```

### Inventory Domain

```text
Product
Warehouse
Stock
Asset
Serial Number
Stock Movement
Sparepart
Purchase Order
Supplier
```

### HR Domain

```text
Employee
Role
Department
Attendance
Payroll
Performance
```

---

# 7. 13 AI Agents

```text
AG-001 Orchestrator
AG-002 Management
AG-003 Business Intelligence
AG-004 Sales
AG-005 Marketing
AG-006 Customer Service
AG-007 Billing
AG-008 Finance
AG-009 Accounting
AG-010 NOC
AG-011 Ticket
AG-012 Field Operations
AG-013 Inventory & Procurement
```

Hubungannya:

```text
                    ORCHESTRATOR
                         │
       ┌─────────────────┼──────────────────┐
       │                 │                  │
       ▼                 ▼                  ▼
   MANAGEMENT       COMMERCIAL          OPERATIONS
       │             │                  │
       │          ┌──┼──┐          ┌────┼────┐
       │          ▼  ▼  ▼          ▼    ▼    ▼
       │        Sales Mkt CS       NOC Ticket Field
       │
       ├── BI
       │
       └── Finance
            ├── Billing
            ├── Finance
            └── Accounting

              SUPPLY
                 │
                 ▼
          Inventory/Procurement
```

---

# 8. Web Application

Web adalah **Business Operating Console**.

Struktur menu:

```text
Dashboard

CUSTOMER
├── Customers
├── Services
├── Packages
└── Customer History

SALES
├── Leads
├── Prospects
├── Opportunities
└── Follow Up

MARKETING
├── Campaigns
├── Ads
├── Content
└── Analytics

OPERATIONS
├── Tickets
├── Incidents
├── Work Orders
├── Installation
├── Maintenance
└── Technicians

NETWORK
├── NOC
├── Routers
├── OLT
├── Devices
├── Monitoring
└── Network Map

BILLING
├── Invoices
├── Payments
├── Receivables
└── Billing Cycle

FINANCE
├── Cash
├── Bank
├── Income
├── Expense
└── Cashflow

ACCOUNTING
├── Chart of Accounts
├── Journal
├── Ledger
└── Reports

INVENTORY
├── Products
├── Warehouse
├── Stock
├── Assets
└── Stock Movement

PROCUREMENT
├── Suppliers
├── Purchase Requests
└── Purchase Orders

HR
├── Employees
├── Roles
└── Payroll

REPORTS

AI
├── Agents
├── Tasks
├── Conversations
├── Workflows
├── Approvals
├── Tool Calls
├── Audit Logs
└── Evaluations

SYSTEM
├── Users
├── Roles
├── Permissions
├── Settings
└── Integrations
```

---

# 9. Telegram Architecture

Telegram bukan database.

Telegram adalah **AI interaction interface**.

```text
OWNER
  │
  ▼
Telegram
  │
  ▼
Telegram Gateway
  │
  ▼
Identity
  │
  ▼
Authorization
  │
  ▼
AI Gateway
  │
  ▼
Orchestrator
  │
  ▼
Agent
  │
  ▼
Tool
  │
  ▼
Business Service
```

Telegram dapat digunakan untuk:

```text
Query
Command
Notification
Alert
Approval
Report
Escalation
```

Contoh:

```text
Owner:
"Berapa pelanggan aktif?"

Telegram
 ↓
Orchestrator
 ↓
Management / BI
 ↓
Customer Service
 ↓
Database
```

---

# 10. Approval Architecture

Tidak semua AI action otomatis.

Kita gunakan tiga level:

### LOW RISK

```text
AI
 ↓
Execute
```

Contoh:

* membuat laporan
* klasifikasi tiket
* membuat draft
* membaca data
* membuat reminder

### MEDIUM RISK

```text
AI
 ↓
Recommendation
 ↓
Approval
 ↓
Execute
```

### HIGH RISK

```text
AI
 ↓
Recommendation
 ↓
Human
 ↓
Approval
 ↓
Execute
 ↓
Verification
```

Contoh:

* restart router
* perubahan firewall
* pembelian besar
* refund
* perubahan harga
* suspend massal

---

# 11. Workflow Engine

Semua proses penting harus menjadi workflow.

Contoh pelanggan baru:

```text
LEAD
 ↓
QUALIFICATION
 ↓
REGISTRATION
 ↓
COVERAGE CHECK
 ↓
SURVEY
 ↓
APPROVAL
 ↓
INSTALLATION
 ↓
ACTIVATION
 ↓
BILLING
 ↓
ACTIVE CUSTOMER
```

---

# 12. Incident Workflow

```text
ALERT
 ↓
INCIDENT
 ↓
CLASSIFICATION
 ↓
SEVERITY
 ↓
DIAGNOSIS
 ↓
ACTION
 ↓
VERIFICATION
 ↓
RESOLUTION
 ↓
POST-MORTEM
```

---

# 13. Ticket Workflow

```text
CUSTOMER
 ↓
COMPLAINT
 ↓
TICKET
 ↓
PRIORITY
 ↓
ASSIGNMENT
 ↓
TECHNICIAN
 ↓
ACTION
 ↓
EVIDENCE
 ↓
VERIFICATION
 ↓
CLOSE
```

---

# 14. Finance Workflow

```text
INVOICE
 ↓
PAYMENT
 ↓
FINANCE
 ↓
ACCOUNTING
 ↓
JOURNAL
 ↓
LEDGER
 ↓
FINANCIAL REPORT
```

---

# 15. Inventory Workflow

```text
PURCHASE REQUEST
 ↓
APPROVAL
 ↓
PURCHASE ORDER
 ↓
RECEIVING
 ↓
STOCK IN
 ↓
WAREHOUSE
 ↓
STOCK OUT
 ↓
ASSET / TECHNICIAN
```

---

# 16. Agent Communication

Agent **tidak seharusnya saling berbicara secara bebas**.

Gunakan:

```text
Agent
 ↓
Task
 ↓
Event
 ↓
Another Agent
```

Contoh:

```text
TICKET_CREATED

        ↓

NOC_DIAGNOSIS_REQUESTED

        ↓

FIELD_WORK_REQUIRED

        ↓

WORK_ORDER_CREATED

        ↓

WORK_COMPLETED

        ↓

NETWORK_VERIFICATION

        ↓

TICKET_RESOLVED
```

Ini membuat sistem dapat dilacak.

---

# 17. Event Bus

Event penting:

```text
CUSTOMER_CREATED
CUSTOMER_ACTIVATED
CUSTOMER_SUSPENDED

INVOICE_CREATED
PAYMENT_RECEIVED
PAYMENT_OVERDUE

TICKET_CREATED
TICKET_ASSIGNED
TICKET_RESOLVED

NETWORK_ALERT
DEVICE_DOWN
LINK_DOWN

WORK_ORDER_CREATED
WORK_ORDER_COMPLETED

STOCK_LOW
PURCHASE_REQUESTED
PURCHASE_APPROVED

CAMPAIGN_CREATED
LEAD_CREATED
LEAD_CONVERTED
```

---

# 18. Tool Architecture

Agent hanya mendapatkan tools sesuai kewenangannya.

Contoh:

```text
NOC Agent

get_router_status
get_interface_status
get_olt_status
get_radius_status
get_customer_connection
create_incident
request_field_work
```

Sedangkan Finance:

```text
get_revenue
get_expenses
get_receivables
get_cashflow
create_expense
```

Dan Inventory:

```text
get_stock
get_asset
create_stock_movement
create_purchase_request
```

---

# 19. Security

Semua request harus melewati:

```text
Authentication
      ↓
Authorization
      ↓
Permission
      ↓
Policy
      ↓
Tool
      ↓
Business Service
```

Tidak boleh:

```text
Telegram
 ↓
Agent
 ↓
Router
```

tanpa security layer.

---

# 20. Audit System

Semua tindakan AI dicatat:

```text
Agent ID
User ID
Conversation ID
Task ID
Tool
Input
Decision
Approval
Execution
Result
Timestamp
Risk Level
```

Contoh:

```text
AG-010 NOC

Action:
restart_router

Target:
POP-03

Requested By:
Owner

Approval:
Approved

Result:
SUCCESS

Duration:
42 seconds
```

---

# 21. AI Memory

Memory dibagi menjadi:

```text
Short-Term Memory
Conversation

Task Memory
Current task

Long-Term Memory
Business knowledge

Operational Memory
Previous incidents

User Preference
Owner preferences
```

Namun memory **tidak boleh menggantikan database bisnis**.

---

# 22. Knowledge System

RAG/Knowledge berisi:

```text
SOP
Documentation
Network Documentation
Product Documentation
Technical Manuals
Company Policies
Troubleshooting Guide
Accounting Policies
Marketing Guidelines
```

Agent dapat mencari knowledge sebelum mengambil keputusan.

---

# 23. Model Router

Jangan mengunci semua agent ke satu model.

```text
                MODEL ROUTER
                     │
       ┌─────────────┼─────────────┐
       ▼             ▼             ▼
    Cheap          Balanced       Premium
       │             │             │
 Classification   Reasoning     Critical
 Simple Tasks     Analysis      Decision
```

Router memilih model berdasarkan:

```text
Task Complexity
Cost
Latency
Context
Reliability
Availability
```

---

# 24. Observability

Kita harus dapat melihat:

```text
Agent Runs
Token Usage
Latency
Tool Calls
Errors
Failures
Cost
Success Rate
Human Approval
```

Dashboard:

```text
AI SYSTEM HEALTH

Agents             13/13 ONLINE
Tasks               247
Success Rate        97.8%
Tool Errors          3
Pending Approval     7
Average Latency    2.8s
Daily Cost          Rp XXX
```

---

# 25. Evaluation

Setiap agent mempunyai evaluation suite.

```text
Agent
 ↓
Test Cases
 ↓
Expected Result
 ↓
Actual Result
 ↓
Score
```

Metric:

```text
Accuracy
Reliability
Tool Selection
Policy Compliance
Hallucination
Cost
Latency
```

---

# 26. Business Intelligence

Semua domain menghasilkan data.

```text
Sales
Marketing
Customer
Network
Ticket
Billing
Finance
Inventory
```

↓

```text
DATA PLATFORM
```

↓

```text
BI
```

↓

```text
MANAGEMENT
```

↓

```text
OWNER
```

---

# 27. Executive Dashboard

Owner melihat:

```text
┌─────────────────────────────────────┐
│          BUSINESS HEALTH            │
├─────────────────────────────────────┤
│ Customers        5,231              │
│ Active           5,087              │
│ New              127                │
│ Churn            32                 │
│ Revenue          Rp XXX             │
│ Expense          Rp XXX             │
│ Profit           Rp XXX             │
│ Receivable       Rp XXX             │
│ Network Uptime   99.7%              │
│ Open Tickets     43                 │
└─────────────────────────────────────┘
```

AI kemudian memberikan:

```text
INSIGHTS

⚠ Inventory ONT menurun
⚠ POP-03 mengalami degradation
↑ Customer acquisition meningkat
↓ Churn menurun
```

---

# 28. Closed Loop

Target akhir sistem:

```text
             OBSERVE
                │
                ▼
             ANALYZE
                │
                ▼
             DECIDE
                │
                ▼
              ACT
                │
                ▼
            VERIFY
                │
                ▼
             MEASURE
                │
                ▼
              LEARN
                │
                └──────────→ OBSERVE
```

Inilah yang membedakan sistem Anda dari aplikasi billing biasa.

---

# 29. Struktur Repository

Untuk implementasi nanti, saya menyarankan pemisahan:

```text
rt-rw-net-platform/
│
├── apps/
│   ├── web/
│   ├── api/
│   ├── ai/
│   └── telegram/
│
├── packages/
│   ├── contracts/
│   ├── shared/
│   └── schemas/
│
├── services/
│   ├── business/
│   ├── billing/
│   ├── network/
│   ├── finance/
│   └── inventory/
│
├── agents/
│   ├── orchestrator/
│   ├── management/
│   ├── bi/
│   ├── sales/
│   ├── marketing/
│   ├── customer_service/
│   ├── billing/
│   ├── finance/
│   ├── accounting/
│   ├── noc/
│   ├── ticket/
│   ├── field/
│   └── inventory/
│
├── workflows/
├── tools/
├── knowledge/
├── tests/
│
├── docs/
│   ├── business/
│   ├── architecture/
│   ├── agents/
│   ├── workflows/
│   ├── api/
│   └── security/
│
└── infrastructure/
    ├── docker/
    ├── monitoring/
    └── deployment/
```

---

# 30. Urutan Implementasi

**Jangan mengerjakan repository tersebut dari atas ke bawah.**

Gunakan fase:

```text
PHASE 01
Business Blueprint
        ↓
PHASE 02
System Architecture
        ↓
PHASE 03
Database / Data Model
        ↓
PHASE 04
Business API
        ↓
PHASE 05
Authentication / RBAC
        ↓
PHASE 06
Core Web Application
        ↓
PHASE 07
Network Integration
        ↓
PHASE 08
Billing / Finance
        ↓
PHASE 09
Ticket / Operations
        ↓
PHASE 10
Inventory
        ↓
PHASE 11
AI Platform
        ↓
PHASE 12
13 Agents
        ↓
PHASE 13
Telegram
        ↓
PHASE 14
Workflow Automation
        ↓
PHASE 15
BI / Executive Dashboard
        ↓
PHASE 16
Evaluation
        ↓
PHASE 17
Controlled Automation
        ↓
PHASE 18
Production
```

---

# 31. Teknologi yang saya rekomendasikan

Untuk kebutuhan Anda, saya akan menggunakan:

| Layer            | Teknologi                                           |
| ---------------- | --------------------------------------------------- |
| Web              | Next.js + React + TypeScript                        |
| Business Backend | Laravel                                             |
| Database         | MariaDB                                             |
| AI/Agents        | Python                                              |
| Agent Runtime    | OpenAI Agents SDK / framework agent yang sesuai     |
| Cache            | Redis                                               |
| Queue            | Redis-based queue / dedicated queue bila diperlukan |
| Network          | MikroTik API + SNMP + RADIUS + OLT integration      |
| Telegram         | Telegram Bot API                                    |
| API              | REST + internal contracts                           |
| Auth             | Laravel-based authentication + RBAC                 |
| Storage          | S3-compatible object storage                        |
| Monitoring       | Prometheus + Grafana                                |
| Logs             | Structured logging                                  |
| Deployment       | Docker                                              |

Saya tetap akan menjaga **Laravel + MariaDB sebagai core business system**, sementara Python menangani AI/agent workloads.

---

# 32. Prinsip terpenting

Sistem akhirnya harus seperti ini:

```text
                     OWNER
                       │
               ┌───────┴───────┐
               ▼               ▼
             WEB            TELEGRAM
               │               │
               └───────┬───────┘
                       ▼
                AI ORCHESTRATOR
                       │
              ┌────────┼────────┐
              ▼        ▼        ▼
            AGENTS   WORKFLOW  TOOLS
              │        │        │
              └────────┼────────┘
                       ▼
                BUSINESS SYSTEM
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
        CRM/ERP       NMS        FINANCE
          │            │            │
          └────────────┼────────────┘
                       ▼
                    DATABASE
                       │
                       ▼
                     DATA
                       │
                       ▼
                       BI
                       │
                       ▼
                     OWNER
```

**Ini blueprint yang sebaiknya kita jadikan baseline.**

Namun saya tidak akan menganggap Blueprint v1.0 ini sudah final untuk langsung diberikan ke coding agent. **Langkah setelah ini adalah melakukan Architecture Review terhadap blueprint ini**, lalu mengubahnya menjadi dokumen yang jauh lebih formal:

```text
MASTER BLUEPRINT
       ↓
ARCHITECTURE DECISION RECORDS
       ↓
DOMAIN MODEL
       ↓
SYSTEM CONTEXT
       ↓
CONTAINER ARCHITECTURE
       ↓
DATABASE ERD
       ↓
API CONTRACT
       ↓
AGENT CONTRACT
       ↓
TOOL CONTRACT
       ↓
EVENT CONTRACT
       ↓
SECURITY / RBAC MATRIX
       ↓
WORKFLOW SPECIFICATION
       ↓
IMPLEMENTATION PLAN
       ↓
TASK DAG
       ↓
CODING AGENTS
```

**Baru pada titik terakhir OpenHands/CrewAI/Agent-Denboy kita beri pekerjaan coding.** Dengan demikian agent tidak akan bebas mengambil keputusan arsitektur yang sebenarnya sudah kita putuskan di awal.
