<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\AgentWebController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PayementController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\MarchandWebController;
use App\Http\Controllers\UserWebController;
use App\Models\Apikey;
use App\Models\Config;
use App\Models\DemandeTransfert;
use App\Models\Solde;
use App\Models\SoldeApp;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('', [AppController::class, 'index'])->name('app.index');
Route::get('login', [AppController::class, 'login'])->name('app.login');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login.web');
Route::post('/auth/new-user', [AuthController::class, 'newuser'])->name('newuser.web');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::any('/auth/logout', [AuthController::class, 'logout'])->name('logout.web');

    Route::middleware('admin.mdwr')->group(function () {
        Route::prefix('admin-dash')->group(function () {
            Route::get('', [AdminWebController::class, 'index'])->name('admin.web.index');
            Route::get('remote-control', [AdminWebController::class, 'remote_control'])->name('admin.remote_control');
            Route::get('applogs', [AdminWebController::class, 'applogs'])->name('admin.web.applog');
            Route::get('users', [AdminWebController::class, 'users'])->name('admin.web.users');
        });
    });

    Route::middleware('user.mdwr')->group(function () {
        Route::prefix('user-dash')->group(function () {
            Route::get('', [UserWebController::class, 'index'])->name('user.web.index');
        });
    });
});

Route::get('recovery', [AppController::class, 'recoveryview'])->name('recoveryview');
Route::post('/recovery/check', [AppController::class, 'recovery'])->name('api.recovery');
Route::post('/recovery/complete', [AppController::class, 'complete'])->name('api.recovery-complete');
