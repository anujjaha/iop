<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IpoAssignments\AdminIpoAssignmentsController;

Route::group([], function () {
    /*
     * Admin IpoAssignments Controller
     */

    // Route for Ajax DataTable
    Route::get("ipoassignments/get", [AdminIpoAssignmentsController::class, 'getTableData'])->name("ipoassignments.get-list-data");

    Route::get("ipoassignments/create/{id}", [AdminIpoAssignmentsController::class, 'create'])->name("ipoassignments.create");

    Route::post("ipoassignments/get-clients", [AdminIpoAssignmentsController::class, 'getEligibleClients'])->name("ipoassignments.get-clients");

    Route::post("ipoassignments/get-clients", [AdminIpoAssignmentsController::class, 'getEligibleClients'])->name("ipoassignments.get-clients");

    Route::post("ipoassignments/revoke", [AdminIpoAssignmentsController::class, 'revokeIpo'])->name("ipoassignments.revoke-ipo");

    Route::post("ipoassignments/alloted", [AdminIpoAssignmentsController::class, 'allotedIpo'])->name("ipoassignments.alloted-ipo");

    Route::get("ipoassignments/alloted-list", [AdminIpoAssignmentsController::class, 'allotedList'])->name("ipoassignments.alloted-list");

    Route::post("ipoassignments/assign-client", [AdminIpoAssignmentsController::class, 'assignClient'])->name("ipoassignments.assign-client");

    Route::post("ipoassignments/settle-ipo", [AdminIpoAssignmentsController::class, 'settleIpo'])->name("ipoassignments.settle-ipo");


    Route::resource("ipoassignments", AdminIpoAssignmentsController::class);
});