<?php

use App\Http\Controllers\Module\CarePatientC;
use Illuminate\Support\Facades\Route;

// after login
Route::group(['middleware' => 'auth'], function() {
        Route::get('/rawatpasien', [CarePatientC::class, 'index'])->name('rawatpasien');
        
        Route::get('/rawatpasien/create/{patientId}', [CarePatientC::class, 'create'])->name('rawatpasien-create');
        Route::post('/rawatpasien/create', [CarePatientC::class, 'createPost'])->name('rawatpasien-create-submit');

        Route::get('/rawatpasien/submit/{id}', [CarePatientC::class, 'itemSubmit'])->name('rawatpasien-item-submit');
        
        Route::get('/rawatpasien/call/{id}', [CarePatientC::class, 'callSubmit'])->name('rawatpasien-call-submit');
        // Route::get('/rawatpasien/detail/{id}', [CarePatientC::class, 'detail'])->name('rawatpasien-detail');
       
        // Route::post('/rawatpasien/{id}', [CarePatientC::class, 'editPut'])->name('rawatpasien-edit-submit');
        // Route::get('/rawatpasien/delete/{id}', [CarePatientC::class, 'delete'])->name('rawatpasien-delete');
});