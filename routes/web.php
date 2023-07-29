<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\RoleController;
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
    Route::get('/admin/users', [AdminController::class,'dashboard'])->name('admin.users');
    Route::get('/users/show/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::get('/users', [AdminController::class,'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class,'storeUser'])->name('admin.users.store');
    Route::post('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class,'destroyUser'])->name('admin.users.destroy');

    Route::get('/systems', [SystemController::class,'index'])->name('systems');
    Route::get('/systems/show/{system}', [SystemController::class,'showSystem'])->name('systems.show');
    Route::get('/systems/{system}/edit', [SystemController::class,'editSystem'])->name('systems.edit');
    Route::get('/systems/create', [SystemController::class,'createSystem'])->name('systems.create');
    Route::post('/systems', [SystemController::class,'storeSystem'])->name('systems.store');
    Route::put('/systems/{system}/update', [SystemController::class,'updateSystem'])->name('systems.update');
    Route::delete('/systems/{system}', [SystemController::class,'destroySystem'])->name('systems.destroy');

    Route::get('/roles', [RoleController::class,'index'])->name('roles');
    Route::get('/roles/show/{role}', [RoleController::class,'showRole'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class,'editRole'])->name('roles.edit');
    Route::get('/roles/create', [RoleController::class,'createRole'])->name('roles.create');
    Route::post('/roles', [RoleController::class,'storeRole'])->name('roles.store');
    Route::put('/roles/{role}/update', [RoleController::class,'updateRole'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class,'destroyRole'])->name('roles.destroy');
});

//Route::middleware(['auth', 'user'])->group(function () {
//    Route::get('/requests', [UserController::class, 'index'])->name('user.dashboard');
//    Route::get('/requests/create', [UserController::class, 'createRequest'])->name('user.request.create');
//    Route::post('/requests', [UserController::class, 'storeRequest'])->name('user.request.store');
//    Route::get('/requests/show/{request}', [UserController::class, 'showRequest'])->name('user.request.show');
//    Route::put('/requests/{request}/update', [UserController::class, 'updateRequest'])->name('user.request.update');
//    Route::get('/requests/{request}/edit', [UserController::class, 'editRequest'])->name('user.request.edit');
//});

Route::get('/change_requests', [ChangeRequestController::class,'index'])->name('change_requests');
Route::get('/change_requests/create', [ChangeRequestController::class,'create'])->name('change_requests.create');
Route::post('/change_requests', [ChangeRequestController::class,'store'])->name('change_requests.store');
Route::post('/change_requests/show/{change_request}', [ChangeRequestController::class,'show'])->name('change_requests.show');
Route::get('/change_requests/{id}/edit', [ChangeRequestController::class,'edit'])->name('change_requests.edit');
Route::put('/change_requests/{id}', [ChangeRequestController::class,'update'])->name('change_requests.update');
Route::delete('/change_requests/{id}', [ChangeRequestController::class,'destroy'])->name('change_requests.destroy');


Route::post('/change_requests/{change_request}/comments', [CommentController::class, 'store'])->name('comments.store');



require __DIR__.'/auth.php';
