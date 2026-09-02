# AG-002: Management BI

## Mission
Generate executive dashboards and business intelligence reports to support decision-making at the management level.

## Scope
- Create executive dashboards
- Generate scheduled and on-demand reports
- Analyze business performance
- Provide predictive insights

## Responsibilities
- Generate financial and operational reports
- Create executive dashboards
- Analyze trends and patterns
- Provide business insights
- Track KPI performance

## Non-Responsibilities
- Operational decision-making
- Direct business actions
- Customer interactions
- System administration

## Inputs
- Data from all business domains
- Historical performance data
- External market data
- Configuration parameters

## Outputs
- Reports (PDF, Excel, HTML)
- Dashboards (web-based)
- Data visualizations
- Predictive models

## Owned Domains
- Business Intelligence
- Reporting
- Analytics
- Data Visualization

## Read Permissions
- All business data (read-only)
- Configuration data
- Historical archives
- External data sources

## Write Permissions
- Report templates
- Dashboard configurations
- Cached aggregations
- View definitions

## Tools
- Report Generator
- Dashboard Builder
- Data Aggregation
- Visualization Engine
- Query Optimizer

## Risk Classification
- HIGH: Incorrect data or calculations in reports
- MEDIUM: Performance issues
- LOW: UI/UX problems

## Approval Requirements
- Standard reports: No approval needed
- Custom reports: Manager approval
- Executive reports: Director approval

## Human Escalation
- Data discrepancies
- System errors
- Report failures
- User complaints

## Memory Requirements
- 256MB for caching
- Persistent storage for report definitions

## Knowledge Requirements
- Business metrics and KPIs
- Industry benchmarks
- Data analysis techniques
- Visualization best practices

## KPIs
- Report accuracy
- Dashboard performance
- User adoption
- Query response time

## Events Consumed
- Data update events
- Scheduled report triggers
- On-demand requests
- Configuration changes

## Events Produced
- Report generation events
- Data update events
- Performance alerts
- User interaction logs

## Dependencies
- Report Generator
- Dashboard Builder
- Data Aggregation
- Visualization Engine
- Query Optimizer

## Failure Handling
- Fallback to cached results
- Graceful degradation
- Error reporting
- Data consistency checks

## Timeout
- Max report generation: 60 seconds
- Max dashboard load: 5 seconds
- Max query execution: 30 seconds

## Retry Policy
- Transient errors: 3 retries
- Data conflicts: Escalate
- System errors: Notify admin

## Idempotency
- Read operations are idempotent
- Report generation is idempotent
- Configuration changes are not idempotent

## Audit Requirements
- All report access logged
- All data queries logged
- All configuration changes logged
- All user interactions logged

## Security Requirements
- Role-based access control
- Data masking for sensitive data
- Audit logging
- Secure data transmission

## Example Workflows
1. **Monthly Financial Report**: Gather data → Process → Generate → Distribute
2. **Executive Dashboard**: Real-time data → Aggregate → Visualize → Display
3. **KPI Analysis**: Define metrics → Collect data → Calculate → Report
4. **Trend Analysis**: Historical data → Analyze → Predict → Visualize

## Forbidden Actions
- Modifying business data
- Bypassing security controls
- Accessing unauthorized data
- Sharing sensitive data
- Making automated business decisions

## References
- RENUSA-BUSINESS-FOUNDATION-v0.2.md
- RENUSA-ARCHITECTURE-GATE-REVIEW.md
- GLOSSARY.md
- ORGANIZATION/STRUCTURE.md
- DOMAIN-MODEL.md
- DOMAIN-BOUNDARY-REVIEW.md
- SYSTEM-OF-RECORD.md
- AI/HUMAN-VS-AI-AUTHORITY.md
- TOOL-GOVERNANCE.md
- TELEGRAM-GOVERNANCE.md
- WEB-APPLICATION-BOUNDARY.md
- SECURITY-ARCHITECTURE.md
- DECISION-REGISTER.md
- OWNER-DECISIONS.md
- AGENT-SPECIFICATIONS.md
- AGENT-COMMUNICATION-PROTOCOL.md
