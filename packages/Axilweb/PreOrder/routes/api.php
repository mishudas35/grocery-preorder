<?php

use Axilweb\PreOrder\Controllers\ProductController;
use Axilweb\PreOrder\Controllers\PreOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('preorder')->group(function () {
    Route::post('/store', [PreOrderController::class, 'store'])->middleware('throttle:10,1');
    Route::get('/list', [PreOrderController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
});
