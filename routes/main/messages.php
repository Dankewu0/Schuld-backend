<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('message')->group(function () {
    Route::get('/', [MessagesController::class, 'index']);
    Route::get('{message}', [MessagesController::class, 'show']);
    Route::post('/', [MessagesController::class, 'store']);
    Route::put('{message}', [MessagesController::class, 'update']);
    Route::delete('{message}', [MessagesController::class, 'destroy']);
});
