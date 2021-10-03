<?php

namespace App\Observers;

use App\Http\Requests\AnimeRequest;
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
		//$translate = [];
		$translateArr = $anime->getTranslate()->get()->toArray();
		if (!empty($translateArr)) {
			foreach ($translateArr as $item) {
				$item['name'] = str_replace(' / ', ' - ', $item['name']);
				$translate[] = $item['name'];
			}
		} else {
			$translate[] = ' в озвучке не указана';
		}
		$translate = implode(', ', $translate);
		$translate = ' серия в озвучке ' . $translate;

		if ($anime->getYear()->first()) {
			$year = $anime->getYear()->first()->name . ' года ';
		}

		if ($anime->episodes_aired) {
			$episode = $anime->episodes_aired . ' серия ';
		}
		$anime->russian = $anime->name;

		$metatitle = $anime->name . ' ' . $year . $episode . $translate;
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
