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
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', 'NewsController@allNews')->name('all-news');
    Route::prefix('/news')->group(function () {
        Route::get('/{name}', 'NewsController@oneNews')->name('one-news');
    });
    Route::post('/add-review', 'ReviewController@createReview')->name('add-review');

    Route::prefix('/category')->group(function () {
        Route::get('/all', 'CategoryController@allCategories')->name('all-categories');
        Route::get('/{name}', 'CategoryController@oneCategory')->name('one-category');
    });

    Route::prefix('/tag')->group(function () {
        Route::get('/all', 'TagController@allTags')->name('all-tags');
        Route::get('/{id}', 'TagController@oneTag')->name('one-tag');
    });

    Route::prefix('/news-by-status')->group(function () {
        Route::get('/{id}', 'StatusController@allNewsByStatus')->name('news-by-status');
    });
});


Route::get('/auth/facebook', 'Auth\LoginController@authFacebook')->name('auth-facebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@callbackFacebook')->name('callback-facebook');
Route::get('/auth/github', 'Auth\LoginController@authGithub')->name('auth-github');
Route::get('/auth/github/callback', 'Auth\LoginController@callbackGithub')->name('callback-github');


Route::prefix('/admin')->namespace('Admin')->middleware('auth')->group(function () {
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

    Route::prefix('/user')->group(function () {
        Route::get('/all', 'UserController@allUsers')->name('all-users');
        Route::post('/changeStatus/{id}', 'UserController@changeStatus')->name('change-status');
    });
    
    Route::prefix('/parser')->group(function () {
        Route::get('/', 'ParserController@allParsers')->name('all-parsers');
        Route::get('/rbc', 'ParserController@parserRBC')->name('parser-rbc');
        Route::get('/112', 'ParserController@parser112')->name('parser-112');
        Route::get('/korrespondent', 'ParserController@parserKorrespondent')->name('parser-korrespondent');
    });
});

Auth::routes();
//['register' => false]
