<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIFeesController;

Route::apiResource('fees', APIFeesController::class);
?>