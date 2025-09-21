<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\RemoteControlAPIController;
use App\Http\Controllers\api\SyncAPIController;
use Illuminate\Support\Facades\Route;

#==========   USER AUTH  =======#
Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::resource('/remotecontol', RemoteControlAPIController::class)->only(['index', 'store']);
Route::post('sync', [SyncAPIController::class, 'sync']);
Route::post('push', [SyncAPIController::class, 'push']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    //
});
