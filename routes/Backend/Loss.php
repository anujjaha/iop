<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Loss\AdminLossController;

Route::group([], function () {
    /*
     * Admin Loss Controller
     */

    // Route for Ajax DataTable
    Route::get("loss/get", [AdminLossController::class, 'getTableData'])->name("loss.get-list-data");

    Route::resource("loss", AdminLossController::class);
});