<?php

use App\Http\Controllers\Api\V1\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'course', 'as' => 'api.course.'], function () {

});
Route::apiResource('course', CourseController::class);

