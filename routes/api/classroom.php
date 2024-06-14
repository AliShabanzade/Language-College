<?php

use App\Http\Controllers\Api\V1\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'classroom', 'as' => 'api.classroom.'], function () {
    Route::get('/{classroom}/addMember', [ClassroomController::class,'addMember']);
});
Route::apiResource('classroom', ClassroomController::class);


