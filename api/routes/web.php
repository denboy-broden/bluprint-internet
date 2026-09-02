<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/health', fn() => response()->json(['status'=>'ok','service'=>'rt-rw-net-api']));
Route::apiResource('/api/customers', CustomerController::class);
Route::apiResource('/api/services', ServiceController::class);
Route::apiResource('/api/tickets', TicketController::class);
