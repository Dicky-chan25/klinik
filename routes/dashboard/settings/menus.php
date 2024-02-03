<?php

use App\Http\Controllers\Module\MenuC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('settings')->group(function () {
        Route::get('/menus', [MenuC::class, 'index'])->name('menus');
        Route::get('/menus/create', [MenuC::class, 'create'])->name('menus-create');
        Route::get('/menus/{id}', [MenuC::class, 'edit'])->name('menu-edit');
        Route::get('/menus/detail/{id}', [MenuC::class, 'detail'])->name('menu-detail');
        Route::post('/menus/create', [MenuC::class, 'createPost'])->name('menus-create');
        Route::post('/menus/{id}', [MenuC::class, 'editPut'])->name('menus-edit-submit');
        Route::get('/menus/delete/{id}', [MenuC::class, 'delete'])->name('menus-delete');
    });
});