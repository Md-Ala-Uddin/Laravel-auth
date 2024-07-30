<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::middleware('admin.guest')->group(function () {
            Route::get('/login', [LoginController::class, 'show'])->name('login');
            Route::post('/login', [LoginController::class, 'store']);
        });

        Route::middleware('admin')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
            Route::get('/settings', [SettingsController::class, 'show'])->name('settings');

            Route::get('/users', [UserController::class, 'show'])->name('users.index');
            Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.destroy');
        });
    });
