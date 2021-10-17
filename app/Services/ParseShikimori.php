<?php


namespace App\Services;


use App\Models\Kind;
use App\Models\MPAARating;
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

	protected mixed  $dataShiki;
	protected string $fieldsStudios = '';
	protected mixed  $dataVideo;
	protected array  $voiceArr      = [];
	protected string $voice         = '';
	protected string $player        = '';
	protected array  $episodes      = [];
	protected array  $seasoned      = [];
	protected array  $qualityArr    = [];
	protected array  $studiosArr    = [];
	protected array  $array_tip     = [
		'tv'      => 'ТВ',
		'ova'     => 'OVA',
		'movie'   => 'фильм',
		'ona'     => 'ONA',
		'special' => 'спешл',
		'music'   => 'музыкальное видео',
	];
	protected array  $array_rating  = [
		'g'      => 'G',
		'pg'     => 'PG',
		'pg_13'  => 'PG-13',
		'r'      => 'R-17',
		'r_plus' => 'R+',
		'none'   => 'Нет',
		'rx'     => 'Хентай',
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
	 *
	 * @return array
	 */
	public function parseShikimori(string $id): array
	{
		$url = "https://shikimori.one/api/animes/$id";
		$headers = @get_headers($url);
		$this->dataShiki = $this->getCurl($url);
		if ($this->shikimoriError($this->dataShiki)) {
			foreach ((array)$this->dataShiki['studios'] as $key) {
				$studios[] = Studio::firstOrCreate(['title' => $key['name']], ['title' => $key['name'], 'url' => Str::slug($key['name'])])->id;
			}
			if ($this->dataShiki['english'][0]) {
				$shiki['english'] = $this->dataShiki['english'][0];
			}
			if ($this->dataShiki['name']) {
				$shiki['japanese'] = $this->dataShiki['name'];
			}
			if ($this->dataShiki['japanese'][0]) {
				$shiki['japanese'] = $this->dataShiki['japanese'][0];
			}
			if ($this->dataShiki['rating']) {
				$shiki['rating_id'] = MPAARating::where('url', $this->dataShiki['rating'])->first()->id;
			}
			if ($this->dataShiki['aired_on']) {
				$shiki['aired_on'] = date('Y-m-d', strtotime($this->dataShiki['aired_on']));
			}
			if ($this->dataShiki['released_on']) {
				$shiki['released_on'] = date('d.m.Y', strtotime($this->dataShiki['released_on']));
			}
			if ($this->dataShiki['episodes']) {
				$shiki['episodes'] = $this->dataShiki['episodes'];
			}
			if ($this->dataShiki['status'] == 'anons') {
				$shiki['anons'] = 1;
			}
			if ($this->dataShiki['status'] == 'ongoing') {
				$shiki['ongoing'] = 1;
			}
			if ($this->dataShiki['duration']) {
				$shiki['duration'] = $this->dataShiki['duration'];
			}
			if ($this->dataShiki['kind']) {
				$shiki['kind_id'] = Kind::where('name', $this->dataShiki['kind'])->first()->id;
			}
			if ($this->studiosArr) {
				$shiki['studios'] = $this->studiosArr;
			}
			if ($this->dataShiki['franchise']) {
				$shiki['franchise'] = $this->dataShiki['franchise'];
			}
			if ($this->dataShiki['russian']) {
				$shiki['russian'] = $this->dataShiki['russian'];
			}
			if ($this->dataShiki['name']) {
				$shiki['origin'] = $this->dataShiki['name'];
			}
			$shiki['channel_id'] = null;
		}

		return $shiki;
	}

	public function getShikimoriOtherLink(string $id)
	{
		$url = "https://shikimori.one/api/animes/$id/external_links";
		$headers = @get_headers($url);
		$this->dataShiki = $this->getCurl($url);
		foreach ($this->dataShiki as $value) {
			if ($value['kind'] === 'myanimelist') {
				$result['otherLink_title'][] = 'MyAnimeList';
				$result['otherLink_url'][] = $value['url'];
			}
			if ($value['kind'] === 'world_art') {
				$result['otherLink_title'][] = 'World-Art';
				$result['otherLink_url'][] = $value['url'];
			}
			if ($value['kind'] === 'anime_db') {
				$result['otherLink_title'][] = 'AnimeDB';
				$result['otherLink_url'][] = $value['url'];
			}
		}

		return $result;
	}

	/**
	 * @param  string  $apiTokens
	 * @param  string  $shikimoriId
	 *
	 * @return array
	 */
	public function parseKodik(string $apiTokens, string $shikimoriId)
	{
		$this->dataVideo = $this->getCurl("https://kodikapi.com/search?token={$apiTokens}&shikimori_id={$shikimoriId}");
		$translate = Translate::get();
		foreach ((array)$this->dataVideo['results'] as $item) {
			$item['translation']['title'] = str_replace('/', '-', $item['translation']['title']);
			$this->voiceArr[] = Translate::firstOrCreate(['title' => $item['translation']['title']], ['title' => $item['translation']['title'], 'url' => Str::slug($item['translation']['title'])])->id;
			$this->qualityArr[] = Quality::firstOrCreate(['title' => $item['quality']], [['title' => $item['quality'], 'url' => Str::slug($item['quality'])]])->id;
			$this->player = $item['link'];
			$this->episodes[] = $item['last_episode'] ?? 1;
			$this->seasoned[] = $item['last_season'] ?? 1;
		}
		array_multisort($this->dataVideo['results'], SORT_ASC);
		$this->dataVideo['results'] = array_values(
			Arr::sort($this->dataVideo['results'], function ($value) {
				return $value['updated_at'];
			})
		);
		$data['updates'] = $this->morfDate(Arr::last($this->dataVideo['results'])['updated_at'], 'Y-m-d H:m:s');
		$data['translate'] = $this->voiceArr;
		$data['quality'] = array_unique($this->qualityArr);
		$data['player_name'][] = 'kodik';
		$data['player_url'][] = $this->player;
		$episodes = max($this->episodes);
		$seasoned = max($this->seasoned);
		$data['episodes_aired'] = $episodes;

		return $data;
	}
}