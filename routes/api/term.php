<?php

use App\Http\Controllers\Api\V1\TermController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'term', 'as' => 'api.term.'], function () {

});
Route::apiResource('term', TermController::class);

