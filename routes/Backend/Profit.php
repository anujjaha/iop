<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Profit\AdminProfitController;

Route::group([], function () {
    /*
     * Admin Profit Controller
     */

    // Route for Ajax DataTable
    Route::get("profit/get", [AdminProfitController::class, 'getTableData'])->name("profit.get-list-data");

    Route::resource("profit", AdminProfitController::class);
});