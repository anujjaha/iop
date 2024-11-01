<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Expense\AdminExpenseController;

Route::group([], function () {
    /*
     * Admin Expense Controller
     */

    // Route for Ajax DataTable
    Route::get("expense/get", [AdminExpenseController::class, 'getTableData'])->name("expense.get-list-data");

    Route::resource("expense", AdminExpenseController::class);
});