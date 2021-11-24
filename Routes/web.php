<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\Admin\Http\Controllers\Auth\ConfirmablePasswordController;
use Modules\Admin\Http\Controllers\Auth\EmailVerificationNotificationController;
use Modules\Admin\Http\Controllers\Auth\EmailVerificationPromptController;
use Modules\Admin\Http\Controllers\Auth\NewPasswordController;
use Modules\Admin\Http\Controllers\Auth\PasswordResetLinkController;
use Modules\Admin\Http\Controllers\Auth\RegisteredUserController;
use Modules\Admin\Http\Controllers\Auth\VerifyEmailController;
use Modules\Admin\Http\Controllers\Common\ModelEnabledController;
use Modules\Admin\Http\Controllers\Common\ModelRestoreController;
use Modules\Admin\Http\Controllers\Common\ModelSoftDeleteController;
use Modules\Admin\Http\Controllers\Rbac\PermissionController;
use Modules\Admin\Http\Controllers\Rbac\RoleController;
use Modules\Admin\Http\Controllers\Rbac\UserController;

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

/**
 * Authentication Route
 */
Route::prefix(config('auth.admin_auth_prefix'))
    ->name('admin.')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->middleware('guest')
            ->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware('guest')
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('guest')
            ->name('password.update');

        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware('auth')
            ->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');

        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->middleware('auth')
            ->name('password.confirm');

        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
            ->middleware('auth');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');
    });

Route::view('/privacy-terms', 'admin::terms')->name('admin.terms');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index']);

    //Common Operations
    Route::prefix('common')->name('common.')->group(function () {
        Route::get('delete/{route}/{id}', ModelSoftDeleteController::class)->name('delete');
        Route::get('restore/{route}/{id}', ModelRestoreController::class)->name('restore');
        Route::get('enabled', ModelEnabledController::class)->name('enabled');
    });

    Route::resource('permissions', PermissionController::class)->where(['permission' => '([0-9]+)']);
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::patch('{permission}/restore', [PermissionController::class, 'restore'])->name('restore');
        Route::get('/export', [PermissionController::class, 'export'])->name('export');
        Route::get('/import', [PermissionController::class, 'import'])->name('import');
        Route::post('/import', [PermissionController::class, 'importBulk']);
        Route::post('/print', [PermissionController::class, 'print'])->name('print');
    });

    Route::resource('roles', RoleController::class)->where(['role' => '([0-9]+)']);
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::post('export', [RoleController::class, 'export'])->name('export');
        Route::get('import', [RoleController::class, 'import'])->name('import');
        Route::post('import', [RoleController::class, 'importBulk']);
        Route::post('print', [RoleController::class, 'print'])->name('print');
    });

    Route::resource('users', UserController::class)->where(['user' => '([0-9]+)']);
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('export', [UserController::class, 'export'])->name('export');
        Route::get('import', [UserController::class, 'import'])->name('import');
        Route::post('import', [UserController::class, 'importBulk']);
        Route::post('print', [UserController::class, 'print'])->name('print');
    });
});
