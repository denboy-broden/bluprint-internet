# WF-INCIDENT-001: Incident Response Workflow

## Workflow ID: WF-INCIDENT-001
Name: Incident Response
Domain: Operations / Network
Trigger: Monitoring alert from Prometheus/Grafana/SNMP indicating a network anomaly or customer outage
Owner: NOC Manager

## States
1. **Monitoring Alert Received**
2. **Alert Correlated**
3. **Incident Detected**
4. **Root Cause Analysis**
5. **Severity Classified**
6. **Recommendation Generated**
7. **Escalation Determined**
8. **Action Taken (Execute)**
9. **Verification**
10. **Closed**

## State Transitions
| From State | To State | Condition | Action | Agent |
|------------|----------|-----------|--------|-------|
| Monitoring Alert Received | Alert Correlated | Always | Correlate alert with existing alerts & outages | AI NOC Agent |
| Alert Correlated | Incident Detected | Correlated event affects multiple customers OR severity ≥ HIGH | Create incident record | AI NOC Agent |
| Alert Correlated | Monitoring Alert Received (retry) | Single isolated alert, low severity | Wait for additional alerts | AI NOC Agent |
| Incident Detected | Root Cause Analysis | Incident created | Run diagnostic checks (power, uplink, router, fiber, OLT) | AI NOC Agent |
| Root Cause Analysis | Severity Classified | Diagnosis complete | Assign severity (LOW/MEDIUM/HIGH/CRITICAL) based on impact | AI NOC Agent |
| Severity Classified | Recommendation Generated | Severity determined | Generate recommendation based on root cause | AI NOC Agent |
| Recommendation Generated | Escalation Determined | Recommendation needs approval | Check approval requirements per authority matrix | AI NOC Agent |
| Escalation Determined | Action Taken (Execute) | Approval received (or auto-approve for LOW) | Execute action (restart, reroute, disable port, etc.) | AI NOC Agent / NOC Operator (human) |
| Action Taken | Verification | Action executed | Verify impact resolved | AI NOC Agent |
| Verification | Closed | Verified resolved | Close incident, notify affected customers | AI NOC Agent |
| Escalation Determined | Human Intervention | Critical action requiring human (L0) | Notify Owner/Network Engineer for manual action | Human |
| Action Taken | Human Intervention | Action failed or unsafe | Escalate to human for manual resolution | Human |

## Agent Involvement
- **AI NOC Agent**: All states (monitoring, correlation, diagnosis, recommendation, verification)
- **Human NOC Operator**: Assist with diagnosis, execute manual actions
- **Human Network Engineer**: Critical actions (L0)
- **AI Ticket Agent**: Create tickets for affected customers (if not existing)
- **AI CS Agent**: Notify affected customers
- **Human NOC Manager**: Approval for L4/L0 actions, escalate incidents

## Events
**Consumed**
- `MONITORING_ALERT` (from Prometheus/Grafana)
- `SNMP_TRAP` (from network devices)
- `CUSTOMER_OUTAGE` (from CS Agent or customer complaint)
- `TICKET_CREATED` (if related to network issue)

**Produced**
- `ALERT_CORRELATED`
- `INCIDENT_CREATED` (with incident_id, severity, root_cause, impact)
- `RECOMMENDATION_GENERATED`
- `ACTION_EXECUTED`
- `VERIFICATION_COMPLETED`
- `INCIDENT_CLOSED`
- `CUSTOMER_NOTIFICATION_SENT`

## SLA
- **Monitoring Alert Processing**: < 30 seconds
- **Alert Correlation**: < 60 seconds
- **Incident Detection**: < 1 minute
- **Root Cause Analysis**: ≤ 5 minutes
- **Severity Classification**: < 1 minute
- **Recommendation Generation**: < 2 minutes
- **Approval/Escalation**: < 5 minutes (auto for L1-L3, human for L4-L0)
- **Action Execution**: < 10 minutes (L1-L3), depends on human (L4-L0)
- **Verification**: < 5 minutes
- **Total Incident Response SLA**: P1 ≤ 15 minutes, P2 ≤ 30 minutes, P3 ≤ 1 hour

## Approval Points
- **LOW severity**: Auto-execute (e.g., restart interface, clear cache)
- **MEDIUM severity**: NOC Manager approval for restart-type actions
- **HIGH severity**: NOC Manager + Owner approval for restart OLT/router, change firewall
- **CRITICAL severity**: Owner + Network Engineer approval (L0)

## Error Handling
- **Monitoring API failure**: Fall back to manual monitoring, alert NOC Manager
- **Correlation failure**: Log raw alert, manually analyze, notify NOC Manager
- **Diagnosis inconclusive**: Escalate to Network Engineer, open ticket
- **Action execution failure**: Retry once, then escalate to human, log failure
- **Verification fails**: Re-enter diagnosis, adjust recommendation, re-execute

## References
- `processes/BP-NETWORK-001.md`
- `ai/agents/AG-010-NOC.md`
- `ai/agents/AG-011-Ticket.md`
- `ai/agents/AG-006-Customer-Service.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `SECURITY-ARCHITECTURE.md`