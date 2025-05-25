<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth','authorize:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
    return view('admin.dashboard');})->name('dashboard');
    Route::get('/userdata', [UserController::class, 'view'])->name('userdata.index');
     Route::get('/userdata/create', [UserController::class, 'create'])->name('userdata.create');
     Route::post('/userdata/store', [UserController::class, 'store'])->name('userdata.store');
      Route::get('/{id}/edit', [UserController::class, 'store'])->name('userdata.edit');
      Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/userdata/{id}', [UserController::class, 'update'])->name('userdata.update');
});
});

require __DIR__.'/auth.php';
