<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeC;
use App\Http\Controllers\LandingPageC;
use App\Http\Controllers\Module\DoctorC;
use App\Http\Controllers\Module\UserC;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/dashboard/settings/users.php';
require __DIR__ . '/dashboard/settings/userlevels.php';
require __DIR__ . '/dashboard/settings/menus.php';

// landing page
Route::get('/', [LandingPageC::class, 'index']);

Route::get('/queue_ready/{id}', [LandingPageC::class, 'queueReady'])->name('queue-ready');

Route::get('/newpatient', [LandingPageC::class, 'newPatient'])->name('new-patient');
Route::post('/newpatient', [LandingPageC::class, 'newPatientPost'])->name('new-patient');

Route::get('/queue', [LandingPageC::class, 'queue'])->name('queue');
Route::post('/queue', [LandingPageC::class, 'queuePost'])->name('queue');

Route::get('/history', [LandingPageC::class, 'history'])->name('history');

//  as guest
Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeC::class, 'index'])->name('home');
});
