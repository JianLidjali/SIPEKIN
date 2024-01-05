<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilPenilaianController;
use App\Http\Controllers\PerformanceAppraisalController;
use App\Http\Controllers\ProfileController;
use App\Models\PerformanceAppraisal;
use Illuminate\Support\Facades\Log;

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
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );
    if ($status === Password::RESET_LINK_SENT) {
        Log::info('Password reset link sent to: ' . $request->email);
        return redirect()->back()->with(['success', 'Password reset link sent to: ' . $request->email]);
    } else {
        Log::error('Password reset link not sent. Error: ' . $status);
        return back()->withErrors(['email' => __($status)]);
    }
})->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('pages.auth.reset-password', ['token' => $token]);
})->name('password.reset');


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

    if ($status === Password::PASSWORD_RESET) {
        Log::info('Password reset successful for email: ' . $request->email);
        return redirect()->route('login')->with('status', 'Your password has been reset.');
    } else {
        Log::error('Password reset failed. Error: ' . $status);
        return back()->withErrors(['email' => [__($status)]]);
    }
})->name('password.update');


Route::middleware('web', 'auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/employee', EmployeeController::class)->names('employee')->except(['show']);
    Route::get('/employee/export', [EmployeeController::class, 'export'])->name('employee.export');

    Route::get('/appraisal/{id}', [PerformanceAppraisalController::class, 'show'])->name('appraisal.show');

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

    route::resource('/user', userController::class)->names('user');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    // routes/web.php
    Route::post('/dashboard/{id}/hod', [DashboardController::class, 'approveHod'])->name('hod.approve');
    Route::post('/dashboard/{id}/hrd', [DashboardController::class, 'approveHrd'])->name('hrd.approve');
    Route::post('/dashboard/{id}/gm', [DashboardController::class, 'approveGM'])->name('gm.approve');
    Route::post('/dashboard/{id}/reject', [DashboardController::class, 'reject'])->name('reject');

    Route::get('/hasilPenilaian', [HasilPenilaianController::class, 'index']);
    Route::post('/cetak/{id}', [HasilPenilaianController::class, 'cetak'])->name('appraisal.print');
});
