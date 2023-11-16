<?php

use App\Http\Controllers\Api\V1\BokController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'bok', 'as' => 'api.bok.'], function () {

});
Route::apiResource('bok', BokController::class);

