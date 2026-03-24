<?php

use App\Http\Controllers\CentrifugoController;
use Illuminate\Support\Facades\Route;

Route::prefix('centrifugo')->group(function () {
    Route::post('token', [CentrifugoController::class, 'token']);
});
