<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIClientStockTransactionController;

Route::apiResource('clientstocktransaction', APIClientStockTransactionController::class);
?>