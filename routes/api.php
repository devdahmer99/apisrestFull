<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('categories/{id}/products', [CategoryController::class, 'products']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
