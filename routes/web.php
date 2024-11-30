<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Models\Product;

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

Route::get('/', function () {
    return view('home', [
        'page' => 'Home'
    ]);
})->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/menu/{product}', [MenuController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'page' => 'Categories',
        'categories' => Category::all()
    ]);
})->name('categories');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'autenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/manage', function() {
    return view('manage.index', [
        'page' => 'Manage'
    ]);
})->name('manage')->middleware('admin');

Route::get('/manage/menu/checkslug', [ProductController::class, 'checkSlug'])->middleware('admin');
Route::resource('/manage/menu', ProductController::class)->middleware('admin');

Route::get('/manage/categories/checkslug', [CategoryController::class, 'checkSlug'])->middleware('admin');
Route::resource('/manage/categories', CategoryController::class)->middleware('admin');

Route::get('/manage/orders', [OrderController::class, 'showAll'])->middleware('admin');
Route::get('/manage/orders/{order}', [OrderController::class, 'showDetails'])->middleware('admin');

Route::get('/orders', [OrderController::class, 'show'])->middleware('auth');
Route::get('/orders/{product}', [OrderController::class, 'order'])->middleware('auth');
Route::post('/orders', [OrderController::class, 'makeOrder'])->middleware('auth');
Route::put('/orders/{orderDetail}', [OrderController::class, 'editOrder'])->middleware('auth');
Route::put('/orders/{order}/pay', [OrderController::class, 'payOrder'])->middleware('auth');
Route::delete('/orders/{orderDetail}', [OrderController::class, 'deleteOrder'])->middleware('auth');
