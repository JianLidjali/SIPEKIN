<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
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
    return redirect()->route('dashboard.index');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('web', 'auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/karyawan', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/karyawan/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/karyawan', [EmployeeController::class, 'store'])->name('employee.store');
});
//Route::resource('/karyawan', EmployeeController::class)->names('employee');
