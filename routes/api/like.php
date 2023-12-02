<?php

use App\Http\Controllers\Api\V1\LikeController;
use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'api.like.'], function () {

});
Route::apiResource('like', LikeController::class);
Route::get('like/notice/{notice}',[NoticeController::class,'addLike']);

