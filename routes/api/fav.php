<?php

use App\Http\Controllers\Api\V1\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'fav', 'as' => 'api.fav.'], function () {
    Route::post('/gallery/{gallery}', [GalleryController::class, 'addFav']);
    Route::post('gallery', [GalleryController::class, 'show'])->name('fav.gallery.show');

});


