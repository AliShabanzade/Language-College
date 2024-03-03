<?php

use App\Http\Controllers\Api\V1\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'department', 'as' => 'api.department.'], function () {

});
Route::apiResource('department', DepartmentController::class);

