<?php

namespace App\Http\Controllers;

use App\Models\PersonalMessage;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalMessageController extends Controller
{
    /**
     * Display a listing of the resource.
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
