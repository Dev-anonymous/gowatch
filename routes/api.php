<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DataAPIController;
use App\Http\Controllers\api\PhoneAPIController;
use App\Http\Controllers\api\RemoteControlAPIController;
use App\Http\Controllers\api\SyncAPIController;
use App\Http\Controllers\PAYController;
use App\Models\Errorlog;
use Illuminate\Support\Facades\Route;

#==========   USER AUTH  =======#
Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () {
    Route::post('sync', [SyncAPIController::class, 'sync']);

    Route::post('applog', function () {
        $err = request('error');
        if (is_string($err) and $err) {
            Errorlog::create(['date' => nnow(), 'data' => $err]);
        }
        // return gettype($err);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('phone', PhoneAPIController::class)->only(['index', 'update']);
    Route::resource('/remotecontol', RemoteControlAPIController::class)->only(['index', 'store']);
    Route::get('phone-apps', [DataAPIController::class, 'phoneapps'])->name('phoneapps');
    Route::post('sub-info', [DataAPIController::class, 'subinfo'])->name('subinfo');
    Route::get('sub-capability', [DataAPIController::class, 'subcapability'])->name('subcapability');

    Route::post('/pay/init', [PAYController::class, 'init_payment'])->name('api.init.pay');
    Route::get('/pay/check', [PAYController::class, 'check_payment'])->name('api.check.pay');
});
