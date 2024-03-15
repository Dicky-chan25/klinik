<?php

use App\Http\Controllers\Module\CompoundingMedicineC;
use App\Http\Controllers\Module\MedicineC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('datamaster')->group(function () {
        Route::get('/obatracik', [CompoundingMedicineC::class, 'index'])->name('obatracik');
        Route::get('/obatracik/create', [CompoundingMedicineC::class, 'create'])->name('obatracik-create');
        Route::post('/obatracik/create', [CompoundingMedicineC::class, 'createPost'])->name('obatracik-create-submit');
    });
});