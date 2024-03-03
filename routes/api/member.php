<?php

use App\Http\Controllers\Api\V1\MemberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'member', 'as' => 'api.member.'], function () {

});
Route::apiResource('member', MemberController::class);

