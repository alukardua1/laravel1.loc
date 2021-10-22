<?php

namespace App\Services;

use App\Http\Requests\AnimeRequest;
use App\Models\AnimeRelated;
use App\Models\OtherLink;
use App\Models\Player;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use URL;

/**
 * Trait FunctionTrait
 *
 * @package App\Services
 */
trait FunctionTrait
{
	/**
	 * Проверяет наличие данных в запросе
	 *
	 * @param  mixed  $post  запись
	 */
	public function isNotNull($post)
	{
		abort_if(empty($post), 404);
	}

	/**
	 * Формирование RSS потока
	 *
	 * @param  mixed   $feed
	 * @param  mixed   $posts
	 * @param  string  $title
	 * @param  string  $description
	 *
	 * @return mixed
	 */
	public function getRss(mixed $feed, mixed $posts, string $title = '', string $description = ''): mixed
	{
		$feed->title = $title ?? '☆AnimeFree☆ - смотреть аниме в русской озвучке';
		$feed->description = $description ?? '☆AnimeFree☆ - смотреть аниме на русском без регистрации';
		$feed->logo = 'http://yoursite.tld/logo.jpg';
		$feed->link = $title ? url('feed') . '/user/' . $title : url('feed');
		$feed->setDateFormat('datetime');
		$feed->pubdate = $posts[0]->created_at ?? date('date');
		$feed->lang = 'en';
		$feed->setShortening(true);
		$feed->setTextLimit(100);
		$feed->setCustomView($this->frontend . 'feed.rss_yandex');

		foreach ($posts as $post) {
			$feed->addItem(
				[
					'title'       => $post->name,
					'author'      => $post->getUser->login,
					'link'        => URL::to("/anime/" . $post->id . "-" . $post->url),
					'pubdate'     => date("r", strtotime($post->updated_at)),
					'description' => $post->description,
					'content'     => $post->description_html,
					'category'    => $post->getCategory,
					'poster'      => asset('storage/' . $post->original_img),
				]
			);
		}

		return $feed;
	}

	/**
	 * Формирование комментариев
	 *
	 * @param  mixed  $comments  Запись
	 *
	 * @return mixed
	 */
	public function showComments(mixed $comments): mixed
	{
		// Изменяем коллекцию.
		$comments->transform(
			function ($comment) use ($comments) {
				// Добавляем к каждому комментарию дочерние комментарии.
				if ($comment->trashed()) {
					$comment->description_html = 'комментарий удален';
				}
				$comment->children = $comments->where('parent_comment_id', '=', $comment->id);

				return $comment;
			}
		);

		// Удаляем из коллекции комментарии у которых есть родители.
		$comments = $comments->reject(
			function ($comment) {
				return $comment->parent_comment_id !== 0;
			}
		);

		return $comments->sortByDesc('created_at');
	}

	/**
	 * Запись в базу ссылок
	 *
	 * @param  mixed  $formRequest
	 * @param  int    $id
	 */
	public function setOtherLink(mixed $formRequest, int $id)
	{
		foreach ($formRequest['otherLink_title'] as $key => $value) {
			if ($formRequest['otherLink_url'][$key]) {
				$formRequest['otherLink'][$key]['anime_id'] = $id;
				$formRequest['otherLink'][$key]['title'] = $formRequest['otherLink_title'][$key];
				if ($formRequest['otherLink_title'][$key] == 'World-Art') {
					$formRequest['otherLink'][$key]['id_link'] = $this->parseWA($formRequest['otherLink_url'][$key]);
				} else {
					$formRequest['otherLink'][$key]['id_link'] = $this->parseLink($formRequest['otherLink_url'][$key]);
				}
				$formRequest['otherLink'][$key]['url'] = $formRequest['otherLink_url'][$key];
			}
			$find = ['anime_id' => $id, 'id_link' => $formRequest['otherLink'][$key]['id_link'], 'title' => $formRequest['otherLink'][$key]['title']];

			$OtherLink[] = OtherLink::updateOrCreate($find, $formRequest['otherLink'][$key]);
		}
	}

