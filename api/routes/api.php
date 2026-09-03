<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\ApiTokenMiddleware;

// ✅ Health check - PUBLIC (no auth required)
Route::get('/health', fn() => response()->json([
    'status' => 'ok',
    'service' => 'rt-rw-net-api',
    'version' => '0.1.0',
    'database' => 'connected'
]));

// 🔐 Protected Routes - API Token Auth
Route::middleware(\App\Http\Middleware\ApiTokenMiddleware::class)->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('tickets', TicketController::class);
});
