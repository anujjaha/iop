<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APISimplanController;

Route::apiResource('simplan', APISimplanController::class);
?>