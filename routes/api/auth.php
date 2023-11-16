<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('confirm', [AuthController::class, 'confirm']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgetPassword', [AuthController::class, 'forgetPassword']);
Route::post('logout', [AuthController::class, 'logout']);

