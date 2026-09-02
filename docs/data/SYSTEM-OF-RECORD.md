# Data Ownership Gate

## System of Record Matrix

| Entity | Owner Domain | Source of Truth | Writers | Readers |
|--------|-------------|-----------------|---------|---------|
| Customer | Customer | Business DB | Customer Service, Sales | All domains |
| Contact | Customer | Business DB | Customer Service | Customer domain |
| Lead | Sales | Business DB | Sales, Marketing | Sales, Marketing |
| Opportunity | Sales | Business DB | Sales | Sales |
| Service | Service | Business DB | NOC, Billing | Network, Billing, Customer |
| Package | Service | Business DB | Service | Sales, Billing |
| Invoice | Billing | Business DB | Billing | Customer, Finance, Payment |
| Payment | Payment | Business DB | Payment, Finance | Finance, Accounting, Customer |
| Cash Account | Finance | Business DB | Finance | Management, Accounting |
| Bank Account | Finance | Business DB | Finance | Management, Accounting |
| Journal Entry | Accounting | Business DB | Accounting | Accounting, Management |
| POP | Network | Network DB + Business DB | NOC | NOC, Field Ops |
| Router | Network | Network DB | NOC | NOC, Field Ops |
| OLT | Network | Network DB | NOC | NOC, Field Ops |
| ONT/ONU | Network | Network DB | NOC, Field Ops | NOC, Customer |
| Ticket | Ticket | Business DB | CS, NOC | All operations |
| Incident | Incident | Business DB + NMS | NOC | NOC, Management |
| Work Order | Field Ops | Business DB | Field Ops | Field Ops, Inventory |
| Stock | Inventory | Business DB | Warehouse | Inventory, Procurement |
| Asset | Asset | Business DB | Warehouse | Field Ops, Inventory |
| Purchase Request | Procurement | Business DB | Procurement | Procurement, Finance |
| Purchase Order | Procurement | Business DB | Procurement | Procurement, Warehouse |
| Supplier | Procurement | Business DB | Procurement | Procurement |
| Employee | HR | Business DB | HR | HR, Management |
| Campaign | Marketing | Business DB | Marketing | Marketing, Sales |
| Customer Interaction | Customer Service | Business DB | CS | CS, NOC |

## Single Source of Truth Rules

1. Each entity has exactly ONE primary owner domain.
2. Each entity has exactly ONE source of truth system.
3. Other domains can READ but cannot WRITE to entities they don't own.
4. Cross-domain updates happen via events, not direct writes.
5. AI agents can READ but cannot directly WRITE except through defined tools.

## Exceptions Documented

No exceptions found at this stage. If identified, document with justification and Owner approval.