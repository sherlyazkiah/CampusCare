<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ReportController;

// === AUTH ===
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// === ADMIN ROUTES ===
Route::middleware(['auth', 'authorize:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // === USER ===
    Route::get('/userdata', [AdminController::class, 'view'])->name('userdata.index');
    Route::get('/userdata/create', [AdminController::class, 'create'])->name('userdata.create');
    Route::post('/userdata', [AdminController::class, 'store'])->name('userdata.store');
    Route::get('/userdata/{id}/edit', [AdminController::class, 'edit'])->name('userdata.edit');
    Route::put('/userdata/{id}', [AdminController::class, 'update'])->name('userdata.update');
    Route::delete('/userdata/{id}', [AdminController::class, 'destroy'])->name('userdata.destroy');
    Route::get('/userdata/{id}', [AdminController::class, 'show'])->name('userdata.show'); // <-- detail user
    Route::get('/floorroomdata', [RoomController::class, 'index'])->name('floorroomdata.index');

    // === FLOOR CRUD ===
    Route::get('/floors/create', [FloorController::class, 'create'])->name('floors.create');
    Route::post('/floors', [FloorController::class, 'store'])->name('floors.store');
    Route::get('/floors/{floor}/edit', [FloorController::class, 'edit'])->name('floors.edit');
    Route::put('/floors/{floor}', [FloorController::class, 'update'])->name('floors.update');
    Route::delete('/floors/{floor}', [FloorController::class, 'destroy'])->name('floors.destroy');

    // === ROOM CRUD ===
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    // === FACILITY ===
    Route::get('/facilitydata', [FacilityController::class, 'view'])->name('facilitydata.index');
    Route::get('/facilitydata/create', [FacilityController::class, 'create'])->name('facilitydata.create');
    Route::post('/facilitydata', [FacilityController::class, 'store'])->name('facilitydata.store');
    Route::get('/facilitydata/{facility}/edit', [FacilityController::class, 'edit'])->name('facilitydata.edit');
    Route::put('/facilitydata/{facility}', [FacilityController::class, 'update'])->name('facilitydata.update');
    Route::delete('/facilitydata/{facility}', [FacilityController::class, 'destroy'])->name('facilitydata.destroy');

    Route::get('/facilitydata', [FacilityController::class, 'index'])->name('facilitydata.index');
    Route::resource('facilitydata', FacilityController::class);

    Route::resource('damagereport', ReportController::class);
  
    Route::get('/profile', function () {
              return view('admin.Profile');
      });
});

Route::middleware(['auth'])->prefix('user')->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/reports', [ReportController::class, 'userReports'])->name('user.reports');

    Route::get('/report', function () {
        return view('user.Report');
    });

    Route::get('/create-report', function () {
            return view('user.CreateReport');
    });

    
});
