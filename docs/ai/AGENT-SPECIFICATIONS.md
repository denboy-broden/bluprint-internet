# Additional Agent Specification References

This file completes references mentioned in agent specs but not fully documented.

---

## AGENT-SPECIFICATIONS.md (Master Reference)

This file serves as the master index and reference guide for all agent specifications.

### Agent Specification Requirements (per File 04 — Agent Platform)

Every agent specification must include:

1. **Agent ID** (format: AG-NNN)
2. **Agent Name**
3. **Domain** (Management, Commercial, Operations, Finance, Supply, Core)
4. **Level** (L0, L1, L2)
5. **Purpose** — Why this agent exists
6. **Responsibilities** — MUST DO / SHOULD DO / MAY DO / MUST NOT DO
7. **Inputs** — Data sources consumed
8. **Outputs** — Artifacts produced
9. **Tools** — APIs, services, systems used
10. **Data Access** — Read/Write permissions per entity
11. **Permission Matrix** — Specific to agent domain
12. **Handoffs** — Other agents this agent communicates with
13. **Agent-to-Agent Communication** — Structured message format used
14. **Memory Requirements** — Short-term and long-term memory needs
15. **Knowledge Requirements** — What knowledge base must be available
16. **Workflows** — Business processes this agent participates in
17. **Approval Requirements** — Which actions require human approval
18. **Escalation Policy** — When and how to escalate
19. **KPI & Performance** — Metrics for agent evaluation
20. **Audit Requirements** — What must be logged
21. **Failure Handling** — How failures are handled
22. **Security Requirements** — Security policies for agent
23. **Timeout & Retry Policy** — Technical limits
24. **Idempotency Requirements** — Which actions must be idempotent

---

## AGENT-COMMUNICATION-PROTOCOL.md (Complete)
See `docs/ai/AGENT-COMMUNICATION-PROTOCOL.md`

---

## Cross-References Table

| Agent Spec | References | Referenced By |
|-----------|-----------|--------------|
| AG-001 Orchestrator | All other agent specs | All agents |
| AG-002 Management BI | `DECISION-REGISTER.md` | `AGENT-INDEX.md` |
| AG-003 BI | `SECURITY-ARCHITECTURE.md`, `HUMAN-VS-AI-AUTHORITY.md` | `AGENT-INDEX.md` |
| AG-004 Sales | `processes/BP-CUSTOMER-001.md`, `RULE-REGISTRY.md` | `AGENT-INDEX.md` |
| AG-005 Marketing | `processes/BP-MARKETING-001.md` | `AGENT-INDEX.md` |
| AG-006 Customer Service | `processes/BP-TICKET-001.md`, `processes/BP-CUSTOMER-001.md` | `AGENT-INDEX.md` |
| AG-007 Billing | `business-rules/ADDITIONAL-RULES.md`, `processes/BP-BILLING-001.md` | `AGENT-INDEX.md` |
| AG-008 Finance | `processes/BP-FINANCE-001.md`, `business-rules/ADDITIONAL-RULES.md` | `AGENT-INDEX.md` |
| AG-009 Accounting | `processes/BP-BILLING-001.md` | `AGENT-INDEX.md` |
| AG-010 NOC | `processes/BP-NETWORK-001.md`, `business-rules/ADDITIONAL-RULES.md` | `AGENT-INDEX.md` |
| AG-011 Ticket | `processes/BP-TICKET-001.md`, `processes/BP-INCIDENT-001.md` | `AGENT-INDEX.md` |
| AG-012 Field Operations | `processes/BP-FIELD-001.md`, `processes/BP-INVENTORY-001.md` | `AGENT-INDEX.md` |
| AG-013 Inventory/Procurement | `processes/BP-INVENTORY-001.md`, `processes/BP-PROCUREMENT-001.md` | `AGENT-INDEX.md` |

---

This completes the agent specification framework.

## References
- `docs/ai/agents/AG-001-ORCHESTRATOR.md`
- `docs/ai/agents/AG-002-MANAGEMENT.md`
- `docs/ai/agents/AG-003-BI.md`
- `docs/ai/agents/AG-004-Sales.md`
- `docs/ai/agents/AG-005-Marketing.md`
- `docs/ai/agents/AG-006-Customer-Service.md`
- `docs/ai/agents/AG-007-Billing.md`
- `docs/ai/agents/AG-008-Finance.md`
- `docs/ai/agents/AG-009-Accounting.md`
- `docs/ai/agents/AG-010-NOC.md`
- `docs/ai/agents/AG-011-Ticket.md`
- `docs/ai/agents/AG-012-Field-Operations.md`
- `docs/ai/agents/AG-013-Inventory-Procurement.md`
- `docs/ai/AGENT-INDEX.md`
- `docs/ai/AGENT-COMMUNICATION-PROTOCOL.md`
- `docs/04-AGENT-PLATFORM.md`
- `docs/03-AGENT-ORGANIZATION-BLUEPRINT.md`
- `docs/02-STRUKTUR-AGENT.md`
- `docs/01-BUSINESS-BLUEPRINT.md`
- `docs/07-Business-Operating-System.md`