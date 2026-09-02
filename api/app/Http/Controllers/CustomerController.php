<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Customer::query();
        if ($request->filled('status')) $query->where('status', $request->status);
        return response()->json($query->paginate(20));
    }
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'status' => 'nullable|in:LEAD,PROSPECT,ACTIVE',
        ]);
        $validated['customer_id'] = 'CUST-' . time();
        return response()->json(Customer::create($validated), 201);
    }
    public function show(Customer $customer): JsonResponse { return response()->json($customer); }
}
