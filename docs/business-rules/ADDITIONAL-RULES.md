# Network Domain — Additional Business Rules

## BR-NETWORK-001: Network Incident Declaration
- **Category**: Incident Management
- **Rule**: A network incident must be declared when monitoring detects an outage affecting 10+ customers OR any critical infrastructure (OLT/POP) failure
- **Trigger**: Monitoring alert + correlation analysis
- **Actor**: NOC Agent / NOC Manager
- **Preconditions**: Monitoring data available, correlation engine functional
- **Validation**: Impact count verification, severity assessment
- **Action**: Create incident record, notify NOC Manager, notify affected customers
- **Result**: Incident declared and tracked
- **Exception**: Isolated single-customer issue (handled as ticket, not incident)
- **Risk**: HIGH (service availability impact)
- **Approval**: NO (auto-declare for 10+ customers), YES (NOC Manager for 5-10 customers)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: NOC Manager

## BR-NETWORK-002: Service Suspension for Non-Payment
- **Category**: Network / Billing
- **Rule**: Customer service must be suspended after 30 days of unpaid invoice using network-level actions (disable port/session)
- **Trigger**: Daily overdue check
- **Actor**: Billing Agent / NOC Agent
- **Preconditions**: Invoice overdue > 30 days, no payment arrangement
- **Validation**: Outstanding balance check, suspension eligibility
- **Action**: Auto-suspend (disable PPPoE session / VLAN port) with notification
- **Result**: Service suspended, customer notified
- **Exception**: Owner can grant extension (max 7 days)
- **Risk**: HIGH (revenue impact + customer satisfaction)
- **Approval**: NO (automated), YES (extension approval)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Billing Officer

## BR-NETWORK-003: Critical Network Action Approval
- **Category**: Security
- **Rule**: Restart OLT, change firewall rules, or change routing table requires Owner + Network Engineer approval
- **Trigger**: AI NOC Agent recommends critical action
- **Actor**: NOC Agent / Network Engineer / Owner
- **Preconditions**: Incident severity CRITICAL, recommendation generated
- **Validation**: Severity check, impact assessment
- **Action**: Send approval request to Owner and Network Engineer
- **Result**: Action executed only after approval
- **Exception**: NONE (always requires approval)
- **Risk**: CRITICAL (security and network stability)
- **Approval**: YES (Owner + Network Engineer)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: NOC Manager

---

# Finance Domain — Additional Business Rules

## BR-FINANCE-001: Cash Flow Forecast Accuracy
- **Category**: Financial Planning
- **Rule**: Cash flow forecasts must be generated monthly and compared to actual cash positions
- **Trigger**: Monthly close
- **Actor**: Finance Agent / Finance Manager
- **Preconditions**: All billing and payment data available for period
- **Validation**: Actual vs forecast comparison
- **Action**: Generate forecast, compare to actual, adjust model
- **Result**: Forecast accuracy tracked, model improved
- **Exception**: NONE
- **Risk**: MEDIUM (business planning)
- **Approval**: NO
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Finance Manager

## BR-BILLING-001: Invoice Generation Accuracy
- **Category**: Billing Integrity
- **Rule**: Every generated invoice must have valid customer association, correct line items, and accurate total calculation
- **Trigger**: Invoice generation process
- **Actor**: Billing Agent / Billing Officer
- **Preconditions**: Customer service active, billing cycle configured, package rate available
- **Validation**: Line item sum check, customer status check, rate verification
- **Action**: Block invoice if validation fails, log error
- **Result**: Invoice accurate or generation blocked
- **Exception**: NONE
- **Risk**: HIGH (revenue accuracy)
- **Approval**: NO
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Billing Officer

---

# Procurement Domain — Additional Business Rules

## BR-PROCUREMENT-001: Purchase Order Approval
- **Category**: Procurement / Finance
- **Rule**: Purchase orders above defined thresholds require approval; emergency procurement requires retroactive approval
- **Trigger**: Purchase request created
- **Actor**: Procurement Agent / Procurement Manager / Finance Manager
- **Preconditions**: Stock level below minimum, budget available
- **Validation**: Amount threshold check, supplier verification
- **Action**: Request approval for PO above threshold
- **Result**: PO approved/rejected, supplier contacted
- **Exception**: Emergency procurement (retroactive approval required within 48 hours)
- **Risk**: MEDIUM (financial control)
- **Approval**: YES (Procurement Manager for medium, Finance Manager for high)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Procurement Manager