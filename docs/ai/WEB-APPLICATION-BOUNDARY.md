# Web Application Boundary

## Position

Web Application is the **UI Layer** for human users.

Architecture Flow:
```
Web Browser
→ Web Application (Next.js)
→ API
→ Business Services
→ Domain
→ Database
```

AI also uses the same API through tools, NOT direct database access.

---

## Application Modules

- Dashboard
- Customers
- Sales
- Marketing
- Services
- Billing
- Payments
- Finance
- Accounting
- Network
- Tickets
- Incidents
- Field Operations
- Inventory
- Procurement
- HR
- Reports
- BI
- AI Control
- Settings
- Audit

---

## Boundary Rules

1. **No direct database access** from frontend
2. **All actions go through Business API**
3. **AI uses same API through tools**
4. **Permission check at API layer**
5. **All write actions auditable**

---

## Role-Based UI

- Different dashboards per role
- Different actions per permission
- Different views per scope
- AI control panel for managers