<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IpoDetails\AdminIpoDetailsController;

Route::group([], function () {
    /*
     * Admin IpoDetails Controller
     */

    // Route for Ajax DataTable
    Route::get("ipodetails/get", [AdminIpoDetailsController::class, 'getTableData'])->name("ipodetails.get-list-data");

    Route::get("ipodetails/chart", [AdminIpoDetailsController::class, 'showChart'])->name("ipodetails.show-chart");

    Route::post("ipodetails/upload-csv", [AdminIpoDetailsController::class, 'uploadCsv'])->name("ipodetails.upload-csv");

    Route::get("ipodetails/download-csv/{id}", [AdminIpoDetailsController::class, 'downloadCsv'])->name("ipodetails.download-csv");

    Route::resource("ipodetails", AdminIpoDetailsController::class);
});