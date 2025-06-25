<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ClientStockTransaction\AdminClientStockTransactionController;

Route::group([], function () {
    /*
     * Admin ClientStockTransaction Controller
     */

    // Route for Ajax DataTable
    Route::get("clientstocktransaction/get", [AdminClientStockTransactionController::class, 'getTableData'])->name("clientstocktransaction.get-list-data");

    Route::resource("clientstocktransaction", AdminClientStockTransactionController::class);
});