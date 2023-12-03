<?php

use App\Http\Controllers\Api\V1\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'api.like.'], function () {

});
Route::get('like/blog/{blog}',[BlogController::class, 'addLike']);

