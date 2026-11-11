<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\McxTrade\AdminMcxTradeController;

Route::group([], function () {
    /*
     * Admin McxTrade Controller
     */

    // Route for Ajax DataTable
    Route::get("mcxtrade/get", [AdminMcxTradeController::class, 'getTableData'])->name("mcxtrade.get-list-data");

    Route::resource("mcxtrade", AdminMcxTradeController::class);
});