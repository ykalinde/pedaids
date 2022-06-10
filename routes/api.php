<?php

use App\Http\Controllers\KeysController;
use App\Http\Controllers\MinMaxController;
use App\Http\Controllers\TableQueriesController;
use Illuminate\Support\Facades\Route;

Route::get("minmax", MinMaxController::class);
Route::post("tables/query", TableQueriesController::class);
Route::post("keys/generate", [KeysController::class, "generate"]);
Route::post("keys/disable", [KeysController::class, "disable"]);
