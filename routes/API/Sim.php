<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APISimController;

Route::apiResource('sim', APISimController::class);
?>