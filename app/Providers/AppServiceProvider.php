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
            if(!auth()->user()) return;

            $userId = auth()->user()->id;//user can be retrieved only after the middleware is called
            $lists = TodoList::where('user_id', $userId)->get();
            $view->with('lists', $lists);
        });

        if(config('database.default') == 'sqlite'){
            $db = app()->make('db');
            $db->connection()->getPdo()->exec("pragma foreign_keys=1");
        }
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
