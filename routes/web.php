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
    // роутеры авторизации, регистрации
    Auth::routes();
    Route::get('/auth/facebook', 'Auth\LoginController@authFacebook')->name('auth-facebook');
    Route::get('/auth/facebook/callback', 'Auth\LoginController@callbackFacebook')->name('callback-facebook');
    Route::get('/auth/github', 'Auth\LoginController@authGithub')->name('auth-github');
    Route::get('/auth/github/callback', 'Auth\LoginController@callbackGithub')->name('callback-github');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', 'NewsController@allNews')->name('all-news');
    Route::prefix('/news')->group(function () {
        Route::get('/search', 'NewsController@searchNews')->name('search-news');
        Route::get('/{slug}', 'NewsController@oneNews')->name('one-news');
    });

    Route::post('/add-review', 'ReviewController@createReview')->name('add-review');

    Route::prefix('/category')->group(function () {
        Route::get('/all', 'CategoryController@allCategories')->name('all-categories');
        Route::get('/{slug}', 'CategoryController@oneCategory')->name('one-category');
    });

    Route::prefix('/tag')->group(function () {
        Route::get('/all', 'TagController@allTags')->name('all-tags');
        Route::get('/{slug}', 'TagController@oneTag')->name('one-tag');
    });

    Route::prefix('/news-by-status')->group(function () {
        Route::get('/{slug}', 'StatusController@allNewsByStatus')->name('news-by-status');
    });
});

Route::prefix('/admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('/news', 'NewsController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::resource('/author', 'AuthorController');
    Route::resource('/status', 'StatusController');

    Route::post('/delete-image', 'NewsController@deleteImage')->name('delete-image');

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
    
    Route::prefix('/parser')->namespace('Parser')->group(function () {
        // парсинг вручную
        Route::get('/', 'ParserController@allParsers')->name('all-parsers');
        Route::get('/rbc', 'ParserController@parserRBC')->name('parser-rbc');
        Route::get('/112', 'ParserController@parser112')->name('parser-112');
        Route::get('/korrespondent', 'ParserController@parserKorrespondent')->name('parser-korrespondent');
        Route::get('/newsru', 'ParserController@ParserNewsru')->name('parser-news-ru');

        // CRUD операции для парсинга
        Route::get('/allLinksParser', 'ParserCRUDController@allLinksParser')->name('all-links-parser');
        Route::get('/createLinkParser', 'ParserCRUDController@createLinkParser')->name('create-link-parser');
        Route::post('/storeLinkParser', 'ParserCRUDController@storeLinkParser')->name('store-link-parser');
        Route::get('/editLinkParser/{id}', 'ParserCRUDController@editLinkParser')->name('edit-link-parser');
        Route::post('/updateLinkParser', 'ParserCRUDController@updateLinkParser')->name('update-link-parser');
        Route::get('/deleteLinkParser/{id}', 'ParserCRUDController@deleteLinkParser')->name('delete-link-parser');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});