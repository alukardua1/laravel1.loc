<?php

namespace App\Providers;

use App\Http\ViewComposers\AnonsComposer;
use App\Http\ViewComposers\CarouselAnimeComposer;
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
    	\View::composer('web.frontend.layout.component.menu', MenuComposer::class);
	    \View::composer('web.frontend.layout.component.kind', KindComposer::class);
	    \View::composer('web.frontend.anime.component.carousel', CarouselAnimeComposer::class);
	    \View::composer('web.frontend.layout.component.mpaa', MpaaRatingComposer::class);
	    \View::composer('web.frontend.layout.component.translate', TranslateComposer::class);
	    \View::composer('web.frontend.layout.component.year', YearComposer::class);
	    \View::composer(['web.frontend.layout.component.country','web.frontend.user.profile'], CountryComposer::class);
	    \View::composer('web.frontend.layout.component.quality', QualityComposer::class);
	    \View::composer('web.frontend.anime.component.anons', AnonsComposer::class);
	    \View::composer('web.frontend.anime.component.popular', PopularComposer::class);
    }
}
