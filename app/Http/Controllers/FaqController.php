<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Repository\Interfaces\FaqRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function index()
	{
		$allFaq = $this->faqRepository->getFaq()->paginate($this->paginate);

		return view($this->frontend . 'faq.index', compact('allFaq'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Faq  $faq
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Faq $faq)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Faq  $faq
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Faq $faq)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Faq           $faq
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Faq $faq)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Faq  $faq
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Faq $faq)
	{
		//
	}
}
