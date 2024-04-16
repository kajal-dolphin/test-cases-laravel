<?php

use App\Http\Controllers\BookContrller;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});

Route::prefix('book')->name('book.')->controller(BookContrller::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});

Route::prefix('calculation')->name('calculation.')->controller(CalculationController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});

Route::get('/dashboard',[DashBoardController::class,'dashboard'])->name('dahboard');
