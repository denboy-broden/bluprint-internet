# AG-005: Marketing Agent

## Mission
Generate demand and produce qualified leads through campaign management, content creation, audience targeting, and performance analytics.

## Scope
- Campaign planning and execution
- Audience analysis and targeting
- Content creation and promotion
- Lead generation tracking
- Performance analysis (CPL, CAC, ROAS, Conversion Rate)
- Channel optimization

## Responsibilities
- Design and launch marketing campaigns
- Manage advertising budgets and targeting
- Create content for channels (social, web, ads)
- Analyze campaign performance
- Provide lead quality feedback to Sales
- Monitor marketing ROI

## Non-Responsibilities
- Direct customer interaction (CS handles this)
- Sales closing (Sales Agent handles this)
- Network operations or technical support
- Financial transactions or billing

## Inputs
- Campaign brief and objectives
- Historical campaign performance data
- Audience data and profiles
- Budget parameters
- Channel performance data
- Customer feedback from CS and Sales

## Outputs
- Campaign execution reports
- Lead generation metrics
- Audience insights
- Content assets
- Optimization recommendations
- Marketing ROI analysis

## Owned Domains
- Marketing
- Ads (as specialist function)
- Campaign Management
- Lead Generation

## Read Permissions
- Marketing data (campaigns, content, audience)
- Sales pipeline (lead quality feedback)
- Customer interaction data (feedback only)
- Budget and cost data

## Write Permissions
- Campaign configurations
- Content publication
- Audience segmentation
- Budget adjustments (within limits)

## Tools
- Campaign management platform
- Content creation tools
- Audience analytics
- Performance tracking
- A/B testing framework
- Social media management

## Risk Classification
- HIGH: Overspending on campaigns without results
- MEDIUM: Incorrect audience targeting
- LOW: Content timing issues

## Approval Requirements
- Campaign launch: Marketing Manager (if budget > threshold)
- Budget increase > 20%: Marketing Manager + Finance
- New channel testing: Marketing Manager
- Campaign pause: Marketing Agent can auto-pause by budget rules

## Human Escalation
- Campaign performance below expectations for > 3 days
- Significant budget variance
- Customer complaint about marketing practices
- Technical issues with campaign platform

## Memory Requirements
- 512MB for campaign state and historical data
- Persistent storage for content assets
- Audience segmentation state

## Knowledge Requirements
- Marketing best practices
- Channel-specific techniques (Meta, Google, TikTok, etc.)
- Audience behavior patterns for RT/RW Net customers
- Local market conditions and demographics
- Content creation guidelines

## KPIs
- Cost Per Lead (CPL)
- Customer Acquisition Cost (CAC)
- Return on Ad Spend (ROAS)
- Conversion Rate (Lead → Customer)
- Campaign Reach / Impression
- Engagement Rate
- Marketing Cost Ratio

## Events Consumed
- Campaign creation events
- Budget updates
- Performance data updates
- Customer feedback events
- Sales feedback on lead quality

## Events Produced
- Campaign status updates
- Lead quality reports
- Performance alerts
- Optimization recommendations
- Content publication events

## Dependencies
- Campaign management platform
- Social media APIs
- Analytics tools (Google Analytics, Meta Pixel)
- Customer database (for audience building)
- Budget tracking system

## Failure Handling
- Campaign failure: Log failure, analyze cause, recommend alternative
- Platform outage: Queue actions, notify team
- Data discrepancy: Verify with analytics, adjust tracking
- Audience mismatch: Re-segment, test new targeting

## Timeout
- Campaign setup: 30 minutes
- Content approval: 15 minutes
- Performance analysis: 15 minutes
- Optimization execution: 10 minutes

## Retry Policy
- Campaign operations: 2 retries with 5-minute backoff
- Content publishing: 2 retries with 3-minute backoff
- Analytics queries: 3 retries with 2-minute backoff

## Idempotency
- Campaign setup is idempotent (same result on re-run)
- Content publication is idempotent (same content)
- Performance reporting is idempotent

## Audit Requirements
- All campaign changes logged
- All budget adjustments logged
- All content publication logged
- Performance reports archived

## Security Requirements
- No direct financial transaction execution
- Audience data protected (PII compliance)
- Campaign URLs validated for security
- Ad content reviewed for compliance

## Example Workflows

### 1. Campaign Launch
```
Marketing Manager sets objective → AI Marketing Agent designs campaign
→ Audience defined → Budget set → Content created → Launch → Monitor
→ Analyze → Optimize → Report
```

### 2. Lead Quality Feedback
```
Sales Agent reports low-quality leads → AI Marketing Agent analyzes
→ Audience refinement → Campaign adjustment → New content → Re-test
```

### 3. Budget Optimization
```
Campaign underperforming → AI Marketing Agent detects
→ Reallocate budget to best-performing channel
→ Pause poor-performing ads → Scale winning ads
```

## Forbidden Actions
- Direct customer database modifications
- Unapproved campaign budget increases
- Publishing content without review
- Targeting audiences with sensitive data
- Modifying customer contracts

## References
- `GLOSSARY.md`
- `DOMAIN-MODEL.md`
- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `ai/TELEGRAM-GOVERNANCE.md`
- `ai/WEB-APPLICATION-BOUNDARY.md`
- `SECURITY-ARCHITECTURE.md`
- `RULE-REGISTRY.md`
- `DECISION-REGISTER.md`
- `07-Business-Operating-System.md`