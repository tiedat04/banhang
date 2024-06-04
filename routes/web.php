<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminLoginMiddleware;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;




/*
    Route::get('cars',[CarController::class,'index'])->name('cars.index');
    Route::post('cars',[CarController::class,'store'])->name('cars.store');
    Route::get('cars/create',[CarController::class,'create'])->name('cars.create');
    Route::get('cars/{car}',[CarController::class,'show'])->name('cars.show');
    Route::put('cars/{car}',[CarController::class,'update'])->name('cars.update');
    Route::delete('cars/{car}',[CarController::class,'destroy'])->name('cars.destroy');
    Route::get('cars/{car}/edit',[CarController::class,'edit'])->name('cars.edit');
*/ 

Route::get('index', [PageController::class, 'index'])->name('banhang.index');
// chi tiết sản phẩm
Route::get('productDetail/{id}', [PageController::class, 'detail'])->name('banhang.productDetail');
// thêm vào giỏ hàng 
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');
// xóa sản phẩm trong giỏ hàng
Route::get('/del-cart/{id}',[PageController::class,'delCartItem'])->name('banhang.xoagiohang');
// Đơn đặt hàng
Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');//sau khi đã định nghĩa route mà trong file view header báo lỗi chưa định nghĩa thì chạy câu lệnh php artisan route:clear

;
Route::get('/dangky', [PageController::class, 'getSignup'])->name('getsignup');
Route::post('/dangky', [PageController::class, 'postSignup'])->name('postsignup');

Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getlogin');
Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postlogin');

Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getlogout');


Route::get('categories', [CategoryController::class, 'getCateList'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);
Route::prefix('admin')->group(function () {
    Route::middleware([AdminLoginMiddleware::class])->group(function () {
        Route::group(['prefix'=>'category'],function(){
             // admin/category/danhsach
             Route::get('danhsach',[CategoryController::class,'getCateList'])->name('admin.getCateList');
             Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
             Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
             Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
             Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
             Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
         });

   });
 });
 Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');

Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::resource('contacts', AdminContactController::class);
Route::resource('contactview', ContactController::class);

Route::prefix('admin')->group(function () {
   Route::get('contactad', [AdminContactController::class, 'index'])->name('admin.contacts.index');
   Route::post('contactad/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
});


