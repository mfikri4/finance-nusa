<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FinanceController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Finance;
use App\Http\Middleware\User;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::group(['middleware' => 'admin'],function(){  

    Route::get('/admin', [HomeController::class, 'index'])->name('home')->middleware('verified');

    Route::prefix('financea')->group(function(){
        Route::get('/', [FinanceController::class, 'index'])->name('home')->middleware('verified');
        Route::get('create', [FinanceController::class, 'create'])->name('home')->middleware('verified');
        Route::post('create', [FinanceController::class, 'insert'])->name('home')->middleware('verified');
        Route::get('ewallet/{id}', [FinanceController::class, 'cek'])->name('home')->middleware('verified');
        Route::get('currency/{id}', [FinanceController::class, 'add_currency'])->name('home')->middleware('verified');
        Route::post('currency', [FinanceController::class, 'insert'])->name('home')->middleware('verified');
        Route::get('edit/{id}', [FinanceController::class, 'edit'])->name('home')->middleware('verified');
        Route::post('edit/{id}', [FinanceController::class, 'update'])->name('home')->middleware('verified');
        Route::get('delete/{id}', [FinanceController::class, 'delete'])->name('home')->middleware('verified');
    });

    Route::prefix('user-data')->group(function(){
        Route::get('/', [HomeController::class, 'all'])->name('home')->middleware('verified');
        Route::get('create', [HomeController::class, 'create'])->name('home')->middleware('verified');
        Route::post('tambah', [HomeController::class, 'tambah'])->name('home')->middleware('verified');
        Route::get('edit/{id}', [HomeController::class, 'edit'])->name('home')->middleware('verified');
        Route::post('edit/{id}', [HomeController::class, 'update'])->name('home')->middleware('verified');
        Route::get('delete/{id}', [HomeController::class, 'delete'])->name('home')->middleware('verified');
    });
});

Route::group(['middleware' => 'finance'],function(){  
    
    Route::get('/finance', [HomeController::class, 'index'])->name('home')->middleware('verified');

    Route::prefix('fin')->group(function(){
        Route::get('/{id}', [FinanceController::class, 'index_fin'])->name('home')->middleware('verified');
        Route::get('wlt/{id}', [FinanceController::class, 'cek'])->name('home')->middleware('verified');
        Route::get('create', [FinanceController::class, 'add'])->name('home')->middleware('verified');
        Route::post('tambah', [FinanceController::class, 'tambah'])->name('home')->middleware('verified');
        Route::get('edit/{id}', [FinanceController::class, 'edit'])->name('home')->middleware('verified');
        Route::post('edit/{id}', [FinanceController::class, 'update'])->name('home')->middleware('verified');
        Route::get('delete/{id}', [FinanceController::class, 'delete'])->name('home')->middleware('verified');
    });
});


Route::group(['middleware' => 'support'],function(){  
    
    Route::get('/finances', [HomeController::class, 'index'])->name('home')->middleware('verified');

    Route::prefix('finances')->group(function(){
        Route::get('/{id}', [FinanceController::class, 'index_fin'])->name('home')->middleware('verified');
        Route::get('ewlt/{id}', [FinanceController::class, 'cek'])->name('home')->middleware('verified');
        Route::get('create', [FinanceController::class, 'add'])->name('home')->middleware('verified');
        Route::post('tambah', [FinanceController::class, 'tambah'])->name('home')->middleware('verified');
        Route::get('edit/{id}', [FinanceController::class, 'edit'])->name('home')->middleware('verified');
        Route::post('edit/{id}', [FinanceController::class, 'update'])->name('home')->middleware('verified');
        Route::get('delete/{id}', [FinanceController::class, 'delete'])->name('home')->middleware('verified');
    });
});