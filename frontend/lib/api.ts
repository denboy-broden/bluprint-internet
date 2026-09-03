const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8001/api';

export async function getCustomers() {
  const res = await fetch(`${API_URL}/customers`, {
    headers: { 'X-API-Token': 'rt-rw-net-secret-2026' }
  });
  if (!res.ok) throw new Error('Failed to fetch customers');
  return res.json();
}

export async function getServices() {
  const res = await fetch(`${API_URL}/services`, {
    headers: { 'X-API-Token': 'rt-rw-net-secret-2026' }
  });
  return res.json();
}

export async function getTickets() {
  const res = await fetch(`${API_URL}/tickets`, {
    headers: { 'X-API-Token': 'rt-rw-net-secret-2026' }
  });
  return res.json();
}

// ============ Invoice (Billing) ============
export async function getInvoices(params?: { status?: string; customer_id?: number }) {
  const qs = new URLSearchParams();
  if (params?.status) qs.set('status', params.status);
  if (params?.customer_id) qs.set('customer_id', String(params.customer_id));
  const query = qs.toString() ? `?${qs.toString()}` : '';
  const res = await fetch(`${API_URL}/invoices${query}`, {
    headers: { 'X-API-Token': 'rt-rw-net-secret-2026' }
  });
  return res.json();
}

export async function markInvoiceAsPaid(id: number) {
  const res = await fetch(`${API_URL}/invoices/${id}/pay`, {
    method: 'POST',
    headers: { 'X-API-Token': 'rt-rw-net-secret-2026', 'Accept': 'application/json' }
  });
  return res.json();
}
