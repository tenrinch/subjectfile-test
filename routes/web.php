<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\AuditLogController;

use App\Http\Controllers\Staff\FileController;
use App\Http\Controllers\Staff\IncomingController;
use App\Http\Controllers\Staff\OutgoingController;
use App\Http\Controllers\Staff\CategoryController;
use App\Http\Controllers\Staff\SenderDestinationController;

use App\Http\Controllers\Coordinator\StaffController;

use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'login');

Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Audit Logs
Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']])->middleware('auth');;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    //Departments
    Route::resource('departments', DepartmentController::class, ['except' => ['store', 'update', 'destroy', 'show']]);
});

Route::group(['prefix' => 'staff', 'as' => 'staff.', 'middleware' => ['auth', 'staff']], function () {

    //Files
    Route::resource('files', FileController::class, ['except' => ['store', 'update', 'destroy']]);

    //Incoming
    Route::resource('incomings', IncomingController::class, ['except' => ['store', 'update', 'destroy']]);

    //Outgoing
    Route::resource('outgoings', OutgoingController::class, ['except' => ['store', 'update', 'destroy']]);

    //Category
    Route::resource('categories', CategoryController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    //SenderDestination
    Route::resource('sender-destinations', SenderDestinationController::class, ['except' => ['store', 'update', 'destroy', 'show']]);
});

Route::group(['prefix' => 'coordinator', 'as' => 'coordinator.', 'middleware' => ['auth', 'coordinator']], function () {

    //Staff
    Route::resource('staff', StaffController::class, ['except' => ['store', 'update', 'destroy', 'show']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
