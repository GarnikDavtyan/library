<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/books');
    
    Route::middleware(['staff'])->group(function () {
        Route::resource('books', BookController::class)->only([
            'edit', 'create'
        ]);

        Route::resource('categories', CategoryController::class)->only([
            'index', 'create', 'edit'
        ]);

        Route::resource('staff', StaffController::class)->only([
            'index', 'create', 'edit'
        ]);
    });

    Route::resource('books', BookController::class)->only([
        'index', 'show'
    ]);

    Route::post('/logout', function() {
        Session::flush();
    
        Auth::logout();
    
        return redirect('/');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/login', 'auth.login')->name('login');
});

