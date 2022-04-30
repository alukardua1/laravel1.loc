<?php

namespace App\Providers;

use App\Http\ViewComposers\AnonsComposer;
use App\Http\ViewComposers\CarouselAnimeComposer;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\ChannelComposer;
use App\Http\ViewComposers\CopyrightHolderComposer;
use App\Http\ViewComposers\CountryComposer;
use App\Http\ViewComposers\GeoBlockComposer;
use App\Http\ViewComposers\KindComposer;
use App\Http\ViewComposers\MpaaRatingComposer;
use App\Http\ViewComposers\PopularComposer;
use App\Http\ViewComposers\QualityComposer;
use App\Http\ViewComposers\StudioComposer;
use App\Http\ViewComposers\TranslateComposer;
use App\Http\ViewComposers\UserComposer;
use App\Http\ViewComposers\YearComposer;
use Illuminate\Support\ServiceProvider;
use View;

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
        view()->composer(['web.frontend.layout.app'], CarouselAnimeComposer::class);
        view()->composer(['web.frontend.layout.app'], AnonsComposer::class);
        view()->composer(['web.frontend.layout.app'], PopularComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add'], CategoryComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add'], KindComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add'], MpaaRatingComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add', 'web.frontend.order.*'], TranslateComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add'], YearComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.frontend.user.profile', 'web.backend.anime.edit', 'web.backend.anime.add'], CountryComposer::class);
        view()->composer(['web.frontend.layout.app', 'web.backend.anime.edit', 'web.backend.anime.add'], QualityComposer::class);
        view()->composer(['web.backend.anime.edit', 'web.backend.anime.add'], ChannelComposer::class);
        view()->composer(['web.backend.anime.edit', 'web.backend.anime.add'], UserComposer::class);
        view()->composer(['web.backend.anime.edit', 'web.backend.anime.add'], StudioComposer::class);
        view()->composer(['web.backend.anime.edit', 'web.backend.anime.add'], GeoBlockComposer::class);
        view()->composer(['web.backend.anime.edit', 'web.backend.anime.add'], CopyrightHolderComposer::class);
    }
}
