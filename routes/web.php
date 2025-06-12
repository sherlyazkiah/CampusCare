<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\classroomController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;

// === LANDING PAGE ===
Route::get('/', function () {
        return view('auth.LandingPage');
    });

// === AUTH ===
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// === ADMIN ROUTES ===
Route::middleware(['auth', 'authorize:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    //Route::get('/dashboard', function () {
        //return view('admin.dashboard');
    //})->name('admin.dashboard');
     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');
    // === USER ===
    Route::get('/userdata', [AdminController::class, 'view'])->name('userdata.index');
    Route::get('/userdata/create', [AdminController::class, 'create'])->name('userdata.create');
    Route::post('/userdata', [AdminController::class, 'store'])->name('userdata.store');
    Route::get('/userdata/{id}/edit', [AdminController::class, 'edit'])->name('userdata.edit');
    Route::put('/userdata/{id}', [AdminController::class, 'update'])->name('userdata.update');
    Route::delete('/userdata/{id}', [AdminController::class, 'destroy'])->name('userdata.destroy');
    Route::get('/userdata/{id}', [AdminController::class, 'show'])->name('userdata.show'); // <-- detail user
    Route::get('/floorroomdata', [RoomController::class, 'index'])->name('floorroomdata.index');
    //Route::put('/profile/update', [AdminController::class, 'update_profile'])->name('profile.update');
    Route::put('/profile/update', [AdminController::class, 'update_profile'])->name('profile.update')->middleware('auth');
    Route::get('admin/profile', function () {
              return view('admin.Profile');
      });
      Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password.update');

    //Admin Biodata  
    Route::get('/biodata', [AdminController::class, 'biodata'])->name('biodata.edit')->middleware('auth');
    Route::post('/biodata/store', [AdminController::class, 'storebiodata'])->name('biodata.store')->middleware('auth');
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
    //Route::patch('/damage-report/{id}/criteria', [ReportController::class, 'updateCriteria'])->name('damage-report.updateCriteria');

    //Route::get('/calculation-step', function () {
        //return view('admin.CalculationStep');
    //});
    //Route::get('/repair-recommendation', [ReportController::class, 'storeAndCalculateVikor'])->name('damage-report.updateCriteria');
   Route::get('/repair-recommendation', [ReportController::class, 'showRepairRecommendation'])->name('repair-recommendation');
   Route::get('/damage-reports', [ReportController::class, 'index'])->name('damage-reports.index');
    Route::patch('/damage-report/{id}/criteria-calculate', [ReportController::class, 'storeAndCalculateVikor'])->name('damage-report.storeAndCalculateVikor');
    Route::post('/assign-technician', [DamageReportController::class, 'assignTechnician'])->name('assign.technician');

  
    
});

Route::middleware(['auth', 'authorize:lecture,student'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'view'])->name('user.dashboard');

    //profile
    
    
    //Student Biodata
    Route::get('/biodata', [UserController::class, 'StudentBiodata'])->name('student.biodata.edit')->middleware('auth');
    Route::post('/biodata/store', [UserController::class, 'StudentStorebiodata'])->name('student.biodata.store')->middleware('auth');
    
    //Lecture Biodata
    Route::get('/biodata/lecture', [UserController::class, 'LectureBiodata'])->name('lecture.biodata.edit')->middleware('auth');
    Route::post('/biodata/lecture/store', [UserController::class, 'LectureStorebiodata'])->name('lecture.biodata.store')->middleware('auth');
    
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.profile.password.update');
    Route::get('/profile', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('user.profile.update');

    Route::get('/reports', [ReportController::class, 'userReports'])->name('user.reports');

    Route::get('/report', function () {
        return view('user.Report');
    });

    //Route::get('/rooms-by-floor/{floor_id}', [ReportController::class, 'getRoomsByFloor']);
    //Route::get('/get-rooms/{floor_id}', [App\Http\Controllers\ReportController::class, 'getRooms']);


    Route::get('/create-report', [ReportController::class, 'create']);
    Route::get('/rooms-by-floor/{floor_id}', [ReportController::class, 'getRoomsByFloor'])->name('rooms.by.floor');
    
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

Route::post('/user/submit-feedback', [ReportController::class, 'storeFeedback'])->name('user.feedback.submit');


    
});


Route::middleware(['auth'])->prefix('technician')->group(function () {

    //Route::get('/dashboard', function () {
    //  return view('technician.dashboard');
    //})->name('technician.dashboard');
    Route::get('/dashboard', [TaskController::class, 'indexdashboard'])->name('technician.dashboard');
    Route::get('/task', [TaskController::class, 'index'])->name('technician.task');
    Route::get('/history', [TaskController::class, 'history'])->name('technician.history');
    Route::post('/technician/tasks/{id}/mark-in-progress', [TaskController::class, 'markInProgress'])->name('technician.tasks.markInProgress');
    Route::post('/technician/tasks/{id}/mark-completed', [TaskController::class, 'markCompleted'])->name('technician.tasks.markCompleted');
});

    