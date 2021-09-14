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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Auth::routes();
Route::get('/error', [App\Http\Controllers\ErrorController::class, 'index'])->name('error');

/* Routes for Users Management by admin */
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::prefix('admin')->group(function () {
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'adminUsers'])->name('admin.users');
    Route::get('/user/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.user.show');
    Route::put('/user/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.user.update');
    Route::get('/user/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.user.delete');

    Route::get('/roles', [App\Http\Controllers\AdminController::class, 'adminRoles'])->name('admin.roles');
    Route::get('/role/{id}', [App\Http\Controllers\AdminController::class, 'roleEdit'])->name('admin.role.show');
    Route::put('/role/{id}', [App\Http\Controllers\AdminController::class, 'roleUpdate'])->name('admin.role.update');
});

/* Routes for Users Management by manager */
Route::get('/manager', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager');
Route::prefix('manager')->group(function () {
    Route::get('/users', [App\Http\Controllers\ManagerController::class, 'adminUsers'])->name('manager.users');
    Route::get('/user/create', [App\Http\Controllers\ManagerController::class, 'create'])->name('manager.user.create');
    Route::post('/user/store', [App\Http\Controllers\ManagerController::class, 'store'])->name('manager.user.store');
    Route::get('/user/{id}', [App\Http\Controllers\ManagerController::class, 'edit'])->name('manager.user.show');
    Route::put('/user/{id}', [App\Http\Controllers\ManagerController::class, 'update'])->name('manager.user.update');
});

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
