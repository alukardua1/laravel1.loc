<?php

namespace App\Providers;

use App\Models\Anime;
use App\Models\Category;
use App\Models\Comment;
use App\Observers\AnimeObserver;
use App\Observers\CategoryObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    Comment::observe(CommentObserver::class);
	    Anime::observe(AnimeObserver::class);
	    Category::observe(CategoryObserver::class);
    }
}
