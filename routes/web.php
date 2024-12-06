<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/singup',[SignupController::class,'index'])->name('singup');
Route::post('/singup',[SignupController::class,'store'])->name('singup.store');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::get('/Admin.admindashboard', [AdminController::class, 'index'])->name('admindashboard');
// Route::get('/admindashboard', [AdminController::class, 'index'])->name('admindashboard')->middleware('auth');
Route::post('/Admin.admindashboard', [AdminController::class, 'addadmin'])->name('admin.addadmin');

Route::post('/Admin.add-product', [ProductController::class, 'store'])->name('products.store');

Route::get('/Admin.add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/Admin.add-category', [CategoryController::class, 'store'])->name('categories.store');


Route::get('/User.userdashboard',[UserController::class,'index'])->name('user.dashboard');


// Route::group(['middleware' => ['auth:admin']], function() {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/admin/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.editProduct');
//     Route::post('/admin/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
//     Route::post('/admin/site/update', [AdminController::class, 'updateSiteInfo'])->name('admin.updateSiteInfo');
// });
