<?php

use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comment', 'as' => 'api.comment.'], function () {

});
Route::apiResource('comment', CommentController::class);
Route::post('comment/notice/{notice}', [NoticeController::class, 'comment']);

