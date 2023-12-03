<?php

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'as' => 'api.category.'], function () {

});
Route::apiResource('category', CategoryController::class);
Route::get('category/toggle/{category}', [CategoryController::class, 'toggle']);



