<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

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

// ─── Public Routes (No Login Required) ──────────────────────────────────────

Route::get('/', function () {
    return view('welcome');
});

// Auth pages – redirect to /home if already logged in
Route::get('/register', [usersController::class, 'index']);
Route::get('/login',    [usersController::class, 'index1'])->name('login');
Route::post('/register_user', [usersController::class, 'register']);
Route::post('/login_user',    [usersController::class, 'login']);

Route::get('/forgot-password',  [usersController::class, 'forgotPassword']);
Route::post('/forgot-password', [usersController::class, 'forgotPassword']);
Route::post('/update-password-direct', [usersController::class, 'resetPasswordDirect']);

// ─── Protected Routes (Login Required) ──────────────────────────────────────

Route::middleware('check.login')->group(function () {

    // Home
    Route::get('/home', [usersController::class, 'home']);

    // Blog page (user-facing posts listing)
    Route::get('/blog',        [usersController::class, 'blog'])->name('blog');
    Route::get('/blog/create', [usersController::class, 'blogCreate'])->name('blog.create');
    Route::post('/blog',       [usersController::class, 'blogStore'])->name('blog.store');
    Route::get('/blog/{id}/edit', [usersController::class, 'blogEdit'])->name('blog.edit');
    Route::put('/blog/{id}',    [usersController::class, 'blogUpdate'])->name('blog.update');
    Route::delete('/blog/{id}', [usersController::class, 'blogDestroy'])->name('blog.destroy');
    Route::post('/blog/{id}/like', [usersController::class, 'toggleLike'])->name('blog.like');
    Route::post('/blog/{id}/comment', [usersController::class, 'postComment'])->name('blog.comment');
    Route::delete('/comment/{id}', [usersController::class, 'deleteComment'])->name('comment.delete');

    // 👇 ADD HERE (PROFILE)
    Route::get('/profile', [usersController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [usersController::class, 'updateProfile']);
    Route::post('/profile/password', [usersController::class, 'changePassword']);

    // Logout
    Route::post('/logout', [usersController::class, 'logout']);

    // Static pages
    Route::get('/about', function () {
        return view('about');
    });

    Route::get('/contact', function () {
        return view('contact');
    });

    // Admin panel
    Route::get('/admin', [usersController::class, 'admin']);
    Route::get('/users', [usersController::class, 'getAllUser']);

    // Comments
    Route::resource('/comment', CommentController::class);

    // Category & Post – explicit create routes before resource
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/post/create',     [PostController::class, 'create'])->name('post.create');

    // Frontend detail routes
    Route::get('/category/{id}', [usersController::class, 'categoryPosts'])->name('category.show');
    Route::get('/post/{id}',     [usersController::class, 'postDetail'])->name('post.show');

    // Resource routes (excluding create & show which are handled above)
    Route::resource('/category', CategoryController::class)->except(['create', 'show']);
    Route::resource('/post',     PostController::class)->except(['create', 'show']);
});

