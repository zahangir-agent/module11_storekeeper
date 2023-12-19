<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[StoreController::class,'dashboard']);
Route::get('/productlist',[StoreController::class,'productlist']);
Route::get('/addproduct',[StoreController::class,'addproduct']);
Route::get('/updateproduct',[StoreController::class,'updateproduct']);

Route::get('/transactionalhistory',[StoreController::class,'transactionalhistory']);

Route::post('/product-store',[StoreController::class,'store'] )->name('store-product');
Route::get('/product-edit/{id}',[StoreController::class,'updateview'] )->name('product_edit');
Route::POST('/product-update',[StoreController::class,'update'])->name('product_update');

Route::get('/product-saleview/{id}',[StoreController::class,'saleview'] )->name('product_view');
Route::post('/product-sale',[StoreController::class,'sale'] )->name('product_sale');
