<?php

namespace App\Services;

use App\Models\OtherLink;
use App\Models\Player;

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
	 * @param mixed $post
	 */
	public function isNotNull($post)
	{
		abort_if(empty($post), 404);
	}

	/**
	 * @param          $feed
	 * @param          $posts
	 * @param  string  $title
	 * @param  string  $description
	 *
	 * @return mixed
	 */
	public function getRss($feed, $posts, $title = '', $description = '')
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
	 * @param $comments
	 *
	 * @return mixed
	 */
	public function showComments($comments)
	{
		// Изменяем коллекцию.
		$comments->transform(function ($comment) use ($comments) {
			// Добавляем к каждому комментарию дочерние комментарии.
			if ($comment->trashed()) {
				$comment->description_html = 'комментарий удален';
			}
			$comment->children = $comments->where('parent_comment_id', '=', $comment->id);

			return $comment;
		});

		// Удаляем из коллекции комментарии у которых есть родители.
		$comments = $comments->reject(function ($comment) {
			return $comment->parent_comment_id !== 0;
		});

		return $comments->sortByDesc('created_at');
	}

	/**
	 * @param $formRequest
	 * @param $id
	 */
	public function setOtherLink($formRequest, $id)
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
	 * @param $formRequest
	 * @param $id
	 */
	public function setPlayer($formRequest, $id)
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
	 * @param $requestCheck
	 * @param $name
	 *
	 * @return int
	 */
	protected function check($requestCheck, $name)
	{
		if (!isset($requestCheck[$name])) {
			return 0;
		}
		return $requestCheck[$name];
	}
}