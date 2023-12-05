<?php

use App\Http\Controllers\Api\V1\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'gallery', 'as' => 'api.gallery.'], function () {
    Route::patch('toggle/{gallery}', [GalleryController::class, 'toggle'])->name('toggle');
    Route::post('comment/{gallery}', [GalleryController::class, 'comment'])->name('comment');
});
Route::apiResource('gallery', GalleryController::class);


