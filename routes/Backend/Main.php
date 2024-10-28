<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Main\AdminMainController;

Route::group([], function () {
    /*
     * Admin Main Controller
     */

    // Route for Ajax DataTable
    Route::get("main/get", [AdminMainController::class, 'getTableData'])->name("main.get-list-data");

    Route::resource("main", AdminMainController::class);
});