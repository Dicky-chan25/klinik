<?php

use App\Http\Controllers\Module\MedicineAllC;
use App\Http\Controllers\Module\MedicineInC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('obat')->group(function () {
        Route::get('/obatmasuk', [MedicineAllC::class, 'index'])->name('obatmasuk');
        // Route::get('/obatmasuk/create', [MedicineInC::class, 'create'])->name('obatmasuk-create');
        // Route::post('/obatmasuk/create', [MedicineInC::class, 'createPost'])->name('obatmasuk-create');
        // Route::get('/obatmasuk/edit/{id}', [MedicineInC::class, 'edit'])->name('obatmasuk-edit');
        // Route::put('/obatmasuk/edit/{id}', [MedicineInC::class, 'editPut'])->name('obatmasuk-edit');
        // Route::get('/obatmasuk/detail/{id}', [MedicineInC::class, 'detail'])->name('obatmasuk-detail');
        // Route::get('/obatmasuk/delete/{id}', [MedicineInC::class, 'delete'])->name('obatmasuk-delete');
    });
});