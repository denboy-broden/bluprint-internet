# Architecture Decision Records (ADR)

This directory contains Architecture Decision Records for the RT/RW Net AI Operating System.

## What is an ADR?

An Architecture Decision Record (ADR) is a document that captures an important architectural decision made along with its context and consequences.

## ADR Format

```
Title: Short descriptive title
Status: Proposed | Accepted | Deprecated | Superseded
Context: What is the issue that we're seeing that is motivating this decision or change?
Decision: What is the change that we're proposing or have decided to do?
Consequences: What becomes easier or more difficult to do and any risks introduced by this change?
```

## ADR Index

| ID | Title | Status | Date | Related Files |
|----|-------|--------|------|---------------|
| ADR-001 | Use Laravel as Backend Framework | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-002 | Use Next.js as Frontend Framework | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-003 | Use MariaDB as Primary Database | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-004 | Use Python for AI Platform | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-005 | Use Redis for Queue & Cache | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-006 | Use Telegram as Primary AI Interface | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-007 | 13 Agent Architecture | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-008 | 7-Layer System Architecture | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-009 | Human Approval for High-Risk Actions | Accepted | 2026-09-01 | DECISION-REGISTER.md |
| ADR-010 | No Direct Database Access for AI | Accepted | 2026-09-01 | DECISION-REGISTER.md |

## Detailed ADRs

### ADR-001: Use Laravel as Backend Framework

**Status:** Accepted

**Context:** We need a robust, mature PHP framework for building the business backend (CRM, Billing, Finance, Inventory, etc.) with strong ecosystem support, built-in authentication, and excellent ORM.

**Decision:** Use Laravel 11.x as the primary backend framework.

**Consequences:**
- Positive: Mature ecosystem, excellent documentation, built-in auth (Sanctum), powerful ORM (Eloquent), good testing tools, large community
- Negative: PHP runtime required, learning curve for non-PHP developers

---

### ADR-002: Use Next.js as Frontend Framework

**Status:** Accepted

**Context:** We need a modern React framework with server-side rendering, TypeScript support, and good developer experience for building the web dashboard.

**Decision:** Use Next.js 14+ with App Router, TypeScript, and Tailwind CSS.

**Consequences:**
- Positive: SSR/SSG support, excellent TypeScript support, fast refresh, built-in optimization, Vercel deployment
- Negative: React ecosystem dependency, potential complexity for simple pages

---

### ADR-003: Use MariaDB as Primary Database

**Status:** Accepted

**Context:** We need a reliable, ACID-compliant relational database with good performance, open-source licensing, and strong JSON support for flexible data models.

**Decision:** Use MariaDB 10.11+ as the primary database.

**Consequences:**
- Positive: Drop-in MySQL replacement, better performance, open source, JSON support, window functions, CTEs
- Negative: Less cloud-managed options than PostgreSQL, some advanced features differ from PostgreSQL

---

### ADR-004: Use Python for AI Platform

**Status:** Accepted

**Context:** The AI/ML ecosystem is predominantly Python-based. We need a language with strong library support for AI agents, LLM integration, and data processing.

**Decision:** Use Python 3.11+ for the AI platform (agents, orchestration, tools, evaluation).

**Consequences:**
- Positive: Rich AI/ML ecosystem (LangChain, OpenAI SDK, etc.), excellent LLM integration, great data processing libraries
- Negative: Different language than backend (polyglot), requires separate deployment, GIL limitations for CPU-bound tasks

---

### ADR-005: Use Redis for Queue & Cache

**Status:** Accepted

**Context:** We need a high-performance in-memory store for caching, session management, and job queue processing.

**Decision:** Use Redis 7+ for caching, queue (via Laravel Horizon or custom), and rate limiting.

**Consequences:**
- Positive: Sub-millisecond latency, pub/sub for events, streams for queue, TTL support, clustering
- Negative: Memory-limited, persistence not as durable as database, additional infrastructure component

---

### ADR-006: Use Telegram as Primary AI Interface

**Status:** Accepted

**Context:** The Owner needs a mobile-friendly, real-time interface to interact with the AI system, receive alerts, and approve actions.

**Decision:** Use Telegram Bot API as the primary AI interaction interface (alongside web dashboard).

**Consequences:**
- Positive: Mobile-native, push notifications, inline keyboards for approvals, file sharing, wide adoption in Indonesia
- Negative: Not a replacement for web dashboard, limited UI capabilities, dependent on Telegram infrastructure

---

### ADR-007: 13 Agent Architecture

**Status:** Accepted

**Context:** We need a manageable number of AI agents that cover all business domains without creating "agent sprawl" where too many agents have overlapping responsibilities.

**Decision:** Implement exactly 13 core agents organized into 5 domains (Core, Management, Commercial, Operations, Finance, Supply).

**Consequences:**
- Positive: Clear ownership boundaries, manageable complexity, aligns with business departments
- Negative: Some agents may have broad responsibilities, requires careful permission design

---

### ADR-008: 7-Layer System Architecture

**Status:** Accepted

**Context:** We need a clear architectural separation between experience layer, AI organization, automation, business applications, business services, data, and infrastructure.

**Decision:** Implement 7-layer architecture as defined in `06-Arsitektur-Operating_System.md`.

**Consequences:**
- Positive: Clear separation of concerns, testable layers, technology independence per layer
- Negative: More components to manage, potential latency between layers, requires strong interface contracts

---

### ADR-009: Human Approval for High-Risk Actions

**Status:** Accepted

**Context:** AI agents must not be able to execute critical actions (network changes, financial transactions, security modifications) without human oversight.

**Decision:** Implement tiered approval system (L0-L5) as defined in `HUMAN-VS-AI-AUTHORITY.md`. All CRITICAL and HIGH risk actions require explicit human approval.

**Consequences:**
- Positive: Safety, compliance, auditability, risk mitigation
- Negative: Slower execution for critical actions, requires human availability, approval workflow complexity

---

### ADR-010: No Direct Database Access for AI

**Status:** Accepted

**Context:** AI agents must not have direct SQL access to the database to prevent data corruption, bypassing business logic, and security issues.

**Decision:** All AI data access must go through Business Services / APIs. AI uses tools that call these services.

**Consequences:**
- Positive: Business logic enforced, audit trail maintained, security boundaries respected, easier testing
- Negative: Additional abstraction layer, potential performance overhead, more development effort

---

## How to Add New ADRs

1. Create a new file: `ADR-XXX-descriptive-title.md`
2. Use the standard format above
3. Update this index
4. Add to `DECISION-REGISTER.md`
5. Get Owner approval before marking as Accepted

## References
- `DECISION-REGISTER.md` - Master decision register
- `OWNER-DECISIONS.md` - Owner-specific decisions
- `04-AGENT-PLATFORM.md` - Platform architecture decisions
- `06-Arsitektur-Operating_System.md` - System architecture
- `07-Business-Operating-System.md` - Business OS blueprint