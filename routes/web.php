<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/index');
    }

    return redirect('/login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('invoices/products/{section}', [InvoiceController::class, 'getProductsBySection'])
        ->name('products.by-section');

    Route::resource('customers', CustomerController::class)
        ->except(['destroy']);
    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])
        ->middleware('admin')
        ->name('customers.destroy');

    Route::resource('sections', SectionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);



    Route::middleware(['admin'])->group(function () {
        Route::resource('employees', EmployeeController::class);
    });

    Route::get('/{page}', [AdminController::class, 'index']);
});
