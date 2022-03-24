<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        view()->composer('layout.sidebar', function(\Illuminate\View\View $view) {            
            $view->with('tagsCloud', \App\Models\Tag::has('articles')->get());
        });

        Paginator::defaultSimpleView('vendor.pagination.simple-default');
    }
}
