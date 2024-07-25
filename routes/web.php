<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\http\Controllers\DisbursementVoucherController;
use App\http\Controllers\PayeeController;
use App\http\Controllers\FundClusterController;
use App\Http\Controllers\ResponsibilityCenterController;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('disbursement-vouchers', DisbursementVoucherController::class);

require __DIR__.'/auth.php';




Route::get('/search-fund-clusters', [FundClusterController::class, 'search']);
Route::get('/search-payees', [PayeeController::class, 'search']);
Route::get('/search-responsibility-centers', [ResponsibilityCenterController::class, 'search']);

Route::apiResource('responsibility-centers', ResponsibilityCenterController::class);


Route::get('/disbursement-vouchers/{id}/pdf', [DisbursementVoucherController::class, 'generatePdf'])->name('disbursement-vouchers.pdf');