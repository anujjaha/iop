<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StockDetails\AdminStockDetailsController;

Route::group([], function () {
    /*
     * Admin StockDetails Controller
     */

    // Route for Ajax DataTable
    Route::get("stockdetails/get", [AdminStockDetailsController::class, 'getTableData'])->name("stockdetails.get-list-data");

    Route::resource("stockdetails", AdminStockDetailsController::class);
});