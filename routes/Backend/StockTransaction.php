<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StockTransaction\AdminStockTransactionController;

Route::group([], function () {
    /*
     * Admin StockTransaction Controller
     */

    // Route for Ajax DataTable
    Route::get("stocktransaction/get", [AdminStockTransactionController::class, 'getTableData'])->name("stocktransaction.get-list-data");

    Route::resource("stocktransaction", AdminStockTransactionController::class);
});