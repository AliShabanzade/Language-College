<?php

use App\Http\Controllers\Api\V1\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'attendance', 'as' => 'api.attendance.'], function () {

});
Route::apiResource('attendance', AttendanceController::class);

