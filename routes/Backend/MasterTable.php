<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MasterTable\AdminMasterTableController;

Route::group([
], function () {
    /*
     * Admin MasterTable Controller
     */

    // Route for Ajax DataTable
    Route::get("mastertable/get", [AdminMasterTableController::class, 'getTableData'])->name("mastertable.get-list-data");

    Route::resource("mastertable", AdminMasterTableController::class);
    //Route::resource('items', ItemController::class);

    //Route::get('mastertable', [AdminMasterTableController::class, 'index'])->name('mastertable.index');
});