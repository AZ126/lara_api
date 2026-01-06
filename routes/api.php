<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function(){
    Route::post('/create', [UserController::class, 'store']);
    Route::get('/get', [UserController::class, 'index']);
});
