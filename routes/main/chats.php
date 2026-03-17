<?php

use App\Http\Controllers\ChatsController;
use Illuminate\Support\Facades\Route;

Route::prefix('chat')->group(function () {
    Route::get('/', [ChatsController::class, 'index']);
    Route::get('{chat}', [ChatsController::class, 'show']);
    Route::post('/', [ChatsController::class, 'store']);
    Route::put('{chat}', [ChatsController::class, 'update']);
    Route::delete('{chat}', [ChatsController::class, 'destroy']);
});
