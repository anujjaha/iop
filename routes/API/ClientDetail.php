<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIClientDetailController;

Route::apiResource('clientdetail', APIClientDetailController::class);
?>