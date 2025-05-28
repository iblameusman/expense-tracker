<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;

// Welcome Page
Route::view('/', 'home');

// Dashboard & Reports (Requires auth + verified)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');

    // Reports
    Route::prefix('reports')
        ->name('reports.')
        ->controller(ReportController::class)
        ->group(function () {
            Route::get('/',     'index')->name('index');
            Route::get('pdf',   'exportPdf')->name('pdf');
            Route::get('excel', 'exportExcel')->name('excel');
        });

    // CRUD
    Route::resource('expenses',   ExpenseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('budgets',    BudgetController::class);
});

// Profile routes (Requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth scaffolding (e.g. Laravel Breeze/Fortify)
require __DIR__.'/auth.php';
