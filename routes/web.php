<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/dashboard', [VisitorController::class, 'dashboard'])->name('dashboard');
Route::get('/add-visitor', [VisitorController::class, 'create'])->name('visitors.create');
Route::post('/add-visitor', [VisitorController::class, 'store'])->name('visitors.store');
Route::post('/checkout', [VisitorController::class, 'checkout'])->name('visitors.checkout');
Route::get('/checked-out-visitors', [VisitorController::class, 'checkedOut'])->name('visitors.checkedout');
Route::get('/view-data', [VisitorController::class, 'index'])->name('visitors.index');