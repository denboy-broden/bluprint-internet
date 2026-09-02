# RENUSA Business Processes

## Overview

This directory contains detailed business process definitions for the RT/RW Net AI Operating System. Each process follows a standard format and is mapped to the relevant business domain.

---

## Process Index

| Process ID | Process Name | Domain | Priority | Status |
|------------|-------------|--------|----------|--------|
| BP-CUSTOMER-001 | Customer Onboarding | Customer | MUST | Draft |
| BP-CUSTOMER-002 | Customer Termination | Customer | MUST | Draft |
| BP-BILLING-001 | Invoice Generation | Billing | MUST | Draft |
| BP-BILLING-002 | Payment Processing | Billing | MUST | Draft |
| BP-BILLING-003 | Overdue Collection | Billing | MUST | Draft |
| BP-NETWORK-001 | Service Activation | Network | MUST | Draft |
| BP-NETWORK-002 | Service Suspension | Network | MUST | Draft |
| BP-NETWORK-003 | Service Restoration | Network | MUST | Draft |
| BP-TICKET-001 | Ticket Lifecycle | Ticket | MUST | Draft |
| BP-INCIDENT-001 | Incident Management | Incident | MUST | Draft |
| BP-FIELD-001 | Work Order Execution | Field Ops | MUST | Draft |
| BP-INVENTORY-001 | Stock Replenishment | Inventory | MUST | Draft |
| BP-SALES-001 | Lead to Customer | Sales | MUST | Draft |
| BP-MARKETING-001 | Campaign Execution | Marketing | MUST | Draft |

---

## Process Definition Format

```
PROCESS ID: BP-{DOMAIN}-{NUMBER}
Process Name: {Name}
Domain: {Business Domain}
Owner: {Role responsible}
Priority: {MUST / SHOULD / COULD}
Status: {Draft / Review / Approved / Implemented}

Purpose
------
Why this process exists and what business value it delivers.

Trigger
-------
What initiates this process (event, schedule, action).

Actors
------
Who participates in this process:
- Primary: {Actor}
- Secondary: {Actor}
- System: {System/Agent}

Inputs
------
What data/information is needed:
- {Input 1}
- {Input 2}

Outputs
-------
What the process produces:
- {Output 1}
- {Output 2}

Steps
-----
1. Step description
2. Step description
3. Step description

Decision Points
---------------
- If {condition} then {action} else {action}
- If {condition} then {escalate to role}

Business Rules Applied
---------------------
- BR-{DOMAIN}-{NUMBER}: {Rule summary}
- BR-{DOMAIN}-{NUMBER}: {Rule summary}

KPIs
----
- {KPI Name}: Target {value}
- {KPI Name}: Target {value}

Exceptions
-----------
- {Exception scenario}: {Handling}
- {Exception scenario}: {Handling}

Approval Requirements
--------------------
- {Action}: Requires {Approver Role}
- {Action}: No approval required

System Dependencies
-------------------
- {Module/System}
- {Module/System}

Status: {Draft / Review / Approved / Implemented}
Owner: {Role}
Last Updated: {Date}
```

---

## BP-CUSTOMER-001: Customer Onboarding

**Process Name:** Customer Onboarding  
**Domain:** Customer / Sales  
**Owner:** Sales Manager  
**Priority:** MUST  
**Status:** Draft

### Purpose
Convert a prospect into an active customer with service installed and billing initiated.

### Trigger
- Prospect agrees to subscription
- Sales order created
- Down payment received

### Actors
| Role | Participation |
|------|--------------|
| Sales Agent | Primary - coordinates onboarding |
| Field Technician | Secondary - performs installation |
| CS Agent | Secondary - final activation |
| AI Sales Agent | System - monitors SLA |
| AI Field Ops Agent | System - schedules technician |

### Steps

