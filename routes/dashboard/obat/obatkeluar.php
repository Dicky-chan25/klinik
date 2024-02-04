<?php

use App\Http\Controllers\Module\MedicineOutC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('obat')->group(function () {
        Route::get('/obatkeluar', [MedicineOutC::class, 'index'])->name('obatkeluar');
        // Route::get('/obatkeluar/create', [MedicineOutC::class, 'create'])->name('obatkeluar-create');
        // Route::post('/obatkeluar/create', [MedicineOutC::class, 'createPost'])->name('obatkeluar-create');
        // Route::get('/obatkeluar/edit/{id}', [MedicineOutC::class, 'edit'])->name('obatkeluar-edit');
        // Route::put('/obatkeluar/edit/{id}', [MedicineOutC::class, 'editPut'])->name('obatkeluar-edit');
        // Route::get('/obatkeluar/detail/{id}', [MedicineOutC::class, 'detail'])->name('obatkeluar-detail');
        // Route::get('/obatkeluar/delete/{id}', [MedicineOutC::class, 'delete'])->name('obatkeluar-delete');
    });
});