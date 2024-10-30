<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APITaxController;

Route::apiResource('tax', APITaxController::class);
?>