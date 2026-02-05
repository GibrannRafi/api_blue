<?php

use App\Http\Controllers\StoreBallanceController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::apiResource('user', UserController::class);
Route::get('user/all/paginated',[UserController::class, 'getAllPaginated']);
Route::post('store/{id}/verified', [StoreController::class, 'updateVerifiedStatus']);

Route::apiResource('store', StoreController::class);
Route::get('store/all/paginated',[StoreController::class, 'getAllPaginated']);

Route::apiResource('store-ballance', StoreBallanceController::class);
Route::get('store-ballance/all/paginated',[StoreBallanceController::class, 'getAllPaginated']);
