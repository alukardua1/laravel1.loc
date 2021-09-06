<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackShipped;
use Illuminate\Http\Request;
use Mail;

class FeedbackController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		return view($this->frontend . 'feedback.index');
	}

	public function store(Request $request)
	{
		$post = $request->all();
		Mail::to('admin@anime-free.ru')->send(new FeedbackShipped($post));
		return back();
	}
}
