<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DataAPIController;
use App\Http\Controllers\api\FeedbackAPIController;
use App\Http\Controllers\api\PhoneAPIController;
use App\Http\Controllers\api\RemoteControlAPIController;
use App\Http\Controllers\api\SyncAPIController;
use App\Http\Controllers\PAYController;
use App\Models\Errorlog;
use Illuminate\Support\Facades\Route;

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
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('phone', PhoneAPIController::class)->only(['index', 'update']);
    Route::resource('/remotecontol', RemoteControlAPIController::class)->only(['index', 'store']);
    Route::get('phone-apps', [DataAPIController::class, 'phoneapps'])->name('phoneapps');
    Route::post('sub-info', [DataAPIController::class, 'subinfo'])->name('subinfo');
    Route::get('applog', [DataAPIController::class, 'applog'])->name('applog');
    Route::get('sub-capability', [DataAPIController::class, 'subcapability'])->name('subcapability');

    Route::post('/pay/init', [PAYController::class, 'init_payment'])->name('api.init.pay');
    Route::get('/pay/check', [PAYController::class, 'check_payment'])->name('api.check.pay');

    Route::get('feedback', [FeedbackAPIController::class, 'index'])->name('feedback.index');
});

Route::post('feedback', [FeedbackAPIController::class, 'store'])->name('feedback.store');

Route::get('test-odoo', function () {
    $tmp = [];
    $faker = Faker\Factory::create();
    foreach (range(1, 20) as $k => $el) {
        $tmp[] = (object) [
            'id' => $k + 1,
            'name' => $faker->name(),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
        ];
    }
    return $tmp;
});
