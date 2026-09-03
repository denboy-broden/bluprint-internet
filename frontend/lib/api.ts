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
