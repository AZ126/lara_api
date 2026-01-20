<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('user/create', [UserController::class, 'store']);
Route::get('user/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/get/all', [UserController::class, 'index']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
