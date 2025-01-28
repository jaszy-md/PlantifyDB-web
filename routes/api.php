<?php

use App\Http\Controllers\API\PlantController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Hier kun je alle API-routes voor je applicatie registreren. Deze routes
| worden geladen door de RouteServiceProvider binnen een groep die
| is toegewezen aan het "api" middleware-group.
|
*/

// API Resource Routes voor Planten en Categorieën zonder middleware
Route::apiResource('plants', PlantController::class);
Route::apiResource('categories', CategoryController::class);
