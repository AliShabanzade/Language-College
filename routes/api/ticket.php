<?php

use App\Http\Controllers\Api\V1\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ticket', 'as' => 'api.ticket.'], function () {

});
Route::apiResource('ticket', TicketController::class);

