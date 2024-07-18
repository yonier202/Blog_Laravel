<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;

    Route::get('/', function () {

        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/categories', CategoryController::class)
        ->names('categories')
        ->except('show'); //excepto crear metodo show

    Route::resource('/posts', PostController::class)
        ->names('posts')
        ->except('show'); //excepto crear metodo show
    
    Route::resource('/roles', RoleController::class)
        ->except('show'); //excepto crear metodo show

    Route::resource('/permissions', PermissionController::class)
    ->except('show'); //excepto crear metodo show

    Route::resource('/users', UserController::class)
        ->except('show', 'create', 'store'); 