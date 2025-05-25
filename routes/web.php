<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;   





Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//Admin
Route::middleware(['auth', 'authorize:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User Data
    Route::get('/userdata', [UserController::class, 'view'])->name('userdata.index');
    Route::get('/userdata/create', [UserController::class, 'create'])->name('userdata.create');
    Route::post('/userdata', [UserController::class, 'store'])->name('userdata.store');
    Route::get('/userdata/{id}/edit', [UserController::class, 'edit'])->name('userdata.edit');
    Route::put('/userdata/{id}', [UserController::class, 'update'])->name('userdata.update');
    });

//User

    
    Route::get('/damagereport', function () {return view('admin.DamageReport');});
    Route::get('/repair-recommendation', function () {return view('admin.RepairRecommendation');});
    Route::get('/facility-data', function () {return view('admin.FacilityData');});
    Route::get('/floor-room-data', function () {return view('admin.FloorRoomData');});
});
