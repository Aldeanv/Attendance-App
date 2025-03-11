<?php

use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\UserController;
use App\Exports\UsersExport;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/participants', [ParticipantsController::class, 'index'])->name('participant.index');
    Route::get('/participants/create', [ParticipantsController::class, 'create'])->name('participant.create');
    Route::post('/participants/import', [ParticipantsController::class, 'import'])->name('participant.import');
    Route::delete('/participants/delete-all', [ParticipantsController::class, 'destroyAll'])->name('participant.destroyAll');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/store', [AttendanceController::class, 'store']);
    Route::get('/attendance/export', function () {
        return Excel::download(new AttendanceExport, 'Daftar_Kehadiran.xlsx');
    })->name('attendance.export');
    Route::delete('/attendance/destroy-all', [AttendanceController::class, 'destroyAll'])->name('attendance.destroyAll');

    Route::get('/event', [EventController::class, 'index'])->name('event.index');

    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/export', function () {
        return Excel::download(new UsersExport, 'users.xlsx');
    })->name('users.export');
});

require __DIR__.'/auth.php';
