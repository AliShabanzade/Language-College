<?php

use App\Http\Controllers\Api\V1\LikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'api.like.'], function () {

});
Route::apiResource('like', LikeController::class);

