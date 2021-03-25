<?php

namespace App\Observers;

use App\Models\Anime;
use App\Services\FunctionTrait;
use Str;

class AnimeObserver
{
	use FunctionTrait;

	/**
	 * Handle the Anime "created" event.
	 *
	 * @param  \App\Models\Anime  $anime
	 *
	 * @return void
	 */
	public function created(Anime $anime)
	{
		//
	}

	/**
	 * Handle the Anime "updated" event.
	 *
	 * @param  \App\Models\Anime  $anime
	 *
	 * @return void
	 */
	public function updated(Anime $anime)
	{
		//
	}

	/**
	 * @param  \App\Models\Anime  $anime
	 */
	public function saving(Anime $anime)
	{
		$translateArr = $anime->getTranslate()->get()->toArray();
		foreach ($translateArr as $item) {
			$translate[] = $item['name'];
		}
		$translate = implode(', ', $translate);

		$metatitle = $anime->name . ' ' . $anime->getYear()->first()->name . ' года ' . $anime->episodes_aired . ' серия в озвучке ' . $translate;
		$url = $anime->name . ' ' . $anime->episodes_aired . ' серия';
		$anime->metatitle = $metatitle;
		$anime->url = Str::slug($url);
		$description = strip_tags($anime->description_html);
		$anime->keywords = $this->seoKeywords($description);
		$anime->description = $description;
	}

	/**
	 * Handle the Anime "deleted" event.
	 *
	 * @param  \App\Models\Anime  $anime
	 *
	 * @return void
	 */
	public function deleted(Anime $anime)
	{
		//
	}

	/**
	 * Handle the Anime "restored" event.
	 *
	 * @param  \App\Models\Anime  $anime
	 *
	 * @return void
	 */
	public function restored(Anime $anime)
	{
		//
	}

	/**
	 * Handle the Anime "force deleted" event.
	 *
	 * @param  \App\Models\Anime  $anime
	 *
	 * @return void
	 */
	public function forceDeleted(Anime $anime)
	{
		//
	}
}
