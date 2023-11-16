<?php

use App\Http\Controllers\Api\V1\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'order-item', 'as' => 'api.order-item.'], function () {

});
Route::apiResource('order-item', OrderItemController::class);

