<?php


namespace App\Repository;


use App\Models\Category;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Model;
use App\Models\MPAARating;
use App\Models\Quality;
use App\Models\Studio;
use App\Models\Translate;
use App\Repository\Interfaces\DLEParse;
use App\Services\CurlTrait;
use File;
use Illuminate\Support\Facades\DB;
use Storage;
use Str;

/**
 * Class DLEParseRepository
 *
 * @package App\Repository
 */
class DLEParseRepository implements DLEParse
{
	use CurlTrait;

	/**
	 * @return mixed
	 */
	public function parseCategory()
	{
		$categories = DB::connection("mysql2")->table('dle_category')->select(
			['id', 'name', 'alt_name', 'fulldescr']
		)->get();
		foreach ($categories as $value) {
			$category[] = [
				'id'          => $value->id,
				'title'       => $value->name,
				'url'         => $value->alt_name,
				'description' => $value->fulldescr,
			];
		}
		return $category;
	}

	/**
	 * @return mixed
	 */
	public function parseUser()
	{
		$users = DB::connection("mysql2")->table('dle_users')->select(['*'])->get();
		foreach ($users as $user) {
			$result[] = [
				'id'       => $user->user_id,
				'login'    => $user->name,
				'name'     => $user->fullname,
				'group_id' => $user->user_group,
				'email'    => $user->email,
			];
		}
		return $result;
	}

	private function status($xfieldStatus)
	{
		switch ($xfieldStatus) {
			case 'released':
				$result['anons'] = 0;
				$result['ongoing'] = 0;
				break;
			case 'ongoing':
				$result['ongoing'] = 1;
				break;
			case 'anons':
				$result['anons'] = 1;
				break;
		}

		return $result;
	}

	private function kind($tip)
	{
		switch ($tip) {
			case 'OVA':
				return 1;
			case 'фильм':
				return 2;
			case 'ТВ':
				return 3;
			case 'ONA':
				return 4;
			case 'музыкальное видео':
				return 5;
			case 'спешл':
				return 6;
		}
	}

