<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Transactions\AdminTransactionsController;

Route::group([], function () {
    /*
     * Admin Transactions Controller
     */

    // Route for Ajax DataTable
    Route::get("transactions/get", [AdminTransactionsController::class, 'getTableData'])->name("transactions.get-list-data");

    Route::post("transactions/add-balance", [AdminTransactionsController::class, 'addBalance'])->name("transactions.add-balance");

    Route::resource("transactions", AdminTransactionsController::class);
});