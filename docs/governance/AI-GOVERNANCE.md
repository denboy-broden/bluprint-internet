# AI Governance Policy

## 1. Purpose

Defines how AI Agents are governed — their authority, approval requirements, audit responsibilities, and compliance obligations.

## 2. AI Authority Levels

| Level | Name | Description | Approval | Audit | Example |
|-------|------|-------------|----------|-------|---------|
| L0 | Human Only | AI cannot act | Required (Owner) | Required | Firewall change, large purchase |
| L1 | AI Read | AI reads only | Not required | Required | View customer data |
| L2 | AI Recommend | AI suggests, human decides | Required (Manager) | Required | Recommend suspension |
| L3 | AI Draft | AI creates draft, human reviews | Required (specialist) | Required | Draft invoice adjustment |
| L4 | AI Execute with Approval | AI executes after human approval | Required (NOC/Dept Head) | Required | Restart router interface |
| L5 | AI Execute Automatically | AI executes with audit only | Not required | Required | Monitor alert, classify ticket |

## 3. Mandatory Agent Requirements

Every AI Agent must:
- Have a written specification (AG-XXX.md)
- Have defined MUST/SHOULD/MAY/MUST NOT actions
- Have explicit permission matrix
- Have approval requirements per action type
- Have audit logging for all significant actions
- Have human escalation path
- Have failure handling procedures
- Have timeouts and retry policies

## 4. Approval Workflows

### 4.1 Auto-Execute (No Approval)
For L5 actions: AI executes, audits, notifies if needed.

### 4.2 Single Approval
For L4 actions: AI requests, Manager approves, AI executes.

### 4.3 Dual Approval
For critical L4/L0 actions: AI requests, both Owner and Manager approve.

### 4.4 Threshold-Based
- Amount: > Rp 5.000.000 = dual approval
- Impact: > 100 customers affected = dual approval
- Time: Emergency = auto with retroactive approval

## 5. Inter-Agent Communication

- Use structured messages, not free-form chat
- Each message must include: sender, receiver, type, data, timestamp
- All inter-agent communication must be auditable
- Use Event Bus for fan-out, direct calls for specific tasks

## 6. Tool Usage

- AI Agents use tools to call business services
- No direct database access
- All tools are registered in `ai/TOOL-GOVERNANCE.md`
- Each tool has defined permission requirements
- Cross-domain tool usage is restricted

## 7. Knowledge and Memory

- Each agent has defined knowledge scope
- Each agent has defined memory requirements
- Cross-agent memory sharing must be explicit
- Sensitive data (PII) must be protected

## 8. Performance and Evaluation

- Each agent has defined KPIs
- Weekly performance reviews
- Monthly accuracy and SLA compliance reviews
- Quarterly business value assessment

## 9. Risk Management

- High-risk actions require approval per risk matrix
- Risk levels: LOW / MEDIUM / HIGH / CRITICAL
- AI must escalate when confidence < threshold
- Failed or risky actions must be reported
- AI must not bypass safety constraints

## 10. Security

- All AI Agent communications encrypted
- Access to AI platform restricted to authorized roles
- No direct database writes from AI
- All actions logged and auditable
- Secrets (API keys, credentials) managed via HashiCorp Vault or AWS Secrets Manager

## 11. Compliance

- GDPR / data protection: Customer data protected, right to be forgotten
- PSAK / accounting: Financial records comply
- Local regulations: Telecom operations comply
- Audit trail completeness: All required events recorded
- Regular security assessments: Quarterly

## 12. Violations and Enforcement

Violations result in:
- Immediate suspension of agent or user
- Investigation by security team
- Owner notification
- Corrective action
- Documentation update

## 13. Document References

- `ai/HUMAN-VS-AI-AUTHORITY.md`
- `ai/TOOL-GOVERNANCE.md`
- `ai/TELEGRAM-GOVERNANCE.md`
- `ai/WEB-APPLICATION-BOUNDARY.md`
- `SECURITY-ARCHITECTURE.md`
- `business-rules/RULE-REGISTRY.md`
- `docs/ai/agents/AG-001-ORCHESTRATOR.md` (governance owner)
- `docs/governance/APPROVAL-POLICY.md`
- `docs/governance/AUDIT-POLICY.md`