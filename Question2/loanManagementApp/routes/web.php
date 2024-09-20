<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanReportController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::resource('loan-products', LoanProductController::class);
    Route::resource('customers', CustomerController::class);
    // Route for the loan applications report
    Route::get('/loan_applications/report', [LoanReportController::class, 'index'])->name('loan_applications.report');

});
Route::prefix('dashboard')->group(function () {
    Route::resource('loan_applications', LoanApplicationController::class);
    Route::get('loan_applications/approve/{id}', [LoanApplicationController::class, 'approve'])->name('loan_applications.approve');
    Route::get('loan_applications/repay/{id}', [LoanApplicationController::class, 'repay'])->name('loan_applications.repay');



});



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
