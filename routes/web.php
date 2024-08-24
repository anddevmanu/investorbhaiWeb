<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');


    Route::prefix('calculator')->group(function() {
        Route::get('/simple-interest', [CalculatorController::class, 'simpleInterest'])->name('simple.calculator');
        Route::get('/compound-interest', [CalculatorController::class, 'compoundInterest'])->name('compound.calculator');
        Route::get('/loan-calculator', [CalculatorController::class, 'loanCalculator'])->name('loan.calculator');
        Route::get('/sip', [CalculatorController::class, 'sipCalculator'])->name('sip.calculator');
        Route::get('/ppf', [CalculatorController::class, 'ppfCalculator'])->name('ppf.calculator');
        Route::get('/recurring', [CalculatorController::class, 'rdCalculator'])->name('rd.calculator');
    });






Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);


Route::middleware(['role:user'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user');
    });
});


Route::middleware(['role:editor'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('/editor/dashboard', [EditorController::class, 'dashboard'])->name('editor.dashboard');
    });
});

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('user')->group(function() {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
