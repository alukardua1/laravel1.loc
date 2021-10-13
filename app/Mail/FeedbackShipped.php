<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackShipped extends Mailable
{
	use Queueable;
	use SerializesModels;

	public array $post;

	/**
	 * @param  mixed  $post
	 */
	public function __construct(mixed $post)
	{
		$this->post = $post;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): static
	{
		$text = $this->post['message1'];
		return $this->from($this->post['email'])
			->subject($this->post['name'])
			->view('emails.email')
			->with([
				       'login'    => $this->post['login'],
				       'message1' => $text,
			       ]);
	}
}
