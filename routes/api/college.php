<?php

use App\Http\Controllers\Api\V1\CollegeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'college', 'as' => 'api.college.'], function () {

});
Route::apiResource('college', CollegeController::class);
Route::post('college/{college}/addCourse',[CollegeController::class, 'addCourse']);
Route::post('college/{college}/toggle/course/{course}',[CollegeController::class, 'toggle']);


