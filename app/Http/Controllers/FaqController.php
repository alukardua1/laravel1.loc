<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FaqRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FaqController extends Controller
{
	protected FaqRepositoryInterfaces $faqRepository;

	public function __construct(FaqRepositoryInterfaces $faqRepository)
	{
		parent::__construct();
		$this->faqRepository = $faqRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): Application|Factory|View
	{
		$allFaq = $this->faqRepository->getFaq()->paginate(20);

		return view($this->frontend . 'faq.index', compact('allFaq'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $faq
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(string $faq): View|Factory|Application
	{
		$faqShow = $this->faqRepository->getFaq($faq)->first();

		return view($this->frontend . 'faq.show', compact('faqShow'));
	}
}
