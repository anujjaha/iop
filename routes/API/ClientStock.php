<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIClientStockController;

Route::apiResource('clientstock', APIClientStockController::class);
?>