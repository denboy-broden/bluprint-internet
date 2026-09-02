# Workflows

This directory contains technical workflow definitions for the RT/RW Net AI Operating System.

A **workflow** is the technical implementation of a business process — the sequence of states, transitions, events, and agent handoffs that a task goes through from trigger to completion.

## Workflow Index

| ID | Workflow | Domain | Trigger | Agents Involved | Status |
|----|----------|--------|---------|-----------------|--------|
| WF-CUSTOMER-001 | Customer Onboarding | Customer/Sales | Sales order created | Sales, CS, NOC, Field, Billing | Draft |
| WF-CUSTOMER-002 | Customer Termination | Customer | Termination request | CS, Billing, Finance, NOC | Draft |
| WF-INCIDENT-001 | Incident Response | Operations/Network | Monitoring alert | NOC, Ticket, CS, Field | Draft |
| WF-TICKET-001 | Ticket Lifecycle | Operations/CS | Customer complaint | CS, Ticket, NOC, Field | Draft |
| WF-BILLING-001 | Invoice & Collection | Billing/Finance | Billing cycle | Billing, Finance, Accounting | Draft |
| WF-PROCUREMENT-001 | Procurement | Supply/Inventory | Low stock alert | Inventory, Finance, Procurement | Draft |

## Workflow Definition Format

Each workflow follows this structure:

```
WORKFLOW ID: WF-{DOMAIN}-{NUMBER}
Name: {Workflow name}
Domain: {Business domain}
Trigger: {What starts the workflow}
Owner: {Role responsible}

States
------
List of states the workflow transitions through.

State Transitions
-----------------
Table: From State → To State (Condition → Action → Agent)

Agent Involvement
-----------------
Which agents participate and at what step.

Events
------
Events produced and consumed during the workflow.

SLA
---
Time limits for each state.

Approval Points
---------------
Actions that require human approval.

Error Handling
--------------
What happens when something fails.
```

## References
- `processes/` – Business process definitions
- `ai/agents/` – Agent specifications
- `ai/AGENT-COMMUNICATION-PROTOCOL.md` – Agent communication format
- `business-rules/RULE-REGISTRY.md` – Business rules