<?php

use App\Http\Controllers\Api\V1\Test2Controller;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'test2', 'as' => 'api.test2.'], function () {

});
Route::apiResource('test2', Test2Controller::class);

