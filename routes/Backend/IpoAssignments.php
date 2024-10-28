<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IpoAssignments\AdminIpoAssignmentsController;

Route::group([], function () {
    /*
     * Admin IpoAssignments Controller
     */

    // Route for Ajax DataTable
    Route::get("ipoassignments/get", [AdminIpoAssignmentsController::class, 'getTableData'])->name("ipoassignments.get-list-data");

    Route::post("ipoassignments/get-clients", [AdminIpoAssignmentsController::class, 'getEligibleClients'])->name("ipoassignments.get-clients");

    Route::post("ipoassignments/revoke", [AdminIpoAssignmentsController::class, 'revokeIpo'])->name("ipoassignments.revoke-ipo");

    Route::resource("ipoassignments", AdminIpoAssignmentsController::class);
});