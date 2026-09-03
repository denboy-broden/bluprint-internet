<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Invoice::with(['customer', 'service']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        return response()->json($query->paginate(20));
    }

    public function show(Invoice $invoice): JsonResponse
    {
        return response()->json($invoice->load(['customer', 'service']));
    }

    public function markAsPaid(Invoice $invoice): JsonResponse
    {
        $invoice->update([
            'status' => 'PAID',
            'paid_at' => now(),
        ]);

        return response()->json([
            'message' => 'Invoice marked as paid',
            'invoice' => $invoice
        ]);
    }
}
