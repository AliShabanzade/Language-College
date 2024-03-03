<?php

use App\Http\Controllers\Api\V1\TermDateController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'term-date', 'as' => 'api.term-date.'], function () {

});
Route::apiResource('term-date', TermDateController::class);

