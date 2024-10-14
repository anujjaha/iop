<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APITransactionsController;

Route::apiResource('transactions', APITransactionsController::class);
?>