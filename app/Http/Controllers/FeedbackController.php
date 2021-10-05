<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackShipped;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
	public function index(): View|Factory|Application
	{
		return view($this->frontend . 'feedback.index');
	}

	public function store(Request $request): RedirectResponse
	{
		$post = $request->all();
		Mail::to('admin@anime-free.ru')->send(new FeedbackShipped($post));
		return back();
	}
}
