<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIGeneralController;

Route::apiResource('general', APIGeneralController::class);
?>