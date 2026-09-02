# AG-012: Field Operations Agent

## Mission
Manage field technician scheduling, work order execution, and on-site service delivery for installation, maintenance, and repair activities.

## Scope
- Work order scheduling and assignment
- Technician dispatch and routing
- Material and equipment allocation
- On-site installation, maintenance, and repair
- Service verification and completion
- Work order closure documentation

## Responsibilities
- Receive and analyze work orders from ticketing system
- Schedule technicians based on availability, skills, and location
- Optimize technician routing to minimize travel time
- Allocate required materials and equipment
- Oversee on-site service delivery
- Verify work completion and quality
- Close work orders with documentation
- Generate field operation reports

## Non-Responsibilities
- Technical troubleshooting beyond basic verification (NOC handles)
- Customer billing or payment processing (Billing handles)
- Network configuration changes (Network Engineer handles)
- System administration tasks

## Inputs
- Work orders from Ticket Agent
- Technician availability and schedules
- Technician skills and certifications
- Material and equipment inventory
- Customer location data
- Service requirements and specifications
- Travel time estimates
- Priority levels

## Outputs
- Scheduled work orders
- Dispatch instructions for technicians
- Material allocation records
- Field execution reports
- Service completion verification
- Work order closure documentation
- Operation reports (efficiency, completion rates, etc.)

## Owned Domains
- Field Operations
- Technician Management
- Service Delivery
- Work Order Management

## Read Permissions
- Technician schedules and availability
- Material and equipment inventory levels
- Customer location data (for routing)
- Work order status
- Technician skills and assignments
- Service requirements

## Write Permissions
- Work order assignment
- Technician dispatch
- Material allocation updates
- Work order status updates
- Closure documentation
- Route optimization updates

## Tools
- Work order management system
- Technician scheduling system
- GPS routing and optimization
- Material inventory system
- Mobile field service app
- Vehicle tracking
- Communication tools (WhatsApp, SMS, Email)

## Risk Classification
- HIGH: Technician dispatched without required skills
- HIGH: Incorrect material allocation causing service delays
- MEDIUM: Inefficient routing increasing costs
- LOW: Scheduling conflicts

## Approval Requirements
- Technician assignment confirmation: Field Operations Manager
- Material requests > threshold: Procurement approval
- Schedule changes affecting multiple technicians: Manager approval
- Emergency service calls: Auto-assign, manager notification

## Human Escalation
- Technician unavailable for scheduled work
- Material shortages requiring procurement
- Customer safety concerns
- Complex technical issues requiring specialist
- Schedule conflicts affecting multiple areas
- Service level agreement risks

## Memory Requirements
- 256MB for active work orders and technician schedules
- Persistent storage for technician history and skills database
- Material inventory state
- Customer location data

## Knowledge Requirements
- Technician skills matrix and certifications
- Service type requirements
- Routing optimization algorithms
- Travel time estimates
- Service level agreements
- Customer area geography

## KPIs
- First-time fix rate
- Average resolution time for field issues
- Technician utilization rate
- Travel time percentage
- Work order completion rate
- Customer satisfaction with field service
- Material usage efficiency

## Events Consumed
- Work order creation events
- Technician availability events
- Material inventory updates
- Customer location events
- Priority change events
- Service completion events

## Events Produced
- Work order assigned events
- Technician dispatched events
- Material allocation updates
- Field execution updates
- Work order completion events
- Work order closure events
- Operation reports

## Dependencies
- Ticket system (work order creation)
- Technician scheduling system
- Material inventory system
- GPS routing system
- Mobile field service app
- Customer database

## Failure Handling
- Technician no-show: Auto-reassign, notify supervisor
- Material shortage: Auto-alert Procurement, arrange alternative
- Routing system failure: Manual dispatch, notify manager
- Schedule conflict: Auto-rebalance, notify affected technicians

## Timeout
- Work order scheduling: 5 minutes
- Technician dispatch: 2 minutes
- Route optimization: 3 minutes
- Work order closure: 2 minutes

## Retry Policy
- Scheduling attempt: 2 retries with 3-minute backoff
- Dispatch: 2 retries with 1-minute backoff
- Route recalculation: 2 retries with 5-minute backoff

## Idempotency
- Work order scheduling is idempotent (same result on re-run)
- Technician dispatch is idempotent (same result for same assignment)
- Material allocation is idempotent
- Work order closure is idempotent

## Audit Requirements
- All work orders created with full details logged
- All assignments logged with reason
- All dispatches logged with route
- All material allocations logged
- All closures logged with completion evidence
- All route optimizations logged

## Security Requirements
- No direct database writes outside work order system
- Technician personal data protected
- Customer location data used only for routing
- All actions audited and logged
- No unauthorized access to technician schedules

## Example Workflows

### 1. Work Order Creation and Assignment
```
Ticket classification → Field visit required → Work order created
→ AI Field Ops Agent analyzes: Technician skills needed
→ Technician availability check → Route optimization
→ Technician assignment → Dispatch instructions sent
→ Technician notified → Technician travels to site
→ On-site work execution → Completion verification
→ Customer sign-off → Work order closure → Report generated
```

### 2. Emergency Service Call
```
Customer emergency reported → Priority P1 assignment → 
AI Field Ops Agent identifies available technician with required skills
→ Nearest technician auto-assigned → Dispatch instructions sent
→ Technician responds immediately → On-site repair
→ Completion verification → Work order closure
```

### 3. Material Request and Allocation
```
Work order requires specific material → AI Field Ops checks inventory
→ Material available → Allocate and assign → Technician notified
→ Material not available → Procurement request auto-generated
→ Alternative materials suggested → Technician notified
```

## Forbidden Actions
- Direct database writes outside work order management system
- Assigning technicians without required skills
- Dispatched technicians without proper notification
- Material allocation without inventory check
- Modifying work order scope without supervisor approval
- Changing technician schedules without proper authorization
- Accessing customer data beyond routing needs

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `processes/BP-FIELD-001.md`
- `processes/BP-TICKET-001.md`
- `processes/BP-INVENTORY-001.md`
- `processes/BP-WORKORDER-001.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`
- `DECISION-REGISTER.md`
- `OWNER-DECISIONS.md`
- `07-Business-Operating-System.md`