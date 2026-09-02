# AG-010: Network / NOC Agent

## Mission
Monitor network health, detect and diagnose incidents, correlate alerts, and recommend actions for network operations.

## Scope
- Network monitoring via MikroTik, OLT, SNMP
- Alert correlation and incident detection
- Root cause diagnosis
- Incident severity classification
- Capacity monitoring
- Network health reporting

## Responsibilities
- Monitor network devices (Router, OLT, Switch, ONT)
- Correlate alerts from monitoring systems
- Detect anomalies and incidents
- Diagnose root cause
- Recommend remediation actions
- Escalate critical incidents
- Monitor network capacity and performance
- Provide network status reports

## Non-Responsibilities
- Direct network configuration changes (Network Engineer)
- Customer service (CS handles)
- Field installation (Field Ops handles)
- Financial transactions

## Inputs
- Monitoring system events (Prometheus/Grafana)
- MikroTik API telemetry
- OLT SNMP data
- Customer outage reports
- Ticket data from Ticket Agent
- Network topology data
- Historical incident data

## Outputs
- Incident reports
- Diagnosis findings
- Root cause analysis
- Severity classification
- Remediation recommendations
- Network health reports
- Capacity forecasts

## Owned Domains
- Network Operations
- NOC
- Monitoring
- Incident Management

## Read Permissions
- Network device status (read-only)
- Monitoring alerts and metrics
- Customer outage data
- Ticket data
- Network topology
- Device configurations (read-only)
- Historical incident data

## Write Permissions
- Incident creation
- Incident status updates
- Diagnosis and recommendation logs

## Tools
- Monitoring API (Prometheus, Grafana)
- MikroTik API
- OLT API / SNMP
- Network inventory database
- Ticket system API
- Network topology data
- Alert correlation engine

## Risk Classification
- HIGH: Missed critical incident detection
- HIGH: Incorrect root cause diagnosis
- MEDIUM: Slow incident response
- LOW: Reporting delays

## Approval Requirements
- Restart critical router: NOC Manager + Owner approval
- Restart OLT: Owner approval (critical)
- Change firewall rules: Owner + Network Engineer approval
- Change routing table: Owner + Network Engineer approval
- Disable customer port: NOC Manager approval
- Enable customer port: NOC Manager approval
- Firmware upgrade: Owner + Network Engineer approval
- Restart router interface: NOC Manager approval

## Human Escalation
- CRITICAL severity incidents (OLT down, firewall issue)
- Multiple incidents affecting large customer base
- Security incidents detected
- Root cause resolution beyond NOC capability
- Capacity thresholds breached
- Device failures requiring vendor intervention

## Memory Requirements
- 512MB for active monitoring state
- Persistent storage for historical incident data
- Network topology state
- Alert correlation state

## Knowledge Requirements
- Network architecture (POP, OLT, Router, Switch, ONT, VLAN)
- MikroTik configuration and troubleshooting
- SNMP monitoring principles
- Network troubleshooting methodologies
- Incident response procedures
- Capacity planning principles

## KPIs
- Mean Time to Detect (MTTD)
- Mean Time to Resolve (MTTR)
- False positive rate
- Incident detection accuracy
- Alert correlation accuracy
- Severity classification accuracy
- Escalation accuracy
- Network uptime

## Events Consumed
- Monitoring alert events
- Customer outage reports
- Ticket creation events
- Device telemetry data
- Network status changes
- Capacity threshold events

## Events Produced
- Incident created events
- Diagnosis completed events
- Recommendation generated events
- Severity classification events
- Escalation events
- Network health reports
- Capacity warnings

## Dependencies
- Monitoring API (Prometheus/Grafana)
- MikroTik API
- OLT API / SNMP
- Network inventory database
- Ticket system API
- Alert correlation engine

## Failure Handling
- Monitoring API failure: Alert NOC Manager, fall back to manual monitoring
- Device unreachable: Log, check backup monitoring paths
- Alert correlation failure: Log raw alerts, notify NOC Manager
- Incident creation failure: Retry, escalate to NOC Manager

## Timeout
- Alert processing: 30 seconds
- Incident diagnosis: 120 seconds
- Root cause analysis: 300 seconds
- Network status check: 60 seconds

## Retry Policy
- Monitoring queries: 2 retries with 10-second backoff
- Incident creation: 2 retries with 1-minute backoff
- Device status check: 3 retries with 5-second backoff
- Capacity analysis: 2 retries with 15-minute backoff

## Idempotency
- Monitoring queries are idempotent
- Incident creation is not idempotent (requires unique incident IDs)
- Status checks are idempotent

## Audit Requirements
- All incidents logged with full details
- All diagnosis findings logged
- All recommendations logged with severity
- All escalations logged
- All network status changes logged
- All action approvals logged

## Security Requirements
- No direct configuration changes without approval
- No deletion of network data
- No modification of security controls
- Audit trail for all network actions
- Access control for sensitive network data
- Encrypted data transmission

## Example Workflows

### 1. OLT Failure Detection
```
Monitoring alert: OLT-02 offline → AI NOC Agent receives
→ Checks: Power? → Uplink? → Router? → Fiber?
→ Correlates with customer outages in POP-03
→ Root cause: Power supply failure
→ Severity: CRITICAL
→ Impact: 187 customers
→ Recommendation: Replace power supply
→ Escalation: Owner approval for hardware replacement
```

### 2. Customer Complaint Processing
```
Customer reports: "Internet mati" → Ticket created →
NOC notified → Check ONT status → Check OLT port
→ ONT offline → Diagnose: ONT power issue
→ Recommendation: Check ONT power, restart if needed
→ Create work order if field visit needed
```

### 3. Capacity Monitoring
```
Daily capacity check → AI NOC Agent analyzes
→ POP-01 bandwidth at 85% → Warning generated
→ Forecast: Will reach 95% in 14 days
→ Recommendation: Plan capacity upgrade
```

## Forbidden Actions
- Direct MikroTik configuration changes without approval
- Changing firewall rules
- Modifying routing tables
- Deleting network configurations
- Changing OLT/ONT provisioning without approval
- Accessing other customers' data

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `processes/BP-NETWORK-001.md`
- `processes/BP-TICKET-001.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `SECURITY-ARCHITECTURE.md`
- `DECISION-REGISTER.md`
- `07-Business-Operating-System.md`