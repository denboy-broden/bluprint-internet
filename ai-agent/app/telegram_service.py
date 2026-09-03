"""Telegram Notification Service untuk RT/RW Net AI Agent"""
import os
import httpx
import logging

logger = logging.getLogger(__name__)

class TelegramService:
    def __init__(self):
        self.bot_token = os.getenv("TELEGRAM_BOT_TOKEN", "")
        self.chat_id = os.getenv("TELEGRAM_CHAT_ID", "")
        self.api_url = f"https://api.telegram.org/bot{self.bot_token}"
    
    def is_configured(self) -> bool:
        """Cek apakah Telegram bot sudah dikonfigurasi"""
        return bool(self.bot_token and self.chat_id)
    
    async def send_message(self, text: str) -> dict:
        """Kirim pesan ke Telegram"""
        if not self.is_configured():
            logger.warning("Telegram not configured. Set TELEGRAM_BOT_TOKEN and TELEGRAM_CHAT_ID")
            return {"success": False, "error": "Telegram not configured"}
        
        try:
            async with httpx.AsyncClient() as client:
                payload = {
                    "chat_id": self.chat_id,
                    "text": text,
                    "parse_mode": "HTML",
                    "disable_web_page_preview": True
                }
                response = await client.post(
                    f"{self.api_url}/sendMessage",
                    json=payload,
                    timeout=10.0
                )
                result = response.json()
                
                if result.get("ok"):
                    logger.info(f"Telegram message sent successfully")
                    return {"success": True, "message_id": result["result"]["message_id"]}
                else:
                    logger.error(f"Telegram API error: {result}")
                    return {"success": False, "error": result.get("description", "Unknown error")}
        except Exception as e:
            logger.error(f"Failed to send Telegram message: {e}")
            return {"success": False, "error": str(e)}
    
    async def send_billing_notification(self, invoice_data: dict) -> dict:
        """Kirim notifikasi tagihan ke pelanggan"""
        customer_name = invoice_data.get("customer_name", "Pelanggan")
        invoice_number = invoice_data.get("invoice_number", "N/A")
        amount = invoice_data.get("amount", 0)
        due_date = invoice_data.get("due_date", "N/A")
        
        message = f"""📋 <b>TAGIHAN BARU</b>

👤 Pelanggan: {customer_name}
🔢 No. Invoice: <code>{invoice_number}</code>
💰 Jumlah: <b>Rp {amount:,.2f}</b>
📅 Jatuh Tempo: {due_date}

Silakan lakukan pembayaran sebelum jatuh tempo.

_Notifikasi otomatis dari RT/RW Net AI Agent_"""

        return await self.send_message(message)
    
    async def send_overdue_notification(self, customer_name: str, total_debt: float, invoice_count: int) -> dict:
        """Kirim notifikasi tunggakan"""
        message = f"""⚠️ <b>PEMBERITAHUAN TUNGGAKAN</b>

👤 Pelanggan: {customer_name}
📊 Total Tunggakan: <b>Rp {total_debt:,.2f}</b>
📋 Jumlah Invoice: {invoice_count}

Mohon segera lakukan pembayaran untuk menghindari penangguhan layanan.

_Notifikasi otomatis dari RT/RW Net AI Agent_"""

        return await self.send_message(message)
    
    async def send_daily_summary(self, summary: dict) -> dict:
        """Kirim ringkasan harian ke admin"""
        pending = summary.get("pending", 0)
        paid = summary.get("paid", 0)
        pending_amount = summary.get("pending_amount", 0)
        
        message = f"""📊 <b>RINGKASAN HARIAN BILLING</b>

✅ Lunas: {paid}
⏳ Pending: {pending}
💰 Total Piutang: <b>Rp {pending_amount:,.2f}</b>

_Notifikasi otomatis dari RT/RW Net AI Agent_"""

        return await self.send_message(message)


# Singleton instance
telegram_service = TelegramService()
