<?php

use App\Http\Controllers\Api\V1\SessionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'session', 'as' => 'api.session.'], function () {

});
Route::apiResource('session', SessionController::class);

