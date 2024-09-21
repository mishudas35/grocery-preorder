<?php

use Axilweb\PreOrder\Controllers\ProductController;
use Axilweb\PreOrder\Controllers\PreOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('preorder')->group(function () {
    Route::post('/store', [PreOrderController::class, 'store']);
    Route::get('/list', [PreOrderController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
});
