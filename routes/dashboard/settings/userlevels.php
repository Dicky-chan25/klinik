<?php

use App\Http\Controllers\Module\UserlevelC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('settings')->group(function () {
        Route::get('/userlevels', [UserlevelC::class, 'index'])->name('userlevels');
        Route::get('/userlevels/create', [UserlevelC::class, 'create'])->name('userlevels-create');
        Route::post('/userlevels/create', [UserlevelC::class, 'createPost'])->name('userlevels-create');
        Route::get('/userlevels/{id}', [UserlevelC::class, 'edit'])->name('userlevels-edit');
        Route::post('/userlevels/{id}', [UserlevelC::class, 'editPut'])->name('userlevels-edit-submit');
        Route::get('/userlevels/delete/{id}', [UserlevelC::class, 'delete'])->name('userlevels-delete');

        Route::get('/userlevels/detail/{id}', [UserlevelC::class, 'detail'])->name('userlevels-detail');
        Route::get('/userlevels/detail/{id}/{access}/{value}', [UserlevelC::class, 'updateAccess'])->name('userlevels-update-access');
    });
});