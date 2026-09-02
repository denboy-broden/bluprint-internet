# Human vs AI Authority Matrix

## Authority Levels

| Level | Description | Who Decides |
|-------|-------------|-------------|
| L0 | Human Only | Human makes all decisions |
| L1 | AI Read / Observe | AI can read, human decides |
| L2 | AI Recommend | AI suggests, human approves |
| L3 | AI Draft | AI creates draft, human reviews |
| L4 | AI Execute with Approval | AI executes after human approval |
| L5 | AI Execute Automatically | AI executes without human intervention |

---

## Domain Authority Matrix

| Action | Domain | Level | Approval Required |
|--------|--------|-------|-------------------|
| View customer data | Customer | L1 | No |
| Create customer record | Customer | L2 | No (validation only) |
| Modify customer profile | Customer | L2 | Policy check |
| Delete customer record | Customer | L0 | Owner approval |
| Generate invoice | Billing | L3 | No (system automated) |
| Send invoice | Billing | L4 | No (system automated) |
| Apply discount | Billing | L2 | Manager approval |
| Refund payment | Payment | L0 | Finance Manager |
| Record payment | Payment | L4 | Auto-reconciliation |
| Bank reconciliation | Finance | L2 | Accountant review |
| Create journal entry | Accounting | L2 | Accountant review |
| Month-end close | Accounting | L1 | Accountant driven |
| View network status | Network | L1 | No |
| Restart router interface | Network | L4 | NOC Manager |
| Disable customer port | Network | L4 | NOC Manager |
| Change firewall rule | Network | L0 | Network Engineer + Owner |
| Change routing table | Network | L0 | Network Engineer + Owner |
| Create VLAN | Network | L2 | Network Engineer review |
| Assign IP address | Network | L2 | Network Engineer review |
| OLT port configuration | Network | L2 | NOC Operator review |
| ONT registration | Network | L3 | Field Tech validates |
| View ticket | Ticket | L1 | No |
| Classify ticket | Ticket | L4 | Auto-classification |
| Assign ticket | Ticket | L4 | Auto-assignment rules |
| Close ticket | Ticket | L2 | CS validation |
| Create incident | Incident | L4 | Auto from monitoring |
| Declare major incident | Incident | L0 | NOC Manager + Management |
| Close incident | Incident | L2 | NOC validation |
| Create work order | Field Ops | L4 | Auto from ticket |
| Assign technician | Field Ops | L4 | Auto by location/skill |
| Complete work order | Field Ops | L2 | Supervisor verification |
| Check stock level | Inventory | L1 | No |
| Reserve stock | Inventory | L4 | Auto for work order |
| Issue stock | Inventory | L2 | Tech confirmation |
| Create purchase request | Procurement | L2 | Manager approval |
| Create purchase order | Procurement | L2 | Manager approval |
| Approve purchase order | Procurement | L0 | Finance Manager (amount > threshold) |
| Receive goods | Procurement | L2 | Warehouse verification |
| Create campaign | Marketing | L2 | Manager review |
| Launch ad | Marketing | L2 | Budget check |
| Pause campaign | Marketing | L4 | Auto by budget |

---

## Network Actions Detail

| Network Action | AI Level | Required Approval | Risk Level |
|----------------|----------|-------------------|------------|
| Ping / trace | L5 | None | LOW |
| SNMP query | L5 | None | LOW |
| Get interface status | L5 | None | LOW |
| Get OLT status | L5 | None | LOW |
| Get customer connection | L5 | None | LOW |
| Disable customer port | L4 | NOC Manager | MEDIUM |
| Enable customer port | L4 | NOC Manager | MEDIUM |
| Restart router | L4 | NOC Manager | HIGH |
| Restart OLT | L0 | Network Engineer + Owner | CRITICAL |
| Change firewall | L0 | Network Engineer + Owner | CRITICAL |
| Change routing | L0 | Network Engineer + Owner | CRITICAL |
| Create VLAN | L2 | Network Engineer | HIGH |
| Modify VLAN | L2 | Network Engineer | HIGH |
| Assign static IP | L2 | Network Engineer | MEDIUM |
| Configure PPPoE | L2 | NOC Operator | MEDIUM |
| Provision ONT | L3 | Field Tech validates | HIGH |
| Deprovision ONT | L3 | Field Tech validates | HIGH |
| Firmware upgrade | L0 | Network Engineer + Owner | CRITICAL |
| Config backup | L4 | NOC Manager | MEDIUM |
| Config restore | L0 | Network Engineer + Owner | CRITICAL |

---

## Finance Actions Detail

| Finance Action | AI Level | Required Approval |
|----------------|----------|-------------------|
| View cash balance | L5 | None |
| View bank balance | L5 | None |
| Create expense record | L3 | Policy check |
| Approve expense | L2 | Manager (threshold) |
| Initiate transfer | L4 | Dual approval > threshold |
| Reconcile bank | L2 | Accountant review |
| Generate financial report | L4 | Auto-scheduled |
| Adjust journal | L0 | Accountant only |

---

## AI Safety Constraints

1. **No direct database writes** - All writes through Business Services
2. **No network config without approval** - All network changes require human
3. **No financial transactions without approval** - Money movement = human approval
4. **No customer data modification without audit** - Every change audited
5. **No privilege escalation** - AI cannot grant itself permissions
6. **All high-risk actions require Owner approval** - Critical actions = Owner

---

## Authority Escalation Path

```
L1 (Read) → L2 (Recommend) → L3 (Draft) → L4 (Execute with Approval) → L5 (Auto)
                    ↓
            Escalation to human
            if confidence < threshold
            or risk > threshold
```