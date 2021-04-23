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
		View::composer(['web.frontend.layout.component.menu', 'web.backend.anime.edit', 'web.backend.anime.add'], CategoryComposer::class);
		View::composer(['web.frontend.layout.component.kind', 'web.backend.anime.edit', 'web.backend.anime.add'], KindComposer::class);
		View::composer(['web.frontend.anime.component.carousel', 'web.backend.anime.edit', 'web.backend.anime.add'], CarouselAnimeComposer::class);
		View::composer(['web.frontend.layout.component.mpaa', 'web.backend.anime.edit', 'web.backend.anime.add'], MpaaRatingComposer::class);
		View::composer(['web.frontend.layout.component.translate', 'web.backend.anime.edit', 'web.backend.anime.add', 'web.frontend.order.order_add'], TranslateComposer::class);
		View::composer(['web.frontend.layout.component.year', 'web.backend.anime.edit', 'web.backend.anime.add'], YearComposer::class);
		View::composer(['web.frontend.layout.component.country', 'web.frontend.user.profile', 'web.backend.anime.edit', 'web.backend.anime.add'], CountryComposer::class);
		View::composer(['web.frontend.layout.component.quality', 'web.backend.anime.edit', 'web.backend.anime.add'], QualityComposer::class);
		View::composer(['web.frontend.anime.component.anons'], AnonsComposer::class);
		View::composer(['web.frontend.anime.component.popular'], PopularComposer::class);
		View::composer(['web.backend.anime.edit', 'web.backend.anime.add'], ChannelComposer::class);
		View::composer(['web.backend.anime.edit', 'web.backend.anime.add'], UserComposer::class);
		View::composer(['web.backend.anime.edit', 'web.backend.anime.add'], StudioComposer::class);
		View::composer(['web.backend.anime.edit', 'web.backend.anime.add'], GeoBlockComposer::class);
		View::composer(['web.backend.anime.edit', 'web.backend.anime.add'], CopyrightHolderComposer::class);
	}
}
