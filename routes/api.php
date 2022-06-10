<?php

use App\Http\Controllers\MinMaxController;
use App\Http\Controllers\TableQueriesController;
use Illuminate\Support\Facades\Route;

Route::get("minmax", MinMaxController::class);
Route::post("tables/query", TableQueriesController::class);
