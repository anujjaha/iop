<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Asset\AdminAssetController;

Route::group([], function () {
    /*
     * Admin Asset Controller
     */

    // Route for Ajax DataTable
    Route::get("asset/get", [AdminAssetController::class, 'getTableData'])->name("asset.get-list-data");

    Route::resource("asset", AdminAssetController::class);
});