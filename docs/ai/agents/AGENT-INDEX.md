# Agent Specifications Index

Master list of all AI Agent Specifications for RT/RW Net AI Operating System.

## Overview

This document provides the complete index of all 13 AI Agent Specifications. Each agent has its own detailed specification file covering mission, scope, responsibilities, permissions, tools, workflows, and more.

## Agent Specifications

### Core Platform (L0)
| Agent ID | Agent Name | File | Domain | Level | Status |
|----------|-----------|------|--------|-------|--------|
| AG-001 | Orchestrator Agent | [AG-001-ORCHESTRATOR.md](./AG-001-ORCHESTRATOR.md) | Core | L0 | Approved |

### Management Domain (L1-L2)
| Agent ID | Agent Name | File | Domain | Level | Status |
|----------|-----------|------|--------|-------|--------|
| AG-002 | Management Agent | [AG-002-MANAGEMENT.md](./AG-002-MANAGEMENT.md) | Management | L1 | Approved |
| AG-003 | Business Intelligence Agent | [AG-003-BI.md](./AG-003-BI.md) | Management | L2 | Approved |

### Commercial Domain (L2)
| Agent ID | Agent Name | File | Domain | Level | Status |
|----------|-----------|------|--------|-------|--------|
| AG-004 | Sales Agent | [AG-004-Sales.md](./AG-004-Sales.md) | Commercial | L2 | Approved |
| AG-005 | Marketing Agent | [AG-005-Marketing.md](./AG-005-Marketing.md) | Commercial | L2 | Approved |
| AG-006 | Customer Service Agent | [AG-006-Customer-Service.md](./AG-006-Customer-Service.md) | Commercial | L2 | Approved |

### Finance Domain (L2)
| Agent ID | Agent Name | File | Domain | Level | Status |
|----------|-----------|------|--------|-------|--------|
| AG-007 | Billing Agent | [AG-007-Billing.md](./AG-007-Billing.md) | Finance | L2 | Approved |
| AG-008 | Finance Agent | [AG-008-Finance.md](./AG-008-Finance.md) | Finance | L2 | Approved |
| AG-009 | Accounting Agent | [AG-009-Accounting.md](./AG-009-Accounting.md) | Finance | L2 | Approved |

### Operations Domain (L2)
| Agent ID | Agent Name | File | Domain | Level | Status |
|----------|-----------|------|--------|-------|--------|
| AG-010 | Network / NOC Agent | [AG-010-NOC.md](./AG-010-NOC.md) | Operations | L2 | Approved |
| AG-011 | Ticket / Support Agent | [AG-011-Ticket.md](./AG-011-Ticket.md) | Operations | L2 | Approved |
| AG-012 | Field Operations Agent | [AG-012-Field-Operations.md](./AG-012-Field-Operations.md) | Operations | L2 | Approved |
| AG-013 | Inventory / Procurement Agent | [AG-013-Inventory-Procurement.md](./AG-013-Inventory-Procurement.md) | Supply | L2 | Approved |

## Domain Summary

### Commercial Domain
- **4 agents** covering Sales, Marketing, and Customer Service
- Responsible for generating and maintaining customer relationships
- Handles the customer journey from lead to post-service support

### Finance Domain
- **3 agents** covering Billing, Finance, and Accounting
- Responsible for all financial operations and financial health
- Ensures regulatory compliance and financial accuracy

### Operations Domain
- **4 agents** covering NOC, Ticket, Field Operations, and Inventory/Procurement
- Responsible for service delivery, network operations, and supply chain
- Ensures operational efficiency and customer service excellence

### Core Platform
- **1 agent** (Orchestrator) coordinating all operations
- Acts as the central nervous system for the AI Operating System

## Next Steps for Implementation

1. **Review** each agent specification for completeness
2. **Test** each agent individually using its example workflows
3. **Integrate** agents using the communication protocol
4. **Validate** the orchestrator works with all agents
5. **Deploy** using the phased approach (MVP → Production → Enterprise)

## Extended Agents (Future)

Once the 13 core agents are stable, consider adding:
- AG-014: HR Agent
- AG-015: Compliance / Legal Agent
- AG-016: Audit Agent
- AG-017: Risk Agent
- AG-018: Network Planning Agent
- AG-019: Ads Optimization Agent
- AG-020: Customer Retention Agent

## References

- `02-STRUKTUR-AGENT.md` – Agent structure and recommendations
- `03-AGENT-ORGANIZATION-BLUEPRINT.md` – Organization blueprint
- `04-AGENT-PLATFORM.md` – Platform and specifications
- `05-MEMBANGUN-AI-AGENT.md` – AI agent building guide
- `06-Arsitektur-Operating_System.md` – System architecture
- `07-Business-Operating-System.md` – Business OS blueprint
- `ai/HUMAN-VS-AI-AUTHORITY.md` – Authority levels and approval matrix
- `ai/TOOL-GOVERNANCE.md` – Tool governance framework
- `ai/TELEGRAM-GOVERNANCE.md` – Telegram governance
- `ai/WEB-APPLICATION-BOUNDARY.md` – Web application boundary
- `SECURITY-ARCHITECTURE.md` – Security architecture
- `RULE-REGISTRY.md` – Business rule registry
- `DECISION-REGISTER.md` – Decision register
- `OWNER-DECISIONS.md` – Owner decisions