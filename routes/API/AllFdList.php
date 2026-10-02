<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIAllFdListController;

Route::apiResource('allfdlist', APIAllFdListController::class);
?>