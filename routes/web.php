<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropretyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// authentification
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'registerUser']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginUser']);

// Logout route
Route::post('/logout', [UserController::class, 'logoutUser'])->middleware(['auth:sanctum'])->name('logout');

// Home route
Route::get('/', [HomeController::class, 'get'])->name('index')->middleware('auth');

// Routes for Authenticated Users
Route::middleware(['web', '\App\Http\Middleware\CheckSession::class', 'auth'])->group(function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'get'])->name('categories.index');
    Route::get('/createcategories', [CategoryController::class, 'create'])->name('createcategories');
    Route::post('/addcategory', [CategoryController::class, 'add'])->name('categories.add');

    // Properties
    Route::get('/properties', [PropretyController::class, 'get'])->name('properties.index');
    Route::get('/createproperties', [PropretyController::class, 'create'])->name('createproperties');
    Route::post('/createproperties', [PropretyController::class, 'add'])->name('addproperty');
});

