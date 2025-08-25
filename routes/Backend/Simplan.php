<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Simplan\AdminSimplanController;

Route::group([], function () {
    /*
     * Admin Simplan Controller
     */

    // Route for Ajax DataTable
    Route::get("simplan/get", [AdminSimplanController::class, 'getTableData'])->name("simplan.get-list-data");

    Route::post("simplan/add-new", [AdminSimplanController::class, 'addNew'])->name("simplan.add-new");

    Route::resource("simplan", AdminSimplanController::class);
});