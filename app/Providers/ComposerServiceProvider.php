<?php

namespace App\Providers;

use App\Http\ViewComposers\AnonsComposer;
use App\Http\ViewComposers\CarouselAnimeComposer;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\CountryComposer;
use App\Http\ViewComposers\KindComposer;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\MpaaRatingComposer;
use App\Http\ViewComposers\PopularComposer;
use App\Http\ViewComposers\QualityComposer;
use App\Http\ViewComposers\TranslateComposer;
use App\Http\ViewComposers\YearComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
    	\View::composer('*', CategoryComposer::class);
	    \View::composer('*', KindComposer::class);
	    \View::composer('*', CarouselAnimeComposer::class);
	    \View::composer('*', MpaaRatingComposer::class);
	    \View::composer('*', TranslateComposer::class);
	    \View::composer('*', YearComposer::class);
	    \View::composer('*', CountryComposer::class);
	    \View::composer('*', QualityComposer::class);
	    \View::composer('*', AnonsComposer::class);
	    \View::composer('*', PopularComposer::class);
    }
}
