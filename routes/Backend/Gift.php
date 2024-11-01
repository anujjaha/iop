<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Gift\AdminGiftController;

Route::group([], function () {
    /*
     * Admin Gift Controller
     */

    // Route for Ajax DataTable
    Route::get("gift/get", [AdminGiftController::class, 'getTableData'])->name("gift.get-list-data");

    Route::resource("gift", AdminGiftController::class);
});