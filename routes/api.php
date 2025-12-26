<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Public Routes
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::post('/save_progress', [UserProgressController::class, 'saveProgress']);
});
