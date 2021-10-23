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
	 * Отслеживание добавления записи
	 *
	 * @param  \App\Models\Anime  $anime
	 */
	public function creating(Anime $anime)
	{
		$this->saving($anime);
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
	 * Отслеживание обновления записи
	 *
	 * @param  \App\Models\Anime  $anime
	 */
	public function saving(Anime $anime)
	{
		$year = '';
		$episode = '';
		$translate = [];
		$translateArr = $anime->getTranslate()->get()->toArray();
		if (!empty($translateArr)) {
			foreach ($translateArr as $item) {
				$item['title'] = str_replace(' / ', ' - ', $item['title']);
				$translate[] = $item['title'];
			}
		} else {
			$translate[] = ' без озвучивания';
		}
		$translate = ' серия в озвучке ' . implode(', ', $translate);
		if ($anime->getYear()->first()) {
			$year = $anime->getYear()->first()->year . ' года ';
		}
		if ($anime->episodes_aired) {
			$episode = $anime->episodes_aired . ' серия ';
		}
		$metatitle = $anime->russian . ' ' . $year . $episode . $translate;
		$url = $anime->name . ' ' . $anime->episodes_aired . ' серия';
		$anime->metatitle = $metatitle;
		$anime->url = Str::slug($url);
		$description = strip_tags($anime->description);
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
