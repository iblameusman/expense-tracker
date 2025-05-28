<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [ReportController::class, 'index'])
        ->name('dashboard');

    // Standard CRUD resources
    Route::resource('expenses',  ExpenseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('budgets',    BudgetController::class);

    // Reporting (same controller, different exports)
    Route::prefix('reports')
         ->name('reports.')
         ->controller(ReportController::class)
         ->group(function () {
             Route::get('/',      'index')->name('index');
             Route::get('pdf',    'exportPdf')->name('pdf');
             Route::get('excel',  'exportExcel')->name('excel');
         });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
});

require __DIR__.'/auth.php';
