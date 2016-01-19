<?php

namespace App\Providers;

use App\TodoList;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view) {
            $userId = auth()->user()->id;//user can be retrieved only after the middleware is called
            $lists = TodoList::where('user_id', $userId)->get();
            $view->with('lists', $lists);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
