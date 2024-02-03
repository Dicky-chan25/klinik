<?php

use App\Http\Controllers\MenuC;
use App\Http\Controllers\Module\MedicineAllC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('settings')->group(function () {
        Route::get('/dokter', [MedicineAllC::class, 'index'])->name('dokter');
        // Route::get('/dokter/create', [MenuC::class, 'create'])->name('dokter-create');
        // Route::get('/dokter/{id}', [MenuC::class, 'edit'])->name('menu-edit');
        // Route::get('/dokter/detail/{id}', [MenuC::class, 'detail'])->name('menu-detail');
        // Route::post('/dokter/create', [MenuC::class, 'createPost'])->name('dokter-create');
        // Route::post('/dokter/{id}', [MenuC::class, 'editPut'])->name('dokter-edit-submit');
        // Route::get('/dokter/delete/{id}', [MenuC::class, 'delete'])->name('dokter-delete');
    });
});