# WF-CUSTOMER-001: Customer Onboarding Workflow

## Workflow ID: WF-CUSTOMER-001
Name: Customer Onboarding
Domain: Customer / Sales
Trigger: Sales order created (sales agent registers a new prospect as a customer)
Owner: Sales Manager

## States
1. **Sales Order Received**
2. **Coverage & Capacity Check**
3. **Customer Registration**
4. **Service Creation**
5. **Installation Scheduling**
6. **Installation Execution**
7. **Installation Verification**
8. **Service Activation**
9. **First Invoice Generation**
10. **Completed**

## State Transitions
| From State | To State | Condition | Action | Agent |
|------------|----------|-----------|--------|-------|
| Sales Order Received | Coverage & Capacity Check | Always | Run coverage & capacity check | AI Sales Agent (via Coverage API) |
| Coverage & Capacity Check | Customer Registration | Coverage OK & Capacity available | Create customer record | AI Sales Agent |
| Coverage & Capacity Check | Sales Order Received (retry) | Coverage fail but alternative area available | Notify sales agent for alternative area | AI Sales Agent |
| Coverage & Capacity Check | Halt (manual) | Coverage fail & no alternative | Escalate to Sales Manager for review | AI Sales Agent |
| Customer Registration | Service Creation | Customer data validated (BR-CUSTOMER-003) | Create service record, assign package, generate PPPoE credentials | AI Sales Agent |
| Service Creation | Installation Scheduling | Service created | Schedule technician, allocate materials | AI Field Operations Agent |
| Installation Scheduling | Installation Execution | Technician assigned & materials ready | Dispatch technician with work order | AI Field Operations Agent |
| Installation Execution | Installation Execution | Technician on-site (no change) | Perform installation (ONT, cabling, configure PPPoE) | Field Technician (human) |
| Installation Execution | Installation Verification | Installation complete & tested | Verify ONT online, PPPoE session, speed test | AI NOC Agent |
| Installation Verification | Service Activation | Verification passed | Activate service in billing cycle, notify customer | AI Customer Service Agent |
| Service Activation | First Invoice Generation | Service activated | Generate first invoice (including installation fee if any) | AI Billing Agent |
| First Invoice Generation | Completed | Invoice generated & sent | Close workflow | System |

## Agent Involvement
- **AI Sales Agent**: States 1-4 (coordination, registration, service creation)
- **AI NOC Agent**: State 7 (verification)
- **AI Field Operations Agent**: States 5-6 (scheduling, dispatch)
- **Field Technician**: State 6 (physical installation)
- **AI Customer Service Agent**: State 8 (activation notification)
- **AI Billing Agent**: State 9 (invoice generation)
- **Human Sales Agent**: Escalation point for coverage issues
- **Human CS Agent**: Optional for customer notification

## Events
**Consumed**
- `SALES_ORDER_CREATED` (from Sales Agent or CRM)

**Produced**
- `CUSTOMER_REGISTERED` (after state 3)
- `SERVICE_CREATED` (after state 4)
- `WORK_ORDER_CREATED` (after state 5)
- `INSTALLATION_COMPLETED` (after state 6)
- `SERVICE_VERIFIED` (after state 7)
- `SERVICE_ACTIVATED` (after state 8)
- `FIRST_INVOICE_GENERATED` (after state 9)
- `CUSTOMER_ONBOARDING_COMPLETED` (final)

## SLA
- **Coverage & Capacity Check**: < 2 minutes
- **Customer Registration**: < 1 minute
- **Service Creation**: < 1 minute
- **Installation Scheduling**: < 15 minutes (tech assignment)
- **Installation Execution**: ≤ 2 business days (field SLA)
- **Installation Verification**: < 5 minutes
- **Service Activation**: < 2 minutes
- **First Invoice Generation**: < 1 minute
- **Total Onboarding SLA**: ≤ 3 business days (target 1 day for simple installs)

## Approval Points
- None fully automated; escalation to human for:
  - Coverage failure with no alternative (Sales Manager)
  - Installation failure (Field Ops Manager)
  - Verification failure (NOC Manager)

## Error Handling
- **Coverage check failure**: Log, suggest alternative area, escalate to Sales Manager if no alternatives
- **Capacity exceeded**: Queue for capacity expansion, notify sales to delay
- **Customer registration validation failure**: Return error to sales agent, correct data
- **Installation failure**: Create maintenance ticket, reschedule, notify customer
- **Verification failure**: Alert NOC Manager, create incident, notify customer of delay
- **Invoice generation failure**: Retry 2x, alert Billing Officer

## References
- `processes/BP-CUSTOMER-001.md`
- `ai/agents/AG-004-Sales.md`
- `ai/agents/AG-006-Customer-Service.md`
- `ai/agents/AG-010-NOC.md`
- `ai/agents/AG-012-Field-Operations.md`
- `ai/agents/AG-007-Billing.md`
- `SECURITY-ARCHITECTURE.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`