from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import httpx
import os

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