<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;

Route::controller(UsersController::class)
    ->middleware('auth')
    ->name('users.')
    ->prefix('users')
    ->group(function () {
        Route::get('/', 'index')->middleware(['permission:users.index'])->name('index');

        Route::middleware(['permission:users.create'])->group(function () {
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
        });

        Route::middleware(['permission:users.edit'])->group(function () {
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::patch('/{id}', 'update')->name('update');
        });

        Route::delete('/{id}', 'destroy')->middleware(['permission:users.destroy'])->name('destroy');
    });
