<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * View Composer → shares $navCategories (live from MongoDB) with
     * header.blade.php on EVERY page automatically.
     * When admin adds a new category it instantly appears in the navbar.
     */
    public function boot(): void
    {
        View::composer('header', function ($view) {
            $view->with('navCategories', Category::orderBy('category_name')->get());
        });
    }
}
