<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/{page}', [AdminController::class, 'index']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
