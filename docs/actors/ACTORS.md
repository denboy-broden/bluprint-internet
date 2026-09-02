# Actors & Roles — RENUSA RT/RW Net

## Actor Definitions

| Actor ID | Name | Type | Role | Domain | Permissions | Owned By |
|----------|------|------|------|--------|-------------|---------|
| ACT-001 | Owner / Pemilik | Human | Strategic decision maker | All | Full access | — |
| ACT-002 | General Manager | Human | Operations coordinator | All | Read / Approve / Manage | Owner |
| ACT-003 | Sales Manager | Human | Sales department head | Sales / Marketing | Sales + Marketing data | GM |
| ACT-004 | Sales Agent | Human | Lead conversion | Sales | Own leads, customer records | Sales Manager |
| ACT-005 | Marketing Manager | Human | Campaign & ads head | Marketing / Ads | Marketing data, budget | GM |
| ACT-006 | Marketing Specialist | Human | Content & campaign execution | Marketing | Campaign data | Marketing Manager |
| ACT-007 | Ads Specialist | Human | Paid advertising management | Marketing / Ads | Ad platforms, budget | Marketing Manager |
| ACT-008 | CS Manager | Human | Customer service head | Customer Service | Customer + ticket data | GM |
| ACT-009 | CS Agent | Human | Customer support | Customer Service | Customer records, tickets | CS Manager |
| ACT-010 | Operations Manager | Human | Operations head | Operations / Network | All operational data | GM |
| ACT-011 | NOC Manager | Human | Network operations head | Network / Operations | Network + incident data | Operations Manager |
| ACT-012 | NOC Operator | Human | Monitor & diagnose network | Network / Operations | Monitoring, tickets | NOC Manager |
| ACT-013 | Network Engineer | Human | Network design & config | Network | Network config (approval req) | NOC Manager |
| ACT-014 | Field Operations Manager | Human | Technician scheduling head | Field Operations | Field + inventory data | Operations Manager |
| ACT-015 | Field Technician | Human | On-site installation/repair | Field Operations | Assigned work orders | Field Ops Manager |
| ACT-016 | Installation Coordinator | Human | Installation scheduling | Operations | Installation orders | Operations Manager |
| ACT-017 | Finance Manager | Human | Finance & budget head | Finance / Accounting | All financial data | GM |
| ACT-018 | Billing Officer | Human | Invoice & collection | Billing / Finance | Billing + customer data | Finance Manager |
| ACT-019 | Accountant | Human | Journal & reporting | Accounting / Finance | Accounting data | Finance Manager |
| ACT-020 | Procurement Manager | Human | Procurement & vendor | Procurement / Inventory | Procurement + supplier | GM |
| ACT-021 | Warehouse Staff | Human | Stock management | Inventory / Procurement | Inventory data | Procurement Manager |
| ACT-022 | HR Officer | Human | HR & payroll | HR | HR data | GM |
| ACT-023 | AI Orchestrator | AI | Central coordinator | AI Platform | All agent specs, workflow | Owner / GM |
| ACT-024 | AI Management Agent | AI | Executive reporting | Management / BI | Read business data | GM |
| ACT-025 | AI BI Agent | AI | Analytics & dashboard | Management / BI | Read all data | GM |
| ACT-026 | AI Sales Agent | AI | Lead → customer | Commercial / Sales | Sales data, CRM | Sales Manager |
| ACT-027 | AI Marketing Agent | AI | Campaign & lead gen | Commercial / Marketing | Marketing data | Marketing Manager |
| ACT-028 | AI Customer Service Agent | AI | Customer inquiry | Commercial / CS | Customer + ticket | CS Manager |
| ACT-029 | AI Billing Agent | AI | Invoice & collection | Finance / Billing | Billing data | Billing Officer |
| ACT-030 | AI Finance Agent | AI | Cashflow & budget | Finance | Financial data | Finance Manager |
| ACT-031 | AI Accounting Agent | AI | Journal & reconciliation | Finance / Accounting | Accounting data | Accountant |
| ACT-032 | AI NOC Agent | AI | Network monitoring | Operations / Network | Network + device | NOC Manager |
| ACT-033 | AI Ticket Agent | AI | Ticket lifecycle | Operations / Ticket | Ticket + incident | CS Manager |
| ACT-034 | AI Field Operations Agent | AI | Work order & scheduling | Operations / Field | Field + inventory | Field Ops Manager |
| ACT-035 | AI Inventory Agent | AI | Stock & procurement | Supply / Inventory | Inventory + supplier | Procurement Manager |

## Actor Interaction Rules

1. **No AI actor has direct database access** — all access via Business Services / APIs.
2. **Human approval required** for actions at L0/L4 (critical / high-risk) per `HUMAN-VS-AI-AUTHORITY.md`.
3. **Audit trail** required for all AI actor actions.
4. **Role-based access** enforced at API layer.

## References
- `GLOSSARY.md`
- `SECURITY-ARCHITECTURE.md`
- `DOMAIN-MODEL.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `organization/STRUCTURE.md`