```
1. SALES ORDER CREATED
   └─ System creates onboarding task
   └─ AI Sales Agent notified

2. COVERAGE & CAPACITY CHECK
   └─ Check POP availability
   └─ Check bandwidth capacity
   └─ If not available → notify Sales, stop process

3. CUSTOMER REGISTRATION
   └─ Create customer record
   └─ Collect: name, address, phone, ID, contact
   └─ Validate required fields (BR-CUSTOMER-003)
   └─ Assign customer ID: CUST-{YYYY}-{NNNN}

4. SERVICE CREATION
   └─ Create service record linked to customer
   └─ Assign package based on subscription
   └─ Generate PPPoE credentials
   └─ Assign IP address

5. INSTALLATION SCHEDULING
   └─ Field Ops Agent schedules technician
   └─ Send appointment to customer
   └─ Prepare materials (ONT, cable, etc.)

6. INSTALLATION EXECUTION
   └─ Technician visits customer site
   └─ Install ONT and cabling
   └─ Configure PPPoE on customer router
   └─ Test connectivity
   └─ Record signal levels

7. INSTALLATION VERIFICATION
   └─ NOC Agent verifies connection
   └─ Confirm ONT online in OLT
   └─ Confirm PPPoE session active
   └─ Speed test passed

8. SERVICE ACTIVATION
   └─ CS Agent activates service
   └─ Billing cycle starts
   └─ Send welcome notification to customer

9. FIRST INVOICE GENERATION
   └─ Billing Agent generates first invoice
   └─ Include installation fee if any
   └─ Set due date per billing cycle
```

### Decision Points

| Condition | Action |
|-----------|--------|
| POP not available | Notify Sales, pause onboarding, suggest alternative area |
| Capacity exceeded | Notify Sales, pause onboarding, queue for capacity expansion |
| Installation fails | Create maintenance ticket, reschedule |
| Customer not home | Reschedule installation, log attempt |

### Business Rules Applied
- BR-CUSTOMER-001: Customer Identity Uniqueness
- BR-CUSTOMER-002: Customer Status Validity
- BR-CUSTOMER-003: Customer Profile Required Fields
- BR-CUSTOMER-004: Customer Termination Requires Settlement (future)

### KPIs
| KPI | Target | Owner |
|-----|--------|-------|
| Onboarding completion rate | > 95% | Sales Manager |
| Average onboarding time | < 5 days | Operations Manager |
| First-time installation success | > 90% | NOC Manager |

### Exceptions
| Scenario | Handling |
|----------|----------|
| Customer cancels before installation | Mark as CANCELLED, no charges |
| Installation fee unpaid | Delay installation until paid |
| Equipment damaged during install | Replace under warranty, log incident |

### Approval Requirements
| Action | Approval Required |
|--------|-----------------|
| Service activation | No (automated after verification) |
| Waive installation fee | Sales Manager |
| Cancel onboarding | Sales Manager |

---

## BP-TICKET-001: Ticket Lifecycle

**Process Name:** Ticket Lifecycle  
**Domain:** Ticket / Customer Service  
**Owner:** CS Manager  
**Priority:** MUST  
**Status:** Draft

### Purpose
Track and resolve customer-reported issues from creation to closure.

### Trigger
- Customer reports issue via phone, WhatsApp, or Telegram
- AI CS Agent receives complaint
- Network alert auto-creates ticket

### Actors
| Role | Participation |
|------|--------------|
| CS Agent | Primary - receives and classifies ticket |
| AI CS Agent | System - triages and routes |
| AI Ticket Agent | System - monitors SLA |
| NOC Operator | Secondary - technical diagnosis |
| AI NOC Agent | System - root cause analysis |
| Field Technician | Secondary - on-site resolution |
| AI Field Ops Agent | System - schedules work |

### Steps

