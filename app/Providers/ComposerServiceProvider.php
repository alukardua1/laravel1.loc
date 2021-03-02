<?php

namespace App\Providers;

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
	    view()->composer(
		    'web.frontend.layout.menu',
		    'App\Http\ViewComposers\MenuComposer'
	    );
	    view()->composer(
		    'web.frontend.layout.kind',
		    'App\Http\ViewComposers\KindComposer'
	    );
	    view()->composer(
	    	'web.frontend.anime.component.carousel',
		    'App\Http\ViewComposers\CarouselAnimeComposer'
	    );
	    view()->composer(
		    'web.frontend.layout.mpaa',
		    'App\Http\ViewComposers\MpaaRatingComposer'
	    );
    }
}
