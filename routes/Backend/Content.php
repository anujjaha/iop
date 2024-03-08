<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Content\AdminContentController;

Route::group([], function () {
    /*
     * Admin Content Controller
     */

    // Route for Ajax DataTable
    Route::get("content/get", [AdminContentController::class, 'getTableData'])->name("content.get-list-data");

    Route::resource("content", AdminContentController::class);
});