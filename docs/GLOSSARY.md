# RENUSA Glossary - Standardized Terminology

This glossary ensures consistent use of terms across all RENUSA documentation.

---

## A

**Account**
A financial record representing a customer's billing relationship. Distinct from Customer entity.

**Action**
An executable operation performed by a system component (human, AI agent, or tool).

**Actor**
An entity (human, system, or AI agent) that performs actions within the system.

**Agent**
An AI component that performs specific business functions under defined authority and permissions.

**Agent-as-Tool**
Pattern where one AI agent is used as a callable tool by another agent.

**Approval**
Formal authorization required before a high-risk action can be executed.

**Asset**
A trackable physical or logical resource with serial number and lifecycle (e.g., ONT, OLT, Router).

**Audit**
Immutable record of an action with full context (who, what, when, why, how).

## B

**Business Process**
A defined sequence of business activities producing a specific outcome.

**Business Rule**
A condition that must be satisfied for a business action to be valid.

## C

**Capability**
A high-level business function the organization can perform (e.g., "Customer Management").

**Command**
An instruction from user/AI to the system requesting a specific action.

**Customer**
A person or organization receiving services from RENUSA.

## D

**Data Owner**
The domain responsible for the accuracy, integrity, and lifecycle of a data entity.

**Department**
A functional grouping within the organization (e.g., Sales Department).

**Domain**
A logical boundary for related business data and rules (e.g., Billing Domain).

## E

**Entity**
A real-world concept represented in the system with identity and attributes.

**Event**
A significant business occurrence that triggers reactions in the system.

**Event Bus**
The infrastructure that propagates events between producers and consumers.

## F

**Function**
A specific business activity (e.g., "Invoice Generation").

## H

**Handoff**
Transfer of task responsibility from one agent to another.

## I

**Incident**
A network event affecting multiple customers, requiring coordinated response.

**Intent**
The purpose extracted from a user request before routing.

**Invoice**
A bill issued to a customer for services rendered.

## K

**Knowledge**
Long-term reference information available to agents (SOPs, manuals, policies).

## M

**Memory**
Short-term or contextual information maintained for an agent or conversation.

**Module**
A logical grouping of code/functionality in the application.

## N

**Network Domain**
All entities related to network infrastructure (POP, OLT, Router, etc.).

## O

**Orchestrator**
The central AI component that coordinates agents, routes tasks, and manages context.

**Organization**
The highest-level entity in the company structure (Owner → Management).

## P

**Package**
A defined service offering with specific features and price.

**Payment**
A financial transaction settling one or more invoices.

**Permission**
The right to perform a specific action on a specific resource.

**Policy**
A set of rules governing how actions are evaluated and approved.

**Process**
See Business Process.

## R

**Role**
A named set of permissions assigned to users (e.g., "Sales Manager").

## S

**Service**
An active subscription between a customer and a package.

**Source of Truth**
The single system designated as authoritative for a specific data entity.

**Subscription**
Synonym for Service in customer-facing context.

**System of Record**
Same as Source of Truth.

## T

**Task**
A unit of work assigned to an agent or human.

**Ticket**
A customer-facing issue tracked through resolution (distinct from Incident).

**Tool**
A callable function an agent can invoke to interact with the system.

## W

**Workflow**
The technical implementation of a business process with states and transitions.

**Work Order**
An internal task assigned to a technician for on-site work.

---

## CRITICAL DISTINCTIONS (Must Not Be Confused)

| Term A | Term B | Distinction |
|--------|--------|-------------|
| Customer | Account | Customer = person/org; Account = financial relationship |
| Ticket | Incident | Ticket = single customer issue; Incident = multi-customer event |
| Service | Subscription | Service = technical configuration; Subscription = billing view |
| Asset | Inventory | Asset = serial-numbered deployed equipment; Inventory = generic stock |
| Function | Capability | Function = specific activity; Capability = broad ability |
| Process | Workflow | Process = business definition; Workflow = technical implementation |
| Permission | Policy | Permission = what allowed; Policy = how decisions made |
| Audit | Log | Audit = business record; Log = technical record |
| Domain | Module | Domain = business boundary; Module = code boundary |
| Event | Command | Event = fact that happened; Command = request to happen |