<?php

use App\Basket;
use App\Http\Controllers\BasketController;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false

]);
Route::middleware(['auth'])->group( function (){
//------------------   ADMIN   ------------------
    Route::group([
        'prefix' => 'admin'
    ], function (){

        //GET
        Route::get('getting', 'AdminController@getAdmin')->name('GettingAdmin')->middleware('GetedAdmin');
        Route::get('archive', 'ProductsController@archive')->name('products.archive')->middleware('isAdmin');
        Route::get('archive-process/{id}', 'ProductsController@ToArchive')->name('products.archive-process')->middleware('isAdmin');
        Route::get('unarchive-process/{id}', 'ProductsController@ToUnarchive')->name('products.unarchive-process')->middleware('isAdmin');
        //POST
        Route::post('getting-processing', 'AdminController@getAdmin_processing')->name('GettingAdmin-processing')->middleware('GetedAdmin');
        Route::post('searching', 'ProductsController@search')->name('products.search')->middleware('isAdmin');
        Route::post('searching_in_archive', 'ProductsController@search_archive')->name('products.search.archive')->middleware('isAdmin');
        //Resource
        Route::resource('categories', 'CategoryController')->middleware('isAdmin')->except([
            'show'
        ]);
        Route::resource('products', 'ProductsController')->middleware('isAdmin');
        Route::resource('orders', 'OrderController')->middleware('isAdmin')->only([
            'index', 'destroy'
        ]);
        Route::get('/order/{id}/process', 'OrderController@process')->name('orders.process')->middleware('isAdmin');
        Route::get('/order/{id}/done', 'OrderController@done')->middleware('isAdmin')->name('orders.done');
        Route::get('order/archive', 'OrderController@archive')->middleware('isAdmin')->name('orders.archive');
    });
//------------------   SHOP   ------------------

    Route::get('/', 'MainController@index')->name('main.index');
    Route::get('/categories', 'MainController@categories')->name('main.categories');
    Route::get('/categories/{category}', 'MainController@category')->name('main.category');
    Route::get('/product/{id}', 'MainController@product')->name('product');
    Route::get('/product/{id}/like', 'MainController@product_like')->name('product_like');
    Route::get('/product/{id}/dislike', 'MainController@product_dislike')->name('product_dislike');
    Route::resource('baskets', 'BasketController')->only([
        'index', 'destroy'
    ]);
    
    Route::get('/baskets/add/{id}', 'BasketController@add')->name('baskets.add');
    Route::get('/order/{id}/create', 'MainController@createorder')->name('main.order.create');
    Route::post('/order/{id}/store', 'MainController@storeorder')->name('main.order.store');
    Route::get('/orders', 'MainController@indexorder')->name('main.order.index');
    Route::get('/orders/all', 'MainController@buyAll')->name('main.order.all');
    Route::post('/orders/all', 'MainController@storeBuyAll')->name('main.order.storeAll');
});