<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::with(['customer', 'technician'])->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        return response()->json($query->paginate(20));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'nullable|exists:services,id',
            'category' => 'nullable|in:TECHNICAL,BILLING,SALES,COMPLAINT',
            'priority' => 'nullable|in:P1,P2,P3,P4',
            'status' => 'nullable|in:OPEN,IN_PROGRESS,WAITING,RESOLVED,CLOSED,REOPENED',
            'assigned_agent' => 'nullable|string|max:20',
            'assigned_tech' => 'nullable|exists:technicians,id',
            'description' => 'nullable|string',
            'resolution_notes' => 'nullable|string',
            'sla_target_at' => 'nullable|date',
        ]);

        $validated['ticket_id'] = 'TCK-' . time();

        return response()->json(Ticket::create($validated)->load(['customer', 'technician']), 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json($ticket->load(['customer', 'technician', 'workOrders']));
    }

    public function update(Request $request, Ticket $ticket): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'service_id' => 'nullable|exists:services,id',
            'category' => 'nullable|in:TECHNICAL,BILLING,SALES,COMPLAINT',
            'priority' => 'nullable|in:P1,P2,P3,P4',
            'status' => 'sometimes|required|in:OPEN,IN_PROGRESS,WAITING,RESOLVED,CLOSED,REOPENED',
            'assigned_agent' => 'nullable|string|max:20',
            'assigned_tech' => 'nullable|exists:technicians,id',
            'description' => 'nullable|string',
            'resolution_notes' => 'nullable|string',
            'sla_target_at' => 'nullable|date',
        ]);

        $ticket->update($validated);

        return response()->json($ticket->load(['customer', 'technician']));
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        return response()->json(null, 204);
    }
}
