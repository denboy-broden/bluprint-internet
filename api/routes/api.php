<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/health', fn() => response()->json([
    'status' => 'ok',
    'service' => 'rt-rw-net-api',
    'version' => '0.1.0',
    'database' => 'connected'
]));

Route::apiResource('customers', CustomerController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('tickets', TicketController::class);
