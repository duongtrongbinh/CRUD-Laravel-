<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\ProductApiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layout.master');
// })->name('/');
// Route::view('/','dashboard.login')->name('login');
Route::post('/login', [UserController::class, 'store'])->name('user_login');

Route::view('/dashboard', 'dashboard.dashboard')->name('admin');


Route::prefix('/admin')->group(function () {

        // phần category
    Route::prefix('category/')->group(function () {
        Route::get('', [CategoriesController::class, 'index'])->name('list_category');
        Route::post('add', [CategoriesController::class, 'store'])->name('add_category');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('update', [CategoriesController::class, 'update'])->name('update_category');
        Route::get('delete/{id}', [CategoriesController::class, 'destroy'])->name('delete_category');
    });

        // phần product
    Route::prefix('product/')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('list_product');
        Route::get('add', [ProductController::class, 'create'])->name('from_add_product');
        Route::post('size/add', [ProductController::class, 'storeSize'])->name('add_size');
        Route::post('color/add', [ProductController::class, 'storeColor'])->name('add_color');
        Route::post('status/add', [ProductController::class, 'storeStatus'])->name('add_status');
        Route::post('add', [ProductController::class, 'store'])->name('add_product');
        Route::post('add_attribute/{id}', [ProductController::class, 'storeProdutDetail'])->name('add_product-detail');
        Route::put('edit_attribute/{id}', [ProductController::class, 'updateProdutDetail'])->name('edit_product-detail');
        Route::get('edit_product/{id}', [ProductController::class, 'edit'])->name('edit_product');
        Route::put('update', [ProductController::class, 'update'])->name('update_product');
        Route::get('deleteProduct/{id}', [ProductController::class, 'destroyProduct'])->name('delete_product');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('delete_product_detail');

    });
    // phần user
    Route::view('/login','dashboard.login')->name('login');
    Route::view('profile', 'dashboard.profile_user')->name('profile_user');
    

// Route::view('/register','dashboard.register')->name('admin/register');

});

// Route::prefix('/')->group(function (){
//     Route::view('','guest.trangchu')->name('/');
//     Route::get('/product',[ProductApiController::class, 'index'])->name('list_product');
//     Route::get('/product/{id}',[ProductApiController::class, 'show'])->name('product_detail');
// });