<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Tax\AdminTaxController;

Route::group([], function () {
    /*
     * Admin Tax Controller
     */

    // Route for Ajax DataTable
    Route::get("tax/get", [AdminTaxController::class, 'getTableData'])->name("tax.get-list-data");

    Route::resource("tax", AdminTaxController::class);
});