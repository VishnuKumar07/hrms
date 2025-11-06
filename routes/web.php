<?php

use App\Http\Controllers\BloodgroupController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\WorktypeController;
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

    Route::post('/user-changepassword', [ChangePasswordController::class, 'changepassword'])->name('user.changepassword');

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

    Route::get('/designations', [DesignationController::class, 'index'])->name('designations');
    Route::get('/get-designation', [DesignationController::class, 'getDesignation'])->name('get.designation');
    Route::post('/create-designation', [DesignationController::class, 'createDesignation'])->name('create.designation');
    Route::post('/view-designation', [DesignationController::class, 'viewDesignation'])->name('view.designation');
    Route::post('/edit-designation', [DesignationController::class, 'editDesignation'])->name('edit.designation');
    Route::delete('/delete-designation', [DesignationController::class, 'deleteDesignation'])->name('delete.designation');

    Route::get('/worktypes', [WorktypeController::class, 'index'])->name('worktypes');
    Route::get('/get-worktype', [WorktypeController::class, 'getWorktype'])->name('get.worktype');
    Route::post('/create-worktype', [WorktypeController::class, 'createWorktype'])->name('create.worktype');
    Route::post('/view-worktype', [WorktypeController::class, 'viewWorktype'])->name('view.worktype');
    Route::post('/edit-worktype', [WorktypeController::class, 'editWorktype'])->name('edit.worktype');
    Route::delete('/delete-worktype', [WorktypeController::class, 'deleteWorktype'])->name('delete.worktype');

    Route::get('/states', [StateController::class, 'index'])->name('states');
    Route::get('/get-state', [StateController::class, 'getState'])->name('get.state');
    Route::post('/create-state', [StateController::class, 'createState'])->name('create.state');
    Route::post('/view-state', [StateController::class, 'viewState'])->name('view.state');
    Route::post('/edit-state', [StateController::class, 'editState'])->name('edit.state');
    Route::delete('/delete-state', [StateController::class, 'deleteState'])->name('delete.state');

    Route::get('/bloodgroups', [BloodgroupController::class, 'index'])->name('bloodgroups');
    Route::get('/get-bloodgroup', [BloodgroupController::class, 'getBloodgroup'])->name('get.bloodgroup');
    Route::post('/create-bloodgroup', [BloodgroupController::class, 'createBloodgroup'])->name('create.bloodgroup');
    Route::post('/view-bloodgroup', [BloodgroupController::class, 'viewBloodgroup'])->name('view.bloodgroup');
    Route::post('/edit-bloodgroup', [BloodgroupController::class, 'editBloodgroup'])->name('edit.bloodgroup');
    Route::delete('/delete-bloodgroup', [BloodgroupController::class, 'deleteBloodgroup'])->name('delete.bloodgroup');

    Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    Route::get('/get-country', [CountryController::class, 'getCountry'])->name('get.country');
    Route::post('/create-country', [CountryController::class, 'createCountry'])->name('create.country');
    Route::post('/view-country', [CountryController::class, 'viewCountry'])->name('view.country');
    Route::post('/edit-country', [CountryController::class, 'editCountry'])->name('edit.country');
    Route::delete('/delete-country', [CountryController::class, 'deleteCountry'])->name('delete.country');

});

require __DIR__.'/auth.php';
