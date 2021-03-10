<?php

use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', function () {return view('layouts.dashboard');})->name('dashboard');

    Route::group(['prefix'=> 'products' ], function(){
        Route::get('/index', function () {return view('products.index');})->name('products');
        Route::post('get_products', [App\Http\Controllers\ProductsController::class, 'Get'])->name('products.get');    
        Route::post('get_product_id', [App\Http\Controllers\ProductsController::class, 'GetId'])->name('product.get.id');    
        Route::get('/create', function () {return view('products.create');})->name('product.create');
        Route::post('product_create', [App\Http\Controllers\ProductsController::class, 'Create'])->name('product.store');    
        Route::post('product_update', [App\Http\Controllers\ProductsController::class, 'Update'])->name('product.update');    
        Route::post('product_destroy', [App\Http\Controllers\ProductsController::class, 'Destroy'])->name('product.destroy');    
     });

     Route::group(['prefix'=> 'orders' ], function(){
        Route::get('/index', function () {return view('orders.index');})->name('orders');
        Route::get('/create', function () {return view('orders.create');})->name('orders.create');
        Route::get('get_orders', [App\Http\Controllers\OrdersController::class, 'Get'])->name('orders.get');    
        Route::post('order_create', [App\Http\Controllers\OrdersController::class, 'Create'])->name('order.store');  
        Route::post('get_order_id', [App\Http\Controllers\OrdersController::class, 'GetId'])->name('order.get.id');      
        Route::post('order_change_status', [App\Http\Controllers\OrdersController::class, 'Update'])->name('order.change.status');      
        Route::post('download_order', [App\Http\Controllers\OrdersController::class, 'GetPDF'])->name('download.order');      
     });

     Route::group(['prefix'=> 'lgos' ], function(){
        Route::get('/index', function () {return view('logs.index');})->name('logs');
        Route::get('get_logs', [App\Http\Controllers\LogsController::class, 'Get'])->name('logs.get');    
     });
     Route::get('get_users', [App\Http\Controllers\UsersController::class, 'Get'])->name('users.get');    

    
    
});


