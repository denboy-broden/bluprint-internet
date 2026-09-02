# Tool Governance Framework

## Tool Categories

| Category | Purpose | Permission | Risk | Approval |
|----------|---------|------------|------|----------|
| READ TOOL | Read-only data access | Domain read permission | LOW | No approval |
| WRITE TOOL | Write data, create records | Domain write permission | MEDIUM | Manager if > threshold |
| ACTION TOOL | Perform business action | Domain action permission | HIGH | Required approval |
| DANGEROUS ACTION TOOL | Network/Financial critical actions | Owner + Manager approval | CRITICAL | Owner + Manager |

---

## Mandatory Tool Fields

Every tool MUST have:

1. Tool ID
2. Name
3. Purpose
4. Domain ownership
5. Complete Input Schema
6. Complete Output Schema
7. Permission matrix
8. Risk Level (LOW/MEDIUM/HIGH/CRITICAL)
9. Approval requirement
10. Audit requirement
11. Timeout value
12. Retry count
13. Idempotency requirement
14. Compensation action

---

## Tool Approval Matrix

| Risk Level | Auto Execute | Requires Approval | Requires Audit |
|------------|--------------|-------------------|----------------|
| LOW | YES | NO | YES |
| MEDIUM | NO | YES (Manager) | YES |
| HIGH | NO | YES (NOC Manager) | YES |
| CRITICAL | NO | YES (Owner + Manager) | YES |

---

## Tool Failure Handling

If a tool fails:
1. Retry configured count, then stop
2. Compensation action executed if defined
3. Audit log entry created with failure details
4. Escalation if failure count exceeds threshold
5. Human notification for critical failures

---

## Tool Idempotency

Tools marked as idempotent:
- Can be safely called multiple times
- Same result each time
- No side effects on repeated calls
- Example: GET tools, status check tools

Tools NOT idempotent:
- Require careful usage
- May have side effects on repeated calls
- Example: CREATE tools, ACTION tools, DANGEROUS tools

---

## Cross-Domain Tool Restrictions

1. No tool can bypass domain ownership
2. No direct database access
3. No tool can modify entity it doesn't own
4. All write tools must have approval based on risk level
5. All tools must be auditable

### Example Restriction

```
AG-010 NOC Agent
├── CAN use: GET-ROUTER, GET-OLT, GET-POP (read tools)
├── CAN use: RESTART-ROUTER with approval (action tool)
├── CANNOT use: RESTART-OLT without Owner approval
├── CANNOT use: SUSPEND-CUSTOMER
├── CANNOT use: CREATE-ACCOUNT
└── MUST use: Audit log for all actions
```

---

## Tool Registration

All tools must be registered in:
- docs/ai/TOOL-GOVERNANCE.md
- Agent specifications (which tools each agent can use)
- Permission matrix
- Approval engine configuration