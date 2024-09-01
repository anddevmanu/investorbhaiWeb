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
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::get('/cpntact', [UserController::class, 'blog'])->name('contact');
Route::get('/search', [UserController::class, 'blog'])->name('search');

// POST
Route::get('/posts/load-more', [UserController::class, 'loadMorePosts'])->name('posts.loadMore');


Route::prefix('calculator')->group(function () {
    Route::get('/simple-interest', [CalculatorController::class, 'simpleInterest'])->name('simple.calculator');
    Route::get('/compound-interest', [CalculatorController::class, 'compoundInterest'])->name('compound.calculator');
    Route::get('/loan-calculator', [CalculatorController::class, 'loanCalculator'])->name('loan.calculator');
    Route::get('/sip', [CalculatorController::class, 'sipCalculator'])->name('sip.calculator');
    Route::get('/ppf', [CalculatorController::class, 'ppfCalculator'])->name('ppf.calculator');
    Route::get('/recurring', [CalculatorController::class, 'rdCalculator'])->name('rd.calculator');
});



Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/create-question', [UserController::class, 'createQuestion'])->name('create.question');
        Route::post('/store-question', [UserController::class, 'storeQuestion'])->name('store.question');
    });
});



Route::middleware(['role:editor'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/editor/dashboard', [EditorController::class, 'dashboard'])->name('editor.dashboard');
    });
});

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/user/list', [AdminController::class, 'userList'])->name('user.list');
        Route::get('/users/edit/{id}', [AdminController::class, 'userEdit'])->name('users.edit');
        Route::post('/users/{user}', [AdminController::class, 'userupdate'])->name('users.update');
        Route::delete('/user/delete/{user}', [AdminController::class, 'userDelete'])->name('users.delete');

        // QUESTION
        Route::get('/questions/list', [AdminController::class, 'questionList'])->name('admin.question.list');
        Route::get('/questions/create', [AdminController::class, 'questionCreate'])->name('question.create');
        Route::post('/questions/store', [AdminController::class, 'questionStore'])->name('admin.questions.store');
        Route::get('/questions/edit/{post}', [AdminController::class, 'questionEdit'])->name('admin.questions.edit');
        Route::put('/questions/update/{post}', [AdminController::class, 'questionUpdate'])->name('admin.questions.update');
        Route::delete('/questions/delete/{post}', [AdminController::class, 'questionDelete'])->name('admin.questions.delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
