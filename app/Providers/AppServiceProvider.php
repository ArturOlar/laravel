<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // данные для header
        view()->composer('user.layout.header', function ($view) {
            $view->with('categories', Category::take(5)->get());
            $view->with('tags', Tag::take(15)->get());
        });

        // данные для sidebar
        view()->composer('user.layout.sidebar', function($view) {
           $view->with('newsByStatus', News::newsByStatus());
        });

        // данные для footer
        view()->composer('user.layout.footer', function ($view) {
            $view->with('categoriesFooter', Category::take(15)->get());
            $view->with('tagsFooter', Tag::take(15)->get());
            $view->with('newsByStatusFooter', Status::take(15)->get());
            $view->with('authors', Author::take(15)->get());
        });
    }
}
