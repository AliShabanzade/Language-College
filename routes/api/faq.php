<?php

use App\Http\Controllers\Api\V1\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'faq', 'as' => 'api.faq.'], function () {

});
//Route::apiResource('faq', FaqController::class)->parameter('faq' , 'faq:slug');
Route::apiResource('faq', FaqController::class);
Route::get('faq/toggle/{faq}' , [App\Http\Controllers\Api\V1\FaqController::class, 'toggle']);



