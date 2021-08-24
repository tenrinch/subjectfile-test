<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IncomingController;
use App\Http\Controllers\Admin\OutgoingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SenderDestinationController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    //Incoming
    Route::view('incomings/show','admin.dashboard.incoming.show' )->name('show');
    Route::resource('incomings', IncomingController::class, ['except' => ['store', 'update', 'destroy']]);
    
    //Outgoing 
    Route::resource('outgoings', OutgoingController::class, ['except' => ['store', 'update', 'destroy']]);

    //Category
    Route::resource('categories', CategoryController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    //Departments
    Route::resource('departments', DepartmentController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    //Staff
    Route::resource('staff', StaffController::class, ['except' => ['store', 'update', 'destroy', 'show']]);

    //SenderDestination
    Route::resource('sender-destinations', SenderDestinationController::class, ['except' => ['store', 'update', 'destroy', 'show']]);
});


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
