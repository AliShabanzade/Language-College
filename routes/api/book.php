<?php

use App\Http\Controllers\Api\V1\BookController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'book', 'as' => 'api.book.'], function () {

});
Route::apiResource('book', BookController::class);

