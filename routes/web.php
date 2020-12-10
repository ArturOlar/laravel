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

Route::prefix('/')->namespace('User')->group(function () {

    Route::get('/', 'NewsController@allNews')->name('all-news');
    Route::prefix('/news')->group(function () {
        Route::get('/{name}', 'NewsController@oneNews')->name('one-news');
    });

    Route::prefix('/category')->group(function () {
        Route::get('/all', 'CategoryController@allCategories')->name('all-categories');
        Route::get('/{name}', 'CategoryController@oneCategory')->name('one-category');
    });

    Route::prefix('/tag')->group(function () {
        Route::get('/all', 'TagController@allTags')->name('all-tags');
        Route::get('/{id}', 'TagController@oneTag')->name('one-tag');
    });

    Route::post('/add-review', 'ReviewController@createReview')->name('add-review');

    Route::get('/authors', function () {
        return view('user.author.authors');
    });
});

Route::prefix('/admin')->namespace('Admin')->group(function() {
    Route::resource('/news', 'NewsController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::resource('/author', 'AuthorController');
    Route::resource('/status', 'StatusController');

    Route::post('/delete-image', 'NewsImageController@deleteImage')->name('delete-image');

    Route::prefix('/review')->group(function () {
        Route::get('/new', 'ReviewController@newReview')->name('new-review');
        Route::get('/publish', 'ReviewController@publishReview')->name('publish-review');
        Route::get('/canceled', 'ReviewController@canceledReview')->name('canceled-review');
        Route::post('/publish', 'ReviewController@addToPublishReview')->name('add-to-publish-review');
        Route::post('/canceled', 'ReviewController@addToCanceledReview')->name('add-to-canceled-review');
    });
});