<?php

use App\Http\Controllers\Api\V1\CollegeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'college', 'as' => 'api.college.'], function () {

});
Route::apiResource('college', CollegeController::class);
Route::post('college/{college}/add/course',[CollegeController::class, 'addCourse']);
Route::post('college/{college}/toggle/{course}',[CollegeController::class, 'toggle']);


