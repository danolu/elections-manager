<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    LoginController,
    RegisterController,
    ResetPasswordController,
    VerificationController
};

use App\Http\Controllers\{
    UserController,
    CategoryController,
    VoteController
};

use App\Models\Candidate;
use App\Models\Position as PositionModel;
use App\Models\User as UserModel;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

    // Register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'requestLink'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Public eligibility route
Route::any('/eligible-voters', [VoteController::class, 'voters'])->name('eligible.voters');

/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', [VerificationController::class, 'index'])
        ->name('verification.notice');

    Route::get('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/', 'pages.dashboard')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::view('/edit-profile', 'pages.profile.edit')->name('user.edit');
    Route::get('/verify/{email}/{id}', [UserController::class, 'verify'])->name('user.verify');
    Route::post('/verify/resend', [UserController::class, 'resendverify'])->name('resend.verify');

    Route::view('/change-password', 'pages.profile.change-password')->name('password.change');

    /*
    |--------------------------------------------------------------------------
    | Voting
    |--------------------------------------------------------------------------
    */
    Route::view('/vote', 'pages.vote.index')->name('vote');

    Route::get('/vote/{position}', function ($position) {
        return view('pages.vote.position', compact('position'));
    })->name('vote.position');

    /*
    |--------------------------------------------------------------------------
    | Admin Only Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // Analytics Dashboard
        Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics');

        // Results
        Route::view('/results', 'pages.vote.results')->name('results');

        Route::get('/results/{position}', function ($position) {
            return view('pages.vote.position-results', compact('position'));
        })->name('results.position');

        // Export Results
        Route::get('/export/results/excel', [\App\Http\Controllers\ResultsExportController::class, 'exportExcel'])->name('export.results.excel');
        Route::get('/export/results/pdf', [\App\Http\Controllers\ResultsExportController::class, 'exportPdf'])->name('export.results.pdf');
        Route::get('/export/results/{position}/excel', [\App\Http\Controllers\ResultsExportController::class, 'exportPositionExcel'])->name('export.position.excel');
        Route::get('/export/results/{position}/pdf', [\App\Http\Controllers\ResultsExportController::class, 'exportPositionPdf'])->name('export.position.pdf');

        // Candidates
        Route::prefix('candidates')->name('candidates.')->group(function () {

            Route::view('/', 'pages.candidates.index')->name('index');
            Route::view('/create', 'pages.candidates.form')->name('create');

            Route::get('/{candidate}/edit', function (Candidate $candidate) {
                return view('pages.candidates.form', compact('candidate'));
            })->name('edit');
        });

        // Positions
        Route::prefix('positions')->name('positions.')->group(function () {

            Route::view('/', 'pages.positions.index')->name('index');
            Route::view('/create', 'pages.positions.form')->name('create');

            Route::get('/{position}/edit', function (PositionModel $position) {
                return view('pages.positions.form', compact('position'));
            })->name('edit');
        });

        // Categories (Livewire Component)
        Route::view('/categories', 'pages.categories.index')->name('categories.index');

        // Settings
        Route::view('/settings', 'pages.settings.index')->name('settings.index');

        // Voters
        Route::prefix('voters')->name('voters.')->group(function () {

            Route::view('/', 'pages.voters.index')->name('index');
            Route::view('/create', 'pages.voters.form')->name('create');

            // Bulk import routes
            Route::get('/import', [UserController::class, 'showImport'])->name('import');
            Route::post('/import', [UserController::class, 'import'])->name('import.process');
            Route::get('/import/template', [UserController::class, 'downloadTemplate'])->name('import.template');

            // Pending approvals
            Route::get('/pending', [UserController::class, 'pending'])->name('pending');
            Route::post('/{user}/approve', [UserController::class, 'approve'])->name('approve');
            Route::post('/{user}/reject', [UserController::class, 'reject'])->name('reject');

            Route::get('/{user}', function (UserModel $user) {
                return view('pages.voters.show', compact('user'));
            })->name('show');

            Route::get('/{user}/edit', function (UserModel $user) {
                return view('pages.voters.form', compact('user'));
            })->name('edit');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});