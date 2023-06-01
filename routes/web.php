<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::resource('/classEducation', App\Http\Controllers\ClassEducationController::class);
    Route::resource('/schedule', App\Http\Controllers\ScheduleController::class);
    Route::get('/generate/qr/{id}/{user_id}', [App\Http\Controllers\ScheduleController::class, 'qr'])->name('generate.qr');
    Route::get('/scan/qr', [App\Http\Controllers\ScheduleController::class, 'scanqr'])->name('scan.qr');
    Route::post('/check/qr', [App\Http\Controllers\ScheduleController::class, 'checkqr'])->name('check.qr');
    Route::get('/attendance/{id}', [App\Http\Controllers\AttendancesController::class, 'index'])->name('attendance.index');
});