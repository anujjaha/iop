<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ClientDetail\AdminClientDetailController;

Route::group([], function () {
    /*
     * Admin ClientDetail Controller
     */

    // Route for Ajax DataTable
    Route::get("clientdetail/get", [AdminClientDetailController::class, 'getTableData'])->name("clientdetail.get-list-data");

    Route::resource("clientdetail", AdminClientDetailController::class);
});