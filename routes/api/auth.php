<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('confirm', [AuthController::class, 'confirm']);
Route::post('set-password', [AuthController::class, 'setPassword']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('logout', [AuthController::class, 'logout']);

