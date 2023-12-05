<?php

use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notice', 'as' => 'api.notice.'], function () {
    Route::patch('toggle/{notice}', [NoticeController::class, 'toggle'])->name('toggle');
    Route::post('comment/{notice}', [NoticeController::class, 'comment'])->name('comment');
});
Route::apiResource('notice', NoticeController::class);

