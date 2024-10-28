<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIMainController;

Route::apiResource('main', APIMainController::class);
?>