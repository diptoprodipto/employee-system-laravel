<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::post('/', [AuthenticatedSessionController::class, 'store']);

Route::get('/employee', [EmployeeController::class, 'index'])->middleware(['auth', 'prevent-back-history']);
Route::post('/employee', [EmployeeController::class, 'store'])->middleware(['auth', 'prevent-back-history']);
Route::get('/employee/{id}', [EmployeeController::class, 'edit'])->middleware(['auth', 'prevent-back-history'])->name('employee.edit');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->middleware(['auth', 'prevent-back-history'])->name('employee.delete');

Route::get('/attendance', [AttendanceController::class, 'index'])->middleware(['auth', 'prevent-back-history']);
Route::post('/attendance/save', [AttendanceController::class, 'store'])->middleware(['auth', 'prevent-back-history']);
Route::post('/attendance/saveall', [AttendanceController::class, 'store_all'])->middleware(['auth', 'prevent-back-history']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';