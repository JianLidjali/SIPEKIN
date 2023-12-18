<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilPenilaianController;
use App\Http\Controllers\PerformanceAppraisalController;
use App\Models\User;

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
// web.php

Route::get('/forgot-password', function () {
    return view('pages.auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::middleware('web', 'auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/employee', EmployeeController::class)->names('employee')->except(['show']);
    Route::get('/employee/export', [EmployeeController::class, 'export'])->name('employee.export');

    Route::get('/performance-appraisal/annual', [PerformanceAppraisalController::class, 'index'])->name('performance-appraisal.index');
    Route::get('/performance-appraisal/form/{employee}', [PerformanceAppraisalController::class, 'form'])->name('annual.form');
    Route::post('/performance-appraisal/store/{employee}', [PerformanceAppraisalController::class, 'store'])->name('performance-appraisal.store');
    Route::post('/performance-appraisal/storeEmployee/{employee}', [PerformanceAppraisalController::class, 'update'])->name('performance-appraisal.update');

    Route::get('/performance-appraisal/probation', [PerformanceAppraisalController::class, 'masaPercobaan'])->name('performance-appraisal.masaPercobaan');
    Route::get('/performance-appraisal/formProbation/{employee}', [PerformanceAppraisalController::class, 'formProbation'])->name('performance-appraisal-probation.form');
    Route::post('/performance-appraisal/storeProbation/{employee}', [PerformanceAppraisalController::class, 'storeProbation'])->name('probation.store');
    Route::post('/performance-appraisal/storeEmployeeProbation/{employee}', [PerformanceAppraisalController::class, 'updateProbation'])->name('probation.update');

    Route::get('/performance-appraisal/recommendation', [PerformanceAppraisalController::class, 'rekomendasi'])->name('performance-appraisal.rekomendasi');
    Route::get('/performance-appraisal/formRecommendation/{employee}', [PerformanceAppraisalController::class, 'formRecommendation'])->name('performance-appraisal-recommendation.form');
    Route::post('/performance-appraisal/storeRecommendation/{employee}', [PerformanceAppraisalController::class, 'storeRecommendation'])->name('recommendation.store');
    Route::post('/performance-appraisal/storeEmployeeRecommendation/{employee}', [PerformanceAppraisalController::class, 'updateRecommendation'])->name('recommendation.update');


    // routes/web.php
    Route::post('/dashboard/{id}/hod', [DashboardController::class, 'approveHod'])->name('hod.approve');
    Route::post('/dashboard/{id}/hrd', [DashboardController::class, 'approveHrd'])->name('hrd.approve');
    Route::post('/dashboard/{id}/gm', [DashboardController::class, 'approveGM'])->name('gm.approve');
    Route::post('/dashboard/{id}/reject', [DashboardController::class, 'reject'])->name('reject');

    Route::get('/hasilPenilaian', [HasilPenilaianController::class, 'index']);
    Route::post('/cetak/{id}', [HasilPenilaianController::class, 'cetak'])->name('appraisal.print');
});
