<?php

use App\Http\Controllers\Api\V1\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'faq', 'as' => 'api.faq.'], function () {
    Route::patch('toggle/{faq}', [FaqController::class, 'toggle']);
});
//Route::apiResource('faq', FaqController::class)->parameter('faq' , 'faq:slug');
Route::apiResource('faq', FaqController::class);




