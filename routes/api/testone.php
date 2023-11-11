<?php

use App\Http\Controllers\Api\V1\TestoneController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'testone', 'as' => 'api.testone.'], function () {

});
Route::apiResource('testone', TestoneController::class);

