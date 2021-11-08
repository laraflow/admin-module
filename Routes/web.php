<?php

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


use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Rbac\PermissionController;
use Modules\Admin\Http\Controllers\Rbac\RoleController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
});
