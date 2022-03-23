<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Dashboard\DashboardController;

Route::group([
], function () {
    Route::resource("dashboard", DashboardController::class);
});