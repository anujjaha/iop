<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Reminder\AdminReminderController;

Route::group([], function () {
    /*
     * Admin ClientDetail Controller
     */

    // Route for Ajax DataTable
    Route::get("reminder/get", [AdminReminderController::class, 'getTableData'])->name("reminder.get-list-data");

    Route::get("reminder/calendar", [AdminReminderController::class, 'calendar'])->name("reminder.calendar");

    Route::resource("reminder", AdminReminderController::class);
});