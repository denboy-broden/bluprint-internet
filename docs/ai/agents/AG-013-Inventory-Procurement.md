# AG-013: Inventory & Procurement Agent

## Mission
Manage stock levels, forecast material demand, recommend procurement actions, and ensure optimal inventory availability for operations.

## Scope
- Stock level monitoring and tracking
- Material demand forecasting
- Procurement recommendation generation
- Purchase order management
- Supplier relationship monitoring
- Asset lifecycle tracking
- Stock movement and allocation

## Responsibilities
- Monitor inventory levels for all stock items
- Forecast material demand based on historical usage
- Generate procurement recommendations
- Track purchase order status
- Monitor supplier performance
- Track asset movement and allocation
- Generate inventory and procurement reports
- Identify slow-moving and obsolete stock
- Optimize stock levels to reduce carrying costs

## Non-Responsibilities
- Direct financial transactions (Finance Agent handles)
- Customer billing or payment processing (Billing handles)
- Network configuration changes (NOC handles)
- Service installation (Field Operations handles)
- Direct material purchase (Procurement Manager approves)

## Inputs
- Material consumption data from work orders
- Customer installation requirements
- Historical stock movement data
- Supplier pricing and availability
- Current stock levels
- Pending purchase orders
- Equipment failure rates
- Seasonality patterns

## Outputs
- Inventory status reports
- Demand forecasts
- Procurement recommendations
- Stock alert notifications
- Asset allocation records
- Purchase order status updates
- Supplier performance reports
- Inventory optimization recommendations

## Owned Domains
- Inventory
- Procurement
- Asset Management
- Stock Management

## Read Permissions
- Stock levels and locations
- Material consumption history
- Pending purchase orders
- Supplier information
- Asset deployment records
- Equipment failure data

## Write Permissions
- Stock level updates
- Material allocation records
- Procurement request generation (requires approval)
- Asset status updates
- Stock movement records

## Tools
- Inventory management system
- Procurement request system
- Purchase order tracking
- Supplier database
- Asset tracking system
- Demand forecasting engine
- Reporting engine
- Material catalog

## Risk Classification
- HIGH: Stockout of critical materials causing service delays
- HIGH: Overstocking leading to excess carrying costs
- MEDIUM: Inaccurate demand forecasts
- MEDIUM: Supplier delays affecting operations
- LOW: Reporting errors

## Approval Requirements
- Procurement request generation: Procurement Manager approval
- Purchase order issuance: Finance Manager approval (amount > threshold)
- Stock write-off: Finance Manager + Owner approval
- Emergency procurement: Procurement Manager + Finance Manager approval
- Supplier changes: Owner approval
- Asset disposal: Finance Manager + Owner approval

## Human Escalation
- Critical material stockout predicted
- Significant stock variance detected
- Supplier quality issues
- Unusual demand spikes
- Budget overrun in procurement
- Asset loss or damage detected

## Memory Requirements
- 256MB for active inventory state
- Persistent storage for historical stock data
- Supplier information database
- Asset tracking state

## Knowledge Requirements
- Material catalog and specifications
- Stock level optimization principles
- Demand forecasting methods
- Supplier relationships
- Asset lifecycle management
- Procurement policies and procedures
- Market conditions and trends

## KPIs
- Stock availability rate
- Inventory turnover ratio
- Stockout frequency
- Excess stock ratio
- Procurement lead time
- Supplier on-time delivery rate
- Forecast accuracy
- Cost of goods sold trends
- Asset utilization rate

## Events Consumed
- Work order material consumption events
- Customer installation events
- Equipment failure events
- Supplier delivery events
- Stock movement events
- Asset allocation events

## Events Produced
- Stock alert events
- Procurement recommendation events
- Purchase order status events
- Stock update events
- Asset movement events
- Inventory reports

## Dependencies
- Work order system
- Purchase order system
- Supplier APIs
- Asset tracking system
- Finance system (for procurement cost tracking)

## Failure Handling
- Stockout predicted: Auto-alert, expedite procurement
- Overstock detected: Reduce purchase quantity, suggest transfer
- Supplier delivery failure: Re-order from backup supplier
- Forecast error > 20%: Adjust model, flag for review
- Asset tracking failure: Manual verification, escalate

## Timeout
- Stock check: 30 seconds
- Demand forecast: 120 seconds
- Procurement recommendation: 60 seconds
- Purchase order status: 30 seconds

## Retry Policy
- Stock check: 2 retries with 10-second backoff
- Forecast generation: 2 retries with 15-minute backoff
- PO status check: 2 retries with 1-minute backoff
- Supplier query: 2 retries with 30-second backoff

## Idempotency
- Stock checks are idempotent
- Demand forecasts are idempotent (same data = same result)
- PO status checks are idempotent
- Procurement recommendations are idempotent

## Audit Requirements
- All stock movements logged
- All procurement requests logged with approval
- All purchase orders logged
- All asset allocations and movements logged
- All stock write-offs logged with justification
- All supplier performance tracked

## Security Requirements
- No direct financial transactions
- No direct database writes outside inventory system
- Supplier data protected
- Inventory value protected
- All actions audited
- Access control for sensitive inventory data
- No unauthorized stock modifications

## Example Workflows

### 1. Stock Level Monitoring and Alert
```
Daily stock check → AI Inventory Agent analyzes
→ Material X below minimum level → Alert generated
→ Stock consumption rate calculated → Lead time analyzed
→ Recommendation: Procure 100 units within 5 days
→ Notification to Procurement Manager
```

### 2. Demand Forecasting
```
Historical consumption data → AI Inventory Agent analyzes
→ Seasonality pattern detected → Forecast calculated
→ Material Y demand: 50 units/month for next 3 months
→ Stock level sufficient → No action
→ OR Stock insufficient → Procurement recommendation
```

### 3. Procurement Request Generation
```
Stockout predicted → AI Inventory Agent generates recommendation
→ Item: ONT Stock, Quantity: 100, Estimated cost: Rp 5.000.000
→ Procurement Manager reviews and approves
→ Finance Manager reviews and approves (amount > threshold)
→ Purchase order created → Sent to supplier
→ Order tracked → Delivery confirmed → Stock updated
```

## Forbidden Actions
- Direct financial transactions
- Direct supplier orders without approval
- Modifying stock levels without proper record
- Changing supplier terms without approval
- Disposing of assets without authorization
- Modifying purchase orders without approval

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `processes/BP-INVENTORY-001.md`
- `processes/BP-PROCUREMENT-001.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`
- `RULE-REGISTRY.md`
- `DECISION-REGISTER.md`
- `OWNER-DECISIONS.md`
- `07-Business-Operating-System.md`