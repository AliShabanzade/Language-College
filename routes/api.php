<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
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

//Route::get('/test' , function (){
//   echo 'salam';
//});
Route::post('register', [AuthController::class, 'register']);
Route::post('setCode', [AuthController::class, 'setCode']);
Route::post('setPassword', [AuthController::class, 'setPassword']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgetPassword', [AuthController::class, 'forgetPassword']);
Route::post('logout', [AuthController::class, 'logout']);
Route::apiResource('user', UserController::class);

Route::post('user/{user}/add/role',[\App\Http\Controllers\Api\V1\UserController::class,'addRole']);
Route::delete('user/{user}/remove/{role}/role',[\App\Http\Controllers\Api\V1\UserController::class,
                                                'removeRole']);
//addPermission
Route::post('user/{user}/add/Permission',[\App\Http\Controllers\Api\V1\UserController::class,'addPermission']);

