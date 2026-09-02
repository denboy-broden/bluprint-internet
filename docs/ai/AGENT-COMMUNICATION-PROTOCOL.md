# Agent Communication Protocol

## Overview
This document defines how AI agents communicate with each other in the RT/RW Net AI Operating System.

## Communication Principles

1. **Structured Messages Only** — No free-form chat between agents
2. **Explicit Handoffs** — Tasks transferred with full context
3. **Agent-as-Tool Pattern** — One agent can call another as a tool
4. **Orchestrator Coordination** — All multi-agent workflows go through Orchestrator
5. **Audit All Communication** — Every message must be logged

## Message Format

Every inter-agent message must include:

```json
{
  "from": "AG-001",
  "to": "AG-010",
  "message_type": "INCIDENT_CREATED",
  "timestamp": "2026-09-01T20:30:00Z",
  "correlation_id": "INC-2026-00123",
  "data": {
    "incident_id": "INC-2026-00123",
    "severity": "CRITICAL",
    "affected_area": "POP-03",
    "affected_customers": 187,
    "root_cause": "OLT unreachable",
    "confidence": 0.94,
    "evidence": ["OLT status DOWN", "Power failure detected"]
  },
  "context": {
    "customer_id": "CUST-00123",
    "service_status": "OFFLINE",
    "prior_incidents": 3
  },
  "approval_required": false,
  "response_expected": true
}
```

## Message Types

### Event Types
- `TASK_ASSIGNED` — Orchestrator assigns task to agent
- `INCIDENT_CREATED` — Network issue detected
- `TICKET_CREATED` — Customer issue registered
- `CUSTOMER_QUESTION` — Customer inquiry
- `APPROVAL_REQUESTED` — Agent asks for human approval
- `WORK_ORDER_CREATED` — Field operation scheduled
- `STOCK_ALERT` — Low inventory
- `FINANCIAL_REPORT_READY` — Report generated

### Handoff Types
- `HANDOFF_TASK` — Delegate complete task
- `HANDOFF_PARTIAL` — Delegate subtask
- `HANDOFF_ESCALATION` — Escalate to higher authority

## Communication Channels

| Channel | Purpose | Latency Requirement |
|---------|---------|---------------------|
| Internal API / Event Bus | Agent-to-agent messages | < 500ms |
| Direct function call | Agent-as-tool | < 1s |
| Orchestrator routing | Multi-agent coordination | < 2s |
| Human approval request | Telegram / Web | < 5 min |

## Security Requirements

- All messages encrypted in transit (TLS 1.3)
- No sensitive data in message payloads without encryption
- Access control per permission matrix
- All messages auditable
- No direct database access via messages

## Example Workflows

### Incident Response Communication
1. **Monitoring System** → AI NOC Agent: `MONITORING_ALERT`
2. **AI NOC Agent** → Orchestrator: `INCIDENT_CREATED`
3. **Orchestrator** → AI Ticket Agent: `TASK_ASSIGNED` (create tickets for affected)
4. **AI Ticket Agent** → AI CS Agent: `CUSTOMER_NOTIFICATION` (notify affected)
5. **AI NOC Agent** → AI Field Operations Agent: `WORK_ORDER_CREATED` (if needed)
6. **AI NOC Agent** → Orchestrator: `RECOMMENDATION_GENERATED`
7. **Orchestrator** → Human Manager: `APPROVAL_REQUESTED` (if critical action)
8. **Orchestrator** → AI NOC Agent: `ACTION_APPROVED` / `ACTION_REJECTED`
9. **AI NOC Agent** → All affected: `INCIDENT_RESOLVED` / `UPDATE`

This document completes the agent specification framework.

## References
- `AG-001-ORCHESTRATOR.md`
- `02-STRUKTUR-AGENT.md`
- `ai/TOOL-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`