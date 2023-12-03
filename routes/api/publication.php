<?php

use App\Http\Controllers\Api\V1\PublicationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'publication', 'as' => 'api.publication.'], function () {

});
Route::apiResource('publication', PublicationController::class);

