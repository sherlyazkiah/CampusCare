<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\TechnicianController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('user.reports.index');
    Route::post('/reports', [ReportController::class, 'store'])->name('user.reports.store');

    // Logout (logout pakai POST, tapi kalau kamu pakai GET, bisa gini)
    //Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::prefix('technician')->group(function () {
    Route::get('/', [TechnicianController::class, 'index'])->name('technician');
    // Dashboard
    Route::get('/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');


    // Logout (logout pakai POST, tapi kalau kamu pakai GET, bisa gini)
    //Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
