<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {

        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/categories', CategoryController::class)
        ->names('categories')
        ->except('show'); //excepto crear metodo show