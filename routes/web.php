<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckSession;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropretyController;
use App\Http\Controllers\TestController;
use Stichoza\GoogleTranslate\GoogleTranslate;

Route::get('/test', function(){
    return view('test');
});

Route::get('/translate', function () {
    $lang = new GoogleTranslate('en');

    $lang->setSource('en')->setTarget('en');

    $viewContent = file_get_contents(resource_path('views/test.blade.php'));

    $translatedContent = $lang->translate($viewContent);

    return $translatedContent;
});

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
Route::middleware([Authenticate::class])->group(function () {
    // Route::get('/filtered', [FilterController::class, 'show'])->name('show');
    Route::get('/filter/properties', [FilterController::class,'filterProperties'])->name('filter.properties');

    // Categories
    // Route::get('/categories/{category}', [FilterController::class, 'show'])->name('categories.show');
    Route::get('/categories', [CategoryController::class, 'get'])->name('categories.index');
    Route::get('/createcategories', [CategoryController::class, 'create'])->name('createcategories');
    Route::post('/addcategory', [CategoryController::class, 'add'])->name('categories.add');

    // Properties
    Route::get('/properties', [PropretyController::class, 'get'])->name('properties.index');
    Route::get('/createproperties', [PropretyController::class, 'create'])->name('createproperties');
    Route::get('/editproperties/{id}', [PropretyController::class, 'edit'])->name('editproperty');
    Route::get('/showproperty/{id}', [PropretyController::class, 'show'])->name('property.show');
    Route::post('/addproprety', [PropretyController::class, 'add'])->name('addproprety');

    Route::put('/updateproperties/{id}', [PropretyController::class, 'update'])->name('updateproperty');
    Route::delete('/deleteproperties/{id}', [PropretyController::class, 'destroy'])->name('deleteproperty');

    

    // profile
    Route::get('/profile', [ProfileController::class, 'get'])->name('profile');
    Route::get('/editprofile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/updateprofile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware([AdminMiddleware::class])->group(function () {
    //admin 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/userslist', [AdminController::class, 'users'])->name('admin.userslist');
    Route::post('/admin/properties/{id}/validate', [AdminController::class, 'validateProperty'])->name('admin.validateProperty');
    Route::post('/admin/unvalidate-property/{id}/validate', [AdminController::class, 'unvalidateProperty'])->name('admin.unvalidateProperty');
    Route::post('/admin/user/{id}/validate', [AdminController::class, 'validateUser'])->name('admin.validateUser');
    Route::post('/admin/unvalidate-user/{id}/validate', [AdminController::class, 'unvalidateUser'])->name('admin.unvalidateUser');

    Route::delete('/admin/properties/{id}/delete', [AdminController::class, 'deleteProperty'])->name('admin.deleteProperty');
    Route::delete('/admin/user/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});
});



