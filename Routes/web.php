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

    Route::resource('notifications', NotificationController::class);
});
