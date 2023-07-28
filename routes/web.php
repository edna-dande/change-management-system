<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class,'showUser'])->name('admin.users');
    Route::get('/users/show/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::get('/users', [AdminController::class,'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class,'storeUser'])->name('admin.users.store');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class,'destroyUser'])->name('admin.users.destroy');

// Systems CRUD
    Route::get('/systems', [AdminController::class,'showSystems'])->name('systems');
    Route::get('/systems/{system}', [AdminController::class,'editSystem'])->name('systems.edit');
    Route::post('/systems', [AdminController::class,'storeSystem'])->name('systems.store');
    Route::put('/systems/{system}', [AdminController::class,'updateSystem'])->name('systems.update');
    Route::delete('/systems/{system}', [AdminController::class,'destroySystem'])->name('systems.destroy');

// Roles CRUD
    Route::get('/roles', [AdminController::class,'showRoles'])->name('roles');
    Route::get('/roles/{role}', [AdminController::class,'editRole'])->name('roles.edit');
    Route::post('/roles', [AdminController::class,'storeRole'])->name('roles.store');
    Route::put('/roles/{role}', [AdminController::class,'updateRole'])->name('roles.update');
    Route::delete('/roles/{role}', [AdminController::class,'destroyRole'])->name('roles.destroy');
});

require __DIR__.'/auth.php';
