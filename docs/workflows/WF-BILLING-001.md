# WF-BILLING-001: Invoice & Collection Workflow

## Workflow ID: WF-BILLING-001
Name: Invoice & Collection
Domain: Billing / Finance
Trigger: Billing cycle date (e.g., 1st of month) OR service activation (pro-rated first invoice)
Owner: Billing Officer

## States
1. **Billing Cycle Trigger**
2. **Customer Selection**
3. **Invoice Generation**
4. **Invoice Delivery**
5. **Payment Tracking**
6. **Overdue Check**
7. **Collection Action**
8. **Suspension (if overdue)**
9. **Payment Received**
10. **Invoice Closed**

## State Transitions
| From State | To State | Condition | Action | Agent |
|------------|----------|-----------|--------|-------|
| Billing Cycle Trigger | Customer Selection | Billing date reached | Query all active services | AI Billing Agent |
| Customer Selection | Invoice Generation | Customer selected | Generate invoice with line items, set due date | AI Billing Agent |
| Invoice Generation | Invoice Delivery | Invoice created | Send invoice via WhatsApp/Email/Telegram | AI Billing Agent |
| Invoice Delivery | Payment Tracking | Invoice sent | Start payment tracking, set reminder dates | AI Billing Agent |
| Payment Tracking | Overdue Check | Due date reached (daily check) | Check payment status | AI Billing Agent |
| Overdue Check | Collection Action | Not paid after due date | Execute collection sequence | AI Billing Agent |
| Collection Action | Payment Received | Customer pays | Record payment, reconcile | AI Billing Agent |
| Collection Action | Suspension | 30+ days overdue (BR-CUSTOMER-005) | Recommend suspension, notify customer | AI Billing Agent |
| Payment Received | Invoice Closed | Full payment received | Mark invoice paid, update customer status | AI Billing Agent |
| Suspension | Payment Received | Customer pays after suspension | Remove suspension, restore service, close invoice | AI Billing Agent |
| Overdue Check | Invoice Closed | Payment received before overdue action | Record payment, close invoice | AI Billing Agent |

## Collection Sequence
| Day | Action |
|-----|--------|
| Due date | Reminder 1: Payment reminder |
| Due date + 3 days | Reminder 2: Gentle reminder |
| Due date + 7 days | Reminder 3: Urgent reminder |
| Due date + 14 days | Phone call / WhatsApp follow-up |
| Due date + 21 days | Final notice |
| Due date + 30 days | Suspension recommended (BR-CUSTOMER-005) |

## Agent Involvement
- **AI Billing Agent**: All states (generation, delivery, tracking, collection, suspension)
- **AI CS Agent**: Customer notification for suspension
- **AI NOC Agent**: Service suspension (network action)
- **Human Billing Officer**: Manual invoice adjustments, exception handling
- **Human Finance Manager**: Write-offs, payment arrangements

## Events
**Consumed**
- `BILLING_CYCLE_TRIGGER` (scheduled)
- `SERVICE_ACTIVATED` (for pro-rated invoice)
- `PAYMENT_RECEIVED` (from payment gateway)

**Produced**
- `INVOICE_GENERATED`
- `INVOICE_DELIVERED`
- `PAYMENT_REMINDER_SENT`
- `OVERDUE_ALERT`
- `SUSPENSION_RECOMMENDED`
- `PAYMENT_RECEIVED`
- `INVOICE_PAID`
- `SERVICE_SUSPENDED`
- `SERVICE_RESTORED`

## SLA
- **Invoice Generation**: < 5 minutes for all customers in batch
- **Invoice Delivery**: < 1 minute per customer
- **Payment Reminder**: Automated per collection sequence
- **Overdue Check**: Daily at 07:00
- **Suspension Execution**: Within 24 hours of 30-day overdue

## Approval Points
- **Auto-suspension (30+ days overdue)**: No approval (automated per rule)
- **Manual suspension**: Billing Officer approval
- **Payment arrangement > 7 days**: Finance Manager approval
- **Write-off of overdue balance**: Finance Manager + Owner approval
- **Invoice adjustment**: Billing Officer approval

## Error Handling
- **Invoice generation failure**: Retry batch, alert Billing Officer
- **Invoice delivery failure**: Retry via alternative channel (WhatsApp → SMS → Email)
- **Payment gateway webhook failure**: Manual reconciliation, alert Finance
- **Suspension action failure**: Retry, alert NOC Manager
- **Duplicate payment detected**: Flag for manual review

## References
- `processes/BP-BILLING-001.md`
- `processes/BP-NETWORK-001.md` (suspension)
- `ai/agents/AG-007-Billing.md`
- `ai/agents/AG-006-Customer-Service.md`
- `ai/agents/AG-010-NOC.md`
- `business-rules/RULE-REGISTRY.md` (BR-CUSTOMER-005)
- `ai/HUMAN-VS-AI-AUTHORITY.md`