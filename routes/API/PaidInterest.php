<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIPaidInterestController;

Route::apiResource('paidinterest', APIPaidInterestController::class);
?>