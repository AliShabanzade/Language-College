<?php

use App\Http\Controllers\Api\V1\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'test', 'as' => 'api.test.'], function () {

});
Route::apiResource('test', TestController::class);

