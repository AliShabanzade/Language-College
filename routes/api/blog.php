<?php

use App\Http\Controllers\Api\V1\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blog', 'as' => 'api.blog.'], function () {

});
Route::apiResource('blog', BlogController::class);

