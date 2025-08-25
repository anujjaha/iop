<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Sim\AdminSimController;

Route::group([], function () {
    /*
     * Admin Sim Controller
     */

    // Route for Ajax DataTable
    Route::get("sim/get", [AdminSimController::class, 'getTableData'])->name("sim.get-list-data");
    

    Route::get("sim/chart", [AdminSimController::class, 'chart'])->name("sim.chart");

    Route::resource("sim", AdminSimController::class);
});