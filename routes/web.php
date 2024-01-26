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

// landing page
Route::get('/', [LandingPageC::class, 'index']);

//  as guest
Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// after login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeC::class, 'index'])->name('home');
    Route::get('/doctor', [DoctorC::class, 'index'])->name('doctor')->middleware(['auth', 'is-active']);

    Route::prefix('settings')->group(function () {

        Route::get('/userlevels', [HomeC::class, 'index'])->name('userlevels');
        Route::get('/menus', [HomeC::class, 'index'])->name('menus');

        Route::get('/users', [UserC::class, 'index'])->name('users');
        Route::get('/users/create', [UserC::class, 'create'])->name('users-create');
        Route::post('/users/create', [UserC::class, 'createPost'])->name('users-create');
        Route::get('/users/{id}', [UserC::class, 'edit'])->name('users-edit');
        Route::post('/users/{id}', [UserC::class, 'editPut'])->name('users-edit-submit');
        Route::get('/users/delete/{id}', [UserC::class, 'delete'])->name('users-delete');
    });
});
