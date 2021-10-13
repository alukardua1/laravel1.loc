<?php

namespace App\Repository;

use App\Services\CurlTrait;
use App\Services\KodikTrait;
use Config;

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

	/**
	 *
	 */
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
		$category = '&types=' . $category;
		if ($page) {
			$page = '&page=' . $page;
		}
		$json = $this->getCurl('https://kodikapi.com/list' . $this->tokenKodik . '&with_material_data=true' . $category . $page);
		$button = $this->createButton(['prev_page' => $json['prev_page'] ?? null, 'next_page' => $json['next_page'] ?? null]);

		dd(__METHOD__, $json, $button);
	}

	public function searchKodik(string $optionsSearch, string $search): mixed
	{
		$json = $this->getCurl('https://kodikapi.com/list' . $this->tokenKodik . '&with_material_data=true' . $optionsSearch . $search);

		dd(__METHOD__, $json);
	}
}