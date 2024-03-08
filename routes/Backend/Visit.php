<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Visit\AdminVisitController;

Route::group([], function () {
    /*
     * Admin Visit Controller
     */

    // Route for Ajax DataTable
    Route::get("visit/get", [AdminVisitController::class, 'getTableData'])->name("visit.get-list-data");

    Route::resource("visit", AdminVisitController::class);
});