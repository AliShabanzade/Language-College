<?php

use App\Http\Controllers\Api\V1\NoticeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notice', 'as' => 'api.notice.'], function () {

});
Route::apiResource('notice', NoticeController::class);
