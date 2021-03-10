<?php

namespace App\Services;

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

	public function showComments($comments)
	{
		// Изменяем коллекцию.
		$comments->transform(function ($comment) use ($comments) {
			// Добавляем к каждому комментарию дочерние комментарии.
			$comment->children = $comments->where('parent_comment_id', '=', $comment->id);

			return $comment;
		});

		// Удаляем из коллекции комментарии у которых есть родители.
		$comments = $comments->reject(function ($comment) {
			return $comment->parent_comment_id !== 0;
		});

		return $comments;
	}
}