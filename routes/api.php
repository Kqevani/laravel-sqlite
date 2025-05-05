<?php

use App\Http\Controllers\Api\DoctorNetworkController;
use Illuminate\Support\Facades\Route;

// since we don't have the user table, we'll just skip this part
// ->middleware('auth:sanctum')
Route::get('doctor/network-aggregates/{doctor}', [DoctorNetworkController::class, 'aggregates']);
