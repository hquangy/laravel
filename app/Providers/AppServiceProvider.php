<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // $this->app['request']->server->set('HTTPS', true);
        Schema::defaultStringLength(191);
        $categories = Category::orderBy('order')
        ->with('products')
        ->get();
        View::share('categories', $categories);
    }

    public function register()
    {
        //
    }
}
