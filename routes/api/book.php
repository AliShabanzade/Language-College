<?php

use App\Http\Controllers\Api\V1\BookController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'book', 'as' => 'api.book.'], function () {

});
Route::apiResource('book', BookController::class);
Route::get('comment/book/{book}',[BookController::class,'comment']);
Route::get('like/book/{book}',[BookController::class,'addLike']);



