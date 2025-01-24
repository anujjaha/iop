<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIAssetController;

Route::apiResource('asset', APIAssetController::class);
?>