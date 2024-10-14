<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Fees\AdminFeesController;

Route::group([], function () {
    /*
     * Admin Fees Controller
     */

    // Route for Ajax DataTable
    Route::get("fees/get", [AdminFeesController::class, 'getTableData'])->name("fees.get-list-data");

    Route::post("fees/get-clients", [AdminFeesController::class, 'getClients'])->name("fees.get-clients");

    Route::post("fees/pay-client", [AdminFeesController::class, 'payClient'])->name("fees.pay-client");

    Route::resource("fees", AdminFeesController::class);
});