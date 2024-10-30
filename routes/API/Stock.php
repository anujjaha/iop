<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIStockController;

Route::apiResource('stock', APIStockController::class);
?>