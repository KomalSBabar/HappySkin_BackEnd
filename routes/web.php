<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('productlist',[ProductsController::class,'index'])->name('product.index');
// Route::post('create',[ProductsController::class,'create'])->name('product.create');
Route::get('createproduct',[ProductsController::class,'create'])->name('product.create');
Route::post('storeproduct',[ProductsController::class,'store'])->name('product_store');

Route::get('edit/{product_id}',[ProductsController::class,'edit_pro'])->name('product.edit');
Route::post('update/{post_id}',[ProductsController::class,'update_pro'])->name('product.update');
Route::get('delete/{id}',[ProductsController::class,'destroy'])->name('product.destroy');



Route::get('userlist',[UserController::class,'index'])->name('user.index');
Route::get('edituser/{user_id}',[UserController::class,'edit_user'])->name('user.edit');
Route::post('updatees/{user_id}',[UserController::class,'update_user'])->name('user.update');
Route::get('createuser',[UserController::class,'create'])->name('user.create');
Route::post('store',[UserController::class,'store'])->name('user.store');
Route::post('login',[UserController::class,'login'])->name('user.login');
Route::get('logout',[UserController::class,'logout'])->name('user.logout');

Route::get('orderlist',[OrderController::class,'index'])->name('orders.index');


Route::get('/', function () {
    return view('login');
});



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
