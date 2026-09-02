# RENUSA Business Rule Registry

## Rule Format

```
BR-{DOMAIN}-{NUMBER}
Category: {Category}
Rule: {Rule statement}
Description: {Why this rule exists}
Trigger: {When rule is evaluated}
Actor: {Who enforces this rule}
Preconditions: {What must be true before evaluation}
Validation: {How rule is checked}
Action: {What happens if rule passes/fails}
Result: {Outcome of rule execution}
Exception: {When rule does not apply}
Risk: {Business/Operational risk}
Approval: {Required approval}
Audit: {What gets logged}
Status: CONFIRMED | PROPOSED | NEEDS_OWNER_DECISION | DEFERRED
Owner: {Role responsible for rule}
```

---

# CUSTOMER RULES

## BR-CUSTOMER-001: Customer Identity Uniqueness
- **Category**: Data Integrity
- **Rule**: No two customers may have the same combination of (full_name + date_of_birth + address)
- **Trigger**: Customer creation or update
- **Actor**: Customer Service
- **Preconditions**: Customer registration data submitted
- **Validation**: Database uniqueness check
- **Action**: Block creation if duplicate detected
- **Result**: Customer record created or duplicate warning shown
- **Exception**: Same person with different service locations
- **Risk**: MEDIUM (data quality)
- **Approval**: NO
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Sales Manager

## BR-CUSTOMER-002: Customer Status Validity
- **Category**: State Management
- **Rule**: Customer status must follow valid lifecycle: LEAD → PROSPECT → ACTIVE → SUSPENDED → ACTIVE → TERMINATED
- **Trigger**: Status change event
- **Actor**: System / CS Agent
- **Preconditions**: Customer exists
- **Validation**: State machine check
- **Action**: Reject invalid transitions
- **Result**: Status updated or rejected
- **Exception**: Termination from any state (with Owner approval)
- **Risk**: HIGH (business logic)
- **Approval**: NO (for normal flow), YES (early termination)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Sales Manager

## BR-CUSTOMER-003: Customer Profile Required Fields
- **Category**: Data Quality
- **Rule**: A customer cannot become ACTIVE without: name, address, contact_phone, ID_number, package_selected
- **Trigger**: Activation attempt
- **Actor**: CS Agent / Sales Agent
- **Preconditions**: Customer in PROSPECT state
- **Validation**: Field completeness check
- **Action**: Block activation if fields missing
- **Result**: Activation proceeds or blocked
- **Exception**: NONE
- **Risk**: HIGH
- **Approval**: NO
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner': Sales Manager

## BR-CUSTOMER-004: Customer Termination Requires Settlement
- **Category**: Financial
- **Rule**: A customer cannot be terminated while having unpaid invoices
- **Trigger**: Termination request
- **Actor**: CS Agent / Billing Officer
- **Preconditions**: Outstanding balance check
- **Validation**: Invoice status check
- **Action**: Block termination OR force suspension
- **Result**: Termination proceeds or blocked
- **Exception**: With Finance Manager approval for write-off
- **Risk**: HIGH
- **Approval**: YES (Finance Manager)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Billing Officer

## BR-CUSTOMER-005: Customer Suspension After Non-Payment
- **Category**: Billing
- **Rule**: Customer service must be suspended after 30 days of unpaid invoice
- **Trigger**: Daily overdue check
- **Actor**: Billing System / Billing Officer
- **Preconditions**: Invoice overdue > 30 days
- **Validation**: Days overdue calculation
- **Action**: Auto-suspend service (with notification)
- **Result**: Service suspended, customer notified
- **Exception**: Owner can grant extension (max 7 days)
- **Risk**: HIGH (revenue impact)
- **Approval**: NO (automated), YES (extension)
- **Audit**: YES
- **Status**: CONFIRMED
- **Owner**: Billing Officer