<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreBallanceController;
use App\Http\Controllers\StoreBallanceHistoryController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WithdrawalController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::apiResource('user', UserController::class);
Route::get('user/all/paginated',[UserController::class, 'getAllPaginated']);


Route::post('store/{id}/verified', [StoreController::class, 'updateVerifiedStatus']);
Route::apiResource('store', StoreController::class);
Route::get('store/all/paginated',[StoreController::class, 'getAllPaginated']);

Route::apiResource('store-ballance', StoreBallanceController::class)->except(['store', 'update', 'delete']);
Route::get('store-ballance/all/paginated',[StoreBallanceController::class, 'getAllPaginated']);


Route::apiResource('store-ballance-history', StoreBallanceHistoryController::class)->except(['store','update', 'delete']);
Route::get('store-ballance-history/all/paginated',[StoreBallanceHistoryController::class, 'getAllPaginated']);

Route::apiResource('withdrawal', WithdrawalController::class)->except(['update', 'delete']);
Route::get('withdrawal/all/paginated',[WithdrawalController::class, 'getAllPaginated']);
Route::post('withdrawal/{id}/approve', [WithdrawalController::class, 'approve']);


Route::apiResource('buyer', BuyerController::class);
Route::get('buyer/all/paginated',[BuyerController::class, 'getAllPaginated']);

Route::apiResource( 'product-category', ProductCategoryController::class);
Route::get('product-category/all/paginated',[ProductCategoryController::class, 'getAllPaginated']);
Route::get('product-category/slug/{slug}', [ProductCategoryController::class, 'showBySlug']);


Route::apiResource( 'product', ProductController::class);
Route::get('product/all/paginated',[ProductController::class, 'getAllPaginated']);
Route::get('product/slug/{slug}', [ProductController::class, 'showBySlug']);

Route::apiResource( 'transaction', TransactionController::class);
Route::get('transaction/all/paginated',[TransactionController::class, 'getAllPaginated']);
