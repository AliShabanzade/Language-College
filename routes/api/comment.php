<?php

use App\Http\Controllers\Api\V1\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comment', 'as' => 'api.comment.'], function () {

});
Route::apiResource('comment', CommentController::class);

