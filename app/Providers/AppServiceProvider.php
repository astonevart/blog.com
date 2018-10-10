<?php

namespace App\Providers;

use App\Category;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Vinkla\Instagram\Instagram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->composer('layout', function ($view){
            $view->with('popularPosts',Post::orderBy('views','desc')->take(3)->get());
            $view->with('featuredPosts',Post::where('is_featured',1)->take(3)->get());
            $view->with('recentPosts',Post::orderBy('date','desc')->take(3)->get());
            $view->with('categoriesPosts',Category::all());
           $view->with('instagram',new Instagram('2226444125.1677ed0.a338c12153344616bfd6b798d1a99171'));
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