```
1. ISSUE RECEIVED
   └─ Customer reports via channel (phone/WhatsApp/Telegram)
   └─ AI CS Agent identifies customer
   └─ Log interaction in customer history

2. TICKET CREATION
   └─ AI CS Agent creates ticket
   └─ Assign ticket ID: TKT-{YYYY}-{NNNN}
   └─ Record: customer, contact, issue, channel, timestamp

3. INITIAL TRIAGE
   └─ AI CS Agent classifies issue type:
      - TECHNICAL (network/service issue)
      - BILLING (payment/invoice issue)
      - SALES (package/upgrade inquiry)
      - COMPLAINT (service quality)
      - OTHER
   └─ Set priority based on urgency

4. PRIORITY ASSIGNMENT
   ┌─ PRIORITY P1 (Critical)
   │  └─ Service completely down
   │  └─ Multiple customers affected
   │  └─ Security incident
   │
   ├─ PRIORITY P2 (High)
   │  └─ Slow connection impacting work
   │  └─ Intermittent outages
   │  └─ Billing error causing service risk
   │
   ├─ PRIORITY P3 (Medium)
   │  └─ Single customer issue
   │  └─ General inquiry
   │  └─ Non-urgent complaint
   │
   └─ PRIORITY P4 (Low)
      └─ Information request
      └─ General feedback
      └─ Enhancement suggestion

5. ROUTING
   └─ TECHNICAL → NOC queue
   └─ BILLING → Billing queue
   └─ SALES → Sales queue
   └─ COMPLAINT → CS Manager review

6. DIAGNOSIS (Technical Tickets)
   └─ NOC Agent checks:
      - Customer ONT status
      - POP/OLT status
      - Recent alerts in area
      - Historical similar tickets
   └─ If remote fix possible → execute fix → resolve
   └─ If field visit required → create Work Order

7. RESOLUTION
   └─ NOC resolves remotely
      └─ Notify customer of resolution
      └─ Verify customer satisfaction
      └─ Close ticket
   │
   └─ Field resolves on-site
      └─ Field Tech completes work
      └─ NOC verifies fix
      └─ CS notifies customer
      └─ Close ticket

8. TICKET CLOSURE
   └─ Record resolution summary
   └─ Record time to resolve
   └─ Customer satisfaction check
   └─ Ticket status → CLOSED
```

### SLA Targets
| Priority | First Response | Resolution | Escalation |
|----------|---------------|------------|------------|
| P1 | 15 minutes | 4 hours | 2 hours |
| P2 | 1 hour | 24 hours | 8 hours |
| P3 | 4 hours | 72 hours | 48 hours |
| P4 | 24 hours | 7 days | N/A |

### Decision Points

| Condition | Action |
|-----------|--------|
| Same issue repeated by customer | Check if previous ticket closed, escalate to CS Manager |
| Network-wide outage detected | Convert to INCIDENT, notify NOC Manager |
| Customer threatens termination | Escalate to CS Manager, trigger retention process |
| Ticket approaching SLA breach | Auto-escalate, notify supervisor |

### Business Rules Applied
- BR-TICKET-001: Ticket must have valid customer association
- BR-TICKET-002: Ticket cannot be closed without resolution
- BR-TICKET-003: P1 tickets auto-escalate after 2 hours

### KPIs
| KPI | Target | Owner |
|-----|--------|-------|
| First response time | < SLA target | CS Manager |
| Resolution time | < SLA target | CS Manager |
| Ticket reopens | < 5% | CS Manager |
| Customer satisfaction | > 4.0/5.0 | CS Manager |

### Approval Requirements
| Action | Approval Required |
|--------|-----------------|
| Close ticket without resolution | CS Manager |
| Cancel ticket | CS Manager |
| Refund based on ticket | Finance Manager |

---

## BP-BILLING-001: Invoice Generation

**Process Name:** Invoice Generation  
**Domain:** Billing  
**Owner:** Billing Officer  
**Priority:** MUST  
**Status:** Draft

### Purpose
Generate accurate invoices for all active services on a scheduled billing cycle.

### Trigger
- Billing cycle date (e.g., 1st of month)
- Manual trigger by Billing Officer
- Service activation (pro-rated first invoice)

### Steps

```
1. BILLING CYCLE TRIGGER
   └─ System checks billing cycle date
   └─ AI Billing Agent initiates invoice run
   └─ Lock billing period

2. CUSTOMER SELECTION
   └─ Query all ACTIVE services
   └─ Exclude: SUSPENDED, TERMINATED, PENDING
   └─ Calculate billing period for each customer

3. INVOICE LINE ITEMS
   For each customer:
   ├─ Monthly package fee
   ├─ Additional services (if any)
   ├─ Previous balance (carried over)
   ├─ Adjustments (credits, discounts)
   ├─ Pro-rated amounts (for partial months)
   └─ Calculate subtotal and total

4. INVOICE RECORD CREATION
   └─ Generate Invoice ID: INV-{YYYY}{MM}-{NNNN}
   └─ Link to customer and service
   └─ Record line items
   └─ Set due date (e.g., 15th of month)
   └─ Set late penalty start date

5. INVOICE DELIVERY
   └─ Send invoice via:
      - Email (if available)
      - WhatsApp
      - Telegram
      - Physical copy (if needed)
   └─ AI Billing Agent sends automated notification

6. TRACKING
   └─ Mark invoice as ISSUED
   └─ Start payment tracking
   └─ Schedule overdue check for due date + 1
```

