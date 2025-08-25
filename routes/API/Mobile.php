<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIMobileController;

Route::apiResource('mobile', APIMobileController::class);
?>