	/**
	 * @param  null  $id
	 *
	 * @return mixed
	 */
	public function parsePost($id = null)
	{
		if ($id) {
			$posts = DB::connection("mysql2")->table('dle_post')->select(['*'])->where('id', '=', $id)->get();
		} else {
			$posts = DB::connection("mysql2")->table('dle_post')->select(['*'])->get();
		}
		foreach ($posts as $post) {
			$xfield1 = [];
			$xfields = explode('||', $post->xfields);
			foreach ($xfields as $value) {
				$xfield = explode('|', $value);
				$xfield1[$xfield['0']] = $xfield['1'];
			}
			$xfield1 = $this->status($xfield1['status']);
			$kind = $this->kind($xfield1['tip']);
			if (isset($xfield1['translyaciya'])) {
				preg_match_all('/[0-5][0-9]:[0-5][0-9]/', $xfield1['translyaciya'], $xfield1['broadcast']);
			}
			$image = $this->imageFunc($post, 'http://anime-free.ru/uploads/posts/' . $xfield1['izobrazhenie']);
			$mpaa = MPAARating::where('name', $xfield1['rating'])->first();
			$categ = explode(',', $post->category);
			foreach ($categ as $value) {
				$catAnime = [
					'anime_id'    => $post->id,
					'category_id' => $value,
				];
				DB::table('anime_category')->insert($catAnime);
			}
			if (array_key_exists('url_world_art', $xfield1)) {
				$link['anime_id'] = $post->id;
				$link['title'] = 'world-art';
				$link['url'] = $xfield1['url_world_art'];
				DB::table('other_links')->insert($link);
			}
			if (array_key_exists('shikimori_id', $xfield1)) {
				$link['anime_id'] = $post->id;
				$link['title'] = 'shikimori';
				$link['url'] = 'https://shikimori.one/animes/' . $xfield1['shikimori_id'];
				DB::table('other_links')->insert($link);
			}
			if (array_key_exists('myanimelist-id', $xfield1)) {
				$link['anime_id'] = $post->id;
				$link['title'] = 'myanimelist';
				$link['url'] = 'https://myanimelist.net/anime/' . $xfield1['myanimelist-id'];
				DB::table('other_links')->insert($link);
			}
			if (array_key_exists('kinopoisk_id', $xfield1)) {
				$link['anime_id'] = $post->id;
				$link['title'] = 'kinopoisk';
				$link['url'] = 'https://www.kinopoisk.ru/series/' . $xfield1['kinopoisk_id'];
				DB::table('other_links')->insert($link);
			}
			if (array_key_exists('studiya', $xfield1)) {
				$this->addBelongs($xfield1['studiya'], $post, 'studio_id', Studio::class, 'anime_studio');
			}
			if (array_key_exists('proizvodstvo', $xfield1)) {
				$this->addBelongs($xfield1['proizvodstvo'], $post, 'country_id', Country::class, 'anime_country');
			}
			if (array_key_exists('quality', $xfield1)) {
				$this->addBelongs($xfield1['quality'], $post, 'quality_id', Quality::class, 'anime_quality');
			}
			if (array_key_exists('ozvuchka', $xfield1)) {
				$this->addBelongs($xfield1['ozvuchka'], $post, 'translate_id', Translate::class, 'anime_translate');
			}
			if (array_key_exists('kanal', $xfield1)) {
				$channel = Channel::where('name', $xfield1['kanal'])->first();
			} else {
				$channel = collect('id');
				$channel->id = 0;
			}
			if (!$mpaa) {
				$mpaa = collect('id');
				$mpaa->id = 1;
			}
			$result[] = [
				'id'                 => $post->id,
				'user_id'            => 1,
				'original_img'       => $image['original_img'],
				'preview_img'        => $image['preview_img'],
				'anons'              => $xfield1['anons'] ?? 0,
				'ongoing'            => $xfield1['ongoing'] ?? 0,
				'metatitle'          => $post->metatitle,
				'keywords'           => $post->keywords,
				'name'               => $post->title,
				'russian'            => $post->title,
				'url'                => $post->alt_name,
				'kind_id'            => $kind,
				'channel_id'         => $channel->id,
				'status'             => $xfield1['status'],
				'broadcast'          => $xfield1['broadcast'][0][0] ?? null,
				'aired_season'       => $xfield1['sezon'] ?? null,
				'episodes'           => $xfield1['serias-col'] ?? null,
				'episodes_aired'     => $xfield1['seriya'] ?? null,
				'aired_on'           => $this->dates($xfield1['data-vypuska'] ?? null),
				'released_on'        => $this->dates($xfield1['data-okonchaniya'] ?? null),
				'rating_id'          => $mpaa->id,
				'english'            => $xfield1['po-angliyski'] ?? null,
				'japanese'           => $xfield1['po-yaponski'] ?? null,
				'synonyms'           => $xfield1['nazvanie-romadzi'] ?? null,
				'duration'           => $xfield1['dlitelnost'] ?? null,
				'description'        => $post->short_story,
				'description_html'   => $post->short_story,
				'description_source' => $post->short_story,
				'franchise'          => null,
				'player'             => $xfield1['kodik'] ?? null,
				'trailer'            => $xfield1['treyler'] ?? null,
				'created_at'         => date('Y-m-d', strtotime($post->date)),
				'updated_at'         => date('Y-m-d', strtotime($post->date)),
			];
		}

		return $result;
	}

	/**
	 * @param $xfield
	 * @param $post
	 * @param $columns
	 * @param $model
	 * @param $table
	 */
	private function addBelongs($xfield, $post, $columns, $model, $table)
	{
		$data = [];
		$xfieldDle = explode(', ', $xfield);
		foreach ($xfieldDle as $value) {
			$result = $model::where('name', $value)->first();
			if ($result) {
				$data[] = ['anime_id' => $post->id, $columns => $result->id];
			}
		}
		DB::table($table)->insert($data);
		//return $data;
	}

	/**
	 * @param $dates
	 *
	 * @return false|string|null
	 */
	private function dates($dates)
	{
		if ($dates) {
			return date('Y-m-d', strtotime($dates));
		}
		return null;
	}

