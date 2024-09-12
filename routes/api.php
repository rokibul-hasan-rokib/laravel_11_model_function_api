<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryContorller;
use App\Http\Controllers\SubCategoryContorller;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);

Route::apiResource('categories', CategoryContorller::class);

Route::apiResource('subcategories', SubCategoryContorller::class);
