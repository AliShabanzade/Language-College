<?php

use App\Http\Controllers\Api\V1\CartController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cart', 'as' => 'api.cart.'], function () {

});
//Route::apiResource('cart', CartController::class)->parameters(['cart', 'cart:slug']);
Route::apiResource('cart', CartController::class);


