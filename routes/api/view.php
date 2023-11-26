<?php

use App\Http\Controllers\Api\V1\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'view', 'as' => 'api.view.'], function () {

});
Route::apiResource('view', ViewController::class);


