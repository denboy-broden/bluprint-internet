# Approval Policy

## Purpose
Defines how approvals are requested, evaluated, granted, and recorded for AI actions.

## Approval Types

### Type A: Auto-Approve (No Approval Required)
- All L5 actions (monitor, observe, classify, generate reports)
- All LOW risk actions (read-only, notifications)
- All actions with pre-approved policies
- Actions below cost/impact thresholds

### Type B: Single Approval
- L4 actions (execute after approval)
- MEDIUM risk actions (restart service, create ticket, send reminder)
- Actions above cost thresholds (Rp 500.000)
- Actions affecting < 10 customers

### Type C: Dual Approval
- L0/L4 critical actions (restart OLT, change firewall, large purchase, refund)
- HIGH/CRITICAL risk actions
- Actions affecting > 100 customers
- Actions above Rp 5.000.000
- All actions involving security changes

### Type D: Executive Approval
- Strategic decisions (price changes, market expansion, vendor selection)
- Actions affecting company reputation
- Major investment decisions
- Policy changes

## Approval Workflow

```
AI Agent proposes action
  ↓
Check approval requirements per TOOL-GOVERNANCE.md
  ↓
If no approval needed → Execute → Log → Notify
  ↓
If approval needed → Send approval request
  ↓
Approver reviews (system + human context)
  ↓
Approve / Reject / Modify
  ↓
If Approve → Execute → Log → Notify
  ↓
If Reject → Log reason → Notify AI Agent → AI adjusts
  ↓
If Modify → Adjust action → Re-request if needed
```

## Approval Channels

- **Web**: Approval dashboard with details
- **Telegram**: Inline buttons for quick approval
- **Email**: For non-urgent or complex approvals
- **API**: For automated approval workflows

## Approval Time Limits

- **Auto-approve**: Immediate
- **Single approval**: 2 hours (business hours), 4 hours (after hours)
- **Dual approval**: 4 hours (business hours), 8 hours (after hours)
- **Executive approval**: 24 hours
- **Emergency**: 30 minutes (Owner can be reached via Telegram)

## Escalation on Timeout

- If approval not received within time limit:
- Auto-escalate to supervisor
- If supervisor unavailable → escalate to manager
- If manager unavailable → escalate to Owner
- Action remains pending until approved or escalated

## Audit Requirements for Approvals

Every approval action must be logged:
- Request timestamp
- Requester (AI Agent ID or user)
- Action requested (description)
- Risk level
- Approver identity
- Decision (approve/reject/modify)
- Decision timestamp
- Justification (if rejected or modified)
- Execution result (success/failure)

## References
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`
- `docs/ai/TELEGRAM-GOVERNANCE.md`
- `DECISION-REGISTER.md`
- `OWNER-DECISIONS.md`