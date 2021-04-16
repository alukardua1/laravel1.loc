<?php

namespace App\Services;

use App\Models\OtherLink;
use App\Models\Player;
use Auth;

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
	 * @param $post
	 */
	public function isNotNull($post)
	{
		abort_if(empty($post), 404);
	}

	/**
	 * Формирование RSS потока
	 *
	 * @param          $feed
	 * @param          $posts
	 * @param  string  $title
	 * @param  string  $description
	 *
	 * @return mixed
	 */
	public function getRss($feed, $posts, $title = '', $description = ''): mixed
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
					'link'        => \URL::to("/anime/{$post->id}-{$post->url}"),
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
	 * @param $comments
	 *
	 * @return mixed
	 */
	public function showComments($comments): mixed
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
	 * @param       $formRequest
	 * @param  int  $id
	 */
	public function setOtherLink($formRequest, int $id)
	{
		foreach ($formRequest['otherLink_title'] as $key => $value) {
			if ($formRequest['otherLink_url'][$key]) {
				$formRequest['otherLink'][$key]['anime_id'] = $id;
				$formRequest['otherLink'][$key]['title'] = $formRequest['otherLink_title'][$key];
				$formRequest['otherLink'][$key]['url'] = $formRequest['otherLink_url'][$key];
			}
			$find = ['anime_id' => $id, 'title' => $formRequest['otherLink'][$key]['title']];
			$OtherLink[] = OtherLink::updateOrCreate($find, $formRequest['otherLink'][$key]);
		}
	}

	/**
	 * запись в базу плееров
	 *
	 * @param       $formRequest
	 * @param  int  $id
	 */
	public function setPlayer($formRequest, int $id)
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
	 * @param          $requestCheck
	 * @param  string  $name
	 *
	 * @return int
	 */
	protected function check($requestCheck, string $name): int
	{
		if (!isset($requestCheck[$name])) {
			return 0;
		}
		return $requestCheck[$name];
	}

	/**
	 * Создает ключевые слова для поста
	 *
	 * @param       $contents
	 * @param  int  $symbol
	 * @param  int  $words
	 *
	 * @return string
	 */
	private function seoKeywords($contents, $symbol = 5, $words = 35): string
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
	 * @param  array  $attributeArr
	 * @param  mixed  $showAnime
	 */
	public function setAttributes(array $attributeArr, mixed $showAnime)
	{
		foreach ($attributeArr as $key=>$value)
		{
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
	public function showPlayer(mixed $showAnime, array $showPlayerGroup)
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
	 * @param  array  $arrCheck массив [поле => модель]
	 * @param  mixed  $formRequest
	 * @param  mixed  $update обновляемая запись
	 */
	private function checkRequest(array $arrCheck, mixed $formRequest, mixed $update)
	{
		foreach ($arrCheck as $key => $value) {
			$update->$key = $this->check($formRequest, $value);
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
			$update->fill($request->except($key));
			$update->$value()->sync($request[$key]);
		}
	}
}