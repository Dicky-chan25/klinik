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

        Route::get('/rawatpasien/assesment/{id}/close', [CarePatientC::class, 'assesmentClose'])->name('rawatpasien-assesment-close');
        Route::get('/rawatpasien/assesment/{id}/{code}/{title}', [CarePatientC::class, 'assesmentIcd10Update'])->name('rawatpasien-assesment-icd10');
        Route::get('/rawatpasien/assesment/{id}', [CarePatientC::class, 'assesment'])->name('rawatpasien-assesment');
        Route::get('/rawatpasien/assesment/{id}/result', [CarePatientC::class, 'assesmentResult'])->name('rawatpasien-assesment-result');
        Route::post('/rawatpasien/assesment/{id}', [CarePatientC::class, 'assesmentPost'])->name('rawatpasien-assesment-submit');
        
        Route::get('/rawatpasien/onr/{id}', [CarePatientC::class, 'onr'])->name('rawatpasien-onr');
        Route::post('/rawatpasien/onr/{id}', [CarePatientC::class, 'onrPost'])->name('rawatpasien-onr-submit');
        
        Route::get('/rawatpasien/or/{id}', [CarePatientC::class, 'or'])->name('rawatpasien-or');
        Route::get('/rawatpasien/or/{id}/result', [CarePatientC::class, 'orResult'])->name('rawatpasien-or-result');
        Route::post('/rawatpasien/or/{id}', [CarePatientC::class, 'orPost'])->name('rawatpasien-or-submit');
        
        Route::get('/rawatpasien/plan/{id}', [CarePatientC::class, 'tindakan'])->name('rawatpasien-plan');
        Route::get('/rawatpasien/plan/{id}/result', [CarePatientC::class, 'tindakanResult'])->name('rawatpasien-plan-result');
        Route::post('/rawatpasien/plan/{id}', [CarePatientC::class, 'tindakanPost'])->name('rawatpasien-plan-submit');
       
        Route::get('/rawatpasien/laborat/{id}', [CarePatientC::class, 'laborat'])->name('rawatpasien-laborat');
        Route::get('/rawatpasien/laborat/{id}/result', [CarePatientC::class, 'laboratResult'])->name('rawatpasien-laborat-result');
        Route::post('/rawatpasien/laborat/{id}', [CarePatientC::class, 'laboratPost'])->name('rawatpasien-plan-submit');
        
        Route::get('/rawatpasien/riwayat/{id}', [CarePatientC::class, 'riwayat'])->name('rawatpasien-riwayat');
        Route::get('/rawatpasien/riwayat/{id}/{historyId}', [CarePatientC::class, 'riwayatDetail'])->name('rawatpasien-riwayat-detail');
        
});