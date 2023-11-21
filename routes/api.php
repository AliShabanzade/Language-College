<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


$path = __DIR__ . '/api';
$files = scandir($path, SCANDIR_SORT_NONE);
$files = array_diff($files, ['.', '..']);
foreach ($files as $file) {
    require_once "api/{$file}";
}