	/**
	 * @param $anime
	 * @param $image
	 *
	 * @return string[]
	 */
	private function imageFunc($anime, $image)
	{
		$def = '/';
		$path_info = pathinfo($image);
		$Extension = $path_info['extension'];
		$fileName = 'anime_' . $anime->id . '.' . $Extension;
		$pathImg = $def . 'anime/' . $anime->id . '_' . Str::slug($anime->title) . '/';//путь к большой картинке
		$pathImgThumb = $pathImg . 'thumb/';                                           //путь к уменьшеной картинке
		$pathImgSave = $def . 'anime/' . $anime->id . '_' . Str::slug($anime->title) . '/';
		$pathImgSaveThumb = $pathImgSave . 'thumb';

		$imgName = $pathImg . $fileName;
		if (!Storage::exists($imgName)) {
			Storage::putFileAs($pathImg, $image, $fileName);     //запись картинки
			Storage::putFileAs($pathImgThumb, $image, $fileName);//запись уменьшеной картинки
		}

		$result = [
			'original_img' => $pathImg . $fileName,
			'preview_img'  => $pathImgThumb . $fileName,
		];

		return $result;
	}

	/**
	 * @return mixed|void
	 */
	public function parseQualityAnime()
	{
	}

	/**
	 * @return mixed
	 */
	public function parsePostCategory()
	{
		$category = DB::connection("mysql2")->table('dle_post')->select(['*'])->get();
		foreach ($category as $cat) {
			$categ = explode(',', $cat->category);
			foreach ($categ as $value) {
				$result[] = [
					'anime_id'    => $cat->id,
					'category_id' => $value,
				];
			}
		}

		return $result;
	}

	/**
	 * @return array|mixed
	 */
	public function parseChannel()
	{
		$channel = DB::connection("mysql2")->table('dle_post')->select(['*'])->get();

		foreach ($channel as $value) {
			$xfields = explode('||', $value->xfields);
			foreach ($xfields as $value) {
				$xfield = explode('|', $value);
				$xfield1[$xfield['0']] = $xfield['1'];
			}
			$channels = explode(', ', $xfield1['kanal']);

			foreach ($channels as $values) {
				$result[] = [
					'name'          => $values,
					'filtered_name' => $values,
					'url'           => Str::slug($values),
				];
			}
		}
		$result = $this->array_unique_key($result, 'name');
		return $result;
	}

	/**
	 * @param $array
	 * @param $key
	 *
	 * @return array
	 */
	protected function array_unique_key($array, $key)
	{
		$tmp = $key_array = [];
		$i = 0;

		foreach ($array as $val) {
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$tmp[$i] = $val;
			}
			$i++;
		}
		return $tmp;
	}

	/**
	 * @return mixed|void
	 */
	public function parseComments()
	{
		//$comments = DB::connection("mysql2")->table('dle_comments')->select(['*'])->get();
	}

	/**
	 * @return mixed|void
	 */
	public function parsePerson()
	{
		// TODO: Implement parsePerson() method.
	}

	/**
	 * @return mixed|void
	 */
	public function parseStudio()
	{
		$url = 'https://shikimori.one/api/studios';

		$studios = $this->getCurl($url);

		foreach ($studios as $studio) {
			$result[] = [
				'name'          => $studio['name'],
				'filtered_name' => $studio['filtered_name'],
				'url'           => Str::slug($studio['name']),
			];
		}

		return $result;
	}

	/**
	 * @param $url
	 *
	 * @return array
	 */
	public function parseKodik($url)
	{
		$result = [];
		$kodik = $this->getCurl($url);

		foreach ($kodik['results'] as $value) {
			$result[] = $value['title'];
		}

		return $result;
	}

	/**
	 * @param $url
	 *
	 * @return array
	 */
	public function parseKodikQuality($url)
	{
		$result = [];
		$kodik = $this->getCurl($url);

		foreach ($kodik as $value) {
			$result[] = $value['title'];
		}

		return $result;
	}
}
