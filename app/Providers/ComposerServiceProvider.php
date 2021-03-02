<?php

namespace App\Providers;

use App\Http\ViewComposers\CarouselAnimeComposer;
use App\Http\ViewComposers\CountryComposer;
use App\Http\ViewComposers\KindComposer;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\MpaaRatingComposer;
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
    	\View::composer('web.frontend.layout.menu', MenuComposer::class);
	    \View::composer('web.frontend.layout.kind', KindComposer::class);
	    \View::composer('web.frontend.anime.component.carousel', CarouselAnimeComposer::class);
	    \View::composer('web.frontend.layout.mpaa', MpaaRatingComposer::class);
	    \View::composer('web.frontend.layout.translate', TranslateComposer::class);
	    \View::composer('web.frontend.layout.year', YearComposer::class);
	    \View::composer('web.frontend.layout.country', CountryComposer::class);
	    \View::composer('web.frontend.layout.quality', QualityComposer::class);
    }
}
