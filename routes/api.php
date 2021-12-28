<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('transaction')->group(function () {
    Route::post('checkout', [App\Http\Controllers\TransactionController::class, 'checkout']);
    Route::get('history/{id}', [App\Http\Controllers\TransactionController::class, 'getHistory']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
