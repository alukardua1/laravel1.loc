<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use Illuminate\Http\Request;

/**
 * Class QualityController
 *
 * @package App\Http\Controllers
 */
class QualityController extends Controller
{
	/**
	 * QualityController constructor.
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
	 * @param  \App\Models\Quality  $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Quality $quality)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Quality  $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Quality $quality)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Quality       $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Quality $quality)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Quality  $quality
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Quality $quality)
	{
		//
	}
}
