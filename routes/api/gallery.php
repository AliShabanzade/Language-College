<?php

use App\Http\Controllers\Api\V1\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'gallery', 'as' => 'api.gallery.'], function () {

});
Route::apiResource('gallery', GalleryController::class);

Route::patch('gallery/toggle/{gallery}', [GalleryController::class, 'toggle']);

Route::post('gallery/comment/{gallery}', [GalleryController::class, 'comment']);
