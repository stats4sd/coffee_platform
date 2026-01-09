<?php

use App\Http\Controllers\Backpack;
use Illuminate\Support\Facades\Route;

// Overwrites the default backpack\Base routes file to add the custom locale handling:

// Route::prefix('{locale?}')->middleware(['check.locale', 'set.locale'])->group(function () {

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(array_merge(
    (array) config('backpack.base.web_middleware', 'web'),
    ['set.locale'],
))->group(
    function () {
        // if not otherwise configured, setup the auth routes
        if (config('backpack.base.setup_auth_routes')) {
            // Authentication Routes...
            Route::get('login', [Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('backpack.auth.login');
            Route::post('login', [Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, 'login']);
            Route::get('logout', [Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, 'logout'])->name('backpack.auth.logout');
            Route::post('logout', [Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, 'logout']);

            // Registration Routes...
            Route::get('register', [Backpack\CRUD\app\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register');
            Route::post('register', [Backpack\CRUD\app\Http\Controllers\Auth\RegisterController::class, 'register']);

            // if not otherwise configured, setup the password recovery routes
            if (config('backpack.base.setup_password_recovery_routes', true)) {
                Route::get('password/reset', [Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('backpack.auth.password.reset');
                Route::post('password/reset', [Backpack\CRUD\app\Http\Controllers\Auth\ResetPasswordController::class, 'reset']);
                Route::get('password/reset/{token}', [Backpack\CRUD\app\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('backpack.auth.password.reset.token');
                Route::post('password/email', [Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('backpack.auth.password.email');
            }
        }

        // if not otherwise configured, setup the dashboard routes
        if (config('backpack.base.setup_dashboard_routes')) {
            Route::get('dashboard', [Backpack\CRUD\app\Http\Controllers\AdminController::class, 'dashboard'])->name('backpack.dashboard');
            Route::get('/', [Backpack\CRUD\app\Http\Controllers\AdminController::class, 'redirect'])->name('backpack');
        }

        // if not otherwise configured, setup the "my account" routes
        if (config('backpack.base.setup_my_account_routes')) {
            Route::get('edit-account-info', [Backpack\CRUD\app\Http\Controllers\MyAccountController::class, 'getAccountInfoForm'])->name('backpack.account.info');
            Route::post('edit-account-info', [Backpack\CRUD\app\Http\Controllers\MyAccountController::class, 'postAccountInfoForm'])->name('backpack.account.info.store');
            Route::post('change-password', [Backpack\CRUD\app\Http\Controllers\MyAccountController::class, 'postChangePasswordForm'])->name('backpack.account.password');
        }
    });
// });