### Business Rules Applied
- BR-BILLING-001: Invoice must have valid customer
- BR-BILLING-002: Invoice total must match line items sum
- BR-BILLING-003: Late payment penalty applied after due date

### KPIs
| KPI | Target | Owner |
|-----|--------|-------|
| Invoice generation accuracy | 100% | Billing Officer |
| Invoice delivery rate | > 95% | Billing Officer |
| On-time invoice generation | > 99% | Billing Officer |

---

## BP-NETWORK-001: Service Suspension

**Process Name:** Service Suspension  
**Domain:** Network / Billing  
**Owner:** Billing Officer / NOC Manager  
**Priority:** MUST  
**Status:** Draft

### Purpose
Suspend customer service due to non-payment while maintaining service configuration.

### Trigger
- Invoice overdue > 30 days (BR-CUSTOMER-005)
- Manual trigger by Billing Officer
- Owner approval for urgent suspension

### Steps

```
1. OVERDUE CHECK (Daily)
   └─ AI Billing Agent runs daily check
   └─ Query invoices with status OVERDUE
   └─ Calculate days overdue for each

2. SUSPENSION ELIGIBILITY
   └─ Customer has invoice overdue > 30 days
   └─ Customer has no pending payment arrangement
   └─ Customer not on exemption list
   └─ If eligible → proceed to suspension
   └─ If not eligible → log reason, skip

3. SUSPENSION PREPATION
   └─ AI Billing Agent creates suspension task
   └─ Notify CS Agent to prepare customer notification
   └─ NOC Agent prepares network action

4. NETWORK ACTION
   └─ NOC Agent / AI NOC Agent:
      ├─ Option A: Disable PPPoE session (reversible)
      ├─ Option B: Disable VLAN port (reversible)
      └─ Do NOT delete configuration (reversible)
   └─ Record action taken with timestamp

5. CUSTOMER NOTIFICATION
   └─ Send via WhatsApp/Telegram:
      "Layanan internet Anda telah dinonaktifkan sementara 
      karena tagihan belum dibayar. 
      Pastikan pelunasan agar layanan bisa diaktifkan kembali."
   └─ Include: invoice amount, due date, payment instructions

6. RECORD UPDATE
   └─ Update customer status → SUSPENDED
   └─ Update service status → SUSPENDED
   └─ Record suspension date and reason
   └─ Log in customer history

7. FOLLOW-UP SCHEDULING
   └─ Schedule reminder for 7 days after suspension
   └─ If still unpaid → escalate to Finance Manager
```

### Decision Points

| Condition | Action |
|-----------|--------|
| Customer has payment arrangement | Do not suspend, note arrangement |
| Customer is on priority list (hospital, etc.) | Escalate to Owner for decision |
| Network action fails | Retry once, then alert NOC Manager |
| Customer pays before suspension completes | Cancel suspension, restore service |

### Approval Requirements
| Action | Approval Required |
|--------|-----------------|
| Auto-suspension (30+ days overdue) | No (automated per rule) |
| Manual suspension | Billing Officer |
| Emergency suspension | Finance Manager |
| Owner exemption | Owner |

### KPIs
| KPI | Target | Owner |
|-----|--------|-------|
| Suspensions on time | 100% per rule | Billing Officer |
| Successful suspensions | > 99% | NOC Manager |
| Customer notification rate | 100% | CS Agent |

---

## Process Status Legend

| Status | Meaning |
|--------|---------|
| **Draft** | Initial creation, under review |
| **Review** | Being reviewed by stakeholders |
| **Approved** | Approved for implementation |
| **Implemented** | Live in production |
| **Deprecated** | Superseded by another process |

---

## How to Add New Processes

1. Copy the Process Definition Format above
2. Create a new file: `BP-{DOMAIN}-{NUMBER}.md`
3. Fill in all sections
4. Update this README with the new process
5. Submit for review and approval
6. Update status to "Approved" after Owner sign-off

## References

- `DOMAIN-MODEL.md` - Business domain definitions
- `business-rules/RULE-REGISTRY.md` - Business rules applied
- `SECURITY-ARCHITECTURE.md` - Role permissions
- `ai/HUMAN-VS-AI-AUTHORITY.md` - Approval requirements
- `workflows/` - Technical workflow implementations

## Owner

**Last Updated:** 2026-09-01  
**Document Owner:** Project Lead  
**Review Cycle:** Quarterly