<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AllFdList\AdminAllFdListController;

Route::group([], function () {
    /*
     * Admin AllFdList Controller
     */

    // Route for Ajax DataTable
    Route::get("allfdlist/get", [AdminAllFdListController::class, 'getTableData'])->name("allfdlist.get-list-data");

    Route::resource("allfdlist", AdminAllFdListController::class);
});