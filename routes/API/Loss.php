<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APILossController;

Route::apiResource('loss', APILossController::class);
?>