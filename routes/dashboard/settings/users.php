<?php

use App\Http\Controllers\Module\UserC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('settings')->group(function () {
        Route::get('/users', [UserC::class, 'index'])->name('users');
        Route::get('/users/create', [UserC::class, 'create'])->name('users-create');
        Route::post('/users/create', [UserC::class, 'createPost'])->name('users-create');
        Route::get('/users/{id}', [UserC::class, 'edit'])->name('users-edit');
        Route::post('/users/{id}', [UserC::class, 'editPut'])->name('users-edit-submit');
        Route::get('/users/delete/{id}', [UserC::class, 'delete'])->name('users-delete');
    });
});