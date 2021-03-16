<?php

namespace App\Providers;

use App\Http\ViewComposers\AnonsComposer;
use App\Http\ViewComposers\CarouselAnimeComposer;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\ChannelComposer;
use App\Http\ViewComposers\CountryComposer;
use App\Http\ViewComposers\KindComposer;
use App\Http\ViewComposers\MenuComposer;
use App\Http\ViewComposers\MpaaRatingComposer;
use App\Http\ViewComposers\PopularComposer;
use App\Http\ViewComposers\QualityComposer;
use App\Http\ViewComposers\StudioComposer;
use App\Http\ViewComposers\TranslateComposer;
use App\Http\ViewComposers\UserComposer;
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
    	\View::composer(['web.frontend.layout.component.menu', 'web.backend.anime.edit'], CategoryComposer::class);
	    \View::composer(['web.frontend.layout.component.kind', 'web.backend.anime.edit'], KindComposer::class);
	    \View::composer(['web.frontend.anime.component.carousel', 'web.backend.anime.edit'], CarouselAnimeComposer::class);
	    \View::composer(['web.frontend.layout.component.mpaa', 'web.backend.anime.edit'], MpaaRatingComposer::class);
	    \View::composer(['web.frontend.layout.component.translate', 'web.backend.anime.edit'], TranslateComposer::class);
	    \View::composer(['web.frontend.layout.component.year', 'web.backend.anime.edit'], YearComposer::class);
	    \View::composer(['web.frontend.layout.component.country', 'web.backend.anime.edit'], CountryComposer::class);
	    \View::composer(['web.frontend.layout.component.quality', 'web.backend.anime.edit'], QualityComposer::class);
	    \View::composer(['web.frontend.anime.component.anons'], AnonsComposer::class);
	    \View::composer(['web.frontend.anime.component.popular'], PopularComposer::class);
	    \View::composer('web.backend.anime.edit', ChannelComposer::class);
	    \View::composer('web.backend.anime.edit', UserComposer::class);
	    \View::composer('web.backend.anime.edit', StudioComposer::class);
    }
}
