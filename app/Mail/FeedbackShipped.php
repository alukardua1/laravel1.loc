<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackShipped extends Mailable
{
	use Queueable;
	use SerializesModels;

	public array $post;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($post)
	{
		$this->post = $post;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
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