	public function parseLink(string $url)
	{
		preg_match("/\d+/", $url, $id);

		return $id[0];
	}

	/**
	 * @param  string  $WALink
	 *
	 * @return mixed
	 */
	public function parseWA(string $WALink)
	{
		$wa = parse_url($WALink);
		parse_str($wa['query'], $id);

		return $id['id'];
	}

	/**
	 * запись в базу плееров
	 *
	 * @param  mixed  $formRequest
	 * @param  int    $id
	 */
	public function setPlayer(mixed $formRequest, int $id)
	{
		foreach ($formRequest['player_name'] as $key => $value) {
			if ($formRequest['player_url'][$key]) {
				$formRequest['player'][$key]['anime_id'] = $id;
				$formRequest['player'][$key]['name_player'] = $formRequest['player_name'][$key];
				$formRequest['player'][$key]['url_player'] = $formRequest['player_url'][$key];
			}
			$find = ['anime_id' => $id, 'name_player' => $formRequest['player'][$key]['name_player']];
			$player[] = Player::updateOrCreate($find, $formRequest['player'][$key]);
		}
	}

	/**
	 * Проверка input[type=check]
	 *
	 * @param  mixed   $requestCheck
	 * @param  string  $name
	 *
	 * @return int
	 */
	protected function check(mixed $requestCheck, string $name): int
	{
		if (!isset($requestCheck[$name])) {
			return 0;
		}
		return $requestCheck[$name];
	}

	/**
	 * Создает ключевые слова для поста
	 *
	 * @param  string  $contents
	 * @param  int     $symbol
	 * @param  int     $words
	 *
	 * @return string
	 */
	private function seoKeywords(string $contents, int $symbol = 5, int $words = 35): string
	{
		$contents = @preg_replace(["'<[\/\!]*?[^<>]*?>'si", "'([\r\n])[\s]+'si", "'&[a-z0-9]{1,6};'si", "'( +)'si"], ["", "\\1 ", " ", " "], strip_tags($contents));
		$rearray = [
			"~",
			"!",
			"@",
			"#",
			"$",
			"%",
			"^",
			"&",
			"*",
			"(",
			")",
			"_",
			"+",
			"`",
			'"',
			"№",
			";",
			":",
			"?",
			"-",
			"=",
			"|",
			"\"",
			"\\",
			"/",
			"[",
			"]",
			"{",
			"}",
			"'",
			",",
			".",
			"<",
			">",
			"\r\n",
			"\n",
			"\t",
			"«",
			"»",
		];
		$adjectivearray = [
			"ые",
			"ое",
			"ие",
			"ий",
			"ая",
			"ый",
			"ой",
			"ми",
			"ых",
			"ее",
			"ую",
			"их",
			"ым",
			"как",
			"для",
			"что",
			"или",
			"это",
			"этих",
			"всех",
			"вас",
			"они",
			"оно",
			"еще",
			"когда",
			"где",
			"эта",
			"лишь",
			"уже",
			"вам",
			"нет",
			"если",
			"надо",
			"все",
			"так",
			"его",
			"чем",
			"при",
			"даже",
			"мне",
			"есть",
			"только",
			"очень",
			"сейчас",
			"точно",
			"обычно",
		];

		$contents = @str_replace($rearray, " ", $contents);
		$keywordCache = @explode(" ", $contents);
		$rearray = [];

		foreach ($keywordCache as $word) {
			if (strlen($word) >= $symbol && !is_numeric($word)) {
				$adjective = substr($word, -2);
				if (!in_array($adjective, $adjectivearray, true) && !in_array($word, $adjectivearray, true)) {
					$rearray[$word] = (array_key_exists($word, $rearray)) ? ($rearray[$word] + 1) : 1;
				}
			}
		}
		@arsort($rearray);
		$keywordCache = @array_slice($rearray, 0, $words);
		$keywords = "";
		foreach ($keywordCache as $word => $count) {
			$keywords .= "," . $word;
		}

		return substr($keywords, 1);
	}

