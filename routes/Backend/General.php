<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\General\AdminGeneralController;

Route::group([], function () {
    /*
     * Admin General Controller
     */

    // Route for Ajax DataTable
    Route::get("general/get", [AdminGeneralController::class, 'getTableData'])->name("general.get-list-data");
    Route::get("general/{id}/{type}", [AdminGeneralController::class, 'downloadQrCode'])->name("general.qr-download");

    Route::resource("general", AdminGeneralController::class);
});