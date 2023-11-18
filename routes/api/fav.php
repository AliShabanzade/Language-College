<?php

use App\Http\Controllers\Api\V1\FavController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'fav', 'as' => 'api.fav.'], function () {

});
Route::apiResource('fav', FavController::class);

