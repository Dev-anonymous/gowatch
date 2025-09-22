<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\RemoteControlAPIController;
use App\Http\Controllers\api\SyncAPIController;
use App\Models\Errorlog;
use Illuminate\Support\Facades\Route;

#==========   USER AUTH  =======#
Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () {
    Route::resource('/remotecontol', RemoteControlAPIController::class)->only(['index', 'store']);
    Route::post('sync', [SyncAPIController::class, 'sync']);
    Route::post('push', [SyncAPIController::class, 'push']);

    Route::post('applog', function () {
        $err = request('error');
        if (is_string($err) and $err) {
            Errorlog::create(['date' => nnow(), 'data' => $err]);
        }
        // return gettype($err);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    //
});
