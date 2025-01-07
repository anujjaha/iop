<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIInterestController;

Route::apiResource('interest', APIInterestController::class);
?>