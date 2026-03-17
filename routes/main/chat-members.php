<?php

use App\Http\Controllers\ChatMembersController;
use Illuminate\Support\Facades\Route;

Route::prefix('chat-member')->group(function () {
    Route::get('/', [ChatMembersController::class, 'index']);
    Route::get('{chatMember}', [ChatMembersController::class, 'show']);
    Route::post('/', [ChatMembersController::class, 'store']);
    Route::put('{chatMember}', [ChatMembersController::class, 'update']);
    Route::delete('{chatMember}', [ChatMembersController::class, 'destroy']);
});
