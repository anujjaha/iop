<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Stock\AdminStockController;

Route::group([], function () {
    /*
     * Admin Stock Controller
     */

    // Route for Ajax DataTable
    Route::get("stock/get", [AdminStockController::class, 'getTableData'])->name("stock.get-list-data");
    
    Route::post("stock/sell", [AdminStockController::class, 'sell'])->name("stock.sell");

    Route::resource("stock", AdminStockController::class);
});