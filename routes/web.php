<?php

use App\Http\Controllers\Admin\{
    CategoryController, ProductController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::any('/admin/products/search', [ProductController::class, 'search'])->name('products.search');
Route::resource('/admin/products', ProductController::class);

Route::any('/admin/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::resource('/admin/categories', CategoryController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
