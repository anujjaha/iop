<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Interest\AdminInterestController;

Route::group([], function () {
    /*
     * Admin Interest Controller
     */

    // Route for Ajax DataTable
    Route::get("interest/get", [AdminInterestController::class, 'getTableData'])->name("interest.get-list-data");

    Route::resource("interest", AdminInterestController::class);
});