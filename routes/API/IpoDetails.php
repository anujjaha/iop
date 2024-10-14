<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIIpoDetailsController;

Route::apiResource('ipodetails', APIIpoDetailsController::class);
?>