<?php
use App\Models\Category;
use App\Models\Proprety;
use App\Models\ListingType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropretyController;

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
    Route::get('/filtered', [FilterController::class, 'show'])->name('show');

    // Categories
    Route::get('/categories/{category}', [FilterController::class, 'show'])->name('categories.show');
    Route::get('/categories', [CategoryController::class, 'get'])->name('categories.index');
    Route::get('/createcategories', [CategoryController::class, 'create'])->name('createcategories');
    Route::post('/addcategory', [CategoryController::class, 'add'])->name('categories.add');

    // Properties
    Route::get('/properties', [PropretyController::class, 'get'])->name('properties.index');
    Route::get('/createproperties', [PropretyController::class, 'create'])->name('createproperties');
    Route::get('/editproperties/{id}', [PropretyController::class, 'edit'])->name('editproperty');
    Route::post('/addproprety', [PropretyController::class, 'add'])->name('addproprety');

    Route::put('/updateproperties/{id}', [PropretyController::class, 'update'])->name('updateproperty');
    Route::delete('/deleteproperties/{id}', [PropretyController::class, 'destroy'])->name('deleteproperty');

    

    // profile
    Route::get('/profile', [ProfileController::class, 'get'])->name('profile');
    Route::get('/editprofile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/updateprofile/{id}', [ProfileController::class, 'update'])->name('profile.update');
 

});



