<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/get-permission', [PermissionController::class, 'getPermission'])->name('get.permission');
    Route::post('/create-permission', [PermissionController::class, 'createPermission'])->name('create.permission');
    Route::post('/view-permission', [PermissionController::class, 'viewPermission'])->name('view.permission');
    Route::post('/edit-permission', [PermissionController::class, 'editPermission'])->name('edit.permission');
    Route::delete('/delete-permission', [PermissionController::class, 'deletePermission'])->name('delete.permission');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/get-project', [ProjectController::class, 'getProject'])->name('get.project');
    Route::post('/create-project', [ProjectController::class, 'createProject'])->name('create.project');
    Route::post('/view-project', [ProjectController::class, 'viewProject'])->name('view.project');
    Route::post('/edit-project', [ProjectController::class, 'editProject'])->name('edit.project');
    Route::delete('/delete-project', [ProjectController::class, 'deleteProject'])->name('delete.project');

});

require __DIR__.'/auth.php';
