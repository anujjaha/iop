<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIStockDetailsController;

Route::apiResource('stockdetails', APIStockDetailsController::class);
?>