<?php


namespace App\Repository;


use App\Models\Channel;
use App\Models\MPAARating;
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
	 * @var string[]
	 */
	protected static $array_tip = [
		'ТВ'                => 'tv',
		'OVA'               => 'ova',
		'фильм'             => 'movie',
		'ONA'               => 'ona',
		'спешл'             => 'special',
		'музыкальное видео' => 'music',
	];

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
			switch ($xfield1['status']) {
				case 'released':
					$xfield1['anons'] = 0;
					$xfield1['ongoing'] = 0;
					break;
				case 'ongoing':
					$xfield1['ongoing'] = 1;
					break;
				case 'anons':
					$xfield1['anons'] = 1;
					break;
			}
			switch ($xfield1['tip']) {
				case 'ТВ':
					$kind = 3;
					break;
				case 'OVA':
					$kind = 1;
					break;
				case 'фильм':
					$kind = 2;
					break;
				case 'ONA':
					$kind = 4;
					break;
				case 'спешл':
					$kind = 6;
					break;
				case 'музыкальное видео':
					$kind = 5;
					break;
			}
			if (isset($xfield1['translyaciya'])) {
				preg_match_all('/[0-5][0-9]:[0-5][0-9]/', $xfield1['translyaciya'], $xfield1['broadcast']);
			}
			$image = $this->imageFunc($post, 'http://anime-free.ru/uploads/posts/' . $xfield1['izobrazhenie']);
			$mpaa = MPAARating::where('name', $xfield1['rating'])->first();
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

	private function dates($dates)
	{
		if ($dates) {
			return date('Y-m-d', strtotime($dates));
		}
		return null;
	}

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
			//$channels = array_unique($channels);
			//dd(__METHOD__, $channels);
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
}
