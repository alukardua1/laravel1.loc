<?php


namespace App\Services;


use App\Models\Kind;
use App\Models\MPAARating;
use App\Models\OtherLink;
use App\Models\Quality;
use App\Models\Studio;
use App\Models\Translate;
use Illuminate\Support\Arr;
use Str;

/**
 * Trait ParseShikimori
 *
 * @package App\Services
 */
trait ParseShikimori
{
	use CurlTrait;
	use FunctionTrait;

	private mixed  $dataShiki;
	private string $fieldsStudios = '';
	private array  $voiceArr      = [];
	private string $voice         = '';
	private string $player        = '';
	private array  $episodes      = [];
	private array  $seasoned      = [];
	private array  $qualityArr    = [];
	private array  $studiosArr    = [];
	private array  $array_tip     = [
		'tv'      => 'ТВ',
		'ova'     => 'OVA',
		'movie'   => 'фильм',
		'ona'     => 'ONA',
		'special' => 'спешл',
		'music'   => 'музыкальное видео',
	];
	private array  $array_rating  = [
		'g'      => 'G',
		'pg'     => 'PG',
		'pg_13'  => 'PG-13',
		'r'      => 'R-17',
		'r_plus' => 'R+',
		'none'   => 'Нет',
		'rx'     => 'Хентай',
	];
	private array  $extendLink    = [
		'myanimelist'        => 'MyAnimeList',
		'world_art'          => 'World-Art',
		'anime_db'           => 'AnimeDB',
		'kinopoisk'          => 'Kinopoisk',
		'anime_news_network' => 'Anime News Network',
		'kage_project'       => 'Kage Project',
	];

	/**
	 * @param  mixed  $data
	 *
	 * @return bool
	 */
	public function shikimoriError(mixed $data): bool
	{
		return !($data === null);
	}

	/**
	 * @param  string  $id
	 * @param  mixed   $anime
	 *
	 * @return array
	 */
	public function parseShikimori(string $id, mixed $anime): array
	{
		$url = "https://shikimori.one/api/animes/$id";
		$headers = @get_headers($url);
		$this->dataShiki = $this->getCurl($url);
		if ($this->shikimoriError($this->dataShiki)) {
			foreach ((array)$this->dataShiki['studios'] as $key) {
				$studios[] = Studio::firstOrCreate(['title' => $key['name']], ['title' => $key['name'], 'url' => Str::slug($key['name'])])->id;
			}
			if ($this->dataShiki['russian'] != $anime->russian) {
				$shiki['russian'] = $this->dataShiki['russian'];
				$shiki['update'] = true;
			}
			if ($this->dataShiki['name'] != $anime->name) {
				$shiki['name'] = $this->dataShiki['name'];
				$shiki['update'] = true;
			}
			if (implode(', ', $this->dataShiki['english']) != $anime->english) {
				$shiki['english'] = implode(', ', $this->dataShiki['english']);
				$shiki['update'] = true;
			}
			if (implode(', ', $this->dataShiki['synonyms']) != $anime->synonyms) {
				$shiki['synonyms'] = implode(', ', $this->dataShiki['synonyms']);
				$shiki['update'] = true;
			}
			if (implode(', ', $this->dataShiki['japanese']) != $anime->japanese) {
				$shiki['japanese'] = implode(', ', $this->dataShiki['japanese']);
				$shiki['update'] = true;
			}
			if ($this->dataShiki['rating']) {
				$shiki['rating_id'] = MPAARating::where('url', $this->dataShiki['rating'])->first()->id;
			}
			if ($this->dataShiki['aired_on'] != $anime->aired_on) {
				$shiki['aired_on'] = date('Y-m-d', strtotime($this->dataShiki['aired_on']));
				$shiki['update'] = true;
			}
			if ($this->dataShiki['released_on'] != $anime->released_on) {
				$shiki['released_on'] = date('Y-m-d', strtotime($this->dataShiki['released_on']));
				$shiki['update'] = true;
			}
			if (date('c', strtotime($this->dataShiki['next_episode_at'])) != date('c', strtotime($anime->next_episode_at))) {
				$shiki['next_episode_at'] = date('Y-m-d H:i:s', strtotime($this->dataShiki['next_episode_at']));
				$shiki['update'] = true;
			}
			if ($this->dataShiki['episodes'] != $anime->episodes) {
				$shiki['episodes'] = $this->dataShiki['episodes'];
				$shiki['update'] = true;
			}
			if ($this->dataShiki['status'] == 'anons') {
				$shiki['anons'] = 1;
			}
			if ($this->dataShiki['status'] == 'ongoing') {
				$shiki['ongoing'] = 1;
			}
			if ($this->dataShiki['duration'] != $anime->duration) {
				$shiki['duration'] = $this->dataShiki['duration'];
				$shiki['update'] = true;
			}
			if ($this->dataShiki['kind']) {
				$shiki['kind_id'] = Kind::where('name', $this->dataShiki['kind'])->first()->id;
			}
			if ($this->studiosArr) {
				$shiki['studios'] = $this->studiosArr;
			}
			/*if ($this->dataShiki['franchise'] != $anime->franchise) {
				$shiki['franchise'] = $this->dataShiki['franchise'];
				$shiki['update'] = true;
			}*/
			$shiki['channel_id'] = null;
		}

		return $shiki;
	}

