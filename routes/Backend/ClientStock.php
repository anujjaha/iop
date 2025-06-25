<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ClientStock\AdminClientStockController;

Route::group([], function () {
    /*
     * Admin ClientStock Controller
     */

    // Route for Ajax DataTable
    Route::get("clientstock/get", [AdminClientStockController::class, 'getTableData'])->name("clientstock.get-list-data");

    Route::post("clientstock/add-new", [AdminClientStockController::class, 'addNew'])->name("clientstock.add-new");

    Route::post("clientstock/settle", [AdminClientStockController::class, 'settle'])->name("clientstock.settle");

    Route::resource("clientstock", AdminClientStockController::class);
});