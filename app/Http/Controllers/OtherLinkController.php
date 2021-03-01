<?php

namespace App\Http\Controllers;

use App\Models\OtherLink;
use Illuminate\Http\Request;

/**
 * Class OtherLinkController
 *
 * @package App\Http\Controllers
 */
class OtherLinkController extends Controller
{
	/**
	 * OtherLinkController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\OtherLink  $otherLink
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(OtherLink $otherLink)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\OtherLink  $otherLink
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(OtherLink $otherLink)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\OtherLink     $otherLink
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, OtherLink $otherLink)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\OtherLink  $otherLink
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(OtherLink $otherLink)
	{
		//
	}
}
