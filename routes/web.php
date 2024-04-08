<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropretyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[HomeController::class,'get'])->name('index');


Route::get('/categories',[CategoryController::class,'get'])->name('categories.index');
Route::get('/createcategories',[CategoryController::class,'create'])->name('createcategories');
Route::post('/addcategory',[CategoryController::class,'add'])->name('categories.add');


Route::get('/propreties',[PropretyController::class,'get'])->name('propreties');
Route::get('/createpropreties',[PropretyController::class,'create'])->name('createpropreties');