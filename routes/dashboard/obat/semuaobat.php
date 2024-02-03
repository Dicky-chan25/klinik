<?php

use App\Http\Controllers\Module\MedicineAllC;
use App\Http\Controllers\Module\ObatC;
use App\Http\Controllers\Module\UserlevelC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('obat')->group(function () {
        Route::get('/semuaobat', [MedicineAllC::class, 'index'])->name('semuaobat');
        Route::get('/semuaobat/create', [MedicineAllC::class, 'create'])->name('semuaobat-create');
        Route::post('/semuaobat/create', [MedicineAllC::class, 'createPost'])->name('semuaobat-create');

        // Route::get('/semuaobat/edit/{id}', [MedicineAllC::class, 'edit'])->name('semuaobat-edit');
        Route::post('/semuaobat/edit/{id}', [MedicineAllC::class, 'editPut'])->name('semuaobat-edit');

        Route::get('/semuaobat/detail/{id}', [MedicineAllC::class, 'detail'])->name('semuaobat-detail');
        Route::post('/semuaobat/detail/{id}/create', [MedicineAllC::class, 'detailPost'])->name('semuaobat-detail-create');
        Route::get('/semuaobat/delete/{id}', [MedicineAllC::class, 'delete'])->name('semuaobat-delete');
    });
});