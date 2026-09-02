# Audit Policy

## Purpose
Defines what must be audited, how audits are conducted, retention requirements, and access controls.

## Audit Scope

All significant actions must be audited:

- **AI Agent actions**: Every tool call, recommendation, decision, approval request, handoff
- **Human actions**: All write operations, approvals, access to sensitive data
- **System events**: API calls, authentication events, errors, configuration changes
- **Business events**: Customer lifecycle, financial transactions, network changes
- **Security events**: Login attempts, permission changes, data exports

## Audit Log Format

Every audit entry must include:

```
AUDIT_ID: AUD-{YYYYMMDD}-{NNNN}
TIMESTAMP: {ISO 8601 datetime}
ACTOR_TYPE: AI | HUMAN | SYSTEM
ACTOR_ID: {Agent ID or User ID or System ID}
ACTION: {Action description}
TARGET_TYPE: {Entity type}
TARGET_ID: {Entity ID or record}
DOMAIN: {Business domain}
RISK_LEVEL: LOW | MEDIUM | HIGH | CRITICAL
BEFORE_STATE: {JSON or description}
AFTER_STATE: {JSON or description}
REASON: {Justification or trigger}
APPROVAL_ID: {If approval was required}
RESULT: SUCCESS | FAILURE | PENDING
DETAILS: {Additional context or error details}
```

## Audit Categories

### Category 1: Critical Actions (Always Audit)
- Network configuration changes (firewall, routing, VLAN)
- Financial transactions (payments, refunds, write-offs)
- Customer data changes (termination, suspension, contract)
- System access (login, permission changes)
- Agent configuration changes
- Approval requests and decisions

### Category 2: Important Actions (Always Audit)
- Ticket creation and closure
- Work order execution
- Invoice generation and delivery
- Customer notifications
- Inventory movements
- Agent tool usage

### Category 3: Routine Actions (Audit Summary)
- Read operations (can be summarized hourly)
- Report generation
- Scheduled jobs
- Monitoring events

## Audit Retention

| Category | Retention Period | Storage |
|----------|----------------|---------|
| Critical Actions | 7 years | Encrypted database + cold storage |
| Important Actions | 5 years | Encrypted database |
| Routine Actions | 1 year | Database |
| Security Events | 7 years | Encrypted + cold storage |
| System Logs | 90 days | Log server |

## Audit Access Controls

- **AI Agents**: Write-only (cannot read or delete audit logs)
- **Auditors**: Read-only for assigned domains
- **Security Team**: Read-only for all domains
- **Owner / GM**: Read-only for all domains
- **IT Admin**: No direct access (must use audit tool)

Audit logs cannot be modified or deleted by any user or agent once written.

## Audit Review Schedule

- **Daily**: Security team reviews critical security events
- **Weekly**: Department heads review domain-specific audit logs
- **Monthly**: General Manager reviews approval patterns and exceptions
- **Quarterly**: Owner reviews governance compliance
- **Annually**: External audit of audit trail completeness

## Audit Investigation Procedures

When an audit investigation is needed:

1. Request from Owner or GM
2. Define scope (time period, domain, actor)
3. Extract audit logs (encrypted)
4. Analyze for patterns or violations
5. Document findings
6. Escalate to security team if needed
7. Take corrective action
8. Update controls if needed

## Non-Compliance

If audit trail is incomplete or tampered:

- System alert to Security Team
- Investigation initiated
- Access suspended if tampering detected
- Owner notification within 24 hours
- External forensic investigation if needed

## Audit Tools

- Audit log database (MariaDB, append-only)
- Audit query API (restricted access)
- Audit dashboard (for authorized reviewers)
- Audit export tool (for investigations)
- Audit integrity checker (hash verification)

## References
- `SECURITY-ARCHITECTURE.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `GOVERNANCE-POLICY.md`
- `AI-GOVERNANCE.md`