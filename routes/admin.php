<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::middleware('admin')->group(function() {
            Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
            Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
            Route::get('/users', [UserController::class, 'show'])->name('users');
        });
    });
