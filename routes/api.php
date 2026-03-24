<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__.'/main/auth.php';

    Route::middleware('auth:sanctum')->group(function () {
        require __DIR__.'/main/users.php';
        require __DIR__.'/main/chats.php';
        require __DIR__.'/main/messages.php';
        require __DIR__.'/main/chat-members.php';
        require __DIR__.'/main/centrifugo.php';
    });
});
