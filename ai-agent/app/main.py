from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import httpx
import os
from .telegram_service import telegram_service

app = FastAPI(title="RT/RW Net AI Agent", version="0.1.0")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

API_BASE = os.getenv("LARAVEL_API_URL", "http://rt-rw-api:8001/api")

@app.get("/health")
async def health():
    return {"status": "ok", "service": "rt-rw-net-ai-agent"}

@app.get("/customers")
async def list_customers():
    async with httpx.AsyncClient() as client:
        r = await client.get(f"{API_BASE}/customers")
        return r.json()

@app.post("/ai/analyze-tickets")
async def analyze_tickets():
    async with httpx.AsyncClient() as client:
        r = await client.get(f"{API_BASE}/tickets")
        tickets = r.json()
        summary = {
            "total": len(tickets),
            "by_status": {},
            "by_priority": {},
            "urgent_count": sum(1 for t in tickets if t.get("priority") == "urgent")
        }
        for t in tickets:
            status = t.get("status", "unknown")
            priority = t.get("priority", "unknown")
            summary["by_status"][status] = summary["by_status"].get(status, 0) + 1
            summary["by_priority"][priority] = summary["by_priority"].get(priority, 0) + 1
        return summary

# ============ AI Agent Billing Integration (STEP-10) ============

@app.get("/ai/billing/summary")
async def billing_summary():
    """AI Agent: Menganalisis ringkasan tagihan pelanggan"""
    async with httpx.AsyncClient() as client:
        r = await client.get(f"{API_BASE}/invoices", headers={"X-API-Token": os.getenv("API_TOKEN", "rt-rw-net-secret-2026")})
        invoices = r.json().get("data", [])

        total_pending = sum(1 for inv in invoices if inv.get("status") == "PENDING")
        total_paid = sum(1 for inv in invoices if inv.get("status") == "PAID")
        total_amount_pending = sum(float(inv.get("amount", 0)) for inv in invoices if inv.get("status") == "PENDING")

        return {
            "message": "AI Billing Summary analyzed",
            "total_invoices": len(invoices),
            "pending": total_pending,
            "paid": total_paid,
            "pending_amount": total_amount_pending,
            "observation": f"{total_pending} tagihan belum lunas. Total piutang: Rp {total_amount_pending:,.2f}",
            "recommendation": "Fokuskan penagihan pada pelanggan dengan tagihan tertinggi.",
            "risk": "Jika piutang terus meningkat, arus kas perusahaan akan terganggu."
        }

@app.get("/ai/billing/customers-outstanding")
async def customers_outstanding():
    """AI Agent: Menampilkan pelanggan dengan tagihan belum lunas"""
    async with httpx.AsyncClient() as client:
        r = await client.get(f"{API_BASE}/invoices?status=PENDING", headers={"X-API-Token": os.getenv("API_TOKEN", "rt-rw-net-secret-2026")})
        invoices = r.json().get("data", [])

        # Kelompokkan berdasarkan customer
        by_customer = {}
        for inv in invoices:
            cid = inv.get("customer_id")
            if cid not in by_customer:
                by_customer[cid] = {"count": 0, "amount": 0, "invoice_numbers": []}
            by_customer[cid]["count"] += 1
            by_customer[cid]["amount"] += float(inv.get("amount", 0))
            by_customer[cid]["invoice_numbers"].append(inv.get("invoice_number"))

        return {
            "message": "AI Agent: Pelanggan dengan tagihan belum lunas",
            "customers_outstanding": by_customer,
            "action": "Kirim notifikasi tagihan dan tawarkan opsi pembayaran."
        }

# ============ Telegram Notification Feature ============

@app.post("/ai/telegram/send-billing")
async def send_billing_telegram(data: dict):
    """Kirim notifikasi tagihan via Telegram (baru)"""
    result = await telegram_service.send_billing_notification(data)
    return {"status": "sent" if result.get("success") else "failed", "detail": result}

@app.post("/ai/telegram/send-overdue")
async def send_overdue_telegram(data: dict):
    """Kirim notifikasi tunggakan via Telegram (baru)"""
    result = await telegram_service.send_overdue_notification(
        data.get("customer_name"),
        float(data.get("total_debt", 0)),
        int(data.get("invoice_count", 0))
    )
    return {"status": "sent" if result.get("success") else "failed", "detail": result}