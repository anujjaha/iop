<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIContentController;

Route::apiResource('content', APIContentController::class);
?>