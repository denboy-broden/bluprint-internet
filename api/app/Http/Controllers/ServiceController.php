<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Service::with(['customer', 'package']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        return response()->json($query->paginate(20));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'package_id' => 'nullable|exists:packages,id',
            'status' => 'nullable|in:PENDING,ACTIVE,SUSPENDED,TERMINATED',
            'install_date' => 'nullable|date',
            'activation_date' => 'nullable|date',
            'suspension_date' => 'nullable|date',
            'termination_date' => 'nullable|date',
            'pppoe_username' => 'nullable|string|max:50',
            'pppoe_password' => 'nullable|string',
            'assigned_ip' => 'nullable|ip',
            'vlan_id' => 'nullable|integer',
        ]);

        $validated['service_id'] = 'SRV-' . time();

        return response()->json(Service::create($validated)->load(['customer', 'package']), 201);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json($service->load(['customer', 'package', 'tickets']));
    }

    public function update(Request $request, Service $service): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'package_id' => 'nullable|exists:packages,id',
            'status' => 'sometimes|required|in:PENDING,ACTIVE,SUSPENDED,TERMINATED',
            'install_date' => 'nullable|date',
            'activation_date' => 'nullable|date',
            'suspension_date' => 'nullable|date',
            'termination_date' => 'nullable|date',
            'pppoe_username' => 'nullable|string|max:50',
            'pppoe_password' => 'nullable|string',
            'assigned_ip' => 'nullable|ip',
            'vlan_id' => 'nullable|integer',
        ]);

        $service->update($validated);

        return response()->json($service->load(['customer', 'package']));
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
