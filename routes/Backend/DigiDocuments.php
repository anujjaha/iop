<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DigiDocuments\AdminDigiDocumentsController;

Route::group([], function () {
    /*
     * Admin ClientDetail Controller
     */

    // Route for Ajax DataTable
    Route::get("digidocuments/get", [AdminDigiDocumentsController::class, 'getTableData'])->name("digidocuments.get-list-data");

    Route::resource("digidocuments", AdminDigiDocumentsController::class);
});