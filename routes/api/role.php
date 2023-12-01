<?php

use App\Http\Controllers\Api\V1\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'role', 'as' => 'api.role.'], function () {

});
Route::apiResource('role', RoleController::class);
Route::post('user/{user}/add/role',[RoleController::class, 'addRole']);
Route::delete('user/{user}/remove/{role}/role',[RoleController::class, 'removeRole']);



