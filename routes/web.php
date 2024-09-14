<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Api\PostInteractionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


// AUTHENTICATION
Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/user/blog/list', [UserController::class, 'blogListShow'])->name('blog');
Route::get('blog/{slug}', [UserController::class, 'blogDetails'])->name('blog.details');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/search', [UserController::class, 'blog'])->name('search');

// SINGLE POST
Route::get('/questions/{slug}', [PostController::class, 'show'])->name('questions.show');
Route::post('/post/{id}/view', [PostInteractionController::class, 'increaseView']);
Route::post('/post/{id}/like', [PostInteractionController::class, 'like']);
Route::post('/post/{id}/dislike', [PostInteractionController::class, 'dislike']);

// BLOG
Route::get('/blogs', [BlogController::class, 'blogList'])->name('blogs');
Route::post('/enquiry/save', [EnquiryController::class, 'enquirySave'])->name('contact.submit');

// ANSWER
Route::post('/user/answer/save', [AnswerController::class, 'saveAnswer'])->name('answer.save')->middleware('auth');
Route::post('/user/comment/save', [CommentController::class, 'saveComment'])->name('comment.save')->middleware('auth');


Route::prefix('calculator')->group(function () {
    Route::get('/simple-interest', [CalculatorController::class, 'simpleInterest'])->name('simple.calculator');
    Route::get('/compound-interest', [CalculatorController::class, 'compoundInterest'])->name('compound.calculator');
    Route::get('/loan-calculator', [CalculatorController::class, 'loanCalculator'])->name('loan.calculator');
    Route::get('/sip', [CalculatorController::class, 'sipCalculator'])->name('sip.calculator');
    Route::get('/ppf', [CalculatorController::class, 'ppfCalculator'])->name('ppf.calculator');
    Route::get('/recurring', [CalculatorController::class, 'rdCalculator'])->name('rd.calculator');
});


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

        // ENQUIRIES
        Route::get('/enuiries/list', [AdminController::class, 'enquiryList'] )->name('enquiry.list');
        Route::delete('/enuiries/delete/{id}', [AdminController::class, 'deleteEnquiry'])->name('enquiries.delete');
        Route::get('/enuiries/show/{id}', [AdminController::class, 'showEnquiry'])->name('enquiries.show');
    });
});


Route::middleware(['auth', 'role:editor|admin'])->group(function () {

    // Questions
    Route::prefix('questions')->group(function () {
         // QUESTION
         Route::get('/user/list/{userId?}', [PostController::class, 'list'])->name('question.list');
         Route::get('/user/create', [PostController::class, 'questionCreate'])->name('question.create');
         Route::post('/user/store', [PostController::class, 'questionStore'])->name('question.store');
         Route::get('/edit/{post}', [PostController::class, 'questionEdit'])->name('question.edit');
         Route::put('/update/{post}', [PostController::class, 'questionUpdate'])->name('question.update');
         Route::delete('/delete/{post}', [PostController::class, 'questionDelete'])->name('question.delete');
    });

    // CATEGORY
    Route::prefix('category')->group(function() {
        Route::get('list', [CategoryController::class, 'list'])->name('category.list');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    });

    // blog
    Route::prefix('blogs')->group(function () {
        Route::get('/list/{userId?}', [BlogController::class, 'bloglistFinal'])->name('blog.list');
        Route::get('/create', [BlogController::class, 'createBlog'])->name('blog.create');
        Route::post('/admin/blog/store', [BlogController::class, 'storeBlog'])->name('blog.store');
        Route::get('{id}/edit', [BlogController::class, 'editBlog'])->name('blog.edit');
        Route::put('{id}/update', [BlogController::class, 'updateBlog'])->name('blog.update');
        Route::delete('{id}/delete', [BlogController::class, 'deleteBlog'])->name('blog.delete');
    });

});


Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function (){
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';

// api routes
require __DIR__ . '/api.php';
