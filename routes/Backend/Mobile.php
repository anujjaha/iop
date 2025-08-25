<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Mobile\AdminMobileController;

Route::group([], function () {
    /*
     * Admin Mobile Controller
     */

    // Route for Ajax DataTable
    Route::get("mobile/get", [AdminMobileController::class, 'getTableData'])->name("mobile.get-list-data");

    Route::resource("mobile", AdminMobileController::class);
});