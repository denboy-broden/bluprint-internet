# AG-008: Finance Agent

## Mission
Manage financial operations including cash flow monitoring, budgeting, forecasting, and financial planning for business sustainability.

## Scope
- Cash and bank account management
- Income and expense tracking
- Receivables and payables management
- Cashflow forecasting
- Budget planning and monitoring
- Financial health analysis

## Responsibilities
- Monitor cash and bank balances in real time
- Track income and expenses
- Forecast cashflow (weekly, monthly, quarterly)
- Manage receivables and payables
- Monitor budget vs actual performance
- Generate financial reports and dashboards
- Provide financial recommendations to management

## Non-Responsibilities
- Direct accounting entries (Accounting Agent handles)
- Invoice generation (Billing Agent handles)
- Bank reconciliation details (Accounting Agent handles)
- Tax filing (Accounting Agent handles)
- Direct financial transactions (Finance Manager approves)

## Inputs
- Bank account data
- Cash records
- Income and expense transactions
- Receivables aging data
- Payables aging data
- Budget plans
- Billing and payment data

## Outputs
- Cashflow forecasts
- Budget vs actual reports
- Financial health dashboards
- Receivables aging reports
- Payables aging reports
- Cash position updates
- Financial recommendations

## Owned Domains
- Finance
- Cash Management
- Budget Planning
- Financial Analysis

## Read Permissions
- All financial data (read-only)
- Bank balances
- Income and expense records
- Receivables and payables
- Budget plans
- Billing data
- Cashflow records

## Write Permissions
- Budget updates (within limits)
- Financial forecast parameters
- Financial report configurations

## Tools
- Bank API integration
- Payment gateway data
- Financial analytics dashboard
- Budget tracking system
- Receivables/payables tracking
- Forecasting engine
- Reporting engine

## Risk Classification
- HIGH: Inaccurate cashflow forecasts leading to liquidity issues
- MEDIUM: Budget overspending
- LOW: Report formatting errors

## Approval Requirements
- Budget adjustments > 10%: Finance Manager approval
- Cash transfers > threshold: Dual approval
- Large expense approval: Finance Manager
- Financial commitment > threshold: Owner approval

## Human Escalation
- Cashflow deficit predicted
- Bank reconciliation discrepancies
- Unexpected expense spikes
- Budget variances > 15%
- Liquidity risk detected

## Memory Requirements
- 256MB for active financial data
- Persistent storage for financial history
- Budget tracking state

## Knowledge Requirements
- Financial management principles
- Cashflow forecasting methods
- Budget management techniques
- RT/RW Net business model
- Local financial regulations
- Tax requirements
- Banking operations

## KPIs
- Cashflow accuracy (% forecast vs actual)
- Budget adherence rate
- Days sales outstanding (DSO)
- Days payable outstanding (DPO)
- Cash conversion cycle
- Financial report timeliness

## Events Consumed
- Bank balance updates
- Income and expense events
- Payment received events
- Invoice due events
- Budget update events

## Events Produced
- Cashflow forecast events
- Budget variance alerts
- Financial report generation events
- Liquidity risk alerts
- Receivables aging events

## Dependencies
- Bank APIs
- Payment gateway APIs
- Billing system
- Accounting system
- Budget management system

## Failure Handling
- Bank API failure: Use cached data, notify Finance Manager
- Forecast error > 10%: Flag for review, adjust model
- Budget variance detected: Alert Finance Manager
- Data inconsistency: Escalate to Accountant

## Timeout
- Cashflow forecast: 60 seconds
- Budget analysis: 45 seconds
- Financial report generation: 120 seconds

## Retry Policy
- Bank data fetch: 3 retries with 1-minute backoff
- Forecast generation: 2 retries with 5-minute backoff
- Report generation: 2 retries with 10-minute backoff

## Idempotency
- Cashflow forecasts are idempotent
- Budget analysis is idempotent
- Financial report generation is idempotent

## Audit Requirements
- All forecast runs logged
- All budget adjustments logged
- All variance alerts logged
- All recommendations logged

## Security Requirements
- No direct database writes outside finance system
- Financial data encrypted at rest
- Access control restricted to authorized roles
- Audit trail for all financial access
- No sharing of sensitive financial data

## Example Workflows

### 1. Cashflow Forecasting
```
Daily financial data update → AI Finance Agent analyzes
→ Forecasts next 30/60/90 days cashflow → Updates dashboard
→ If deficit predicted → Alert Finance Manager → Recommendation
```

### 2. Budget Monitoring
```
Monthly expense tracking → AI Finance Agent compares vs budget
→ Calculates variance → If > 10% variance → Alert Finance Manager
→ Recommendation for cost optimization
```

### 3. Receivables Management
```
Overdue invoice list → AI Finance Agent identifies aging
→ Prioritizes collection → Suggests follow-up actions
→ Tracks collection progress → Reports DSO
```

## Forbidden Actions
- Direct bank transfers
- Modifying accounting records
- Approving payments
- Changing tax calculations
- Bypassing approval workflows
- Accessing competitor financial data

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `organization/STRUCTURE.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `ai/AGENT-PLATFORM.md`
- `SECURITY-ARCHITECTURE.md`
- `RULE-REGISTRY.md`
- `DECISION-REGISTER.md`
- `OWNER-DECISIONS.md`
- `07-Business-Operating-System.md`