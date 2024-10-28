<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IpoDetails\AdminIpoDetailsController;

Route::group([], function () {
    /*
     * Admin IpoDetails Controller
     */

    // Route for Ajax DataTable
    Route::get("ipodetails/get", [AdminIpoDetailsController::class, 'getTableData'])->name("ipodetails.get-list-data");

    Route::resource("ipodetails", AdminIpoDetailsController::class);
});