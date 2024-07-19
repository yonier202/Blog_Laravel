<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;

    Route::get('/', function () {
        return view('admin.dashboard');
    })
        ->name('dashboard')
        ->middleware(['can:Acceso al dashboard']);

    Route::resource('/categories', CategoryController::class)
        ->names('categories')
        ->middleware(['can:Gestión de categorías'])
        ->except('show'); //excepto crear metodo show

    Route::resource('/posts', PostController::class)
        ->names('posts')
        ->middleware(['can:Gestión de artículos'])
        ->except('show'); //excepto crear metodo show
    
    Route::resource('/roles', RoleController::class)
        ->middleware(['can:Gestión de roles'])
        ->except('show'); //excepto crear metodo show

    Route::resource('/permissions', PermissionController::class)
        ->middleware(['can:Gestión de permisos'])
        ->except('show'); //excepto crear metodo show

    Route::resource('/users', UserController::class)
        ->middleware(['can:Gestión de usuarios'])
        ->except('show', 'create', 'store'); 