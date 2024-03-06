<?php

use App\Http\Controllers\Module\ActionC;
use App\Http\Controllers\Module\PatientRegisteredC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::prefix('datamaster')->group(function () {
        Route::get('/pendaftaranpasien', [PatientRegisteredC::class, 'index'])->name('pendaftaranpasien');
        Route::get('/pendaftaranpasien/create', [PatientRegisteredC::class, 'create'])->name('pendaftaranpasien-create');
        Route::post('/pendaftaranpasien/create', [PatientRegisteredC::class, 'createPost'])->name('pendaftaranpasien-create-submit');
        Route::get('/pendaftaranpasien/delete/{id}', [PatientRegisteredC::class, 'delete'])->name('pendaftaranpasien-delete');
        // Route::get('/pendaftaranpasien/edit/{id}', [PatientRegisteredC::class, 'edit'])->name('pendaftaranpasien-edit');
        // Route::post('/pendaftaranpasien/edit/{id}/submit', [PatientRegisteredC::class, 'editPut'])->name('pendaftaranpasien-edit-submit');
    });
});