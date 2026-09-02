<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['customer', 'technician'])->orderBy('created_at', 'desc')->get();
        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'subject' => 'required|string|max:200',
            'description' => 'required|string',
            'category' => 'nullable|string|max:50',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'status' => 'nullable|in:open,in_progress,resolved,closed',
        ]);

        $ticket = Ticket::create($validated);
        return response()->json($ticket->load(['customer', 'technician']), 201);
    }

    public function show(string $id)
    {
        $ticket = Ticket::with(['customer', 'technician'])->findOrFail($id);
        return response()->json($ticket);
    }

    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'technician_id' => 'nullable|exists:technicians,id',
            'subject' => 'sometimes|required|string|max:200',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:50',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'status' => 'sometimes|required|in:open,in_progress,resolved,closed',
        ]);

        $ticket->update($validated);
        return response()->json($ticket->load(['customer', 'technician']));
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(null, 204);
    }
}
