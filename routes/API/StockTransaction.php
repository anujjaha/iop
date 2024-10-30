<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIStockTransactionController;

Route::apiResource('stocktransaction', APIStockTransactionController::class);
?>