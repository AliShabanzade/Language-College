<?php

use App\Http\Controllers\Api\V1\TicketMessageController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ticket-message', 'as' => 'api.ticket-message.'], function () {

});
Route::apiResource('ticket-message', TicketMessageController::class);

