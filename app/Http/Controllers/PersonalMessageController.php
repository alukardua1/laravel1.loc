<?php

namespace App\Http\Controllers;

use App\Models\PersonalMessage;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class PersonalMessageController
 *
 * @package App\Http\Controllers
 */
class PersonalMessageController extends Controller
{
	/**
	 * PersonalMessageController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @param  \App\Models\User  $user
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(User $user)
    {
        dd(__METHOD__, $user);
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
     * @param  \App\Models\PersonalMessage  $personalMessage
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalMessage $personalMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalMessage  $personalMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalMessage $personalMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalMessage  $personalMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalMessage $personalMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalMessage  $personalMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalMessage $personalMessage)
    {
        //
    }
}
