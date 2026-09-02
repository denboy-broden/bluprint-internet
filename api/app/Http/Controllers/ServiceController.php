<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->get();
        return response()->json($services);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'nullable|integer|min:1',
            'speed_mbps' => 'nullable|integer|min:1',
            'category' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'duration_days' => 'nullable|integer|min:1',
            'speed_mbps' => 'nullable|integer|min:1',
            'category' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $service->update($validated);
        return response()->json($service);
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(null, 204);
    }
}
