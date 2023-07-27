<?php

use App\Http\Controllers\AdminController;
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
    return view('admin.index');
});

Route::middleware('admin')->group(function () {
Route::get('/admin/users', [AdminController::class,'showUsers'])->name('admin.users');
Route::get('/admin/users/{user}', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::post('/admin/users', [AdminController::class,'storeUser'])->name('admin.users.store');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class,'destroyUser'])->name('admin.users.destroy');

// Systems CRUD
Route::get('/admin/systems', [AdminController::class,'showSystems'])->name('admin.systems');
Route::get('/admin/systems/{system}', [AdminController::class,'editSystem'])->name('admin.systems.edit');
Route::post('/admin/systems', [AdminController::class,'storeSystem'])->name('admin.systems.store');
Route::put('/admin/systems/{system}', [AdminController::class,'updateSystem'])->name('admin.systems.update');
Route::delete('/admin/systems/{system}', [AdminController::class,'destroySystem'])->name('admin.systems.destroy');

// Roles CRUD
Route::get('/admin/roles', [AdminController::class,'showRoles'])->name('admin.roles');
Route::get('/admin/roles/{role}', [AdminController::class,'editRole'])->name('admin.roles.edit');
Route::post('/admin/roles', [AdminController::class,'storeRole'])->name('admin.roles.store');
Route::put('/admin/roles/{role}', [AdminController::class,'updateRole'])->name('admin.roles.update');
Route::delete('/admin/roles/{role}', [AdminController::class,'destroyRole'])->name('admin.roles.destroy');
});
