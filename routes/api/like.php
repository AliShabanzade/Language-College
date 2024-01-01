<?php

use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\GalleryController;
use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'api.like.'], function () {
    Route::get('/blog/{blog}', [BlogController::class, 'addLike']);

    Route::get('/notice/{notice}', [NoticeController::class, 'addLike']);

    Route::get('/gallery/{gallery}', [GalleryController::class, 'addLike']);
});



