# Actors Documentation

This directory contains definitions of all actors in the RT/RW Net AI Operating System.

## Overview

The RT/RW Net AI Operating System is powered by a combination of human actors (owners, managers, agents, operators) and AI agents that work together to deliver RT/RW Net services. This document defines all actors, their roles, permissions, and responsibilities.

## What Actors Exist?

### Human Actors

**Strategic & Executive**
- **Owner** – The business owner who makes strategic decisions, approves major investments, and defines company vision.
- **General Manager (GM)** – Runs daily operations, coordinates departments, and implements Owner's strategy.

**Sales & Marketing**
- **Sales Manager** – Leads the sales team, sets targets, and manages customer relationships.
- **Sales Agent** – Generates leads, qualifies prospects, and closes sales.
- **Marketing Manager** – Plans marketing campaigns, manages budget, and coordinates with Sales.
- **Marketing Specialist** – Executes marketing activities, creates content, and manages campaigns.
- **Ads Specialist** – Manages paid advertising, optimizes ad spend, and tracks ROI.

**Customer Service & Support**
- **CS Manager** – Heads customer support, manages CS team, and handles escalations.
- **CS Agent** – Responds to customer inquiries, creates tickets, and provides solutions.

**Operations & Technical**
- **Operations Manager** – Oversees all operations, coordinates between departments, and ensures service delivery.
- **NOC Manager** – Manages Network Operations Center, monitors network health, and responds to incidents.
- **NOC Operator** – Monitors network alerts, diagnoses issues, and creates incidents.
- **Network Engineer** – Designs and configures network infrastructure (requires approval for critical changes).
- **Field Operations Manager** – Schedules technician work, manages field team, and coordinates service delivery.
- **Field Technician** – Performs on-site installation, maintenance, and repairs.
- **Installation Coordinator** – Schedules and coordinates installation activities.

**Finance & Accounting**
- **Finance Manager** – Manages financial planning, budgeting, and reporting.
- **Billing Officer** – Generates invoices, processes payments, and manages collections.
- **Accountant** – Handles journal entries, ledger maintenance, and financial reporting.

**Supply Chain & Inventory**
- **Procurement Manager** – Manages purchasing, vendors, and procurement processes.
- **Warehouse Staff** – Manages inventory, stock levels, and procurement coordination.

**Human Resources**
- **HR Officer** – Manages employee lifecycle, payroll, and HR policies.

### AI Actors (13 Core Agents)

**Core AI Platform**
- **AI Orchestrator (AG-001)** – Coordinates all AI agents, routes tasks, manages workflow.
- **AI Management Agent (AG-002)** – Provides executive reporting and operational insights.
- **AI Business Intelligence Agent (AG-003)** – Performs analytics and data insights.

**Commercial Domain**
- **AI Sales Agent (AG-004)** – Manages lead-to-customer conversion.
- **AI Marketing Agent (AG-005)** – Handles campaign planning and execution.
- **AI Customer Service Agent (AG-006)** – Provides instant customer support and assistance.

**Financial Domain**
- **AI Billing Agent (AG-007)** – Manages invoicing and payment collection.
- **AI Finance Agent (AG-008)** – Manages cash flow and financial forecasting.
- **AI Accounting Agent (AG-009)** – Handles accounting records and financial statements.

**Operations Domain**
- **AI NOC Agent (AG-010)** – Monitors network status and responds to incidents.
- **AI Ticket/Support Agent (AG-011)** – Manages ticket lifecycle and SLA compliance.
- **AI Field Operations Agent (AG-012)** – Manages technician scheduling and field operations.
- **AI Inventory/Procurement Agent (AG-013)** – Manages inventory and procurement.

## Permissions Matrix

All actors have role-based access permissions defined in the `SECURITY-ARCHITECTURE.md` file. Key patterns:

- **Owner / GM**: Full access to all domains and functions
- **Department Managers**: Access to their domain and read access to related domains
- **Human Agents**: Direct customer interaction, limited system access
- **AI Actors**: Read-only access to business data, execute approved actions through tools

## Actor Interaction Rules

1. **No direct database access** – All actors access data through defined APIs/services
2. **Approval workflow** – High-risk actions require human approval per `HUMAN-VS-AI-AUTHORITY.md`
3. **Audit trails** – All actions are logged for compliance and audit purposes
4. **Structured communication** – Agents use structured messages, not free-form chat

## References

- `GLOSSARY.md` – Standardized terminology
- `SECURITY-ARCHITECTURE.md` – Detailed permission matrix
- `DOMAIN-MODEL.md` – Business domain definitions
- `ai/HUMAN-VS-AI-AUTHORITY.md` – Authority level matrix
- `ai/TELEGRAM-GOVERNANCE.md` – Interface governance
- `organization/STRUCTURE.md` – Organizational structure
- `ai/agents/` – Individual agent specifications

## Contact

For questions about actor definitions or permissions, contact the project lead or refer to the security documentation.