# AG-006: Customer Service Agent

## Mission
Provide instant, accurate, and helpful responses to customer inquiries and complaints through multi-channel communication, ensuring customer satisfaction and seamless issue resolution.

## Scope
- Customer inquiry handling (phone, WhatsApp, Telegram)
- Complaint logging and initial triage
- Service status checking
- Billing information provision
- Ticket creation for technical issues
- Customer notification and updates
- Retention support

## Responsibilities
- Receive and respond to customer inquiries via all channels
- Identify and authenticate customers
- Check service status, billing, and ticket information
- Create tickets for technical issues
- Provide billing information and payment guidance
- Send service updates and notifications
- Escalate complex issues to appropriate teams
- Support customer retention efforts

## Non-Responsibilities
- Technical troubleshooting (NOC handles this)
- Network configuration changes (NOC/Network Engineer)
- Billing adjustments (Billing Agent handles)
- Financial transactions (Finance handles)
- Contract modifications (Sales handles)

## Inputs
- Customer identifier (phone number, customer ID, account number)
- Inquiry message (text, voice, call)
- Service status data
- Billing information
- Ticket data
- Customer history and interaction records

## Outputs
- Customer identification and profile
- Service status information
- Billing details and payment status
- Created tickets (for technical issues)
- Response messages (text, voice)
- Escalation notifications
- Customer satisfaction scores

## Owned Domains
- Customer Service
- Commercial
- Customer Interaction
- First-Level Support

## Read Permissions
- Customer records (name, address, contact)
- Service status and configuration
- Billing and payment records
- Ticket history
- Customer interaction history

## Write Permissions
- Ticket creation (for technical issues)
- Customer interaction logs
- Service status updates (limited)
- Customer notification records

## Tools
- CRM system
- Service status API
- Billing API
- Ticket system
- WhatsApp/SMS gateway
- Telegram integration
- Customer knowledge base

## Risk Classification
- MEDIUM: Incorrect information provided to customer
- MEDIUM: Wrong customer identification
- LOW: Ticket creation errors
- LOW: Notification delivery failures

## Approval Requirements
- Billing adjustments: Billing Officer approval
- Service cancellation: CS Manager approval
- Refunds: Finance Manager approval
- Contract modifications: Sales Manager approval

## Human Escalation
- Complex technical issues beyond first-level support
- Billing disputes requiring review
- Customer threats or complaints
- Repeated customer issues
- Security or fraud concerns

## Memory Requirements
- 128MB for active conversations
- Persistent storage for customer interaction history
- Context window for conversation continuity

## Knowledge Requirements
- Product and service offerings
- Package features and pricing
- Common troubleshooting steps
- Billing policies and procedures
- Escalation procedures
- Local language and communication etiquette

## KPIs
- First response time
- First contact resolution rate
- Customer satisfaction score (CSAT)
- Ticket creation rate
- Average handling time
- Escalation rate

## Events Consumed
- Customer inquiry events (phone, WhatsApp, Telegram)
- Service status change events
- Ticket status change events
- Billing events
- Customer feedback events

## Events Produced
- Ticket creation events
- Escalation events
- Customer notification events
- Interaction logging events
- Satisfaction survey events

## Dependencies
- CRM system
- Service status APIs
- Billing system
- Ticket system
- WhatsApp/SMS gateway
- Telegram bot
- Customer knowledge base

## Failure Handling
- Authentication failure: Prompt for re-authentication
- Service check failure: Log, notify NOC, inform customer
- Ticket creation failure: Retry, log, escalate
- Notification delivery failure: Retry via alternative channel

## Timeout
- Max inquiry response: 2 minutes
- Max service check: 30 seconds
- Max ticket creation: 1 minute
- Max escalation: 5 minutes

## Retry Policy
- Service checks: 2 retries with 5-second backoff
- Ticket creation: 2 retries with 10-second backoff
- Notification: 3 retries with 30-second backoff

## Idempotency
- Service status checks are idempotent
- Ticket creation is not idempotent (requires unique IDs)
- Notifications are idempotent (same message safe to retry)

## Audit Requirements
- All customer interactions logged with full transcript
- All customer data accessed logged
- All tickets created logged
- All escalations logged with reason
- Customer identification attempts logged

## Security Requirements
- Customer data protection (PII)
- Authentication required for sensitive information
- Conversation logging for quality and compliance
- No storage of payment card information
- Fraud detection alerts

## Example Workflows

### 1. Internet Down Complaint
```
Customer: "Internet saya mati"
→ AI CS Agent identifies customer via phone number
→ Check service status → ONT offline
→ Check recent alerts → POP-03 outage detected
→ Create ticket → TKT-2026-0147
→ Notify customer: "Gangguan terdeteksi di area Anda. 
 Teknisi sedang menangani. Estimasi perbaikan 2 jam."
```

### 2. Billing Inquiry
```
Customer: "Berapa tagihan saya bulan ini?"
→ AI CS Agent identifies customer
→ Check billing record
→ Respond: "Tagihan Anda Rp 275.000, 
 sudah termasuk paket 20Mbps. Jatuh tempo 15 September."
```

### 3. New Service Inquiry
```
Customer: "Saya mau daftar internet"
→ AI CS Agent identifies location
→ Check coverage availability
→ If available → Create lead, notify Sales
→ If not available → Explain, add to waitlist
```

## Forbidden Actions
- Modifying billing amounts without approval
- Changing customer personal information
- Accessing other customers' data
- Making promises beyond authority
- Transferring calls without customer consent
- Providing competitor pricing information

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `organization/STRUCTURE.md`
- `processes/BP-TICKET-001.md`
- `processes/BP-CUSTOMER-001.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `ai/TELEGRAM-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`
- `RULE-REGISTRY.md`
- `DECISION-REGISTER.md`
- `OWNER-DECISIONS.md`
- `07-Business-Operating-System.md`