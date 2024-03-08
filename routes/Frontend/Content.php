<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Content\ContentController;

Route::group([], function () {
    /*
     * Admin Content Controller
     */
    Route::get("i", [ContentController::class, 'index']);
    Route::get("i/{slug}", [ContentController::class, 'info'])->name('info');
});