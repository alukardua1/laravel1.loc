<?php

namespace App\Repository;

use App\Services\CurlTrait;
use App\Services\KodikTrait;
use Config;
use DB;

class KodikRepository implements Interfaces\KodikRepositoryInterfaces
{
	use CurlTrait;
	use KodikTrait;

	private string $tokenKodik;
	private string $player;
	private string $series;
	private string $translate;
	private string $idKP;
	private string $idWA;
	private string $idShiki;
	private string $idMDL;

	public function __construct()
	{
		$this->tokenKodik = '?token=' . env('KODIK_TOKEN');
		$this->player = Config::get('kodik.player', 'player');
		$this->series = Config::get('kodik.series', 'series');
		$this->translate = Config::get('kodik.translate', 'translate');
		$this->idKP = Config::get('kodik.idKP', 'idKP');
		$this->idWA = Config::get('kodik.idWA', 'idWA');
		$this->idShiki = Config::get('kodik.idShiki', 'idShiki');
		$this->idMDL = Config::get('kodik.idMDL', 'idMDL');
	}

	/**
	 * @param  string|null  $category
	 * @param  string|null  $page
	 *
	 * @return mixed
	 */
	public function listKodik(string $category = null, string $page = null): mixed
	{
		$category = $this->category($category);
		$json = $this->getCurl('https://kodikapi.com/list' . $this->tokenKodik . '&with_material_data=true' . $this->isKodik($category, '&types=') . $this->isKodik($page, '&page='));
		$button = $this->createButton(['prev_page' => $json['prev_page'] ?? null, 'next_page' => $json['next_page'] ?? null]);
		foreach ($json['results'] as $key => $value) {
			if (array_key_exists('shikimori_id', $value)) {
				$db = DB::table('other_links')->where('title', 'Shikimori')->where('id_link', 'like', '%' . $value['shikimori_id'])->first();
			} else {
				$db = null;
			}
			$json['results'][$key]['other_link'] = $this->link($value);
			$json['results'][$key]['created_at'] = 'Добавлен: ' . $this->mutateDat($value['created_at']);
			$json['results'][$key]['updated_at'] = 'Обновлен: ' . $this->mutateDat($value['updated_at']);
			if ($db) {
				$anime = DB::table('animes')->where('id', $db->anime_id)->first();
				$player = DB::table('players')->where('anime_id', $db->anime_id)->first();
				$translate = DB::table('anime_translate')->where('anime_id', $db->anime_id)->join('translates', 'anime_translate.translate_id', '=', 'translates.id')->get();
				$this->isPlayer($player, $key, $db, $anime, $json, $value);
				$this->isTranslate($translate, $value, $json, $key);
				$this->isSeries($anime->episodes_aired, $value, $json, $key);
			} else {
				$json['results'][$key]['link_update'] = $value['title'] . '/' . $value['title_orig'];
				$json['results'][$key]['translate_update'] = $value['translation']['title'];
				$json['results'][$key]['last_episode_update'] = $value['last_episode'];
			}
			//dd(__METHOD__, $value['translation']['id'], $translate->contains('translate_id', $value['translation']['id']));
		}

		return $result = ['json' => $json['results'], 'button' => $button];
	}

	public function searchKodik(string $optionsSearch, string $search): mixed
	{
		$json = $this->getCurl('https://kodikapi.com/list' . $this->tokenKodik . '&with_material_data=true' . $optionsSearch . $search);

		dd(__METHOD__, $json);
	}
}