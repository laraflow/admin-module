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
use Modules\Admin\Http\Controllers\Common\NotificationController;
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


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index']);

    //Permission
    Route::resource('permissions', PermissionController::class)->where(['permission' => '([0-9]+)']);
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::patch('{permission}/restore', [PermissionController::class, 'restore'])->name('restore');
        Route::get('/export', [PermissionController::class, 'export'])->name('export');
        Route::get('/import', [PermissionController::class, 'import'])->name('import');
        Route::post('/import', [PermissionController::class, 'importBulk']);
        Route::post('/print', [PermissionController::class, 'print'])->name('print');
    });

    //Role
    Route::resource('roles', RoleController::class)->where(['role' => '([0-9]+)']);
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::patch('{role}/restore', [RoleController::class, 'restore'])->name('restore');
        Route::get('permission', [RoleController::class, 'permission'])->name('permission');
        Route::get('export', [RoleController::class, 'export'])->name('export');
        Route::get('import', [RoleController::class, 'import'])->name('import');
        Route::post('import', [RoleController::class, 'importBulk']);
        Route::post('print', [RoleController::class, 'print'])->name('print');
    });

    Route::resource('notifications', NotificationController::class);
});
