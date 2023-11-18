<?php

use App\Http\Controllers\Api\V1\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'as' => 'api.setting.'], function () {

});
Route::apiResource('setting', SettingController::class);