	/**
	 * @param  string  $id
	 *
	 * @return array
	 */
	public function getShikimoriOtherLink(string $id)
	{
		$url = "https://shikimori.one/api/animes/$id/external_links";
		$headers = @get_headers($url);
		$this->dataShiki = $this->getCurl($url);
		foreach ($this->dataShiki as $value) {
			if (array_key_exists($value['kind'], $this->extendLink)) {
				$result['otherLink_title'][] = $this->extendLink[$value['kind']];
				$result['otherLink_url'][] = $value['url'];
				$kind = OtherLink::where('url', $value['url'])->first();
				if (!$kind) {
					$result['update'] = true;
				}
			}
		}

		return $result;
	}

	/**
	 * @param  string  $id
	 */
	public function getShikimoriPeople(string $id)
	{
		$url = "https://shikimori.one/api/people/$id";
		$headers = @get_headers($url);
		$this->dataShiki = $this->getCurl($url);
		foreach ($this->dataShiki as $value) {
		}
	}

	/**
	 * @param  string  $apiTokens
	 * @param  string  $shikimoriId
	 *
	 * @return array
	 */
	public function parseKodik(string $apiTokens, string $shikimoriId)
	{
		$dataVideo = $this->getCurl("https://kodikapi.com/search?token={$apiTokens}&shikimori_id={$shikimoriId}");
		$translate = Translate::get();
		if ($dataVideo['results']) {
			foreach ((array)$dataVideo['results'] as $item) {
				$item['translation']['title'] = str_replace('/', '-', $item['translation']['title']);
				$this->voiceArr[] = Translate::firstOrCreate(['title' => $item['translation']['title']], ['title' => $item['translation']['title'], 'url' => Str::slug($item['translation']['title'])]
				)->id;
				$this->qualityArr[] = Quality::firstOrCreate(['title' => $item['quality']], [['title' => $item['quality'], 'url' => Str::slug($item['quality'])]])->id;
				$this->player = $item['link'];
				$this->episodes[] = $item['last_episode'] ?? 1;
				$this->seasoned[] = $item['last_season'] ?? 1;
			}
			array_multisort($dataVideo['results'], SORT_ASC);
			$dataVideo['results'] = array_values(
				Arr::sort($dataVideo['results'], function ($value) {
					return $value['updated_at'];
				})
			);
			$data['translate'] = $this->voiceArr;
			$data['quality'] = array_unique($this->qualityArr);
			$data['player_name'][] = 'kodik';
			$data['player_url'][] = $this->player;
			$episodes = max($this->episodes);
			$seasoned = max($this->seasoned);
			$data['episodes_aired'] = $episodes;

			return $data;
		}
		return $data = [];
	}
}