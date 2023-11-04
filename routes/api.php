<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::get('/test',function (){
//   echo 'test';
//});
Route::post('registerPhone',[\App\Http\Controllers\Api\V1\AuthController::class,'registerPhone']);
Route::post('setCode',[\App\Http\Controllers\Api\V1\AuthController::class,'setCode']);
Route::post('setPassword',[\App\Http\Controllers\Api\V1\AuthController::class,'setPassword']);
Route::post('login',[\App\Http\Controllers\Api\V1\AuthController::class,'login']);
Route::post('forgetPassword',[\App\Http\Controllers\Api\V1\AuthController::class,'forgetPassword']);
Route::post('logout',[\App\Http\Controllers\Api\V1\AuthController::class,'logout']);