	/**
	 * Добавляет аттрибуты
	 *
	 * @param  array  $attributeArr
	 * @param  mixed  $showAnime
	 */
	public function setAttributes(array $attributeArr, mixed $showAnime)
	{
		foreach ($attributeArr as $key => $value) {
			if ($showAnime->$value) {
				$showAnime->$key = $showAnime->$value;
			}
		}
	}

	/**
	 * Добавляет регион блокировки
	 *
	 * @param  mixed  $showAnime
	 * @param  array  $showPlayerGroup
	 *
	 * @return string
	 */
	public function showPlayer(mixed $showAnime, array $showPlayerGroup): string
	{
		if (Auth::user()) {
			$groupId = Auth::user()->getGroup->id;
		} else {
			$groupId = 0;
		}
		if (($showAnime->getRegionBlock->isNotEmpty()) and (!in_array($groupId, $showPlayerGroup))) {
			foreach ($showAnime->getRegionBlock as $item) {
				$regionBlock[] = $item->code;
			}
			return implode(',', $regionBlock);
		} else {
			return '';
		}
	}

	/**
	 * проверяет checked
	 *
	 * @param  array  $arrCheck  массив [поле => модель]
	 * @param  mixed  $formRequest
	 * @param  mixed  $update    обновляемая запись
	 */
	private function checkRequest(array $arrCheck, mixed $formRequest, mixed $update)
	{
		foreach ($arrCheck as $key => $value) {
			if (array_key_exists($key, $formRequest)) {
				$update->$key = $this->check($formRequest, $value);
			}
		}
	}

	/**
	 * Синхронизация моделей
	 *
	 * @param  array  $arrSync  массив [поле => модель]
	 * @param  mixed  $update   обновляемая запись
	 * @param  mixed  $request
	 */
	protected function syncRequest(array $arrSync, mixed $update, mixed $request)
	{
		foreach ($arrSync as $key => $value) {
			if (array_key_exists($key, $request->all())) {
				$update->fill($request->except($key));
				$update->$value()->sync($request[$key]);
			}
		}
	}

	/**
	 * @param  mixed   $request    Запрос
	 * @param  string  $route      Маршрут
	 * @param  string  $textError  Текст выводимой ошибки
	 * @param  null    $id         ID записи
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function ifErrorAddUpdate(mixed $request, string $route, string $textError, $id = null): RedirectResponse
	{
		if ($request) {
			return redirect()->route($route, $id);
		}

		return back()->withErrors(['msg' => $textError])->withInput();
	}

	public function morfDate(mixed $date, string $format)
	{
		return Carbon::parse($date)->format($format);
	}

	/**
	 * @param  mixed  $showAnime
	 * @param  mixed  $repository
	 */
	public function updatePost(mixed $showAnime, mixed $repository)
	{
		$extendLink_id = $showAnime->getOtherLink()->where('title', 'shikimori')->first();
		$shikimori = $this->parseShikimori($extendLink_id->id_link, $showAnime);
		$extendLink = $this->getShikimoriOtherLink($extendLink_id->id_link);
		$kodik = $this->parseKodik(env('KODIK_TOKEN', ''), $extendLink_id->id_link);
		$channel_id = ['channel_id' => $showAnime->channel_id];
		$request = array_merge($shikimori, $extendLink, $kodik, $channel_id);
		if (array_key_exists('update', $request)) {
			$request = new AnimeRequest($request);
			$repository->setAnime($request, $showAnime->id);
		}
	}

	/**
	 * @param  mixed  $showAnime
	 *
	 * @return mixed
	 */
	public function addRelated(mixed $showAnime): mixed
	{
		$related = AnimeRelated::where('anime_id', $showAnime->id)->get();
		if (count($related) != 6) {
			$related = $showAnime->load('getCategory.getAnime')->inRandomOrder()->limit(6)->get();
			foreach ($related as $value) {
				$result = ['anime_id' => $showAnime->id, 'relation_id' => $value->id];
				AnimeRelated::create($result);
			}
			return AnimeRelated::where('anime_id', $showAnime->id)->get();
		}
		return $related;
	}

}