<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InboxController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Reports
    // Route::get('/reports', [ReportController::class, 'index'])->name('user.reports.index');
    // Route::post('/reports', [ReportController::class, 'list'])->name('user.reports.list');

    // Inbox
    //Route::get('/inbox', [InboxController::class, 'index'])->name('user.inbox');

    // Logout (logout pakai POST, tapi kalau kamu pakai GET, bisa gini)
    //Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});
