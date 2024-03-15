<?php

use App\Http\Controllers\Module\MedicineC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/obat', [MedicineC::class, 'index'])->name('obat');
    Route::get('/obat/create', [MedicineC::class, 'create'])->name('obat-create');
    Route::post('/obat/create', [MedicineC::class, 'createPost'])->name('obat-create-submit');
});