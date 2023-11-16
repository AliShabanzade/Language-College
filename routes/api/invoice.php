<?php

use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'invoice', 'as' => 'api.invoice.'], function () {

});
Route::apiResource('invoice', InvoiceController::class);

