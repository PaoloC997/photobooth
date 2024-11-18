<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RetrieveFileController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/retrieve-file/{filePath}', RetrieveFileController::class);

