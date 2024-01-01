<?php

use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\GalleryController;
use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'like', 'as' => 'api.like.'], function () {

});
Route::get('like/blog/{blog}', [BlogController::class, 'addLike']);

Route::get('like/notice/{notice}', [NoticeController::class, 'addLike']);

Route::get('like/gallery/{gallery}', [GalleryController::class, 'addLike']);

Route::get('like/book/{book}', [BookController::class, 'addLike']);


