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
Route::get('home/products', [ProductController::class, 'insertP'])->name('home.products.filter');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/about', function () {
    return view('template.about');
})->name('about');

Route::get('/contact', function () {
    return view('template.contact');
})->name('contact');


Route::get('/singup', [SignupController::class, 'index'])->name('singup');
Route::post('/singup', [SignupController::class, 'store'])->name('singup.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/Admin.admindashboard', [AdminController::class, 'index'])->name('admindashboard');
Route::post('/Admin.admindashboard', [AdminController::class, 'addadmin'])->name('admin.addadmin');
Route::get('/Admin.admindashboard-show-slider',[AdminController::class,'showSliderManagement'])->name('show-slider');
Route::post('/Admin.admindashboard-slider',[AdminController::class, 'uploadSlider'])->name('admin.slider.upload');
Route::post('/Admin.add-product', [ProductController::class, 'store'])->name('products.store');
Route::get('/Admin.add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/Admin.add-category', [CategoryController::class, 'store'])->name('categories.store');



Route::get('/User.userdashboard', [UserController::class, 'index'])->name('user.dashboard');

