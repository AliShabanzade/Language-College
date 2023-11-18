<?php

use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order', 'as' => 'api.order.'], function () {

});
Route::apiResource('order', OrderController::class);

