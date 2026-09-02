# WF-TICKET-001: Ticket Lifecycle Workflow

## Workflow ID: WF-TICKET-001
Name: Ticket Lifecycle
Domain: Operations / Customer Service
Trigger: Customer complaint received (via phone, WhatsApp, Telegram, or monitoring system)
Owner: CS Manager

## States
1. **Issue Received**
2. **Ticket Created**
3. **Issue Classified**
4. **Priority Assigned**
5. **Assigned to Team**
6. **Diagnosis / Resolution**
7. **Resolution Verified**
8. **Customer Notified**
9. **Ticket Closed**

## State Transitions
| From State | To State | Condition | Action | Agent |
|------------|----------|-----------|--------|-------|
| Issue Received | Ticket Created | Customer identified | Create ticket with customer info, issue description | AI CS Agent / AI Ticket Agent |
| Ticket Created | Issue Classified | Ticket created | Classify issue type (technical, billing, sales, complaint) | AI Ticket Agent |
| Issue Classified | Priority Assigned | Classification done | Assign priority based on impact & urgency | AI Ticket Agent |
| Priority Assigned | Assigned to Team | Priority set | Route ticket to appropriate queue (NOC, Billing, CS) | AI Ticket Agent |
| Assigned to Team | Diagnosis / Resolution | Ticket assigned | Technicians investigate & resolve | NOC Operator / CS Agent / Field Tech |
| Diagnosis / Resolution | Resolution Verified | Resolution attempted | Verify fix, test service | NOC / CS / Field |
| Resolution Verified | Customer Notified | Verified working | Notify customer of resolution, confirm satisfaction | AI CS Agent |
| Customer Notified | Ticket Closed | Customer confirms satisfied or SLA expired | Close ticket with resolution summary | AI Ticket Agent |
| Diagnosis / Resolution | Escalation | Resolution failed or SLA breached | Escalate to supervisor/manager | AI Ticket Agent |
| Assigned to Team | Reassigned | Wrong team assigned or technician unavailable | Reassign to correct team | AI Ticket Agent |
| Resolution Verified | Reopened | Customer reports issue persists | Reopen ticket, create new diagnosis cycle | AI Ticket Agent |

## Agent Involvement
- **AI CS Agent**: Issue received, customer identification, notification
- **AI Ticket Agent**: Ticket lifecycle (creation, classification, priority, assignment, verification, closure)
- **AI NOC Agent**: Diagnosis for technical tickets
- **AI Billing Agent**: Resolution for billing tickets
- **Human CS Agent**: Complex inquiries, escalations
- **Human NOC Operator**: Technical diagnosis & resolution
- **Human Field Technician**: On-site resolution
- **Human CS Manager**: Escalation for repeated issues
- **Human Billing Officer**: Billing disputes

## Events
**Consumed**
- `CUSTOMER_COMPLAINT` (from phone, WhatsApp, Telegram, Web)
- `NETWORK_OUTAGE` (from monitoring)
- `BILLING_ISSUE` (from customer inquiry)
- `TICKET_CREATED` (internal)
- `RESOLUTION_ATTEMPTED` (internal)
- `CUSTOMER_FEEDBACK` (satisfaction survey)

**Produced**
- `TICKET_CREATED` (with ticket ID)
- `ISSUE_CLASSIFIED` (with classification & priority)
- `TICKET_ASSIGNED` (with assigned team/agent)
- `ESCALATION_TRIGGERED`
- `RESOLUTION_VERIFIED`
- `CUSTOMER_NOTIFIED`
- `TICKET_CLOSED`
- `TICKET_REOPENED`

## SLA
- **First Response Time**: P1 ≤ 15 min, P2 ≤ 1 hour, P3 ≤ 4 hours, P4 ≤ 24 hours
- **Resolution Time**: P1 ≤ 4 hours, P2 ≤ 24 hours, P3 ≤ 72 hours, P4 ≤ 7 days
- **Assignment**: < 5 minutes after creation
- **Escalation**: Auto-escalate if approaching SLA breach (30 min before deadline)
- **Verification**: < 30 minutes after resolution
- **Customer Notification**: < 15 minutes after verification

## Approval Points
- **Ticket creation**: No approval (automated)
- **Priority change to P1**: Auto-escalate, notify CS Manager
- **Ticket cancellation**: CS Manager approval
- **Ticket closure without resolution**: CS Manager approval
- **Refund based on ticket**: Finance Manager approval

## Error Handling
- **Invalid customer ID**: Prompt re-identification, create lead if new
- **Classification failure**: Default to technical, notify supervisor
- **Assignment failure**: Retry, notify supervisor
- **SLA breach approaching**: Auto-escalate, notify CS Manager
- **Customer dissatisfaction**: Reopen ticket, escalate, follow up
- **Ticket creation failure**: Retry, log, alert system admin

## References
- `processes/BP-TICKET-001.md`
- `ai/agents/AG-006-Customer-Service.md`
- `ai/agents/AG-011-Ticket.md`
- `ai/agents/AG-010-NOC.md`
- `SECURITY-ARCHITECTURE.md`