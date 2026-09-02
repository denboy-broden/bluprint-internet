# WF-PROCUREMENT-001: Procurement Workflow

## Workflow ID: WF-PROCUREMENT-001
Name: Procurement
Domain: Supply / Inventory
Trigger: Low stock alert OR manual purchase request OR scheduled replenishment
Owner: Procurement Manager

## States
1. **Procurement Need Identified**
2. **Procurement Request Created**
3. **Approval Required**
4. **Supplier Selection**
5. **Purchase Order Created**
6. **Goods Received**
7. **Quality Check**
8. **Stock Updated**
9. **Purchase Order Closed**

## State Transitions
| From State | To State | Condition | Action | Agent |
|------------|----------|-----------|--------|-------|
| Procurement Need Identified | Procurement Request Created | Always | Create procurement request with item, quantity, estimated cost | AI Inventory Agent |
| Procurement Request Created | Approval Required | Cost > approval threshold | Route for approval | AI Inventory Agent |
| Procurement Request Created | Supplier Selection | Cost ≤ threshold OR urgent | Skip approval, go to supplier selection | AI Inventory Agent |
| Approval Required | Supplier Selection | Approved | Notify Inventory Agent | Human Procurement Manager |
| Approval Required | Procurement Need Identified (rejected) | Rejected | Notify requestor, cancel request | Human Procurement Manager |
| Supplier Selection | Purchase Order Created | Supplier confirmed | Create PO with item, qty, price, delivery date | AI Inventory Agent |
| Purchase Order Created | Goods Received | PO sent, supplier delivers | Receive goods at warehouse | Human Warehouse Staff |
| Goods Received | Quality Check | Goods received | Verify item, qty, condition against PO | Human Warehouse Staff |
| Quality Check | Stock Updated | Quality passed | Update stock levels in inventory | AI Inventory Agent |
| Quality Check | Supplier Selection | Quality failed | Return goods, negotiate replacement | Human Procurement Manager |
| Stock Updated | Purchase Order Closed | Stock updated | Mark PO complete, archive | AI Inventory Agent |
| Quality Check | Purchase Order Closed (partial) | Partial acceptance | Update partial stock, negotiate remainder | Human Procurement Manager |

## Approval Thresholds
| Amount | Approval Required |
|---------|-----------------|
| < Rp 500.000 | Auto-approve (AI Inventory Agent) |
| Rp 500.000 - Rp 5.000.000 | Procurement Manager |
| > Rp 5.000.000 | Procurement Manager + Finance Manager |
| Emergency procurement | Procurement Manager + Finance Manager (retroactive) |

## Agent Involvement
- **AI Inventory Agent**: Procurement need identification, PR creation, PO creation, stock update
- **Human Procurement Manager**: Approval, supplier negotiation, quality issues
- **Human Warehouse Staff**: Goods receiving, quality check
- **Human Finance Manager**: High-value approvals
- **AI Finance Agent**: Budget check, cost tracking

## Events
**Consumed**
- `LOW_STOCK_ALERT` (from inventory monitoring)
- `WORK_ORDER_MATERIAL_REQUEST` (from field operations)
- `SCHEDULED_REPLENISHMENT` (from demand forecast)
- `MANUAL_PURCHASE_REQUEST`

**Produced**
- `PROCUREMENT_REQUEST_CREATED`
- `APPROVAL_REQUIRED`
- `PROCUREMENT_APPROVED`
- `PROCUREMENT_REJECTED`
- `PURCHASE_ORDER_CREATED`
- `GOODS_RECEIVED`
- `QUALITY_CHECK_PASSED`
- `QUALITY_CHECK_FAILED`
- `STOCK_UPDATED`
- `PURCHASE_ORDER_CLOSED`

## SLA
- **Procurement Request Creation**: < 5 minutes after alert
- **Approval**: < 4 hours (Procurement Manager), < 24 hours (Finance Manager)
- **Supplier Selection**: < 24 hours
- **Purchase Order Creation**: < 1 hour after supplier confirmed
- **Goods Receiving**: Same day as delivery
- **Quality Check**: < 1 hour after receiving
- **Stock Update**: < 30 minutes after QC passed

## Approval Points
- **PR approval**: Per threshold table above
- **Emergency procurement**: Retroactive approval required
- **Price negotiation override**: Procurement Manager + Finance Manager
- **Supplier change**: Procurement Manager

## Error Handling
- **Supplier cannot deliver**: Select alternate supplier, notify requestor
- **Goods damaged on delivery**: Reject, return, negotiate replacement
- **PO not received by supplier**: Follow up, resend if needed
- **Stock update fails**: Retry, alert system admin
- **Approval timeout**: Escalate to Procurement Manager

## References
- `processes/BP-INVENTORY-001.md`
- `ai/agents/AG-013-Inventory-Procurement.md`
- `ai/agents/AG-008-Finance.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `SECURITY-ARCHITECTURE.md`