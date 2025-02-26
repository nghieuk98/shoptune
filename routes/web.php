<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;



Route::get('/', function () {
    //return view('welcome');
    return view('frontend.index');
});
Route::get('/mens', function () {
    //return view('welcome');
    return view('frontend.mens');
});

Route::get('/electronics', function () {
    //return view('welcome');
    return view('frontend.electronics');
});

Route::get('/womens', function () {
    //return view('welcome');
    return view('frontend.womens');
});

Route::get('/short.code', function () {
    //return view('welcome');
    return view('frontend.codes');
});

Route::get('/contact', function () {
    //return view('welcome');
    return view('frontend.contact');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('add', 'add')->name('products.add');
        Route::post('add', 'save')->name('products.save');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::post('edit/{id}', 'update')->name('products.update');
        Route::get('delete/{id}', 'delete')->name('products.delete');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('save', 'save')->name('category.save');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::get('delete/{id}', 'delete')->name('category.delete');
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('users');
        Route::get('add', 'add')->name('users.add');
        Route::post('save', 'save')->name('users.save');
        Route::get('edit/{id}', 'edit')->name('users.edit');
        Route::post('edit/{id}', 'update')->name('users.update');
        Route::get('delete/{id}', 'delete')->name('users.delete');
    });

    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('', 'index')->name('orders');
    });
});