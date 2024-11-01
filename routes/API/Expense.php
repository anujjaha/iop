<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIExpenseController;

Route::apiResource('expense', APIExpenseController::class);
?>