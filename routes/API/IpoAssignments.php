<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIIpoAssignmentsController;

Route::apiResource('ipoassignments', APIIpoAssignmentsController::class);
?>