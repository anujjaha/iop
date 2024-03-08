<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIVisitController;

Route::apiResource('visit', APIVisitController::class);
?>