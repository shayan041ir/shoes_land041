<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;

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
Route::delete('/Admin.admindashboard-deleteadmin/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::post('/Admin.admindashboard-adduser', [AdminController::class, 'adduser'])->name('admin.adduser');
Route::delete('/Admin.admindashboard-deleteuser/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');

Route::get('/Admin.admindashboard-factor',[AdminController::class,'showOrders'])->name('factor.show');

Route::get('/Admin.admindashboard-show-slider',[AdminController::class,'showSliderManagement'])->name('show-slider');
Route::delete('/Admin.admindashboard-delete-slider/{id}', [AdminController::class, 'deleteSlider'])->name('slider.delete');
Route::post('/Admin.admindashboard-slider',[AdminController::class, 'uploadSlider'])->name('admin.slider.upload');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/Admin.add-product', [ProductController::class, 'store'])->name('products.store');
Route::delete('/Admin.admindashboard/{id}', [ProductController::class, 'destroy'])->name('product.delete');

Route::get('/Admin.add-category', [CategoryController::class, 'create'])->name('categories.create');
Route::delete('/Admin.add-category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::post('/Admin.add-category', [CategoryController::class, 'store'])->name('categories.store');



Route::get('/User.userdashboard', [UserController::class, 'index'])->name('user.dashboard');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');


Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');



Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');
Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->name('order.success');
