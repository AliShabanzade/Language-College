<?php

use App\Http\Controllers\Api\V1\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'permission', 'as' => 'api.permission.'], function () {

});
Route::apiResource('permission', PermissionController::class);

