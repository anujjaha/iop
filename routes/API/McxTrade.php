<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIMcxTradeController;

Route::apiResource('mcxtrade', APIMcxTradeController::class);
?>