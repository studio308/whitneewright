<?php namespace App\Providers;

use App\Categories;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer('layouts.header', function($view)
        {
            $categories = Categories::all();
            return $view->with('categories', $categories);
        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}