<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {return view('admin.dashboard');
});
    Route::get('/userdata', [UserController::class, 'view'])->name('userdata.index');
     Route::get('/userdata/create', [UserController::class, 'create'])->name('userdata.create');
     Route::post('/userdata', [UserController::class, 'store'])->name('userdata.store');

    Route::get('/floorroomdata', [FloorController::class, 'view'])->name('floorroomdata.index');
    Route::get('/facilitydata', [FacilityController::class, 'view'])->name('facilitydata.index');
     Route::get('/userdata/{id}/edit', [UserController::class, 'edit'])->name('userdata.edit');
     Route::put('/userdata/{id}', [UserController::class, 'update'])->name('userdata.update');
});

