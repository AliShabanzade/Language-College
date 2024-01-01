<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'api.user.'], function () {

});
Route::apiResource('user', UserController::class);
Route::get('user/toggle/{user}', [UserController::class, 'toggle']);
Route::get('fav/{user}', [UserController::class, 'show'])->name('
');
