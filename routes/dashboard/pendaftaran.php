<?php

use App\Http\Controllers\Module\RegistrationC;
use App\Http\Controllers\VisitorC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/pendaftaran', [RegistrationC::class, 'index'])->name('pendaftaran');
        
        Route::get('/pendaftaran/create/{patientId}', [RegistrationC::class, 'create'])->name('pendaftaran-create');
        Route::post('/pendaftaran/create', [RegistrationC::class, 'createPost'])->name('pendaftaran-create-submit');

        Route::get('/pendaftaran/submit/{id}', [RegistrationC::class, 'itemSubmit'])->name('pendaftaran-item-submit');
        // Route::get('/pendaftaran/detail/{id}', [RegistrationC::class, 'detail'])->name('pendaftaran-detail');
       
        // Route::post('/pendaftaran/{id}', [RegistrationC::class, 'editPut'])->name('pendaftaran-edit-submit');
        // Route::get('/pendaftaran/delete/{id}', [RegistrationC::class, 'delete'])->name('pendaftaran-delete');
});