<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\PersonalMessage;

class CommentObserver
{
	/**
	 * Handle the Comment "created" event.
	 *
	 * @param  \App\Models\Comment  $comment
	 */
	public function created(Comment $comment)
	{
		if ($comment->parent_comment_id) {
			$pm = new PersonalMessage();
			$pm->author_id = 1;
			$pm->recipient_id = $comment->user_id;
			$pm->title = 'Появился новый комментарий';
            $pm->description = $comment->description;
            $pm->save();
		}

	}

	/**
	 * Handle the Comment "updated" event.
	 *
	 * @param  \App\Models\Comment  $comment
	 *
	 * @return void
	 */
	public function updated(Comment $comment)
	{
		//
	}

	/**
	 * Handle the Comment "deleted" event.
	 *
	 * @param  \App\Models\Comment  $comment
	 *
	 * @return void
	 */
	public function deleted(Comment $comment)
	{
		//
	}

	/**
	 * Handle the Comment "restored" event.
	 *
	 * @param  \App\Models\Comment  $comment
	 *
	 * @return void
	 */
	public function restored(Comment $comment)
	{
		//
	}

	/**
	 * Handle the Comment "force deleted" event.
	 *
	 * @param  \App\Models\Comment  $comment
	 *
	 * @return void
	 */
	public function forceDeleted(Comment $comment)
	{
		//
	}
}
