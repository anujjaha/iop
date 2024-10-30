<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIProfitController;

Route::apiResource('profit', APIProfitController::class);
?>