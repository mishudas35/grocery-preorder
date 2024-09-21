<?php

use Axilweb\PreOrder\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('preorder')->group(function () {
    Route::post('/product', [ProductController::class, 'store']);
});
