<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\User\AdminUserController;

Route::group([], function () {
    /*
     * Admin MasterTable Controller
     */

    // Route for Ajax DataTable
    Route::get("users/get", [AdminUserController::class, 'getTableData'])->name("users.get-list-data");

    Route::resource("users", AdminUserController::class);
});