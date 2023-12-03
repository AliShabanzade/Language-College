<?php

use App\Http\Controllers\Api\V1\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'gallery', 'as' => 'api.gallery.'], function () {

});
Route::apiResource('gallery', GalleryController::class);

