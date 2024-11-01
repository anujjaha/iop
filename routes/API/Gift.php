<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIGiftController;

Route::apiResource('gift', APIGiftController::class);
?>