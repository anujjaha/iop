<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ClientDetail\AdminClientDetailController;

Route::group([], function () {
    /*
     * Admin ClientDetail Controller
     */

    // Route for Ajax DataTable
    Route::get("clientdetail/get", [AdminClientDetailController::class, 'getTableData'])->name("clientdetail.get-list-data");
    Route::post("clientdetail/investory-category", [AdminClientDetailController::class, 'investoryCategory'])->name("clientdetail.set-investory-category");

    Route::post("clientdetail/reset-balance", [AdminClientDetailController::class, 'resetBalance'])->name("clientdetail.reset-balance");

    Route::get("clientdetail/download-balance", [AdminClientDetailController::class, 'downloadBalance'])->name("clientdetail.download-balance");

    Route::resource("clientdetail", AdminClientDetailController::class);
});