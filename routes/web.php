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
use App\Http\Controllers\BrandController;
use GuzzleHttp\Psr7\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home/products', [ProductController::class, 'insertP'])->name('home.products.filter');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/home/products/filter', [ProductController::class, 'filterProducts'])->name('home.products.filter');

Route::get('home/brands', function () {
    return view('template.brands');
})->name('brands');

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
Route::post('/logout', action: [LoginController::class, 'logout'])->name('logout');


Route::get('/Admin.admindashboard', [AdminController::class, 'index'])->name('admindashboard');
Route::post('/Admin.admindashboard', [AdminController::class, 'addadmin'])->name('admin.addadmin');
Route::put('/admin/update', [AdminController::class, 'adminupdate'])->name('admin.update');

Route::delete('/Admin.admindashboard-deleteadmin/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::post('/Admin.admindashboard-adduser', [AdminController::class, 'adduser'])->name('admin.adduser');
Route::delete('/Admin.admindashboard-deleteuser/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
Route::get('/admin-products/{id}/edit', [AdminController::class, 'editProduct'])->name('product.edit');
Route::put('/admin-products/{id}', [AdminController::class, 'updateProduct'])->name('product.update');
Route::get('/Admin.admindashboard-factor', [AdminController::class, 'showOrders'])->name('factor.show');

Route::get('/Admin.admindashboard-show-slider', [AdminController::class, 'showSliderManagement'])->name('show-slider');
Route::delete('/Admin.admindashboard-delete-slider/{id}', [AdminController::class, 'deleteSlider'])->name('slider.delete');
Route::post('/Admin.admindashboard-slider', [AdminController::class, 'uploadSlider'])->name('admin.slider.upload');

// نمایش لیست برندها
Route::get('admin/brands', [BrandController::class, 'index'])->name('admin.brands.index');
// ذخیره برند جدید
Route::post('admin/brands', [BrandController::class, 'store'])->name('admin.brands.store');
// نمایش فرم ویرایش برند
Route::get('admin/brands/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
// به‌روزرسانی اطلاعات برند
Route::put('admin/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
// حذف برند
Route::delete('admin/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

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



Route::get('/payment', [CartController::class, 'payment'])->name('payment');

Route::post('/payment/complete', [CartController::class, 'completePayment'])->name('payment.complete');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');




Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/pending', [CommentController::class, 'pendingComments'])->name('admin.comments.pending');
Route::patch('/comments/{id}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');




Route::post('contact', function () {
    // ارسال پیام تشکر یا هر پردازشی
    return view('template.contact')->with('message', 'Thank you for your message!');
})->name('contact');