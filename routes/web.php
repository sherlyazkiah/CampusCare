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
    // Dashboard
    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('user.reports.index');
    Route::post('/reports', [ReportController::class, 'store'])->name('user.reports.store');

    // Logout (logout pakai POST, tapi kalau kamu pakai GET, bisa gini)
    //Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::prefix('technician')->group(function () {
    Route::view('/', 'technician.dashboard')->name('technician.dashboard');
    Route::view('/tasks', 'technician.tasks')->name('technician.tasks');
    Route::view('/history', 'technician.history')->name('technician.history');
});


Route::get('/about', function () {
    return view('about');
})->name('about');
