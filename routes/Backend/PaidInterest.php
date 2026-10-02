<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PaidInterest\AdminPaidInterestController;

Route::group([], function () {
    /*
     * Admin PaidInterest Controller
     */

    // Route for Ajax DataTable
    Route::get("paidinterest/get", [AdminPaidInterestController::class, 'getTableData'])->name("paidinterest.get-list-data");

    Route::resource("paidinterest", AdminPaidInterestController::class);
});