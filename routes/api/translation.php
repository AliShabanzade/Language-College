<?php

use App\Http\Controllers\Api\V1\TranslationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'translation', 'as' => 'api.translation.'], function () {

});
Route::apiResource('translation', TranslationController::class);

